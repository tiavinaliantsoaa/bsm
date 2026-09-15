<!doctype html>
<html lang="fr">
<head><meta charset="UTF-8"><title>{{ ($data['motif'] ?? '') === 'candidature' ? 'Nouvelle candidature' : 'Nouveau message' }} – BSM-Services</title></head>
<body style="font-family: Arial, sans-serif; color:#1E232C; background:#F5F0E7; padding:24px;">
    <div style="max-width:600px; margin:auto; background:#fff; border-radius:12px; padding:28px;">
        <h1 style="margin:0 0 8px 0; font-size:20px;">
            {{ ($data['motif'] ?? '') === 'candidature' ? 'Nouvelle candidature via bsm-services.com' : 'Nouveau message via bsm-services.com' }}
        </h1>
        <p style="color:#6A7280; margin-top:0;">Reçu le {{ now()->translatedFormat('l d F Y à H:i') }}</p>
        <hr style="border:none; border-top:1px solid #E4E7EC; margin:20px 0;">

        <p><strong>Nom :</strong> {{ $data['name'] }} {{ $data['firstname'] }}</p>
        @isset ($data['company'])<p><strong>Entreprise :</strong> {{ $data['company'] ?: '—' }}</p>@endisset
        <p><strong>Email :</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
        @isset ($data['phone'])<p><strong>Téléphone :</strong> {{ $data['phone'] ?: '—' }}</p>@endisset
        @if (!empty($data['poste']))
            <p><strong>Poste :</strong> {{ $data['poste'] }}</p>
        @endif
        @if (!empty($cv['name']))
            <p><strong>CV :</strong> pièce jointe {{ $cv['name'] }}</p>
        @endif

        <h2 style="font-size:16px; margin-top:24px;">Message</h2>
        <p style="white-space:pre-wrap; line-height:1.6;">{{ $data['content'] }}</p>
    </div>
</body>
</html>
