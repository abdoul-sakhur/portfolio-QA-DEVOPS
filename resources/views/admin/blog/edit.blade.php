@extends('layouts.admin')
@section('title', 'Modifier l\'article')

@section('content')
    <form method="POST" action="{{ route('admin.blog.update', $blog) }}" enctype="multipart/form-data" class="max-w-5xl">
        @csrf @method('PUT')
        @include('admin.blog._form', ['post' => $blog])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.blog.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
