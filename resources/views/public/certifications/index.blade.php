@extends('layouts.public')
@section('title', 'Certifications')

@section('content')

@php
    $certImages = $certifications->filter(fn($c) => $c->cover_image)->values();
@endphp

<section class="py-20 reveal" x-data x-intersect.once="$el.classList.add('is-visible')">
    <div class="container mx-auto px-6">
        <x-section-header subtitle="{{ setting('certifications_subtitle', 'Certifications et accréditations professionnelles') }}">
            {{ setting('certifications_title', 'Certifications') }}
        </x-section-header>

        {{-- Category Filter --}}
        @if($categories->count())
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <a href="{{ route('certifications.index') }}"
               class="px-4 py-2 rounded-full text-sm font-mono transition {{ !$categorySlug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                Toutes
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('certifications.index', ['category' => $cat->slug]) }}"
                   class="px-4 py-2 rounded-full text-sm font-mono transition {{ $categorySlug === $cat->slug ? 'bg-accent text-bg-dark' : 'bg-primary text-text-muted border border-gray-800 hover:border-accent/50' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
        @endif

        @if($certifications->count())

        {{-- Lightbox Alpine.js --}}
        <div
            x-data="{
                open: false,
                currentIndex: 0,
                certs: {{ Js::from($certImages->map(fn($c) => [
                    'image' => Storage::url($c->cover_image),
                    'title' => $c->title,
                    'issuer'=> $c->issuer,
                ])->values()) }},
                openAt(i) { this.currentIndex = i; this.open = true; document.body.style.overflow = 'hidden'; },
                close()   { this.open = false; document.body.style.overflow = ''; },
                prev()    { this.currentIndex = (this.currentIndex - 1 + this.certs.length) % this.certs.length; },
                next()    { this.currentIndex = (this.currentIndex + 1) % this.certs.length; }
            }"
            @keydown.escape.window="close()"
            @keydown.arrow-left.window="open && prev()"
            @keydown.arrow-right.window="open && next()">

            {{-- Grille --}}
            @php $imgIdx = 0; @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($certifications as $cert)
                <x-card class="flex flex-col">
                    <div class="flex items-start gap-4">
                        @if($cert->cover_image)
                            <button @click="openAt({{ $imgIdx }})"
                                    class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 border border-gray-800 hover:border-accent/50 transition group relative">
                                <img src="{{ Storage::url($cert->cover_image) }}" alt="{{ $cert->title }}" loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-bg-dark/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </div>
                            </button>
                        @else
                            <div class="w-16 h-16 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-text-main mb-1 leading-snug">{{ $cert->title }}</h3>
                            <p class="text-accent text-sm font-mono">{{ $cert->issuer }}</p>
                        </div>
                    </div>

                    @if($cert->category)
                        <span class="inline-block mt-3 text-xs text-text-muted bg-bg-dark px-2 py-1 rounded font-mono w-fit">{{ $cert->category->name }}</span>
                    @endif

                    <div class="mt-3 text-xs text-text-muted font-mono">
                        <span>Délivré : {{ $cert->issue_date?->format('M Y') }}</span>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-4 pt-4 border-t border-gray-800/60 flex items-center gap-3 flex-wrap">
                        @if($cert->cover_image)
                            {{-- Image uploadée → lightbox --}}
                            <button @click="openAt({{ $imgIdx }})"
                                    class="inline-flex items-center gap-1.5 text-xs font-mono text-text-muted border border-gray-800 hover:border-accent/50 hover:text-accent px-3 py-1.5 rounded transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Voir certification
                            </button>
                        @elseif($cert->credential_url)
                            {{-- Pas d'image mais lien → ouvre dans un nouvel onglet --}}
                            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1.5 text-xs font-mono text-text-muted border border-gray-800 hover:border-accent/50 hover:text-accent px-3 py-1.5 rounded transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Voir certification
                            </a>
                        @endif
                        @if($cert->credential_url && $cert->cover_image)
                            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1.5 text-xs font-mono text-accent hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Vérifier
                            </a>
                        @endif
                    </div>
                </x-card>
                @if($cert->cover_image) @php $imgIdx++; @endphp @endif
                @endforeach
            </div>

            <div class="mt-10">{{ $certifications->withQueryString()->links() }}</div>

            {{-- Lightbox Modal --}}
            <div x-show="open"
                 x-transition:enter="transition duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4"
                 style="display: none;">

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-bg-dark/90 backdrop-blur-sm" @click="close()"></div>

                {{-- Panel --}}
                <div class="relative z-10 max-w-3xl w-full mx-auto"
                     x-transition:enter="transition duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">

                    {{-- Image --}}
                    <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                        <template x-if="certs[currentIndex]">
                            <img :src="certs[currentIndex].image"
                                 :alt="certs[currentIndex].title"
                                 class="w-full max-h-[70vh] object-contain">
                        </template>
                    </div>

                    {{-- Infos + contrôles --}}
                    <div class="mt-3 flex items-center justify-between gap-4 px-1">
                        <div>
                            <p class="text-text-main font-semibold text-sm" x-text="certs[currentIndex]?.title"></p>
                            <p class="text-accent font-mono text-xs" x-text="certs[currentIndex]?.issuer"></p>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($certImages->count() > 1)
                            <span class="text-text-muted font-mono text-xs" x-text="(currentIndex + 1) + ' / ' + certs.length"></span>
                            <button @click="prev()" class="w-8 h-8 rounded border border-gray-700 hover:border-accent/50 text-text-muted hover:text-accent transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="next()" class="w-8 h-8 rounded border border-gray-700 hover:border-accent/50 text-text-muted hover:text-accent transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            @endif
                            <button @click="close()" class="w-8 h-8 rounded border border-gray-700 hover:border-red-500/50 text-text-muted hover:text-red-400 transition flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
            <x-terminal-block title="~/certifications" class="max-w-md mx-auto">
                <p><span class="text-green-400">$</span> <span class="text-text-muted">ls certifications/</span></p>
                <p class="text-text-muted mt-2">total 0</p>
                <p class="text-yellow-400 mt-1">// Aucune certification pour le moment.</p>
                <p class="text-text-muted mt-2"><span class="text-green-400">$</span> <span class="animate-pulse">▊</span></p>
            </x-terminal-block>
        @endif
    </div>
</section>
@endsection
