<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Nexora Games</title>
    <link rel="icon" href="{{ asset('images/sun-icon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <section class="bg-cream">
        <div class="mx-auto max-w-4xl px-6 pt-16 text-center md:pt-20">
            <span class="badge bg-navy text-cream">Get In Touch</span>
            <h1 class="font-pixel mt-4 text-2xl leading-[1.6] text-navy sm:text-3xl">CONTACT THE STUDIO</h1>
            <p class="mx-auto mt-4 max-w-md text-sm text-navy/70">
                Punya pertanyaan, ide kolaborasi, atau cuma mau say hi? Ini semua cara buat
                menghubungi kami.
            </p>
        </div>
    </section>

    <x-contact />

    <x-footer />
    <x-chat-bubble />
</body>
</html>
