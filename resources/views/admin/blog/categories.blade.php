@extends('layouts.admin')
@section('title', 'Catégories du blog')

@section('content')
    <form method="POST" action="{{ route('admin.blog.categories.store') }}" class="flex gap-3 mb-8">
        @csrf
        <input type="text" name="name" placeholder="Nom de la catégorie" required
               class="flex-1 bg-bg-dark border border-gray-800 rounded-lg px-4 py-2 text-text-main text-sm focus:outline-none focus:border-accent transition">
        <x-btn tag="button" type="submit" size="sm">Ajouter</x-btn>
    </form>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Articles</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr class="border-b border-gray-800/50" x-data="{ editing: false }">
                        <td class="px-4 py-3">
                            <span x-show="!editing" class="text-text-main">{{ $cat->name }}</span>
                            <form x-show="editing" x-cloak method="POST" action="{{ route('admin.blog.categories.update', $cat) }}" class="flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $cat->name }}" class="bg-bg-dark border border-gray-800 rounded px-2 py-1 text-text-main text-sm focus:outline-none focus:border-accent">
                                <button type="submit" class="text-accent text-xs hover:underline">OK</button>
                                <button type="button" @click="editing = false" class="text-text-muted text-xs hover:underline">Annuler</button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-text-muted">{{ $cat->posts_count }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <button x-show="!editing" @click="editing = true" class="text-text-muted hover:text-accent transition text-xs">Modifier</button>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.blog.categories.destroy', $cat) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-8 text-center text-text-muted">Aucune catégorie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>
@endsection
