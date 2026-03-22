@extends('layouts.admin')
@section('title', 'Paramètres')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" x-data="{ tab: 'hero' }">
        @csrf

        {{-- Tabs --}}
        <div class="flex gap-1 mb-8 bg-primary rounded-lg p-1 w-fit">
            @foreach(['hero' => 'Hero', 'about' => 'À propos', 'contact' => 'Contact', 'social' => 'Réseaux', 'seo' => 'SEO'] as $key => $label)
                <button type="button" @click="tab = '{{ $key }}'"
                    :class="tab === '{{ $key }}' ? 'bg-accent text-bg-dark' : 'text-text-muted hover:text-text-main'"
                    class="px-4 py-2 rounded-md text-sm font-medium transition">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Hero --}}
        <div x-show="tab === 'hero'" class="space-y-5">
            <div>
                <label class="block text-sm text-text-muted mb-1">Titre du site</label>
                <input type="text" name="site_title" value="{{ $settings['site_title'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Salutation</label>
                <input type="text" name="hero_greeting" value="{{ $settings['hero_greeting'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Nom complet</label>
                <input type="text" name="hero_name" value="{{ $settings['hero_name'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Titre / Rôle</label>
                <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Description Hero</label>
                <textarea name="hero_description" rows="3" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ $settings['hero_description'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Localisation</label>
                <input type="text" name="hero_location" value="{{ $settings['hero_location'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
        </div>

        {{-- About --}}
        <div x-show="tab === 'about'" x-cloak class="space-y-5">
            <div>
                <label class="block text-sm text-text-muted mb-1">Titre section</label>
                <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Sous-titre</label>
                <input type="text" name="about_subtitle" value="{{ $settings['about_subtitle'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Biographie</label>
                <textarea name="about_bio" rows="6" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ $settings['about_bio'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Photo</label>
                @if(!empty($settings['about_photo']))
                    <img src="{{ Storage::url($settings['about_photo']) }}" class="w-20 h-20 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="about_photo" accept="image/*" class="text-sm text-text-muted">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Soft Skills (séparés par virgule)</label>
                <input type="text" name="about_soft_skills" value="{{ $settings['about_soft_skills'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
        </div>

        {{-- Contact --}}
        <div x-show="tab === 'contact'" x-cloak class="space-y-5">
            <div>
                <label class="block text-sm text-text-muted mb-1">Titre section</label>
                <input type="text" name="contact_title" value="{{ $settings['contact_title'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Sous-titre</label>
                <input type="text" name="contact_subtitle" value="{{ $settings['contact_subtitle'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Email de contact</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Téléphone</label>
                <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Statut de disponibilité</label>
                <input type="text" name="contact_status" value="{{ $settings['contact_status'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
        </div>

        {{-- Social --}}
        <div x-show="tab === 'social'" x-cloak class="space-y-5">
            <div>
                <label class="block text-sm text-text-muted mb-1">LinkedIn URL</label>
                <input type="url" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">GitHub URL</label>
                <input type="url" name="social_github" value="{{ $settings['social_github'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Twitter/X URL</label>
                <input type="url" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
        </div>

        {{-- SEO --}}
        <div x-show="tab === 'seo'" x-cloak class="space-y-5">
            <div>
                <label class="block text-sm text-text-muted mb-1">Meta Title</label>
                <input type="text" name="seo_title" value="{{ $settings['seo_title'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Meta Description</label>
                <textarea name="seo_description" rows="3" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ $settings['seo_description'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Meta Keywords</label>
                <input type="text" name="seo_keywords" value="{{ $settings['seo_keywords'] ?? '' }}" class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            </div>
        </div>

        <div class="mt-8">
            <x-btn tag="button" type="submit">Enregistrer les paramètres</x-btn>
        </div>
    </form>
@endsection
