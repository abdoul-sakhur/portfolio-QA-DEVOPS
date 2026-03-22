@props(['title' => 'terminal'])
<div {{ $attributes->merge(['class' => 'bg-bg-dark rounded-lg border border-gray-800 overflow-hidden']) }}>
    <div class="flex items-center gap-2 px-4 py-2 bg-primary border-b border-gray-800">
        <span class="w-3 h-3 rounded-full bg-red-500"></span>
        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
        <span class="w-3 h-3 rounded-full bg-green-500"></span>
        <span class="text-xs text-text-muted ml-2 font-mono">{{ $title }}</span>
    </div>
    <div class="p-4 font-mono text-sm leading-relaxed">
        {{ $slot }}
    </div>
</div>
