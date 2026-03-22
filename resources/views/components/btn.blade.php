@props(['variant' => 'primary', 'tag' => 'a', 'size' => 'md'])
@php
    $base = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-accent/50';
    $sizes = ['sm' => 'px-3 py-1.5 text-sm', 'md' => 'px-6 py-3 text-sm', 'lg' => 'px-8 py-4 text-base'];
    $variants = [
        'primary' => 'bg-accent text-bg-dark hover:bg-accent/80',
        'outline' => 'border border-accent text-accent hover:bg-accent/10',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'secondary' => 'bg-gray-700 text-text-main hover:bg-gray-600',
    ];
    $classes = $base . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($tag === 'button')
    <button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@elseif($tag === 'a')
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@endif
