<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category')->where('is_published', true);

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $blogs = $query->latest('published_at')->paginate(9);
        $categories = BlogCategory::withCount('blogs')->get();
        $recentPosts = Blog::where('is_published', true)->latest()->take(4)->get();

        return view('blog.index', compact('blogs', 'categories', 'recentPosts'));
    }

    public function show(string $slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedBlogs = Blog::where('is_published', true)->where('id', '!=', $blog->id)->take(3)->get();

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }
}
