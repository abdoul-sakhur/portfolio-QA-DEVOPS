@extends('layouts.admin')
@section('title', 'Nouvelle expérience')

@section('content')
    <form method="POST" action="{{ route('admin.experiences.store') }}" class="max-w-2xl">
        @csrf
        @include('admin.experiences._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer l'expérience</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.experiences.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
