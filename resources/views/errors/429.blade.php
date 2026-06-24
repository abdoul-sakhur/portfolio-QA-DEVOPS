@extends('layouts.public')
@section('title', 'Trop de requêtes — 429')

@section('content')
<section class="min-h-[70vh] flex items-center py-20">
    <div class="container mx-auto px-6 text-center">
        <p class="text-accent font-mono text-sm mb-4">Erreur 429</p>
        <h1 class="text-6xl md:text-8xl font-bold text-text-main mb-4 font-mono">429</h1>
        <p class="text-text-muted text-lg mb-8 max-w-md mx-auto">Trop de requêtes envoyées. Merci de patienter quelques instants avant de réessayer.</p>

        <x-terminal-block title="~/terminal">
            <p><span class="text-green-400">$</span> <span class="text-text-muted">curl --rate-limit {{ request()->url() }}</span></p>
            <p class="text-yellow-400 mt-1">429 Too Many Requests — Limite de débit atteinte.</p>
            <p class="mt-2"><span class="text-green-400">$</span> <span class="text-text-muted">sleep 60 && retry</span></p>
            <p class="text-accent animate-pulse">// en attente...</p>
        </x-terminal-block>

        <div class="mt-8 flex flex-wrap gap-4 justify-center">
            <x-btn href="{{ route('home') }}">Retour à l'accueil</x-btn>
        </div>
    </div>
</section>
@endsection
