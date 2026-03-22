@extends('layouts.admin')
@section('title', 'Formations')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-text-main">Toutes les formations</h2>
        <x-btn href="{{ route('admin.educations.create') }}" size="sm">+ Nouvelle formation</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Diplôme</th>
                    <th class="px-4 py-3">Établissement</th>
                    <th class="px-4 py-3">Période</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($educations as $edu)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-main font-medium">{{ $edu->degree }}</td>
                        <td class="px-4 py-3 text-text-muted">{{ $edu->school }}</td>
                        <td class="px-4 py-3 text-text-muted text-xs">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Présent' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.educations.edit', $edu) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.educations.destroy', $edu) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-text-muted">Aucune formation.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $educations->links() }}</div>
@endsection
