<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                },
            },
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { background-color: #020c1b; color: #ccd6f6; font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all 0.2s; padding: 0.5rem 1rem; border-radius: 6px; display: flex; align-items: center; gap: 0.5rem; color: #8892b0; font-size: 0.875rem; }
        .sidebar-link:hover, .sidebar-link.active { background-color: rgba(100,255,218,0.1); color: #64ffda; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen" x-data="{ sidebarOpen: true }">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-primary border-r border-gray-800 p-4 flex flex-col fixed h-full z-40"
               :class="{ '-translate-x-full md:translate-x-0': !sidebarOpen }"
               style="transition: transform 0.3s">
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="text-accent font-bold text-lg">&lt;Admin /&gt;</a>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-1 px-1 text-xs uppercase tracking-wider text-text-muted">Contenu</div>

                <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Projets
                </a>
                <a href="{{ route('admin.projects.categories.index') }}" class="sidebar-link pl-8 {{ request()->routeIs('admin.projects.categories.*') ? 'active' : '' }}">Catégories projets</a>

                <a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog.index', 'admin.blog.create', 'admin.blog.edit') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Blog
                </a>
                <a href="{{ route('admin.blog.categories.index') }}" class="sidebar-link pl-8 {{ request()->routeIs('admin.blog.categories.*') ? 'active' : '' }}">Catégories blog</a>

                <a href="{{ route('admin.certifications.index') }}" class="sidebar-link {{ request()->routeIs('admin.certifications.index', 'admin.certifications.create', 'admin.certifications.edit') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    Certifications
                </a>
                <a href="{{ route('admin.certifications.categories.index') }}" class="sidebar-link pl-8 {{ request()->routeIs('admin.certifications.categories.*') ? 'active' : '' }}">Catégories certifs</a>

                <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Compétences
                </a>

                <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Expériences
                </a>

                <a href="{{ route('admin.educations.index') }}" class="sidebar-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Formations
                </a>

                <div class="pt-4 pb-1 px-1 text-xs uppercase tracking-wider text-text-muted">Paramètres</div>

                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Paramètres
                </a>

                <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Messages
                </a>
            </nav>

            <div class="pt-4 border-t border-gray-800 mt-4">
                <div class="text-sm text-text-muted mb-2">{{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link text-red-400 hover:text-red-300 w-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top bar -->
            <header class="bg-primary border-b border-gray-800 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <h1 class="text-lg font-semibold text-text-main">@yield('title', 'Dashboard')</h1>
                <a href="{{ route('home') }}" target="_blank" class="text-sm text-text-muted hover:text-accent transition">
                    Voir le site →
                </a>
            </header>

            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-900/30 border border-green-700 text-green-400 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-900/30 border border-red-700 text-red-400 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
