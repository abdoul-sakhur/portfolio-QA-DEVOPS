<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>{{ setting('hero_name', 'Abdoul Sarba') }} — Blog</title>
        <link>{{ route('blog.index') }}</link>
        <description>{{ setting('seo_description', 'Articles sur le QA, DevOps et l\'automatisation des tests') }}</description>
        <language>fr-FR</language>
        <lastBuildDate>{{ now()->toRfc1123String() }}</lastBuildDate>
        <atom:link href="{{ route('blog.rss') }}" rel="self" type="application/rss+xml"/>

        @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <guid isPermaLink="true">{{ route('blog.show', $post->slug) }}</guid>
            <pubDate>{{ $post->published_at->toRfc1123String() }}</pubDate>
            @if($post->category)
            <category><![CDATA[{{ $post->category->name }}]]></category>
            @endif
            <description><![CDATA[{{ Str::limit(strip_tags($post->excerpt ?? $post->content ?? ''), 400) }}]]></description>
            @if($post->cover_image)
            <enclosure url="{{ Storage::url($post->cover_image) }}" type="image/jpeg"/>
            @endif
        </item>
        @endforeach
    </channel>
</rss>
