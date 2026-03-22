@extends('layouts.admin')
@section('title', 'Message de ' . $message->name)

@section('content')
    <div class="max-w-2xl">
        <div class="bg-primary rounded-lg border border-gray-800 p-6 space-y-4">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-text-main">{{ $message->subject ?? 'Sans sujet' }}</h2>
                    <p class="text-text-muted text-sm mt-1">De <strong class="text-accent">{{ $message->name }}</strong> &lt;{{ $message->email }}&gt;</p>
                    <p class="text-text-muted text-xs mt-1">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                @if(!$message->is_read)
                    <span class="text-xs bg-accent/20 text-accent px-2 py-1 rounded">Non lu</span>
                @endif
            </div>

            <hr class="border-gray-800">

            <div class="text-text-main text-sm leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>
        </div>

        <div class="mt-6 flex gap-3">
            <x-btn href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}">Répondre par email</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.messages.index') }}">Retour</x-btn>
            <x-modal-confirm>
                <x-slot:trigger>
                    <x-btn variant="danger" tag="button" type="button">Supprimer</x-btn>
                </x-slot:trigger>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                </form>
            </x-modal-confirm>
        </div>
    </div>
@endsection
