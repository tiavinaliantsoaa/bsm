<?php

namespace Tests\Feature;

use App\Mail\ContactMessage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_succeeds_without_a_cv(): void
    {
        Mail::fake();

        $response = $this->from('/contact')->post('/contact', $this->payload());

        $response->assertRedirect(route('contact.show'));
        Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) {
            return $mail->cv === null
                && $mail->envelope()->subject === 'Nouveau message – BSM-Services';
        });
    }

    public function test_candidature_requires_a_cv(): void
    {
        Mail::fake();

        $response = $this->from('/contact?motif=candidature')->post('/contact', $this->payload([
            'motif' => 'candidature',
        ]));

        $response->assertRedirect('/contact?motif=candidature');
        $response->assertSessionHasErrors('cv');
        Mail::assertNothingSent();
    }

    public function test_candidature_rejects_non_pdf_or_word_files(): void
    {
        Mail::fake();
        Storage::fake('local');

        $response = $this->from('/contact?motif=candidature')->post('/contact', $this->payload([
            'motif' => 'candidature',
            'cv' => UploadedFile::fake()->createWithContent('cv.txt', 'not a resume'),
        ]));

        $response->assertSessionHasErrors('cv');
        Mail::assertNothingSent();
    }

    public function test_candidature_stores_the_cv_under_a_generated_name(): void
    {
        Mail::fake();
        Storage::fake('local');

        $original = '../../cv.php.pdf';
        $upload = UploadedFile::fake()->createWithContent(
            $original,
            "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n",
        );

        $response = $this->from('/contact?motif=candidature')->post('/contact', $this->payload([
            'motif' => 'candidature',
            'poste' => 'commercial',
            'cv' => $upload,
        ]));

        $response->assertRedirect(route('contact.show', ['motif' => 'candidature', 'poste' => 'commercial']));
        $response->assertSessionHas('status');

        Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) use ($original) {
            $this->assertNotNull($mail->cv);
            $this->assertNotSame($original, $mail->cv['name']);
            $this->assertDoesNotMatchRegularExpression('/php|\.\./', $mail->cv['name']);
            $this->assertMatchesRegularExpression('/^cv-[0-9A-HJKMNP-TV-Z]{26}\.pdf$/', $mail->cv['name']);
            $this->assertSame('private/cvs/'.$mail->cv['name'], $mail->cv['path']);
            Storage::disk('local')->assertExists($mail->cv['path']);

            $attachments = $mail->attachments();
            $this->assertCount(1, $attachments);

            return $mail->data['motif'] === 'candidature';
        });
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Rabe',
            'firstname' => 'Hery',
            'email' => 'hery.rabe@example.com',
            'content' => 'Candidature — je souhaite rejoindre BSM-Services à Antananarivo.',
        ], $overrides);
    }
}
