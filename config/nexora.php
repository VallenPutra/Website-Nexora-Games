<?php

return [
    // Ganti nomor ini di .env (NEXORA_WHATSAPP) — dipakai konsisten di
    // section kontak, floating button, dan footer.
    'whatsapp_number' => env('NEXORA_WHATSAPP', '6281234567890'),
    'whatsapp_message' => 'Halo Nexora Games, saya mau tanya-tanya soal game kalian!',

    // Email kontak resmi studio — dipakai di section kontak dan footer.
    'contact_email' => env('NEXORA_EMAIL', 'hello@nexoragames.com'),

    // Link sosial media studio — dipakai di footer (bagian SIGNAL).
    // Ganti nilainya di .env kalau sudah ada akun resminya.
    'steam_url' => env('NEXORA_STEAM_URL', '#'),
    'discord_url' => env('NEXORA_DISCORD_URL', '#'),
    'x_url' => env('NEXORA_X_URL', '#'),
];
