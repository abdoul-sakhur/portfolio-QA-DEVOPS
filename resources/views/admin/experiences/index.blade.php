@extends('layouts.admin')
@section('title', 'Expériences')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-text-main">Toutes les expériences</h2>
        <x-btn href="{{ route('admin.experiences.create') }}" size="sm">+ Nouvelle expérience</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Ordre</th>
                    <th class="px-4 py-3">Poste</th>
                    <th class="px-4 py-3">Entreprise</th>
                    <th class="px-4 py-3">Période</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $exp)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-muted font-mono text-xs">{{ $exp->order }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $exp->title }}</td>
                        <td class="px-4 py-3 text-text-muted">{{ $exp->company }}</td>
                        <td class="px-4 py-3 text-text-muted text-xs">
                            {{ $exp->start_date?->format('m/Y') }}
                            —
                            {{ $exp->is_current ? 'Présent' : $exp->end_date?->format('m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.experiences.destroy', $exp) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-text-muted">Aucune expérience.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $experiences->links() }}</div>
@endsection
