<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('seo_title', 'Abdoul Sarba — Testeur QA / DevOps') }}</title>
    <meta name="description" content="{{ setting('seo_description', 'Portfolio de Abdoul Sarba, Testeur Logiciel QA / Testeur Automaticien') }}">
    @if(setting('seo_og_image'))
        <meta property="og:image" content="{{ asset('storage/' . setting('seo_og_image')) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bg-dark': '#020c1b',
                        'primary': '#0a192f',
                        'accent': '#64ffda',
                        'text-main': '#ccd6f6',
                        'text-muted': '#8892b0',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Fira Code', 'monospace'],
                    },
                },
            },
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --color-bg: #020c1b;
            --color-primary: #0a192f;
            --color-accent: #64ffda;
            --color-text: #ccd6f6;
            --color-text-muted: #8892b0;
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }
        body { background-color: var(--color-bg); color: var(--color-text); font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'Fira Code', monospace; }
        .card-hover { transition: var(--transition); border: 1px solid transparent; }
        .card-hover:hover { transform: translateY(-5px); border-color: var(--color-accent); }
        .btn-primary { background-color: var(--color-accent); color: var(--color-primary); font-weight: 600; padding: 0.75rem 1.5rem; border-radius: var(--border-radius); transition: var(--transition); display: inline-block; }
        .btn-primary:hover { box-shadow: 0 0 20px rgba(100, 255, 218, 0.3); }
        .btn-outline { border: 1px solid var(--color-accent); color: var(--color-accent); padding: 0.75rem 1.5rem; border-radius: var(--border-radius); transition: var(--transition); display: inline-block; }
        .btn-outline:hover { background-color: rgba(100, 255, 218, 0.1); }
        .section-title { position: relative; display: inline-block; }
        .section-title::after { content: ''; display: block; width: 100px; height: 2px; background-color: var(--color-accent); margin-top: 0.5rem; }
        .terminal-block { background-color: var(--color-primary); border-radius: var(--border-radius); font-family: 'Fira Code', monospace; overflow: hidden; }
        .terminal-dots span { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }
        .glass-header { backdrop-filter: blur(10px); background-color: rgba(2, 12, 27, 0.85); }
        .skill-bar { background-color: var(--color-primary); border-radius: 4px; overflow: hidden; }
        .skill-bar-fill { background: linear-gradient(90deg, var(--color-accent), #0aff9d); height: 8px; border-radius: 4px; transition: width 1s ease; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--color-bg); }
        ::-webkit-scrollbar-thumb { background: var(--color-text-muted); border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen antialiased">

    <header class="glass-header fixed top-0 left-0 right-0 z-50 border-b border-gray-800" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-accent font-mono font-bold text-lg">
                    &lt;{{ setting('hero_title', 'Abdoul Sarba') }} /&gt;
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-sm">
                    <a href="{{ route('home') }}" class="text-text-muted hover:text-accent transition">Accueil</a>
                    <a href="{{ route('about') }}" class="text-text-muted hover:text-accent transition">À propos</a>
                    <a href="{{ route('projects.index') }}" class="text-text-muted hover:text-accent transition">Projets</a>
                    <a href="{{ route('blog.index') }}" class="text-text-muted hover:text-accent transition">Blog</a>
                    <a href="{{ route('certifications.index') }}" class="text-text-muted hover:text-accent transition">Certifications</a>
                    <a href="{{ route('contact') }}" class="btn-primary text-sm !py-2 !px-4">Contact</a>
                </nav>
                <button @click="open = !open" class="md:hidden text-text-muted">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav x-show="open" x-transition class="md:hidden pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block text-text-muted hover:text-accent py-1">Accueil</a>
                <a href="{{ route('about') }}" class="block text-text-muted hover:text-accent py-1">À propos</a>
                <a href="{{ route('projects.index') }}" class="block text-text-muted hover:text-accent py-1">Projets</a>
                <a href="{{ route('blog.index') }}" class="block text-text-muted hover:text-accent py-1">Blog</a>
                <a href="{{ route('certifications.index') }}" class="block text-text-muted hover:text-accent py-1">Certifications</a>
                <a href="{{ route('contact') }}" class="block text-text-muted hover:text-accent py-1">Contact</a>
            </nav>
        </div>
    </header>

    <main class="pt-16">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 py-8 mt-20">
        <div class="max-w-6xl mx-auto px-4 text-center text-text-muted text-sm">
            <div class="flex justify-center space-x-6 mb-4">
                @if(setting('social_github'))
                    <a href="{{ setting('social_github') }}" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition">GitHub</a>
                @endif
                @if(setting('social_linkedin'))
                    <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition">LinkedIn</a>
                @endif
                @if(setting('social_twitter'))
                    <a href="{{ setting('social_twitter') }}" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition">Twitter</a>
                @endif
            </div>
            <p>&copy; {{ date('Y') }} {{ setting('hero_name', 'Abdoul Sarba') }}. Tous droits réservés.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
