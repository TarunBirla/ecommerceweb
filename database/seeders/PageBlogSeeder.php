<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageBlogSeeder extends Seeder
{
    public function run(): void
    {
        // CMS Static Pages
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<h1>About Eccommers Web</h1><p>We are a premier provider of high-precision industrial petchem parts, handcrafted apparel, and studio-grade consumer electronics. Designed with sustainable materials and engineered for perfection.</p>',
            'seo_title' => 'About Us | Eccommers Web',
            'seo_description' => 'Learn about our commitment to quality industrial parts and luxury lifestyle products.'
        ]);

        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '<h1>Privacy Policy</h1><p>Your privacy is our utmost priority. We handle all customer data, payment credentials, and contact details with strict end-to-end encryption and compliance.</p>',
            'seo_title' => 'Privacy Policy | Eccommers Web'
        ]);

        Page::create([
            'title' => 'Terms & Conditions',
            'slug' => 'terms-conditions',
            'content' => '<h1>Terms & Conditions</h1><p>Welcome to Eccommers Web. By placing orders on our website, you agree to our standard terms of service, shipping policies, and return conditions.</p>',
            'seo_title' => 'Terms & Conditions | Eccommers Web'
        ]);

        Page::create([
            'title' => 'Shipping & Return Policy',
            'slug' => 'shipping-return-policy',
            'content' => '<h1>Shipping & Return Policy</h1><p>We offer free standard shipping on orders above £2000 across India. Returns can be requested within 7 days of delivery through your customer account panel.</p>',
            'seo_title' => 'Shipping & Return Policy | Eccommers Web'
        ]);

        // Blog Categories & Articles
        $bCat = BlogCategory::create(['name' => 'Industry News', 'slug' => 'industry-news']);

        Blog::create([
            'title' => 'Selecting High-Pressure Chemical Valves for Industrial Plants',
            'slug' => 'selecting-high-pressure-chemical-valves-industrial-plants',
            'category_id' => $bCat->id,
            'featured_image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800',
            'excerpt' => 'A technical guide on stainless steel grade selection, WOG pressure ratings, and flange standards.',
            'content' => '<p>When operating petrochemical pipelines, selecting the right ball valve is crucial for pressure containment and safety...</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
