@extends('layouts.public')
@section('title', $post->title)

@section('content')
    <article class="py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-8 text-sm text-text-muted">
                    <a href="{{ route('blog.index') }}" class="hover:text-accent">Blog</a>
                    <span class="mx-2">/</span>
                    <span class="text-text-main">{{ $post->title }}</span>
                </nav>

                @if($post->cover_image)
                    <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-64 md:h-80 object-cover rounded-lg mb-8">
                @endif

                <div class="flex flex-wrap items-center gap-3 mb-4 text-sm">
                    @if($post->category)
                        <span class="text-accent font-mono bg-accent/10 px-3 py-1 rounded-full text-xs">{{ $post->category->name }}</span>
                    @endif
                    <span class="text-text-muted">{{ $post->published_at?->format('d M Y') }}</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-text-main mb-4">{{ $post->title }}</h1>

                @if($post->excerpt)
                    <p class="text-text-muted text-lg mb-8 leading-relaxed border-l-2 border-accent/30 pl-4 italic">{{ $post->excerpt }}</p>
                @endif

                <div class="blog-content max-w-none text-text-muted leading-relaxed">
                    {!! $post->content !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-800">
                    <a href="{{ route('blog.index') }}" class="text-accent hover:underline">← Retour au blog</a>
                </div>
            </div>
        </div>
    </article>

    <style>
        .blog-content h2 { font-size: 1.5em; font-weight: 700; margin: 1.5em 0 0.5em; color: #e2e8f0; }
        .blog-content h3 { font-size: 1.25em; font-weight: 600; margin: 1.2em 0 0.5em; color: #e2e8f0; }
        .blog-content h4 { font-size: 1.1em; font-weight: 600; margin: 1em 0 0.5em; color: #e2e8f0; }
        .blog-content p { margin-bottom: 1em; }
        .blog-content a { color: #64ffda; text-decoration: underline; text-underline-offset: 2px; }
        .blog-content a:hover { opacity: 0.8; }
        .blog-content strong { color: #ccd6f6; font-weight: 600; }
        .blog-content em { font-style: italic; }
        .blog-content ul, .blog-content ol { margin: 1em 0; padding-left: 1.5em; }
        .blog-content ul { list-style-type: disc; }
        .blog-content ol { list-style-type: decimal; }
        .blog-content li { margin-bottom: 0.4em; }
        .blog-content blockquote {
            border-left: 3px solid #64ffda;
            padding: 0.5em 1em;
            margin: 1.5em 0;
            color: #8892b0;
            font-style: italic;
            background: rgba(10, 25, 47, 0.5);
            border-radius: 0 8px 8px 0;
        }
        .blog-content pre {
            background: #0a192f;
            padding: 1em 1.25em;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1.5em 0;
            border: 1px solid #1e293b;
        }
        .blog-content code {
            font-family: 'Fira Code', monospace;
            font-size: 0.9em;
        }
        .blog-content :not(pre) > code {
            background: #0a192f;
            padding: 0.15em 0.4em;
            border-radius: 4px;
            color: #64ffda;
        }
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5em 0;
        }
        .blog-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
        }
        .blog-content table th {
            background: #0a192f;
            font-weight: 600;
            color: #ccd6f6;
            text-align: left;
        }
        .blog-content table td, .blog-content table th {
            border: 1px solid #1e293b;
            padding: 0.6em 1em;
        }
        .blog-content table tr:hover td { background: rgba(10, 25, 47, 0.3); }
        .blog-content hr { border: 0; border-top: 1px solid #1e293b; margin: 2em 0; }
    </style>
@endsection
