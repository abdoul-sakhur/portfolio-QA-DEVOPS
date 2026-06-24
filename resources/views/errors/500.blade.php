@extends('layouts.public')
@section('title', 'Erreur serveur — 500')

@section('content')
<section class="min-h-[70vh] flex items-center py-20">
    <div class="container mx-auto px-6 text-center">
        <p class="text-red-400 font-mono text-sm mb-4">Erreur 500</p>
        <h1 class="text-6xl md:text-8xl font-bold text-text-main mb-4 font-mono">500</h1>
        <p class="text-text-muted text-lg mb-8 max-w-md mx-auto">Une erreur interne est survenue sur le serveur.</p>

        <x-terminal-block title="~/terminal">
            <p><span class="text-green-400">$</span> <span class="text-text-muted">curl {{ request()->url() }}</span></p>
            <p class="text-red-400 mt-1">500 Internal Server Error — Le serveur a rencontré une erreur inattendue.</p>
            <p class="mt-2"><span class="text-green-400">$</span> <span class="text-text-muted">echo "Retourner à l'accueil"</span></p>
            <p class="text-accent">→ <a href="{{ route('home') }}" class="underline hover:text-text-main">Page d'accueil</a></p>
        </x-terminal-block>

        <div class="mt-8 flex flex-wrap gap-4 justify-center">
            <x-btn href="{{ route('home') }}">Retour à l'accueil</x-btn>
            <x-btn variant="outline" href="{{ route('contact') }}">Signaler le problème</x-btn>
        </div>
    </div>
</section>
@endsection
