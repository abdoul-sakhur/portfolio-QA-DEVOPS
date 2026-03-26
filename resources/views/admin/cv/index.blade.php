@extends('layouts.admin')

@section('title', 'Mon CV')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-text-main mb-6">Mon CV</h2>

    @if($cv)
        <div class="bg-primary border border-gray-800 rounded-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-text-main font-semibold">{{ $cv->title }}</p>
                    <p class="text-text-muted text-sm mt-1">Uploadé le {{ $cv->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.cv.download', $cv) }}" class="text-accent hover:underline text-sm">Télécharger</a>
                    <form action="{{ route('admin.cv.destroy', $cv) }}" method="post" onsubmit="return confirm('Supprimer ce CV ?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-300 text-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="bg-primary border border-gray-800 rounded-lg p-6 mb-6 text-text-muted">
            Aucun CV uploadé pour le moment.
        </div>
    @endif

    <div class="bg-primary border border-gray-800 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">{{ $cv ? 'Remplacer le CV' : 'Uploader un CV' }}</h3>
        <form action="{{ route('admin.cv.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-text-muted mb-1">Titre</label>
                <input type="text" name="title" class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-2 text-text-main focus:border-accent focus:outline-none" value="{{ old('title') ?: 'Mon CV' }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-text-muted mb-1">Fichier (PDF, DOC, DOCX — max 5 Mo)</label>
                <input type="file" name="file" class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-2 text-text-main file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-accent file:text-primary file:font-semibold" accept=".pdf,.doc,.docx" required>
            </div>
            <button type="submit" class="bg-accent text-primary font-semibold px-6 py-2 rounded-lg hover:shadow-lg hover:shadow-accent/20 transition">Uploader</button>
        </form>
    </div>
</div>
@endsection
