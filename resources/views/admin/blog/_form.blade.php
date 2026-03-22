@php $p = $post ?? null; @endphp
<div class="space-y-5">
    <div>
        <label class="block text-sm text-text-muted mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $p?->title) }}" required
               class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm">
        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Extrait</label>
        <textarea name="excerpt" rows="2"
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm resize-none">{{ old('excerpt', $p?->excerpt) }}</textarea>
        @error('excerpt') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm text-text-muted mb-1">Contenu *</label>
        <textarea name="content" id="editor-content" rows="12"
                  class="w-full bg-bg-dark border border-gray-800 rounded-lg px-4 py-3 text-text-main focus:outline-none focus:border-accent transition text-sm font-mono resize-y">{{ old('content', $p?->content) }}</textarea>
        @error('content') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
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
        <label class="block text-sm text-text-muted mb-1">Image de couverture</label>
        @if($p?->cover_image)
            <img src="{{ Storage::url($p->cover_image) }}" class="w-32 h-20 object-cover rounded mb-2">
        @endif
        <input type="file" name="cover_image" accept="image/*" class="text-sm text-text-muted">
        @error('cover_image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $p?->is_published) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-600 text-accent focus:ring-accent bg-bg-dark">
        <span class="text-sm text-text-muted">Publié</span>
    </label>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#editor-content',
        base_url: 'https://cdn.jsdelivr.net/npm/tinymce@6',
        suffix: '.min',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'codesample'
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                 'forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                 'bullist numlist outdent indent | link image media codesample | ' +
                 'table blockquote hr | removeformat fullscreen code help',
        block_formats: 'Paragraphe=p; Titre 2=h2; Titre 3=h3; Titre 4=h4; Préformaté=pre',
        skin: 'oxide-dark',
        content_css: 'dark',
        content_style: `
            body {
                font-family: Inter, sans-serif;
                font-size: 15px;
                color: #ccd6f6;
                background: #020c1b;
                line-height: 1.8;
            }
            h2 { font-size: 1.5em; font-weight: 700; margin: 1em 0 0.5em; color: #e2e8f0; }
            h3 { font-size: 1.25em; font-weight: 600; margin: 1em 0 0.5em; color: #e2e8f0; }
            h4 { font-size: 1.1em; font-weight: 600; margin: 1em 0 0.5em; color: #e2e8f0; }
            a { color: #64ffda; }
            blockquote { border-left: 3px solid #64ffda; padding-left: 1em; color: #8892b0; font-style: italic; }
            pre { background: #0a192f; padding: 1em; border-radius: 8px; overflow-x: auto; }
            code { font-family: 'Fira Code', monospace; font-size: 0.9em; }
            img { max-width: 100%; height: auto; border-radius: 8px; }
            table { border-collapse: collapse; width: 100%; }
            table td, table th { border: 1px solid #1e293b; padding: 8px 12px; }
        `,
        images_upload_url: '{{ route("admin.blog.upload-image") }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        images_reuse_filename: false,
        file_picker_types: 'image',
        setup: function(editor) {
            editor.on('init', function() {
                // Sync content to textarea on form submit
                var form = editor.getElement().closest('form');
                if (form) {
                    form.addEventListener('submit', function() {
                        editor.save();
                    });
                }

                // Image upload handler with CSRF
                editor.options.set('images_upload_handler', function(blobInfo) {
                    return new Promise(function(resolve, reject) {
                        var formData = new FormData();
                        formData.append('image', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch('{{ route("admin.blog.upload-image") }}', {
                            method: 'POST',
                            body: formData,
                            credentials: 'same-origin'
                        })
                        .then(function(response) { return response.json(); })
                        .then(function(result) {
                            if (result.location) {
                                resolve(result.location);
                            } else {
                                reject('Upload échoué: ' + (result.error || 'Erreur inconnue'));
                            }
                        })
                        .catch(function() {
                            reject('Erreur réseau lors de l\'upload');
                        });
                    });
                });
            });
        },
        promotion: false,
        branding: false
    });
</script>
@endpush
