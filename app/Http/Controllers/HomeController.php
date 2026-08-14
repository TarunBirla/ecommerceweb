<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->where('status', true)->withCount('products')->orderBy('sort_order')->get();
        $featuredProducts = Product::with(['primaryImage', 'category', 'brand'])->where('is_active', true)->where('is_featured', true)->take(8)->get();
        $newArrivals = Product::with(['primaryImage', 'category', 'brand'])->where('is_active', true)->where('is_new_arrival', true)->take(8)->get();
        $trendingProducts = Product::with(['primaryImage', 'category', 'brand'])->where('is_active', true)->where('is_trending', true)->take(8)->get();
        $brands = Brand::where('status', true)->take(6)->get();

        return view('home', compact('categories', 'featuredProducts', 'newArrivals', 'trendingProducts', 'brands'));
    }
}
