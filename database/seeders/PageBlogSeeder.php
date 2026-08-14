<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class PageBlogSeeder extends Seeder
{
    public function run(): void
    {
        // CMS Static Pages
        Page::updateOrCreate(['slug' => 'about-us'], [
            'title' => 'About Us',
            'content' => '<h1>About Eccommers Web</h1><p>We are a premier provider of high-precision industrial petchem parts, handcrafted apparel, and studio-grade consumer electronics. Designed with sustainable materials and engineered for perfection.</p>',
            'seo_title' => 'About Us | Eccommers Web',
            'seo_description' => 'Learn about our commitment to quality industrial parts and luxury lifestyle products.'
        ]);

        Page::updateOrCreate(['slug' => 'privacy-policy'], [
            'title' => 'Privacy Policy',
            'content' => '<h1>Privacy Policy</h1><p>Your privacy is our utmost priority. We handle all customer data, payment credentials, and contact details with strict end-to-end encryption and compliance.</p>',
            'seo_title' => 'Privacy Policy | Eccommers Web'
        ]);

        Page::updateOrCreate(['slug' => 'terms-conditions'], [
            'title' => 'Terms & Conditions',
            'content' => '<h1>Terms & Conditions</h1><p>Welcome to Eccommers Web. By placing orders on our website, you agree to our standard terms of service, shipping policies, and return conditions.</p>',
            'seo_title' => 'Terms & Conditions | Eccommers Web'
        ]);

        Page::updateOrCreate(['slug' => 'shipping-return-policy'], [
            'title' => 'Shipping & Return Policy',
            'content' => '<h1>Shipping & Return Policy</h1><p>We offer free standard shipping on orders above £2000 across the UK. Returns can be requested within 7 days of delivery through your customer account panel.</p>',
            'seo_title' => 'Shipping & Return Policy | Eccommers Web'
        ]);

        // Blog Categories & Articles
        $bCat = BlogCategory::firstOrCreate(['slug' => 'industry-news'], ['name' => 'Industry & Technology']);
        $bCatLifestyle = BlogCategory::firstOrCreate(['slug' => 'lifestyle-craft'], ['name' => 'Lifestyle & Craft']);

        Blog::updateOrCreate(['slug' => 'selecting-high-pressure-chemical-valves-industrial-plants'], [
            'title' => 'Selecting High-Pressure Chemical Valves for Industrial Plants',
            'category_id' => $bCat->id,
            'featured_image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800',
            'excerpt' => 'A technical guide on stainless steel grade selection, WOG pressure ratings, and flange standards.',
            'content' => '<p>When operating petrochemical pipelines, selecting the right ball valve is crucial for pressure containment and safety. Stainless steel SS316 offers maximum resistance against corrosive chemical compounds...</p><p>Ensure your pipeline flange dimensions conform to ANSI 150# standards before installation.</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Blog::updateOrCreate(['slug' => 'evolution-of-active-noise-cancellation-acoustics'], [
            'title' => 'The Evolution of Active Noise Cancellation Acoustics',
            'category_id' => $bCatLifestyle->id,
            'featured_image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
            'excerpt' => 'How hybrid digital ANC technology transforms daily listening into studio-grade tranquility.',
            'content' => '<p>Active noise cancellation relies on internal and external microphones that sample ambient noise 40,000 times per second, generating inverted sound waves to eliminate background hum...</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Client Testimonials
        Testimonial::updateOrCreate(['client_name' => 'Edward Sterling'], [
            'client_title' => 'Chief Procurement Director',
            'company_name' => 'Sterling Petrochem UK',
            'client_avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200',
            'content' => 'The SS316 flanged valves supplied by Eccommers Web exceeded our plant pressure testing standards. Prompt delivery and impeccable technical specs!',
            'rating' => 5,
            'is_featured' => true,
            'status' => true,
        ]);

        Testimonial::updateOrCreate(['client_name' => 'Sophia Montgomery'], [
            'client_title' => 'Audio Lead Designer',
            'company_name' => 'Acoustica Studios London',
            'client_avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200',
            'content' => 'The Acoustic Master ANC headphones are incredible. The brass aesthetic combined with 40-hour battery life makes it an daily studio essential.',
            'rating' => 5,
            'is_featured' => true,
            'status' => true,
        ]);

        Testimonial::updateOrCreate(['client_name' => 'Arthur Pendelton'], [
            'client_title' => 'Operations Manager',
            'company_name' => 'Northsea Logistics',
            'client_avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200',
            'content' => 'Exceptional customer service, rapid dispatch, and transparent tracking timeline. Will definitely purchase industrial parts again.',
            'rating' => 5,
            'is_featured' => true,
            'status' => true,
        ]);
    }
}
