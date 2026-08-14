@extends('layouts.app')

@section('title', $blog->title . ' | Eccommers Web Blog')

@section('content')

<div style="max-width: 900px; margin: 40px auto; padding: 0 24px;">
    <!-- Breadcrumb -->
    <div style="font-size: 0.88rem; color: var(--muted); margin-bottom: 24px;">
        <a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp; 
        <a href="{{ route('blog.index') }}">Blog</a> &nbsp;/&nbsp; 
        <span style="color: var(--ink); font-weight: 600;">{{ $blog->title }}</span>
    </div>

    <article style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 40px; box-shadow: var(--shadow-sm);">
        <div style="font-size: 0.85rem; color: var(--brass); font-weight: 700; text-transform: uppercase; margin-bottom: 12px;">
            {{ $blog->category ? $blog->category->name : 'Article' }} • Published on {{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}
        </div>

        <h1 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 24px;">{{ $blog->title }}</h1>

        @if($blog->featured_image)
            <div style="height: 400px; border-radius: var(--radius); overflow: hidden; margin-bottom: 32px;">
                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        @endif

        <div style="font-size: 1.05rem; line-height: 1.8; color: var(--ink-soft);" class="blog-body">
            {!! $blog->content !!}
        </div>
    </article>

    <!-- Related Articles -->
    @if($relatedBlogs->count() > 0)
        <div style="margin-top: 60px;">
            <h3 style="font-size: 1.5rem; margin-bottom: 24px;">Related Articles</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
                @foreach($relatedBlogs as $rel)
                    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px;">
                        <h4 style="margin-bottom: 8px;"><a href="{{ route('blog.show', $rel->slug) }}">{{ $rel->title }}</a></h4>
                        <p style="font-size: 0.85rem; color: var(--muted);">{{ Str::limit($rel->excerpt, 80) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection
