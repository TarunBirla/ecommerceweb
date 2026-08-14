@extends('layouts.admin')

@section('title', 'Create Blog Article | Admin')
@section('page-title', 'Create Blog Article')

@section('content')

<div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow-sm); max-width: 800px;">
    <form action="{{ route('admin.blogs.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Article Title</label>
            <input type="text" name="title" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Category</label>
            <select name="category_id" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Featured Image URL</label>
            <input type="url" name="featured_image" placeholder="https://images.unsplash.com/photo-..." style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Excerpt Summary</label>
            <textarea name="excerpt" rows="2" style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius);"></textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 6px;">Article Content (HTML supported)</label>
            <textarea name="content" rows="10" required style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: var(--radius); font-family: monospace;"></textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label><input type="checkbox" name="is_published" value="1" checked> Publish Immediately</label>
        </div>

        <button type="submit" class="btn btn-primary">Save & Publish Article</button>
    </form>
</div>

@endsection
