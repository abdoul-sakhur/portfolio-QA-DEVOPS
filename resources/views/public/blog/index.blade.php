@extends('layouts.public')
@section('title', 'Blog')

@section('content')
    <section class="py-20">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <x-card class="flex flex-col">
                        @if($post->cover_image)
                            <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        @if($post->category)
                            <span class="text-accent text-xs font-mono mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h3 class="text-lg font-bold text-text-main mb-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-accent transition">{{ $post->title }}</a>
                        </h3>
                        <p class="text-text-muted text-sm flex-1 mb-4">{{ Str::limit($post->excerpt, 140) }}</p>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-xs text-text-muted">{{ $post->published_at?->format('d M Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-accent text-sm hover:underline">Lire →</a>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-10">{{ $posts->withQueryString()->links() }}</div>
            @else
                <p class="text-center text-text-muted">Aucun article pour le moment.</p>
            @endif
        </div>
    </section>
@endsection
