@extends('layouts.admin')
@section('title', 'Modifier le témoignage')

@section('content')
    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.testimonials._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.testimonials.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
