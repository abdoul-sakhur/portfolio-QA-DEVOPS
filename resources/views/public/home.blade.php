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

    {{-- Key Figures --}}
    <section class="py-16 border-y border-gray-800/50" x-data="{ shown: false }" x-intersect.once="shown = true">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto text-center">
                @foreach($stats as $stat)
                    <div x-data="{ count: 0, target: {{ $stat['value'] }} }" x-init="$watch('shown', val => { if (val) { let step = Math.ceil(target / 40); let interval = setInterval(() => { count += step; if (count >= target) { count = target; clearInterval(interval); } }, 30); } })">
                        <p class="text-3xl md:text-4xl font-bold text-accent font-mono">
                            <span x-text="count">0</span>{{ $stat['suffix'] }}
                        </p>
                        <p class="text-text-muted text-sm mt-2">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Skills --}}
    @if($skills->count())
    <section class="py-20 bg-primary/50 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('skills_subtitle', 'Technologies et outils que je maîtrise') }}">
                {{ setting('skills_title', 'Compétences') }}
            </x-section-header>

            @php $skillsByCategory = $skills->groupBy('category'); @endphp

            <div class="max-w-5xl mx-auto space-y-10">
                @foreach($skillsByCategory as $category => $categorySkills)
                <div>
                    @if($category)
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-accent font-mono text-xs tracking-widest">// {{ $category }}</span>
                        <span class="flex-1 h-px bg-gray-800"></span>
                    </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($categorySkills as $skill)
                            <x-card :hover="true" class="!p-4 flex items-center gap-3">
                                @if($skill->icon)
                                    <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}" class="w-6 h-6 object-contain flex-shrink-0">
                                @else
                                    <span class="text-accent font-mono text-sm flex-shrink-0">▸</span>
                                @endif
                                <h3 class="font-medium text-text-main text-sm truncate">{{ $skill->name }}</h3>
                            </x-card>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Projects --}}
    @if($featuredProjects->count())
    <section class="py-20 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('projects_subtitle', 'Projets récents en QA & DevOps') }}">
                {{ setting('projects_title', 'Projets phares') }}
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProjects as $project)
                    <x-card class="flex flex-col">
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-48 object-cover rounded-lg mb-4">
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

    {{-- Testimonials --}}
    @if($testimonials->count())
    <section class="py-20 reveal">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="Ce que disent mes clients">
                Témoignages
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach($testimonials as $testimonial)
                    <x-card class="flex flex-col relative overflow-hidden">
                        {{-- Guillemet décoratif --}}
                        <span class="absolute top-3 right-4 text-7xl text-accent/8 font-serif leading-none select-none pointer-events-none" aria-hidden="true">"</span>

                        {{-- Rating blocs --}}
                        <div class="flex items-center gap-1.5 mb-5">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="w-5 h-1.5 rounded-sm {{ $i <= $testimonial->rating ? 'bg-accent' : 'bg-gray-800' }}"></span>
                            @endfor
                            <span class="text-accent font-mono text-xs ml-1">{{ $testimonial->rating }}.0</span>
                        </div>

                        {{-- Contenu --}}
                        <p class="text-text-muted text-sm leading-relaxed flex-1 mb-6">{{ $testimonial->content }}</p>

                        {{-- Auteur --}}
                        <div class="border-t border-gray-800/60 pt-4 flex items-center gap-3">
                            @if($testimonial->client_photo)
                                <img src="{{ Storage::url($testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" loading="lazy" class="w-9 h-9 rounded-full object-cover border border-accent/20 flex-shrink-0">
                            @else
                                <div class="w-9 h-9 rounded-full bg-accent/10 border border-accent/20 flex items-center justify-center text-accent font-bold font-mono text-sm flex-shrink-0">
                                    {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-text-main text-sm font-semibold truncate">{{ $testimonial->client_name }}</p>
                                @if($testimonial->client_role || $testimonial->client_company)
                                    <p class="text-text-muted text-xs font-mono truncate">
                                        {{ $testimonial->client_role }}{{ $testimonial->client_role && $testimonial->client_company ? ' @ ' : '' }}{{ $testimonial->client_company }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Latest Blog Posts --}}
    @if($latestPosts->count())
    <section class="py-20 bg-primary/50 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('blog_subtitle', 'Articles sur le QA, DevOps et l\'automatisation') }}">
                {{ setting('blog_title', 'Derniers articles') }}
            </x-section-header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestPosts as $post)
                    <x-card class="flex flex-col">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-48 object-cover rounded-lg mb-4">
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
