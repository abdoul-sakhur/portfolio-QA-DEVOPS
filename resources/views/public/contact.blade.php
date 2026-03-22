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
                        @if(setting('social_whatsapp'))
                            <a href="https://wa.me/{{ setting('social_whatsapp') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-lg bg-primary border border-gray-800 flex items-center justify-center text-text-muted hover:text-green-400 hover:border-green-400/50 transition" title="WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
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
