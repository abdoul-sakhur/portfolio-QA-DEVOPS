@extends('layouts.admin')
@section('title', 'Modifier la compétence')

@section('content')
    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf @method('PUT')
        @include('admin.skills._form', ['skill' => $skill])
        <div class="mt-6 flex gap-3">
            <x-btn tag="button" type="submit">Enregistrer</x-btn>
            <x-btn variant="secondary" href="{{ route('admin.skills.index') }}">Annuler</x-btn>
        </div>
    </form>
@endsection
