@php $ed = $edu ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Diplôme *</label>
        <input type="text" name="degree" value="{{ old('degree', $ed?->degree) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('degree') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Établissement *</label>
        <input type="text" name="school" value="{{ old('school', $ed?->school) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('school') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Année de début *</label>
            <input type="number" name="start_year" value="{{ old('start_year', $ed?->start_year) }}" required min="1990" max="2099"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('start_year') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Année de fin</label>
            <input type="number" name="end_year" value="{{ old('end_year', $ed?->end_year) }}" min="1990" max="2099"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('end_year') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-y">{{ old('description', $ed?->description) }}</textarea>
        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
