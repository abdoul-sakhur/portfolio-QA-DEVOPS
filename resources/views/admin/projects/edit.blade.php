@extends('layouts.admin')
@section('title', 'Modifier le projet')

@section('content')
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.projects._form', ['project' => $project])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.projects.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
