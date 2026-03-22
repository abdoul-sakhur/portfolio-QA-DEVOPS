@extends('layouts.admin')
@section('title', 'Projets')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher…"
                   class="bg-bg-dark border border-gray-800 rounded-lg px-4 py-2 text-text-main text-sm focus:outline-none focus:border-accent transition w-64">
            <x-btn tag="button" type="submit" size="sm">Chercher</x-btn>
        </form>
        <x-btn href="{{ route('admin.projects.create') }}" size="sm">+ Nouveau projet</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Ordre</th>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Catégorie</th>
                    <th class="px-4 py-3">Vedette</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-muted font-mono">{{ $project->order }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $project->title }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-bg-dark text-accent px-2 py-1 rounded font-mono">{{ $project->category->name ?? '—' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($project->is_featured)
                                <span class="text-accent">★</span>
                            @else
                                <span class="text-text-muted">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-text-muted">Aucun projet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $projects->withQueryString()->links() }}</div>
@endsection
