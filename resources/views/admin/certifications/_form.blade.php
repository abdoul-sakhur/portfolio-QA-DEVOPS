@php $c = $cert ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $c?->title) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Émetteur *</label>
        <input type="text" name="issuer" value="{{ old('issuer', $c?->issuer) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('issuer') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Date d'obtention</label>
            <input type="date" name="issue_date" value="{{ old('issue_date', $c?->issue_date?->format('Y-m-d')) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('issue_date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Date d'expiration</label>
            <input type="date" name="expiry_date" value="{{ old('expiry_date', $c?->expiry_date?->format('Y-m-d')) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('expiry_date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">URL du badge / credential</label>
        <input type="url" name="credential_url" value="{{ old('credential_url', $c?->credential_url) }}"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('credential_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Catégorie *</label>
        <select name="category_id" required
                class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            <option value="">-- Choisir --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $c?->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Image du badge</label>
        @if($c?->cover_image)
            <img src="{{ Storage::url($c->cover_image) }}" class="w-24 h-24 object-contain rounded mb-2">
        @endif
        <input type="file" name="cover_image" accept="image/*" class="text-sm text-text-muted">
        @error('cover_image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
