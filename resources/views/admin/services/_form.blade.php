@php $s = $service ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $s?->title) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Icône (image)</label>
        <input type="file" name="icon" accept="image/*"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-accent file:text-white">
        @if($s?->icon)
            <div class="mt-2 flex items-center gap-2">
                <img src="{{ Storage::url($s->icon) }}" alt="Icône actuelle" class="w-10 h-10 object-contain rounded">
                <span class="text-xs text-text-muted">Icône actuelle</span>
            </div>
        @endif
        @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Description courte *</label>
        <textarea name="short_description" rows="3" required
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('short_description', $s?->short_description) }}</textarea>
        @error('short_description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Description détaillée</label>
        <textarea name="description" rows="6"
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('description', $s?->description) }}</textarea>
        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Tarif</label>
            <input type="text" name="price_label" value="{{ old('price_label', $s?->price_label) }}" placeholder="Sur devis, À partir de 500€…"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('price_label') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Durée estimée</label>
            <input type="text" name="duration" value="{{ old('duration', $s?->duration) }}" placeholder="1-2 semaines, Sur mesure…"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('duration') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Ordre</label>
            <input type="number" name="order" value="{{ old('order', $s?->order ?? 0) }}" min="0"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('order') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 cursor-pointer pb-3">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $s?->is_featured) ? 'checked' : '' }}
                       class="rounded border-gray-700 bg-bg-dark text-accent focus:ring-accent">
                <span class="text-sm text-text-muted">Mettre en avant</span>
            </label>
        </div>
    </div>
</div>
