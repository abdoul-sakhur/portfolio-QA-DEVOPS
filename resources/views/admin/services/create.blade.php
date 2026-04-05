@extends('layouts.admin')
@section('title', 'Nouveau service')

@section('content')
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @include('admin.services._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer le service</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.services.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
