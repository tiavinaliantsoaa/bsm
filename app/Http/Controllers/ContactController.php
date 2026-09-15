<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use App\Support\SafeUploadedFilename;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['cv', 'website']);
        $data['poste'] = $this->posteLabel($data['poste'] ?? null);

        $cv = null;
        if ($request->hasFile('cv')) {
            $upload = $request->file('cv');
            $safeName = SafeUploadedFilename::forCv($upload);
            $storedPath = $upload->storeAs('private/cvs', $safeName, 'local');

            $cv = [
                'disk' => 'local',
                'path' => $storedPath,
                'name' => $safeName,
                'mime' => $upload->getMimeType() ?: 'application/octet-stream',
            ];
        }

        try {
            Mail::to(config('mail.to.address'))->send(new ContactMessage($data, $cv));
        } catch (\Throwable $e) {
            logger()->warning('Contact form email failed', [
                'exception' => $e->getMessage(),
                'email' => $data['email'] ?? null,
                'motif' => $data['motif'] ?? null,
                'cv' => $cv['name'] ?? null,
            ]);
        }

        $query = [];
        if ($request->isCandidature()) {
            $query['motif'] = 'candidature';
            if ($request->filled('poste')) {
                $query['poste'] = $request->string('poste')->toString();
            }
        }

        return redirect()
            ->route('contact.show', $query)
            ->with('status', 'Merci ! Votre message a bien été envoyé. Nous revenons vers vous rapidement.');
    }

    private function posteLabel(?string $slug): ?string
    {
        if ($slug === null || $slug === '') {
            return null;
        }

        foreach (SiteData::recruitment()['jobs'] as $job) {
            if (($job['slug'] ?? '') === $slug) {
                return $job['title'];
            }
        }

        return $slug;
    }
}
