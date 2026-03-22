@extends('layouts.admin')
@section('title', 'Messages')

@section('content')
    <div class="bg-primary rounded-lg border border-gray-800 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-800">
                <tr class="text-text-muted text-left">
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Sujet</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr class="border-b border-gray-800/50 hover:bg-bg-dark/50 transition {{ !$msg->is_read ? 'bg-bg-dark/30' : '' }}">
                        <td class="px-4 py-3">
                            @if(!$msg->is_read)
                                <span class="inline-block w-2 h-2 bg-accent rounded-full"></span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $msg->name }}</td>
                        <td class="px-4 py-3 text-text-muted text-xs font-mono">{{ $msg->email }}</td>
                        <td class="px-4 py-3 text-text-muted">{{ Str::limit($msg->subject, 40) }}</td>
                        <td class="px-4 py-3 text-text-muted text-xs">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="text-text-muted hover:text-accent transition text-xs">Voir</a>
                                <x-modal-confirm>
                                    <x-slot:trigger>
                                        <button type="button" class="text-red-400 hover:text-red-300 transition text-xs">Supprimer</button>
                                    </x-slot:trigger>
                                    <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                </x-modal-confirm>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-text-muted">Aucun message.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
