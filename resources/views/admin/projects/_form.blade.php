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
    {{-- Case Study Fields --}}
    <div class="border-t border-gray-800 pt-5 mt-5">
        <h3 class="text-accent text-sm font-semibold mb-4">Étude de cas (optionnel)</h3>
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-text-muted mb-1">Client</label>
                    <input type="text" name="client" value="{{ old('client', $p?->client) }}"
                           class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                    @error('client') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-text-muted mb-1">Durée de la mission</label>
                    <input type="text" name="mission_duration" value="{{ old('mission_duration', $p?->mission_duration) }}" placeholder="ex: 3 mois"
                           class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                    @error('mission_duration') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Problématique / Challenge</label>
                <textarea name="challenge" rows="3"
                          class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('challenge', $p?->challenge) }}</textarea>
                @error('challenge') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Solution apportée</label>
                <textarea name="solution" rows="3"
                          class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('solution', $p?->solution) }}</textarea>
                @error('solution') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-text-muted mb-1">Résultats obtenus</label>
                <textarea name="results" rows="3"
                          class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('results', $p?->results) }}</textarea>
                @error('results') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $p?->is_featured) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-600 text-accent focus:ring-accent bg-bg-dark">
        <span class="text-sm text-text-muted">Projet vedette</span>
    </label>
</div>
