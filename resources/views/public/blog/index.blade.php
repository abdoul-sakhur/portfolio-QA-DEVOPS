@extends('layouts.public')
@section('title', 'Blog')

@section('content')
    <section class="py-20 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('blog_subtitle', 'Articles sur le QA, DevOps et l\'automatisation') }}">
                {{ setting('blog_page_title', 'Blog') }}
            </x-section-header>

            {{-- Category Filter --}}
            @if($categories->count())
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-mono transition {{ !$categorySlug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                    Tous
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="px-4 py-2 rounded-full text-sm font-mono transition {{ $categorySlug === $cat->slug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
            @endif

            @if($posts->count())
            @php
                $featured = $posts->first();
                $rest     = $posts->getCollection()->skip(1);
                $featuredReading = max(1, (int) ceil(str_word_count(strip_tags($featured->content ?? '')) / 200));
            @endphp

            {{-- Featured article --}}
            @if($posts->currentPage() === 1)
            <div class="mb-12 group">
                <x-card class="md:flex gap-8 !p-0 overflow-hidden">
                    @if($featured->cover_image)
                        <a href="{{ route('blog.show', $featured->slug) }}" class="block md:w-1/2 overflow-hidden flex-shrink-0">
                            <img src="{{ Storage::url($featured->cover_image) }}" alt="{{ $featured->title }}" loading="lazy"
                                 class="w-full h-56 md:h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </a>
                    @endif
                    <div class="flex flex-col justify-center p-6 md:p-8">
                        <div class="flex items-center gap-2 mb-4 font-mono text-xs">
                            <span class="bg-accent text-bg-dark px-2 py-0.5 rounded font-semibold">À la une</span>
                            @if($featured->category)
                                <span class="text-accent border border-accent/30 px-2 py-0.5 rounded">{{ $featured->category->name }}</span>
                            @endif
                            <span class="text-gray-700">·</span>
                            <span class="text-text-muted">~{{ $featuredReading }} min</span>
                        </div>
                        <h2 class="text-xl md:text-2xl font-bold text-text-main mb-3 leading-snug">
                            <a href="{{ route('blog.show', $featured->slug) }}" class="hover:text-accent transition">{{ $featured->title }}</a>
                        </h2>
                        <p class="text-text-muted text-sm leading-relaxed mb-6">{{ Str::limit($featured->excerpt, 200) }}</p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="flex items-center gap-1.5 text-text-muted font-mono text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $featured->published_at?->translatedFormat('d F Y') }}
                            </span>
                            <a href="{{ route('blog.show', $featured->slug) }}" class="text-accent text-xs font-mono hover:underline inline-flex items-center gap-1">
                                <span>lire l'article</span>
                                <span class="transition-transform group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>
                </x-card>
            </div>
            @endif

            {{-- Grille des autres articles --}}
            @if($rest->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rest as $post)
                    @php $readingTime = max(1, (int) ceil(str_word_count(strip_tags($post->content ?? '')) / 200)); @endphp
                    <x-card class="flex flex-col group">
                        @if($post->cover_image)
                            <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden rounded-lg mb-4">
                                <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" loading="lazy"
                                     class="w-full h-44 object-cover transition-transform duration-500 group-hover:scale-105">
                            </a>
                        @endif
                        <div class="flex items-center gap-2 mb-3 font-mono text-xs">
                            @if($post->category)
                                <span class="text-accent border border-accent/30 px-2 py-0.5 rounded">{{ $post->category->name }}</span>
                                <span class="text-gray-700">·</span>
                            @endif
                            <span class="text-text-muted">{{ $post->published_at?->translatedFormat('d F Y') }}</span>
                            <span class="text-gray-700">·</span>
                            <span class="text-text-muted">~{{ $readingTime }} min</span>
                        </div>
                        <h3 class="text-base font-bold text-text-main mb-2 leading-snug">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-accent transition">{{ $post->title }}</a>
                        </h3>
                        <p class="text-text-muted text-sm flex-1 mb-4 leading-relaxed">{{ Str::limit($post->excerpt, 110) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="mt-auto text-accent text-xs font-mono hover:underline inline-flex items-center gap-1">
                            <span>lire l'article</span>
                            <span class="transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    </x-card>
                @endforeach
            </div>
            @endif

            <div class="mt-10">{{ $posts->withQueryString()->links() }}</div>
            @else
                <x-terminal-block title="~/blog" class="max-w-md mx-auto">
                    <p><span class="text-green-400">$</span> <span class="text-text-muted">ls articles/</span></p>
                    <p class="text-text-muted mt-2">total 0</p>
                    <p class="text-yellow-400 mt-1">// Aucun article publié pour le moment.</p>
                    <p class="text-text-muted mt-2"><span class="text-green-400">$</span> <span class="animate-pulse">▊</span></p>
                </x-terminal-block>
            @endif
        </div>
    </section>
@endsection
