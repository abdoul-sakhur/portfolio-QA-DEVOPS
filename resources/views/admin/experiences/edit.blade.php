@extends('layouts.admin')
@section('title', 'Modifier l\'expérience')

@section('content')
    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.experiences._form', ['exp' => $experience])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.experiences.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
