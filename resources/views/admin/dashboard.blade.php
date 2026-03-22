@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <x-card :hover="false">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text-main">{{ $stats['projects'] }}</p>
                    <p class="text-sm text-text-muted">Projets</p>
                </div>
            </div>
        </x-card>
        <x-card :hover="false">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text-main">{{ $stats['posts'] }}</p>
                    <p class="text-sm text-text-muted">Articles</p>
                </div>
            </div>
        </x-card>
        <x-card :hover="false">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-yellow-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text-main">{{ $stats['certifications'] }}</p>
                    <p class="text-sm text-text-muted">Certifications</p>
                </div>
            </div>
        </x-card>
        <x-card :hover="false">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-red-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text-main">{{ $stats['messages'] }}</p>
                    <p class="text-sm text-text-muted">Messages non lus</p>
                </div>
            </div>
        </x-card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-card :hover="false">
            <h3 class="text-lg font-semibold text-text-main mb-4">Raccourcis</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.projects.create') }}" class="flex items-center gap-2 p-3 rounded-lg bg-bg-dark hover:bg-accent/10 text-text-muted hover:text-accent transition text-sm">
                    <span>+</span> Nouveau projet
                </a>
                <a href="{{ route('admin.blog.create') }}" class="flex items-center gap-2 p-3 rounded-lg bg-bg-dark hover:bg-accent/10 text-text-muted hover:text-accent transition text-sm">
                    <span>+</span> Nouvel article
                </a>
                <a href="{{ route('admin.certifications.create') }}" class="flex items-center gap-2 p-3 rounded-lg bg-bg-dark hover:bg-accent/10 text-text-muted hover:text-accent transition text-sm">
                    <span>+</span> Nouvelle certification
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 p-3 rounded-lg bg-bg-dark hover:bg-accent/10 text-text-muted hover:text-accent transition text-sm">
                    ⚙ Paramètres
                </a>
            </div>
        </x-card>
        <x-card :hover="false">
            <h3 class="text-lg font-semibold text-text-main mb-4">Derniers messages</h3>
            @php $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get(); @endphp
            @forelse($recentMessages as $msg)
                <a href="{{ route('admin.messages.show', $msg) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-bg-dark transition mb-1">
                    <div>
                        <span class="text-sm text-text-main {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</span>
                        <span class="text-xs text-text-muted ml-2">{{ Str::limit($msg->subject ?? $msg->message, 40) }}</span>
                    </div>
                    <span class="text-xs text-text-muted">{{ $msg->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="text-sm text-text-muted">Aucun message.</p>
            @endforelse
        </x-card>
    </div>
@endsection
