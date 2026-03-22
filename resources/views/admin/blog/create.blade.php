@extends('layouts.admin')
@section('title', 'Nouvel article')

@section('content')
    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="max-w-5xl">
        @csrf
        @include('admin.blog._form')
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Créer l'article</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.blog.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
