@extends('layouts.public')
@section('title', 'Certifications')

@section('content')
    <section class="py-20">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($certifications as $cert)
                    <x-card class="flex flex-col">
                        <div class="flex items-start gap-4">
                            @if($cert->badge_image)
                                <img src="{{ Storage::url($cert->badge_image) }}" alt="{{ $cert->name }}" class="w-16 h-16 object-contain flex-shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-text-main mb-1">{{ $cert->name }}</h3>
                                <p class="text-accent text-sm font-mono">{{ $cert->issuer }}</p>
                            </div>
                        </div>
                        @if($cert->category)
                            <span class="inline-block mt-3 text-xs text-text-muted bg-bg-dark px-2 py-1 rounded font-mono w-fit">{{ $cert->category->name }}</span>
                        @endif
                        <div class="mt-3 text-xs text-text-muted">
                            <span>Délivré : {{ $cert->issue_date?->format('M Y') }}</span>
                            @if($cert->expiry_date)
                                <span class="ml-3">Expire : {{ $cert->expiry_date->format('M Y') }}</span>
                            @endif
                        </div>
                        @if($cert->credential_id)
                            <p class="text-xs text-text-muted mt-1 font-mono">ID : {{ $cert->credential_id }}</p>
                        @endif
                        @if($cert->credential_url)
                            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener" class="mt-3 text-accent text-sm hover:underline">Vérifier →</a>
                        @endif
                    </x-card>
                @endforeach
            </div>

            <div class="mt-10">{{ $certifications->withQueryString()->links() }}</div>
            @else
                <p class="text-center text-text-muted">Aucune certification pour le moment.</p>
            @endif
        </div>
    </section>
@endsection
