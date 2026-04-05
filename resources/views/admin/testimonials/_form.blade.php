@php $t = $testimonial ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Nom du client *</label>
        <input type="text" name="client_name" value="{{ old('client_name', $t?->client_name) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('client_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Entreprise</label>
            <input type="text" name="client_company" value="{{ old('client_company', $t?->client_company) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('client_company') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Rôle / Poste</label>
            <input type="text" name="client_role" value="{{ old('client_role', $t?->client_role) }}"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('client_role') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Photo du client</label>
        <input type="file" name="client_photo" accept="image/*"
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-accent file:text-white">
        @if($t?->client_photo)
            <div class="mt-2 flex items-center gap-2">
                <img src="{{ Storage::url($t->client_photo) }}" alt="" class="w-10 h-10 object-cover rounded-full">
                <span class="text-xs text-text-muted">Photo actuelle</span>
            </div>
        @endif
        @error('client_photo') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Témoignage *</label>
        <textarea name="content" rows="4" required
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('content', $t?->content) }}</textarea>
        @error('content') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-text-muted mb-1">Note (1-5) *</label>
            <select name="rating" required
                    class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating', $t?->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
            @error('rating') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-text-muted mb-1">Ordre</label>
            <input type="number" name="order" value="{{ old('order', $t?->order ?? 0) }}" min="0"
                   class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
            @error('order') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $t?->is_published) ? 'checked' : '' }}
                   class="rounded border-gray-700 bg-bg-dark text-accent focus:ring-accent">
            <span class="text-sm text-text-muted">Publié</span>
        </label>
    </div>
</div>
