@extends('layouts.public')
@section('title', 'À propos')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('about_subtitle', 'Mon parcours et mon expertise') }}">
                {{ setting('about_title', 'À propos de moi') }}
            </x-section-header>

            <div class="max-w-4xl mx-auto">
                {{-- Bio --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    @if(setting('about_photo'))
                        <div class="flex justify-center">
                            <img src="{{ Storage::url(setting('about_photo')) }}" alt="{{ setting('hero_name') }}" class="w-48 h-48 rounded-full object-cover border-2 border-accent/30">
                        </div>
                    @endif
                    <div class="md:col-span-{{ setting('about_photo') ? '2' : '3' }}">
                        <div class="prose prose-invert max-w-none text-text-muted leading-relaxed">
                            {!! nl2br(e(setting('about_bio', ''))) !!}
                        </div>
                    </div>
                </div>

                {{-- Info Terminal --}}
                <x-terminal-block title="~/about" class="mb-16">
                    <p><span class="text-green-400">$</span> <span class="text-text-muted">cat info.json</span></p>
                    <p class="text-text-main">{</p>
                    <p class="pl-4"><span class="text-accent">"nom"</span>: <span class="text-yellow-300">"{{ setting('hero_name', 'Abdoul Sarba') }}"</span>,</p>
                    <p class="pl-4"><span class="text-accent">"role"</span>: <span class="text-yellow-300">"{{ setting('hero_title', 'QA Engineer & DevOps') }}"</span>,</p>
                    <p class="pl-4"><span class="text-accent">"localisation"</span>: <span class="text-yellow-300">"{{ setting('hero_location', 'France') }}"</span>,</p>
                    <p class="pl-4"><span class="text-accent">"email"</span>: <span class="text-yellow-300">"{{ setting('contact_email', '') }}"</span></p>
                    <p class="text-text-main">}</p>
                </x-terminal-block>

                {{-- Soft Skills --}}
                @if(setting('about_soft_skills'))
                <div class="mb-16">
                    <h3 class="text-xl font-bold text-text-main mb-6 text-center">Soft Skills</h3>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach(explode(',', setting('about_soft_skills')) as $skill)
                            <span class="bg-primary border border-gray-800 text-accent px-4 py-2 rounded-full text-sm font-mono">{{ trim($skill) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Experiences --}}
    @if($experiences->count())
    <section class="py-20 bg-primary/50">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="Mon parcours professionnel">Expériences</x-section-header>

            <div class="max-w-3xl mx-auto relative">
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gray-800 md:-translate-x-px"></div>
                @foreach($experiences as $i => $exp)
                    <div class="relative pl-12 md:pl-0 mb-12 {{ $i % 2 === 0 ? 'md:pr-[calc(50%+2rem)] md:text-right' : 'md:pl-[calc(50%+2rem)]' }}">
                        <div class="absolute left-2 md:left-1/2 top-1 w-4 h-4 rounded-full bg-accent border-4 border-bg-dark md:-translate-x-1/2"></div>
                        <x-card :hover="false">
                            <h3 class="font-bold text-text-main text-lg">{{ $exp->title }}</h3>
                            <p class="text-accent text-sm font-mono">{{ $exp->company }}</p>
                            <p class="text-xs text-text-muted mb-3">{{ $exp->start_year }} — {{ $exp->end_year ?? 'Présent' }}</p>
                            @if($exp->description)
                                <p class="text-text-muted text-sm">{{ $exp->description }}</p>
                            @endif
                            @if($exp->technologies)
                                <div class="flex flex-wrap gap-1 mt-3 {{ $i % 2 === 0 ? 'md:justify-end' : '' }}">
                                    @foreach($exp->technologies as $tech)
                                        <span class="text-xs bg-bg-dark text-accent px-2 py-0.5 rounded font-mono">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </x-card>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Education --}}
    @if($educations->count())
    <section class="py-20">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="Mon parcours académique">Formations</x-section-header>

            <div class="max-w-3xl mx-auto grid gap-6">
                @foreach($educations as $edu)
                    <x-card class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-text-main">{{ $edu->degree }}</h3>
                            <p class="text-accent text-sm font-mono">{{ $edu->institution }}</p>
                            <p class="text-xs text-text-muted">{{ $edu->start_year }} — {{ $edu->end_year ?? 'En cours' }}</p>
                            @if($edu->description)
                                <p class="text-text-muted text-sm mt-2">{{ $edu->description }}</p>
                            @endif
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
