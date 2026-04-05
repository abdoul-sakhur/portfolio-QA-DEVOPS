@extends('layouts.admin')
@section('title', 'Témoignages')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-text-main">Tous les témoignages</h2>
        <x-btn href="{{ route('admin.testimonials.create') }}" size="sm">+ Nouveau témoignage</x-btn>
    </div>

    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Entreprise</th>
                    <th class="px-4 py-3">Note</th>
                    <th class="px-4 py-3">Publié</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition">
                        <td class="px-4 py-3 text-text-main font-medium">
                            @if($testimonial->client_photo)
                                <img src="{{ Storage::url($testimonial->client_photo) }}" alt="" class="w-8 h-8 rounded-full object-cover inline-block mr-2">
                            @endif
                            {{ $testimonial->client_name }}
                        </td>
                        <td class="px-4 py-3 text-text-muted text-xs">{{ $testimonial->client_company ?? '—' }}</td>
                        <td class="px-4 py-3 text-accent">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-700' }}">★</span>
                            @endfor
                        </td>
                        <td class="px-4 py-3">
                            @if($testimonial->is_published)
                                <span class="text-xs bg-green-900/30 text-green-400 px-2 py-1 rounded">Oui</span>
                            @else
                                <span class="text-xs text-text-muted">Non</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-text-muted hover:text-accent transition text-xs">Modifier</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}">
                                        @csrf @method('DELETE')
                                        <p class="text-text-muted mb-4">Supprimer le témoignage de <strong class="text-text-main">{{ $testimonial->client_name }}</strong> ?</p>
                                        <x-btn tag="button" type="submit" class="bg-red-600 hover:bg-red-500">Supprimer</x-btn>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-text-muted">Aucun témoignage.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $testimonials->links() }}</div>
@endsection
