<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Connexion — {{ config('app.name', 'Portfolio') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'bg-dark': '#020c1b',
                            'bg-primary': '#0a192f',
                            'accent': '#64ffda',
                            'text-main': '#ccd6f6',
                            'text-muted': '#8892b0',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            mono: ['Fira Code', 'monospace'],
                        }
                    }
                }
            }
        </script>

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans bg-bg-dark text-text-main antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="/" class="text-accent font-mono text-2xl hover:opacity-80 transition">&lt;Portfolio /&gt;</a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-6 bg-bg-primary border border-gray-800 shadow-xl overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
