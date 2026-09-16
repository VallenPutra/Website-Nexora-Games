<?php

return [
    // Ganti nomor ini di .env (NEXORA_WHATSAPP) — dipakai konsisten di
    // section kontak, floating button, dan footer.
    'whatsapp_number' => env('NEXORA_WHATSAPP', '6281234567890'),
    'whatsapp_message' => 'Halo Nexora Games, saya mau tanya-tanya soal game kalian!',

    // Email kontak resmi studio — dipakai di section kontak dan footer.
    'contact_email' => env('NEXORA_EMAIL', 'hello@nexoragames.com'),
];
