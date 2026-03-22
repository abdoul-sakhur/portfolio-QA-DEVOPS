@extends('layouts.admin')
@section('title', 'Nouvelle compétence')

@section('content')
    <form method="POST" action="{{ route('admin.skills.store') }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @include('admin.skills._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer la compétence</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.skills.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
