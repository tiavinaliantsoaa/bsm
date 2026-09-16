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

    public function test_mail_failure_does_not_confirm_success_and_deletes_the_cv(): void
    {
        Storage::fake('local');

        Mail::shouldReceive('to')->once()->andThrow(new \RuntimeException('SMTP down'));

        $upload = UploadedFile::fake()->createWithContent(
            'cv.pdf',
            "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n",
        );

        $response = $this->from('/contact?motif=candidature')->post('/contact', $this->payload([
            'motif' => 'candidature',
            'poste' => 'commercial',
            'cv' => $upload,
        ]));

        $response->assertRedirect('/contact?motif=candidature');
        $response->assertSessionHasErrors('content');
        $response->assertSessionMissing('status');
        $this->assertSame([], Storage::disk('local')->allFiles());
    }

    public function test_filled_honeypot_is_rejected(): void
    {
        Mail::fake();

        $response = $this->from('/contact')->post('/contact', $this->payload([
            'website' => 'https://spam.example',
        ]));

        $response->assertRedirect('/contact');
        $response->assertSessionHasErrors('website');
        Mail::assertNothingSent();
    }

    public function test_contact_form_is_rate_limited(): void
    {
        Mail::fake();

        for ($i = 0; $i < 5; $i++) {
            $this->from('/contact')->post('/contact', $this->payload())->assertRedirect(route('contact.show'));
        }

        $this->from('/contact')->post('/contact', $this->payload())->assertStatus(429);
    }

    public function test_health_endpoint_is_not_public(): void
    {
        $this->get('/up')->assertNotFound();
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
