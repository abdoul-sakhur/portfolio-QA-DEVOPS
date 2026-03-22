@extends('layouts.public')
@section('title', $project->title)

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-8 text-sm text-text-muted">
                    <a href="{{ route('projects.index') }}" class="hover:text-accent">Projets</a>
                    <span class="mx-2">/</span>
                    <span class="text-text-main">{{ $project->title }}</span>
                </nav>

                @if($project->image)
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-64 md:h-80 object-cover rounded-lg mb-8">
                @endif

                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($project->category)
                        <span class="text-accent text-xs font-mono bg-accent/10 px-3 py-1 rounded-full">{{ $project->category->name }}</span>
                    @endif
                    @if($project->client)
                        <span class="text-text-muted text-xs bg-primary px-3 py-1 rounded-full border border-gray-800">Client : {{ $project->client }}</span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-text-main mb-4">{{ $project->title }}</h1>

                @if($project->short_description)
                    <p class="text-text-muted text-lg mb-8">{{ $project->short_description }}</p>
                @endif

                {{-- Technologies --}}
                @if($project->technologies)
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($project->technologies as $tech)
                            <span class="text-xs bg-primary border border-gray-800 text-accent px-3 py-1 rounded-full font-mono">{{ $tech }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Links --}}
                <div class="flex gap-4 mb-10">
                    @if($project->github_url)
                        <x-btn variant="outline" href="{{ $project->github_url }}" target="_blank" rel="noopener" size="sm">
                            GitHub
                        </x-btn>
                    @endif
                    @if($project->demo_url)
                        <x-btn href="{{ $project->demo_url }}" target="_blank" rel="noopener" size="sm">
                            Démo en ligne
                        </x-btn>
                    @endif
                </div>

                {{-- Content --}}
                <div class="prose prose-invert prose-accent max-w-none text-text-muted">
                    {!! $project->body !!}
                </div>
            </div>
        </div>
    </section>
@endsection
