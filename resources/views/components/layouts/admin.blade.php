<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    {{-- Tailwind + DaisyUI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Futuristic Effects --}}
    <style>
        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 40px 40px; }
        }
        .cyber-grid {
            background-image:
                linear-gradient(rgba(59,130,246,.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,.1) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: gridMove 2s linear infinite;
        }
        .neon-text {
            text-shadow:
                0 0 10px rgba(59,130,246,.8),
                0 0 20px rgba(59,130,246,.6);
        }
    </style>
</head>

<body class="bg-gray-950 text-white overflow-x-hidden">

<div class="drawer lg:drawer-open min-h-screen">
    <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />

    {{-- MAIN CONTENT --}}
    <div class="drawer-content relative">

        {{-- Background Grid --}}
        <div class="absolute inset-0 cyber-grid opacity-20 pointer-events-none"></div>

        {{-- NAVBAR --}}
        <nav class="relative z-10 navbar
                    bg-gradient-to-r from-gray-900 via-gray-950 to-black
                    border-b border-blue-500/30 px-4">

            <label for="my-drawer-4"
                   class="btn btn-square btn-ghost lg:hidden text-blue-400">
                ☰
            </label>

            <div class="flex-1">
                <span class="text-lg font-black tracking-widest neon-text">
                    ADMIN PANEL
                </span>
            </div>
        </nav>

        {{-- PAGE CONTENT --}}
        <main class="relative z-10 p-6">
            {{ $slot }}
        </main>
    </div>

    {{-- SIDEBAR --}}
    @include('components.admin.sidebar')
</div>

{{-- FOOTER --}}
<footer class="relative border-t border-blue-500/30
               bg-gradient-to-b from-gray-900 to-black
               text-center py-4 text-sm text-gray-400">
    © {{ date('Y') }} BengTix Admin System
</footer>

@stack('scripts')
</body>
</html>
