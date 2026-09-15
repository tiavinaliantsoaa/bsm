<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cv = $this->isCandidature()
            ? ['required', File::types(['pdf', 'doc', 'docx'])->max(5 * 1024)]
            : ['prohibited'];

        return [
            'name' => ['required', 'string', 'max:120'],
            'firstname' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['required', 'email:rfc'.(app()->environment('testing') ? '' : ',dns'), 'max:180'],
            'content' => ['required', 'string', 'min:20', 'max:5000'],
            'motif' => ['nullable', Rule::in(['contact', 'candidature'])],
            'poste' => ['nullable', 'string', 'max:80', 'alpha_dash'],
            'cv' => $cv,

            // Honeypot: legitimate users leave this blank; bots often fill it.
            'website' => ['nullable', 'size:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'firstname' => 'prénom',
            'company' => 'entreprise',
            'phone' => 'téléphone',
            'email' => 'e-mail',
            'content' => 'message',
            'cv' => 'CV',
        ];
    }

    public function messages(): array
    {
        return [
            'website.size' => 'Requête invalide.',
            'content.min' => 'Merci de nous en dire un peu plus (20 caractères minimum).',
            'cv.required' => 'Merci de joindre votre CV (PDF ou Word).',
            'cv.prohibited' => 'Le CV n’est accepté que pour une candidature.',
            'cv.max' => 'Le CV ne doit pas dépasser 5 Mo.',
            'cv.mimes' => 'Le CV doit être un fichier PDF ou Word (.pdf, .doc, .docx).',
            'cv.extensions' => 'Le CV doit être un fichier PDF ou Word (.pdf, .doc, .docx).',
            'cv.mimetypes' => 'Le CV doit être un fichier PDF ou Word (.pdf, .doc, .docx).',
        ];
    }

    public function isCandidature(): bool
    {
        return $this->input('motif') === 'candidature';
    }
}
