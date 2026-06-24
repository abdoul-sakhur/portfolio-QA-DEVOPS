@props(['subtitle' => null])
<div {{ $attributes->merge(['class' => 'mb-12 text-center']) }}>
    @if($subtitle)
        <p class="text-accent font-mono text-xs tracking-widest uppercase mb-3">// {{ $subtitle }}</p>
    @endif
    <h2 class="text-3xl md:text-4xl font-bold text-text-main">{{ $slot }}</h2>
    <div class="mt-5 flex items-center justify-center gap-3">
        <span class="w-10 h-px bg-accent/30"></span>
        <span class="text-accent font-mono text-xs">▸</span>
        <span class="w-10 h-px bg-accent/30"></span>
    </div>
</div>
