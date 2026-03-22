@extends('layouts.admin')
@section('title', 'Modifier la formation')

@section('content')
    <form method="POST" action="{{ route('admin.educations.update', $education) }}" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.educations._form', ['edu' => $education])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.educations.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
