@extends('layouts.admin')
@section('title', 'Modifier le service')

@section('content')
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.services._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.services.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
