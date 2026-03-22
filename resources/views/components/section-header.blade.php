@props(['subtitle' => null])
<div {{ $attributes->merge(['class' => 'mb-12 text-center']) }}>
    <h2 class="text-3xl md:text-4xl font-bold text-text-main mb-4">{{ $slot }}</h2>
    @if($subtitle)
        <p class="text-text-muted max-w-2xl mx-auto">{{ $subtitle }}</p>
    @endif
    <div class="mt-4 w-20 h-1 bg-accent mx-auto rounded"></div>
</div>
