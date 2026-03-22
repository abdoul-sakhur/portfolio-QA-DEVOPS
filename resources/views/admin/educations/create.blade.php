@extends('layouts.admin')
@section('title', 'Nouvelle formation')

@section('content')
    <form method="POST" action="{{ route('admin.educations.store') }}" class="max-w-2xl">
        @csrf
        @include('admin.educations._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer la formation</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.educations.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
