<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#f6faf7]">

    <!-- BACKGROUND SOFT GREEN -->
    <div class="fixed inset-0 overflow-hidden -z-10">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-emerald-200/30 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-200/20 rounded-full blur-3xl"></div>

    </div>

    <!-- CENTER SLOT -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- INI TEMPAT LOGIN KAMU -->
        <div class="w-full sm:max-w-md">

            {{ $slot }}

        </div>

    </div>

</body>
</html>