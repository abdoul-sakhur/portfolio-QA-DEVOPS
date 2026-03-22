@props(['hover' => true])
<div {{ $attributes->merge(['class' => 'bg-primary rounded-lg border border-gray-800 p-6 transition-all duration-300' . ($hover ? ' hover:-translate-y-1 hover:border-accent/50' : '')]) }}>
    {{ $slot }}
</div>
