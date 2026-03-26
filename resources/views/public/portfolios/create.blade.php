@extends('layouts.public')

@section('content')
<section class="py-20">
    <div class="max-w-2xl mx-auto px-4">
        <h2 class="text-3xl font-bold section-title mb-10">Uploader un portfolio</h2>

        <div class="bg-primary border border-gray-800 rounded-lg p-6">
            <form action="{{ route('portfolios.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-text-muted mb-1">Titre</label>
                    <input type="text" name="title" class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-2 text-text-main focus:border-accent focus:outline-none" value="{{ old('title') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-text-muted mb-1">Fichier (PDF, DOC, DOCX)</label>
                    <input type="file" name="file" class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-2 text-text-main file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-accent file:text-primary file:font-semibold" accept=".pdf,.doc,.docx" required>
                </div>
                <button type="submit" class="bg-accent text-primary font-semibold px-6 py-2 rounded-lg hover:shadow-lg hover:shadow-accent/20 transition">Uploader</button>
            </form>
        </div>
    </div>
</section>
@endsection
