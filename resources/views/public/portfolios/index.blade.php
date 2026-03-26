@extends('layouts.public')

@section('content')
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl font-bold section-title mb-10">Portfolios</h2>

        @if($portfolios->isEmpty())
            <p class="text-text-muted">Aucun portfolio disponible.</p>
        @else
            <div class="space-y-4">
                @foreach($portfolios as $portfolio)
                    <div class="bg-primary border border-gray-800 rounded-lg p-5 flex items-center justify-between card-hover">
                        <div>
                            <p class="text-text-main font-semibold">{{ $portfolio->title }}</p>
                            <p class="text-text-muted text-sm">{{ $portfolio->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
