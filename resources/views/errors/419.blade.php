@extends('layouts.public')
@section('title', 'Session expirée — 419')

@section('content')
<section class="min-h-[70vh] flex items-center py-20">
    <div class="container mx-auto px-6 text-center">
        <p class="text-accent font-mono text-sm mb-4">Erreur 419</p>
        <h1 class="text-6xl md:text-8xl font-bold text-text-main mb-4 font-mono">419</h1>
        <p class="text-text-muted text-lg mb-8 max-w-md mx-auto">Votre session a expiré. Veuillez recharger la page et réessayer.</p>

        <x-terminal-block title="~/terminal">
            <p><span class="text-green-400">$</span> <span class="text-text-muted">verify --csrf-token</span></p>
            <p class="text-yellow-400 mt-1">419 Page Expired — Le jeton CSRF est invalide ou expiré.</p>
            <p class="mt-2"><span class="text-green-400">$</span> <span class="text-text-muted">echo "Recharger la page"</span></p>
            <p class="text-accent">→ <a href="javascript:history.back()" class="underline hover:text-text-main">Retour à la page précédente</a></p>
        </x-terminal-block>

        <div class="mt-8 flex flex-wrap gap-4 justify-center">
            <x-btn href="javascript:location.reload()">Recharger la page</x-btn>
            <x-btn variant="outline" href="{{ route('home') }}">Accueil</x-btn>
        </div>
    </div>
</section>
@endsection
