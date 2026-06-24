@extends('layouts.public')
@section('title', $post->title)
@section('seo_description', Str::limit(strip_tags($post->excerpt ?? $post->content ?? ''), 160))

@push('meta')
<meta property="og:type" content="article">
<meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
@if($post->category)<meta property="article:section" content="{{ $post->category->name }}">@endif
@if($post->cover_image)<meta property="og:image" content="{{ Storage::url($post->cover_image) }}">@endif
@endpush

@section('content')

{{-- Barre de progression de lecture --}}
<div x-data="{ progress: 0 }"
     @scroll.window="progress = Math.min(100, Math.round((window.scrollY / Math.max(1, document.documentElement.scrollHeight - window.innerHeight)) * 100))">
    <div class="fixed top-0 left-0 h-0.5 bg-accent z-50 transition-[width] duration-100 ease-out" :style="`width: ${progress}%`"></div>
</div>

<article class="py-20" x-data>
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">

            {{-- Breadcrumb --}}
            <nav class="mb-8 flex items-center gap-2 font-mono text-xs text-text-muted">
                <a href="{{ route('blog.index') }}" class="hover:text-accent transition">~/blog</a>
                <span class="text-gray-700">/</span>
                <span class="text-text-main truncate">{{ Str::limit($post->title, 50) }}</span>
            </nav>

            {{-- Cover image --}}
            @if($post->cover_image)
                <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" loading="lazy"
                     class="w-full h-64 md:h-96 object-cover rounded-lg mb-8 border border-gray-800">
            @endif

            {{-- Meta --}}
            @php $readingTime = max(1, (int) ceil(str_word_count(strip_tags($post->content ?? '')) / 200)); @endphp
            <div class="flex flex-wrap items-center gap-3 mb-4 font-mono text-xs">
                @if($post->category)
                    <span class="text-accent bg-accent/10 border border-accent/20 px-3 py-1 rounded-full">{{ $post->category->name }}</span>
                @endif
                <span class="text-text-muted">{{ $post->published_at?->format('d M Y') }}</span>
                <span class="text-gray-700">·</span>
                <span class="text-text-muted">~{{ $readingTime }} min de lecture</span>
            </div>

            {{-- Titre --}}
            <h1 class="text-3xl md:text-4xl font-bold text-text-main mb-6 leading-tight">{{ $post->title }}</h1>

            {{-- Extrait --}}
            @if($post->excerpt)
                <p class="text-text-muted text-lg mb-8 leading-relaxed border-l-2 border-accent/40 pl-4 italic">{{ $post->excerpt }}</p>
            @endif

            {{-- Contenu --}}
            <div class="blog-content max-w-none text-text-muted leading-relaxed"
                 x-init="
                     // Coloration syntaxique
                     if (window.hljs) {
                         $el.querySelectorAll('pre code').forEach(block => hljs.highlightElement(block));
                     }

                     // Blocs de code : wrap + header + bouton copie SVG
                     $el.querySelectorAll('pre').forEach(pre => {
                         const code  = pre.querySelector('code');
                         const lang  = (code?.className.match(/language-(\w+)/) || code?.className.match(/hljs\s+(\w+)/))?.[1] || '';

                         const copyIcon = \`<svg width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><rect x='9' y='9' width='13' height='13' rx='2'/><path d='M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1'/></svg>\`;
                         const checkIcon = \`<svg width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><polyline points='20 6 9 17 4 12'/></svg>\`;

                         const btn = document.createElement('button');
                         btn.className = 'copy-btn';
                         btn.innerHTML = copyIcon;
                         btn.title = 'Copier le code';
                         btn.addEventListener('click', () => {
                             const text = code?.innerText || pre.innerText;
                             navigator.clipboard.writeText(text).then(() => {
                                 btn.innerHTML = checkIcon;
                                 btn.classList.add('copied');
                                 setTimeout(() => { btn.innerHTML = copyIcon; btn.classList.remove('copied'); }, 2000);
                             });
                         });

                         const header = document.createElement('div');
                         header.className = 'code-header';
                         header.innerHTML = \`<span class='code-lang'>\${lang || 'code'}</span>\`;
                         header.appendChild(btn);

                         const wrapper = document.createElement('div');
                         wrapper.className = 'code-block';
                         pre.parentNode.insertBefore(wrapper, pre);
                         wrapper.appendChild(header);
                         wrapper.appendChild(pre);
                     });
                 ">
                {!! $post->content !!}
            </div>

            {{-- Partage + retour --}}
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <a href="{{ route('blog.index') }}" class="text-accent hover:underline font-mono text-sm">← retour au blog</a>

                <div class="flex items-center gap-3">
                    <span class="text-text-muted font-mono text-xs">// partager</span>
                    <a href="https://linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="text-text-muted hover:text-accent transition border border-gray-800 hover:border-accent/40 px-3 py-1.5 rounded font-mono text-xs">
                        LinkedIn
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                       target="_blank" rel="noopener"
                       class="text-text-muted hover:text-accent transition border border-gray-800 hover:border-accent/40 px-3 py-1.5 rounded font-mono text-xs">
                        Twitter
                    </a>
                    <button
                        x-data="{ copied: false }"
                        @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                        class="text-text-muted hover:text-accent transition border border-gray-800 hover:border-accent/40 px-3 py-1.5 rounded font-mono text-xs"
                        :class="{ 'text-accent border-accent/40': copied }">
                        <span x-text="copied ? 'lien copié ✓' : 'copier le lien'">copier le lien</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Articles similaires --}}
        @if($related->count())
        <div class="max-w-5xl mx-auto mt-20 pt-12 border-t border-gray-800">
            <div class="flex items-center gap-3 mb-8">
                <span class="text-accent font-mono text-xs tracking-widest">// articles similaires</span>
                <span class="flex-1 h-px bg-gray-800"></span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $rel)
                    @php $relReading = max(1, (int) ceil(str_word_count(strip_tags($rel->content ?? '')) / 200)); @endphp
                    <x-card class="flex flex-col group">
                        @if($rel->cover_image)
                            <a href="{{ route('blog.show', $rel->slug) }}" class="block overflow-hidden rounded-lg mb-4">
                                <img src="{{ Storage::url($rel->cover_image) }}" alt="{{ $rel->title }}" loading="lazy"
                                     class="w-full h-36 object-cover transition-transform duration-500 group-hover:scale-105">
                            </a>
                        @endif
                        <div class="flex items-center gap-2 mb-2 font-mono text-xs text-text-muted">
                            <span>{{ $rel->published_at?->format('d M Y') }}</span>
                            <span class="text-gray-700">·</span>
                            <span>~{{ $relReading }} min</span>
                        </div>
                        <h3 class="text-sm font-bold text-text-main mb-3 leading-snug flex-1">
                            <a href="{{ route('blog.show', $rel->slug) }}" class="hover:text-accent transition">{{ $rel->title }}</a>
                        </h3>
                        <a href="{{ route('blog.show', $rel->slug) }}" class="text-accent text-xs font-mono hover:underline inline-flex items-center gap-1 mt-auto">
                            <span>lire</span>
                            <span class="transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    </x-card>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>
@endsection
