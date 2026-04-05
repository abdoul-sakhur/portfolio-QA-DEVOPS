<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('seo_title', 'Abdoul Sarba — Testeur QA / DevOps') }}</title>
    <meta name="description" content="{{ setting('seo_description', 'Portfolio de Abdoul Sarba, Testeur Logiciel QA / Testeur Automaticien') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @if(setting('seo_og_image'))
        <meta property="og:image" content="{{ asset('storage/' . setting('seo_og_image')) }}">
    @endif
    <meta property="og:title" content="{{ setting('seo_title', 'Abdoul Sarba — Testeur QA / DevOps') }}">
    <meta property="og:description" content="{{ setting('seo_description', 'Portfolio de Abdoul Sarba, Testeur Logiciel QA / Testeur Automaticien') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ setting('hero_name', 'Abdoul-sacourou Sarba') }}",
        "jobTitle": "{{ setting('hero_title', 'Testeur QA / DevOps Engineer') }}",
        "url": "{{ url('/') }}",
        "description": "{{ setting('seo_description', 'Portfolio de Abdoul Sarba, Testeur Logiciel QA / Testeur Automaticien') }}",
        "knowsAbout": ["QA", "DevOps", "Test Automation", "CI/CD", "Selenium", "Cypress"],
        "sameAs": [
            "{{ setting('social_linkedin', '') }}",
            "{{ setting('social_github', '') }}"
        ]
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                    @if(setting('contact_status') === 'Disponible')
                        <span class="flex items-center gap-1.5 text-green-400 text-xs font-mono border border-green-400/30 rounded-full px-3 py-1">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Disponible
                        </span>
                    @endif
                    <a href="{{ route('home') }}" class="text-text-muted hover:text-accent transition">Accueil</a>
                    <a href="{{ route('about') }}" class="text-text-muted hover:text-accent transition">À propos</a>
                    <a href="{{ route('projects.index') }}" class="text-text-muted hover:text-accent transition">Projets</a>
                    <a href="{{ route('services.index') }}" class="text-text-muted hover:text-accent transition">Services</a>
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
                <a href="{{ route('services.index') }}" class="block text-text-muted hover:text-accent py-1">Services</a>
                <a href="{{ route('blog.index') }}" class="block text-text-muted hover:text-accent py-1">Blog</a>
                <a href="{{ route('certifications.index') }}" class="block text-text-muted hover:text-accent py-1">Certifications</a>
                <a href="{{ route('contact') }}" class="block text-text-muted hover:text-accent py-1">Contact</a>
            </nav>
        </div>
    </header>

    <main class="pt-16">
        @yield('content')
    </main>

    {{-- CTA Banner --}}
    <section class="py-16 bg-primary/50 border-t border-gray-800">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-2xl md:text-3xl font-bold text-text-main mb-4">Un projet en tête ?</h3>
            <p class="text-text-muted mb-8 max-w-xl mx-auto">Besoin d'un QA Engineer ou DevOps pour votre projet ? Discutons de vos besoins et trouvons la meilleure solution ensemble.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://wa.me/{{ setting('social_whatsapp') }}?text={{ urlencode('Bonjour, je souhaite discuter d\'un projet.') }}" target="_blank" rel="noopener" class="btn-primary">Discutons de votre projet</a>
                @if(setting('social_linkedin'))
                    <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener" class="btn-outline">Me suivre sur LinkedIn</a>
                @endif
            </div>
        </div>
    </section>

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
