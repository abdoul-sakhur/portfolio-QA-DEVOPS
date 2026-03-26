@extends('layouts.public')
@section('title', setting('site_title', 'Portfolio QA DevOps'))

@section('content')
    {{-- Hero --}}
    <section class="min-h-[90vh] flex items-center py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                {{-- Left: Text + Terminal --}}
                <div class="flex-1 max-w-2xl">
                    <p class="text-accent font-mono text-sm mb-4">{{ setting('hero_greeting', 'Bonjour, je suis') }}</p>
                    <h1 class="text-4xl md:text-6xl font-bold text-text-main mb-4">{{ setting('hero_name', 'Abdoul-sacourou Sarba') }}</h1>
                    <h2 class="text-2xl md:text-4xl font-bold text-text-muted mb-6">{{ setting('hero_title', 'Testeur QA / DevOps Engineer') }}</h2>
                    <p class="text-text-muted max-w-xl mb-8 leading-relaxed">{{ setting('hero_description', 'Passionné par la qualité logicielle et l\'automatisation des tests. J\'accompagne les équipes dans la mise en place de pipelines CI/CD robustes et de stratégies de tests efficaces.') }}</p>

                    <x-terminal-block title="~/portfolio">
                        <p><span class="text-green-400">$</span> <span class="text-text-muted">whoami</span></p>
                        <p class="text-accent">{{ setting('hero_name', 'Abdoul-sacourou Sarba') }}</p>
                        <p class="mt-2"><span class="text-green-400">$</span> <span class="text-text-muted">cat role.txt</span></p>
                        <p class="text-text-main">{{ setting('hero_title', 'Testeur QA / DevOps Engineer') }}</p>
                        <p class="mt-2"><span class="text-green-400">$</span> <span class="text-text-muted">echo $LOCATION</span></p>
                        <p class="text-text-main">{{ setting('hero_location', "Côte d'Ivoire") }}</p>
                    </x-terminal-block>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <x-btn href="{{ route('projects.index') }}">Voir mes projets</x-btn>
                        <x-btn variant="outline" href="{{ route('contact') }}">Me contacter</x-btn>
                        @if($cv)
                            <a href="{{ route('cv.public.download') }}" class="btn-outline flex items-center gap-2 !py-2 !px-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Télécharger mon CV
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Right: Photo --}}
                @if(setting('about_photo'))
                <div class="flex-shrink-0">
                    <div class="relative">
                        <div class="w-72 h-72 md:w-96 md:h-96 rounded-2xl overflow-hidden border-2 border-accent/30 shadow-lg shadow-accent/10">
                            <img src="{{ Storage::url(setting('about_photo')) }}" alt="{{ setting('hero_name', 'Abdoul-sacourou Sarba') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -inset-1 rounded-2xl border border-accent/10 -z-10"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Skills --}}
    @if($skills->count())
    <section class="py-20 bg-primary/50">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('skills_subtitle', 'Technologies et outils que je maîtrise') }}">
                {{ setting('skills_title', 'Compétences') }}
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach($skills as $skill)
                    <x-card>
                        <div class="flex items-center gap-3 mb-3">
                            @if($skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}" class="w-8 h-8 object-contain">
                            @endif
                            <h3 class="font-semibold text-text-main">{{ $skill->name }}</h3>
                            <span class="ml-auto text-accent text-sm font-mono">{{ $skill->percentage }}%</span>
                        </div>
                        <div class="w-full bg-bg-dark rounded-full h-2">
                            <div class="bg-accent h-2 rounded-full transition-all duration-1000" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                        @if($skill->category)
                            <span class="inline-block mt-3 text-xs text-text-muted bg-bg-dark px-2 py-1 rounded font-mono">{{ $skill->category }}</span>
                        @endif
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Projects --}}
    @if($featuredProjects->count())
    <section class="py-20">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('projects_subtitle', 'Projets récents en QA & DevOps') }}">
                {{ setting('projects_title', 'Projets phares') }}
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProjects as $project)
                    <x-card class="flex flex-col">
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        @if($project->category)
                            <span class="text-accent text-xs font-mono mb-2">{{ $project->category->name }}</span>
                        @endif
                        <h3 class="text-lg font-bold text-text-main mb-2">{{ $project->title }}</h3>
                        <p class="text-text-muted text-sm flex-1 mb-4">{{ Str::limit($project->short_description, 120) }}</p>
                        @if($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies as $tech)
                                    <span class="text-xs bg-bg-dark text-accent px-2 py-1 rounded font-mono">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex gap-3">
                            <a href="{{ route('projects.show', $project->slug) }}" class="text-accent text-sm hover:underline">Voir détails →</a>
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="text-text-muted text-sm hover:text-accent">GitHub</a>
                            @endif
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <x-btn variant="outline" href="{{ route('projects.index') }}">Voir tous les projets</x-btn>
            </div>
        </div>
    </section>
    @endif

    {{-- Latest Blog Posts --}}
    @if($latestPosts->count())
    <section class="py-20 bg-primary/50">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('blog_subtitle', 'Articles sur le QA, DevOps et l\'automatisation') }}">
                {{ setting('blog_title', 'Derniers articles') }}
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestPosts as $post)
                    <x-card class="flex flex-col">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        @if($post->category)
                            <span class="text-accent text-xs font-mono mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h3 class="text-lg font-bold text-text-main mb-2">{{ $post->title }}</h3>
                        <p class="text-text-muted text-sm flex-1 mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-text-muted">{{ $post->published_at?->format('d M Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-accent text-sm hover:underline">Lire →</a>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <x-btn variant="outline" href="{{ route('blog.index') }}">Tous les articles</x-btn>
            </div>
        </div>
    </section>
    @endif
@endsection
