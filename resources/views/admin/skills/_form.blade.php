@php $s = $skill ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Nom *</label>
        <input type="text" name="name" value="{{ old('name', $s?->name) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Icône (image PNG)</label>
        <input type="file" name="icon" accept="image/png"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-accent file:text-white">
        @if($s?->icon)
            <div class="mt-2 flex items-center gap-2">
                <img src="{{ asset('storage/' . $s->icon) }}" alt="Icône actuelle" class="w-10 h-10 object-contain rounded">
                <span class="text-xs text-text-muted">Icône actuelle</span>
            </div>
        @endif
        @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Niveau (0-100) *</label>
            <input type="number" name="level" value="{{ old('level', $s?->level ?? 50) }}" min="0" max="100" required
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('level') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Ordre</label>
            <input type="number" name="order" value="{{ old('order', $s?->order ?? 0) }}" min="0"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('order') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Catégorie *</label>
        <input type="text" name="category" value="{{ old('category', $s?->category) }}" required placeholder="QA, DevOps, Automatisation…"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('category') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
