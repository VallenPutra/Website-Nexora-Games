<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora Games — Small Pixels. Big Adventures.</title>
    <link rel="icon" href="{{ asset('images/sun-icon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />
    <x-hero />
    <x-featured-game />
    <x-more-games />
    <x-philosophy />
    <x-devlog />
    <x-cta />
    <x-footer />
    <x-chat-bubble />
</body>
</html>
