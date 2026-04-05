@extends('layouts.public')
@section('title', 'Services & Prestations')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="Ce que je peux faire pour vous">
                Services & Prestations
            </x-section-header>

            @if($services->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($services as $service)
                    <x-card class="flex flex-col relative overflow-hidden">
                        @if($service->is_featured)
                            <span class="absolute top-3 right-3 bg-accent text-bg-dark text-xs font-bold px-2 py-1 rounded-full">Populaire</span>
                        @endif

                        {{-- Icon --}}
                        <div class="w-14 h-14 rounded-lg bg-accent/10 flex items-center justify-center mb-5 flex-shrink-0">
                            @if($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" alt="{{ $service->title }}" class="w-8 h-8 object-contain">
                            @else
                                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-text-main mb-3">{{ $service->title }}</h3>
                        <p class="text-text-muted text-sm flex-1 mb-5 leading-relaxed">{{ $service->short_description }}</p>

                        {{-- Details --}}
                        <div class="border-t border-gray-800 pt-4 mt-auto space-y-2">
                            @if($service->duration)
                                <div class="flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-text-muted">{{ $service->duration }}</span>
                                </div>
                            @endif
                            @if($service->price_label)
                                <div class="flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-accent font-semibold">{{ $service->price_label }}</span>
                                </div>
                            @endif
                        </div>

                        @if($service->description)
                            <div x-data="{ open: false }" class="mt-4">
                                <button @click="open = !open" class="text-accent text-sm hover:underline flex items-center gap-1">
                                    <span x-text="open ? 'Moins de détails' : 'Plus de détails'"></span>
                                    <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="open" x-transition class="mt-3 text-text-muted text-sm leading-relaxed">
                                    {!! nl2br(e($service->description)) !!}
                                </div>
                            </div>
                        @endif

                        <div class="mt-5">
                            <x-btn href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="w-full text-center">
                                Demander un devis
                            </x-btn>
                        </div>
                    </x-card>
                @endforeach
            </div>
            @else
                <p class="text-center text-text-muted">Les services seront bientôt disponibles.</p>
            @endif

            {{-- CTA --}}
            <div class="mt-16 text-center max-w-2xl mx-auto">
                <x-terminal-block title="~/services">
                    <p><span class="text-green-400">$</span> <span class="text-text-muted">cat process.md</span></p>
                    <p class="mt-2 text-text-main">1. <span class="text-accent">Échange</span> — On discute de votre besoin</p>
                    <p class="text-text-main">2. <span class="text-accent">Proposition</span> — Je vous envoie un devis détaillé</p>
                    <p class="text-text-main">3. <span class="text-accent">Réalisation</span> — Je livre selon le planning convenu</p>
                    <p class="text-text-main">4. <span class="text-accent">Suivi</span> — Accompagnement post-livraison</p>
                </x-terminal-block>

                <div class="mt-8">
                    <x-btn href="https://wa.me/{{ setting('social_whatsapp') }}?text={{ urlencode('Bonjour, je souhaite discuter d\'un projet.') }}" target="_blank" rel="noopener">Discutons de votre projet</x-btn>
                </div>
            </div>
        </div>
    </section>
@endsection
