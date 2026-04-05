@extends('layouts.admin')
@section('title', 'Services')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-text-main">Tous les services</h2>
        <x-btn href="{{ route('admin.services.create') }}" size="sm">+ Nouveau service</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Ordre</th>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Tarif</th>
                    <th class="px-4 py-3">Durée</th>
                    <th class="px-4 py-3">Mis en avant</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-muted font-mono text-xs">{{ $service->order }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">
                            @if($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" alt="" class="w-6 h-6 object-contain inline-block mr-1">
                            @endif
                            {{ $service->title }}
                        </td>
                        <td class="px-4 py-3 text-accent text-xs font-mono">{{ $service->price_label ?? '—' }}</td>
                        <td class="px-4 py-3 text-text-muted text-xs">{{ $service->duration ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if($service->is_featured)
                                <span class="text-xs bg-accent/20 text-accent px-2 py-1 rounded">Oui</span>
                            @else
                                <span class="text-xs text-text-muted">Non</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}">
                                        @csrf @method('DELETE')
                                        <p class="text-text-muted mb-4">Supprimer le service <strong class="text-text-main">{{ $service->title }}</strong> ?</p>
                                        <x-btn tag="button" type="submit" class="bg-red-600 hover:bg-red-500">Supprimer</x-btn>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-text-muted">Aucun service.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $services->links() }}</div>
@endsection
