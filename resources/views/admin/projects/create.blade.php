@extends('layouts.admin')
@section('title', 'Nouveau projet')

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @include('admin.projects._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer le projet</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.projects.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
