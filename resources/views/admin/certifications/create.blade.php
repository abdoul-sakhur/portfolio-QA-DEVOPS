@extends('layouts.admin')
@section('title', 'Nouvelle certification')

@section('content')
    <form method="POST" action="{{ route('admin.certifications.store') }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @include('admin.certifications._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer la certification</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.certifications.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
