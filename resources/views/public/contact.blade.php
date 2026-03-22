@extends('layouts.public')
@section('title', 'Contact')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-6">
            <x-section-header subtitle="{{ setting('contact_subtitle', 'N\'hésitez pas à me contacter') }}">
                {{ setting('contact_title', 'Contact') }}
            </x-section-header>

            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Info --}}
                <div>
                    <x-terminal-block title="~/contact">
                        <p><span class="text-green-400">$</span> <span class="text-text-muted">cat contact.yml</span></p>
                        <p class="mt-2"><span class="text-accent">email:</span> <span class="text-text-main">{{ setting('contact_email', '') }}</span></p>
                        @if(setting('contact_phone'))
                            <p><span class="text-accent">phone:</span> <span class="text-text-main">{{ setting('contact_phone') }}</span></p>
                        @endif
                        <p><span class="text-accent">location:</span> <span class="text-text-main">{{ setting('hero_location', '') }}</span></p>
                        <p><span class="text-accent">status:</span> <span class="text-green-400">{{ setting('contact_status', 'Disponible') }}</span></p>
                    </x-terminal-block>

                    {{-- Social Links --}}
                    <div class="mt-8 flex gap-4">
                        @if(setting('social_linkedin'))
                            <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-lg bg-primary border border-gray-800 flex items-center justify-center text-text-muted hover:text-accent hover:border-accent/50 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        @endif
                        @if(setting('social_github'))
                            <a href="{{ setting('social_github') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-lg bg-primary border border-gray-800 flex items-center justify-center text-text-muted hover:text-accent hover:border-accent/50 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Form --}}
                <div>
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-900/30 border border-green-700 text-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm text-text-muted mb-1">Nom *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full bg-primary border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm text-text-muted mb-1">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full bg-primary border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="subject" class="block text-sm text-text-muted mb-1">Sujet</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                   class="w-full bg-primary border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                            @error('subject') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm text-text-muted mb-1">Message *</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full bg-primary border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <x-btn tag="button" type="submit" class="w-full">Envoyer le message</x-btn>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
