@extends('layouts.admin')
@section('title', 'Compétences')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-text-main">Toutes les compétences</h2>
        <x-btn href="{{ route('admin.skills.create') }}" size="sm">+ Nouvelle compétence</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Ordre</th>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Catégorie</th>
                    <th class="px-4 py-3">Niveau</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-muted font-mono text-xs">{{ $skill->order }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">
                            @if($skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}" class="w-6 h-6 object-contain inline-block mr-1">
                            @endif
                            {{ $skill->name }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-bg-dark text-accent px-2 py-1 rounded font-mono">{{ $skill->category ?? '—' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 bg-bg-dark rounded-full h-2">
                                    <div class="bg-accent h-2 rounded-full" style="width: {{ $skill->level }}%"></div>
                                </div>
                                <span class="text-text-muted text-xs">{{ $skill->level }}%</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-text-muted">Aucune compétence.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $skills->links() }}</div>
@endsection
