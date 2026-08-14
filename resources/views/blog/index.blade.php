@extends('layouts.app')

@section('title', 'Blog & Industry Insights | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;">
    <!-- Breadcrumb -->
    <div style="font-size: 0.88rem; color: var(--muted); margin-bottom: 24px;">
        <a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp; <span style="color: var(--ink); font-weight: 600;">Blog & Articles</span>
    </div>

    <div style="text-align: center; margin-bottom: 48px;">
        <h1 style="font-size: 2.8rem; margin-bottom: 12px;">Industry Insights & Tech Articles</h1>
        <p style="color: var(--muted); font-size: 1.05rem; max-width: 600px; margin: 0 auto;">
            Guides on industrial petchem valve engineering, acoustic technology, and sustainable apparel craftsmanship.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 32px;">
        @foreach($blogs as $blog)
            <article style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: transform 0.3s var(--ease);"
                     onmouseover="this.style.transform='translateY(-4px)';" onmouseout="this.style.transform='none';">
                <div style="height: 220px; background: var(--paper-2); overflow: hidden; position: relative;">
                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
                    <div style="font-size: 0.8rem; color: var(--brass); font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">
                        {{ $blog->category ? $blog->category->name : 'Article' }} • {{ $blog->created_at->format('d M Y') }}
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 12px; line-height: 1.3;">
                        <a href="{{ route('blog.show', $blog->slug) }}" style="color: var(--ink);">{{ $blog->title }}</a>
                    </h3>
                    <p style="color: var(--muted); font-size: 0.92rem; margin-bottom: 20px; line-height: 1.6;">
                        {{ $blog->excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-outline btn-sm" style="margin-top: auto; align-self: flex-start;">
                        Read Full Article →
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <div style="margin-top: 40px;">
        {{ $blogs->links() }}
    </div>
</div>

@endsection
