<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind + DaisyUI -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    <!-- App Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Soft Futuristic Style -->
    <style>
        .grid-soft {
            background-image:
                linear-gradient(rgba(59,130,246,.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,.08) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .glow-soft {
            box-shadow: 0 0 20px rgba(59,130,246,.15);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-950 text-gray-100">

<div class="min-h-screen relative overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0 grid-soft opacity-30 pointer-events-none"></div>

    {{-- Navigation --}}
    <div class="relative z-10">
        @include('components.user.navigation')
    </div>

    {{-- Page Heading --}}
    @isset($header)
        <header class="relative z-10
                       bg-gradient-to-r from-gray-900 via-gray-950 to-black
                       border-b border-blue-500/20 glow-soft">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Page Content --}}
    <main class="relative z-10 max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{ $slot }}
    </main>

</div>

</body>
</html>
