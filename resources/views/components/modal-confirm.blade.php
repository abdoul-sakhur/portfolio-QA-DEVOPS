@props(['title' => 'Confirmer la suppression', 'message' => 'Êtes-vous sûr de vouloir supprimer cet élément ?'])
<div x-data="{ open: false }" {{ $attributes }}>
    <span @click="open = true">{{ $trigger ?? '' }}</span>

    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/70" @click="open = false"></div>
            <div x-show="open" x-transition class="relative bg-primary border border-gray-700 rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold text-text-main mb-2">{{ $title }}</h3>
                <p class="text-text-muted text-sm mb-6">{{ $message }}</p>
                <div class="flex justify-end gap-3">
                    <button @click="open = false" class="px-4 py-2 text-sm text-text-muted hover:text-text-main transition rounded-lg bg-gray-800">Annuler</button>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </template>
</div>
