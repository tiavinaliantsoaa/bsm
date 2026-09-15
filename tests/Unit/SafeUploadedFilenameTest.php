<?php

namespace Tests\Unit;

use App\Support\SafeUploadedFilename;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SafeUploadedFilenameTest extends TestCase
{
    public function test_it_never_reuses_the_client_filename(): void
    {
        $upload = UploadedFile::fake()->createWithContent(
            '../../evil.php.pdf',
            "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n",
        );

        $safe = SafeUploadedFilename::forCv($upload);

        $this->assertDoesNotMatchRegularExpression('/evil|php|\.\.|\//', $safe);
        $this->assertMatchesRegularExpression('/^cv-[0-9A-HJKMNP-TV-Z]{26}\.pdf$/', $safe);
        $this->assertNotSame($upload->getClientOriginalName(), $safe);
    }

    public function test_it_maps_word_mime_types_to_a_safe_extension(): void
    {
        $upload = $this->createPartialMock(UploadedFile::class, ['getMimeType', 'guessExtension', 'getClientOriginalName']);
        $upload->method('getMimeType')->willReturn('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $upload->method('guessExtension')->willReturn('bin');
        $upload->expects($this->never())->method('getClientOriginalName');

        $this->assertMatchesRegularExpression(
            '/^cv-[0-9A-HJKMNP-TV-Z]{26}\.docx$/',
            SafeUploadedFilename::forCv($upload),
        );
    }
}
