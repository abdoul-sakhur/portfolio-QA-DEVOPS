@extends('layouts.admin')
@section('title', 'Nouveau témoignage')

@section('content')
    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @include('admin.testimonials._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer le témoignage</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.testimonials.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
