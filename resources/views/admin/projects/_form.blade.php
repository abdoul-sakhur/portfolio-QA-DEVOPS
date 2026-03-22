@php $p = $project ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $p?->title) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Description *</label>
        <textarea name="description" rows="6" required
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('description', $p?->description) }}</textarea>
        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">URL Démo</label>
            <input type="url" name="url" value="{{ old('url', $p?->url) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">GitHub URL</label>
            <input type="url" name="github_url" value="{{ old('github_url', $p?->github_url) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('github_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Catégorie *</label>
            <select name="category_id" required
                    class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $p?->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Ordre</label>
            <input type="number" name="order" value="{{ old('order', $p?->order ?? 0) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        </div>
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Image de couverture</label>
        @if($p?->cover_image)
            <img src="{{ Storage::url($p->cover_image) }}" class="w-32 h-20 object-cover rounded mb-2">
        @endif
        <input type="file" name="cover_image" accept="image/*" class="text-sm text-text-muted">
        @error('cover_image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $p?->is_featured) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-600 text-accent focus:ring-accent bg-bg-dark">
        <span class="text-sm text-text-muted">Projet vedette</span>
    </label>
</div>
