@extends('layouts.admin')
@section('title', 'Modifier la certification')

@section('content')
    <form method="POST" action="{{ route('admin.certifications.update', $certification) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.certifications._form', ['cert' => $certification])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.certifications.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
