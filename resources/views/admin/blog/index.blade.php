@extends('layouts.admin')
@section('title', 'Blog')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher…"
                   class="bg-bg-dark border border-gray-800 rounded-lg px-4 py-2 text-text-main text-sm focus:outline-none focus:border-accent transition w-64">
            <x-btn tag="button" type="submit" size="sm">Chercher</x-btn>
        </form>
        <x-btn href="{{ route('admin.blog.create') }}" size="sm">+ Nouvel article</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Catégorie</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-main font-medium">{{ $post->title }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-bg-dark text-accent px-2 py-1 rounded font-mono">{{ $post->category->name ?? '—' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($post->is_published)
                                <span class="text-green-400 text-xs">Publié</span>
                            @else
                                <span class="text-yellow-400 text-xs">Brouillon</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-text-muted text-xs">{{ $post->published_at?->format('d/m/Y') ?? '—' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.blog.edit', $post) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-text-muted">Aucun article.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $posts->withQueryString()->links() }}</div>
@endsection
