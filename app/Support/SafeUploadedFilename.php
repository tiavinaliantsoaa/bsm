<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * Builds a storage filename that never reuses the client-supplied name.
 * The original name is discarded: it is not a safe source of extension,
 * path segments, or executable suffixes.
 */
final class SafeUploadedFilename
{
    private const MIME_TO_EXT = [
        'application/pdf' => 'pdf',
        'application/x-pdf' => 'pdf',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
    ];

    private const ALLOWED_EXT = ['pdf', 'doc', 'docx'];

    public static function forCv(UploadedFile $file): string
    {
        $mime = strtolower((string) $file->getMimeType());
        $ext = self::MIME_TO_EXT[$mime] ?? null;

        if ($ext === null) {
            $guessed = strtolower((string) $file->guessExtension());
            $ext = in_array($guessed, self::ALLOWED_EXT, true) ? $guessed : null;
        }

        if ($ext === null) {
            throw new InvalidArgumentException('Type de fichier CV non autorisé.');
        }

        return 'cv-'.Str::ulid().'.'.$ext;
    }
}
