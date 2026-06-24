@extends('layouts.public')
@section('title', 'Projets')

@section('content')
    <section class="py-20 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('projects_subtitle', 'Mes réalisations en QA & DevOps') }}">
                {{ setting('pro                php artisan migrate
                php artisan storage:linkjects_page_title', 'Projets') }}
            </x-section-header>

            {{-- Category Filter --}}
            @if($categories->count())
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <a href="{{ route('projects.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-mono transition {{ !$categorySlug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                    Tous
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat->slug]) }}"
                       class="px-4 py-2 rounded-full text-sm font-mono transition {{ $categorySlug === $cat->slug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
            @endif

            {{-- Projects Grid --}}
            @if($projects->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <x-card class="flex flex-col">
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        @if($project->category)
                            <span class="text-accent text-xs font-mono mb-2">{{ $project->category->name }}</span>
                        @endif
                        <h3 class="text-lg font-bold text-text-main mb-2">{{ $project->title }}</h3>
                        <p class="text-text-muted text-sm flex-1 mb-4">{{ Str::limit($project->short_description, 140) }}</p>
                        @if($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies as $tech)
                                    <span class="text-xs bg-bg-dark text-accent px-2 py-1 rounded font-mono">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex gap-3 mt-auto">
                            <a href="{{ route('projects.show', $project->slug) }}" class="text-accent text-sm hover:underline">Détails →</a>
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="text-text-muted text-sm hover:text-accent">GitHub</a>
                            @endif
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="text-text-muted text-sm hover:text-accent">Démo</a>
                            @endif
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-10">{{ $projects->withQueryString()->links() }}</div>
            @else
                <x-terminal-block title="~/projects" class="max-w-md mx-auto">
                    <p><span class="text-green-400">$</span> <span class="text-text-muted">ls projects/</span></p>
                    <p class="text-text-muted mt-2">total 0</p>
                    <p class="text-yellow-400 mt-1">// Aucun projet disponible pour le moment.</p>
                    <p class="text-text-muted mt-2"><span class="text-green-400">$</span> <span class="animate-pulse">▊</span></p>
                </x-terminal-block>
            @endif
        </div>
    </section>
@endsection
