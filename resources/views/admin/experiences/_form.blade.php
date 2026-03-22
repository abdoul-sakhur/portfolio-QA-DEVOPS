@php $e = $exp ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Poste / Titre *</label>
        <input type="text" name="title" value="{{ old('title', $e?->title) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Entreprise *</label>
        <input type="text" name="company" value="{{ old('company', $e?->company) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('company') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Date de début *</label>
            <input type="date" name="start_date" value="{{ old('start_date', $e?->start_date?->format('Y-m-d')) }}" required
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('start_date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Date de fin</label>
            <input type="date" name="end_date" value="{{ old('end_date', $e?->end_date?->format('Y-m-d')) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('end_date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_current" value="0">
        <input type="checkbox" name="is_current" value="1" {{ old('is_current', $e?->is_current) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-600 text-accent focus:ring-accent bg-bg-dark">
        <span class="text-sm text-text-muted">Poste actuel</span>
    </label>
    <div>
        <label class="block text-sm text-text-muted mb-1">Description</label>
        <textarea name="description" rows="4"
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-y">{{ old('description', $e?->description) }}</textarea>
        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Ordre</label>
        <input type="number" name="order" value="{{ old('order', $e?->order ?? 0) }}" min="0"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('order') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
