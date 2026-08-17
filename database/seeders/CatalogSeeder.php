<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $catElectronics = Category::firstOrCreate(['slug' => 'electronics-accessories'], [
            'name' => 'Electronics & Accessories',
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
            'banner' => 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=1200',
            'description' => 'High quality audio equipment, smart gadgets, and accessories.',
            'sort_order' => 1,
            'status' => true,
        ]);

        $catApparel = Category::firstOrCreate(['slug' => 'apparel'], [
            'name' => 'Men & Women Apparel',
            'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800',
            'banner' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200',
            'description' => 'Premium cotton apparel, jackets, and footwear.',
            'sort_order' => 2,
            'status' => true,
        ]);

        $catIndustrial = Category::firstOrCreate(['slug' => 'petchem-industrial-parts'], [
            'name' => 'Petchem & Industrial Parts',
            'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800',
            'description' => 'Heavy machine parts, valves, pumps, and petrochemical equipment.',
            'sort_order' => 3,
            'status' => true,
        ]);

        // Subcategories
        $subAudio = Category::firstOrCreate(['slug' => 'headphones-audio'], [
            'name' => 'Headphones & Audio',
            'parent_id' => $catElectronics->id,
            'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800',
            'sort_order' => 1,
        ]);

        $subJackets = Category::firstOrCreate(['slug' => 'jackets-outerwear'], [
            'name' => 'Jackets & Outerwear',
            'parent_id' => $catApparel->id,
            'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800',
            'sort_order' => 1,
        ]);

        // 2. Brands
        $brandSony = Brand::firstOrCreate(['slug' => 'nexaudio-pro'], [
            'name' => 'NexAudio Pro',
            'logo' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=300',
            'description' => 'Precision engineered audio solutions.'
        ]);

        $brandCraft = Brand::firstOrCreate(['slug' => 'heritage-apparel-co'], [
            'name' => 'Heritage Apparel Co',
            'logo' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=300',
            'description' => 'Sustainable handcrafted clothing.'
        ]);

        $brandPetchem = Brand::firstOrCreate(['slug' => 'petchem-global-parts'], [
            'name' => 'PetChem Global Parts',
            'description' => 'Industrial grade valves and chemical pipeline components.'
        ]);

        // 3. Attributes & Values
        $attrSize = Attribute::firstOrCreate(['slug' => 'size'], ['name' => 'Size', 'type' => 'button']);
        $sizeS = AttributeValue::firstOrCreate(['attribute_id' => $attrSize->id, 'value' => 'Small']);
        $sizeM = AttributeValue::firstOrCreate(['attribute_id' => $attrSize->id, 'value' => 'Medium']);
        $sizeL = AttributeValue::firstOrCreate(['attribute_id' => $attrSize->id, 'value' => 'Large']);

        $attrColor = Attribute::firstOrCreate(['slug' => 'color'], ['name' => 'Color', 'type' => 'color']);
        $colorBlack = AttributeValue::firstOrCreate(['attribute_id' => $attrColor->id, 'value' => 'Midnight Black'], ['color_code' => '#14150F']);
        $colorGreen = AttributeValue::firstOrCreate(['attribute_id' => $attrColor->id, 'value' => 'Forest Green'], ['color_code' => '#0E3D2A']);
        $colorBrass = AttributeValue::firstOrCreate(['attribute_id' => $attrColor->id, 'value' => 'Brass Gold'], ['color_code' => '#AD8036']);

        // 4. Products

        // Product 1: High-end ANC Headphones
        $p1 = Product::updateOrCreate(['sku' => 'AUD-ANC-001'], [
            'name' => 'Acoustic Master ANC Wireless Headphones',
            'slug' => 'acoustic-master-anc-wireless-headphones',
            'category_id' => $subAudio->id,
            'brand_id' => $brandSony->id,
            'price' => 14999.00,
            'sale_price' => 11999.00,
            'cost_price' => 7500.00,
            'stock' => 100,
            'min_stock_warning' => 5,
            'description' => 'Experience serene studio acoustics with active noise cancellation, custom brass accents, 40-hour battery life, and high-res audio drivers.',
            'specifications' => [
                'Battery Life' => '40 Hours ANC On',
                'Bluetooth Version' => '5.3',
                'Driver Size' => '40mm Neodymium',
                'Weight' => '250g',
                'Warranty' => '2 Years Limited Warranty'
            ],
            'faqs' => [
                ['q' => 'Is this compatible with iPhone and Android?', 'a' => 'Yes, seamless bluetooth pairing across iOS, Android, and Windows.'],
                ['q' => 'Does it include a carrying case?', 'a' => 'Yes, a hard-shell luxury zipper case is included.']
            ],
            'is_active' => true,
            'is_featured' => true,
            'is_trending' => true,
            'is_new_arrival' => true,
            'has_variants' => true,
            'rating_avg' => 4.85,
            'reviews_count' => 12,
            'warranty_info' => '2 Years Manufacturer Replacement Warranty',
            'return_policy_info' => '7-day easy return policy with free pickup',
            'seo_title' => 'Acoustic Master ANC Headphones | Premium Sound',
            'seo_description' => 'Buy Acoustic Master ANC Headphones online with 40-hour battery life and active noise cancellation.'
        ]);

        ProductImage::firstOrCreate(['product_id' => $p1->id, 'image_path' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800'], ['is_primary' => true, 'sort_order' => 1]);
        ProductImage::firstOrCreate(['product_id' => $p1->id, 'image_path' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800'], ['is_primary' => false, 'sort_order' => 2]);

        // Variants for P1
        $v1_1 = ProductVariant::updateOrCreate(['sku' => 'AUD-ANC-001-BLK'], [
            'product_id' => $p1->id,
            'variant_name' => 'Midnight Black',
            'price' => 14999.00,
            'sale_price' => 11999.00,
            'stock' => 50,
            'weight' => 0.25,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
            'attributes_json' => [
                ['attribute' => 'Color', 'value' => 'Midnight Black']
            ]
        ]);

        $v1_2 = ProductVariant::updateOrCreate(['sku' => 'AUD-ANC-001-GRN'], [
            'product_id' => $p1->id,
            'variant_name' => 'Forest Green',
            'price' => 15999.00,
            'sale_price' => 12999.00,
            'stock' => 50,
            'weight' => 0.25,
            'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800',
            'attributes_json' => [
                ['attribute' => 'Color', 'value' => 'Forest Green']
            ]
        ]);

        // Product 2: Industrial Valve
        $p2 = Product::updateOrCreate(['sku' => 'PET-VLV-316'], [
            'name' => 'High-Pressure Stainless Steel SS316 Valve',
            'slug' => 'high-pressure-stainless-steel-ss316-valve',
            'category_id' => $catIndustrial->id,
            'brand_id' => $brandPetchem->id,
            'price' => 8499.00,
            'sale_price' => 7499.00,
            'cost_price' => 4200.00,
            'stock' => 120,
            'min_stock_warning' => 10,
            'description' => 'Heavy-duty 2-inch flanged ball valve built with AISI 316 stainless steel for chemical, oil, and gas refinery pipelines.',
            'specifications' => [
                'Material Grade' => 'Stainless Steel 316',
                'Pressure Rating' => '800 WOG (Water, Oil, Gas)',
                'Connection Type' => 'ANSI Flanged 150#',
                'Temperature Limits' => '-20°C to 220°C'
            ],
            'is_active' => true,
            'is_featured' => true,
            'is_trending' => true,
            'has_variants' => false,
            'rating_avg' => 4.90,
            'reviews_count' => 8,
            'warranty_info' => '3 Years Heavy Industrial Replacement Guarantee'
        ]);

        ProductImage::firstOrCreate(['product_id' => $p2->id, 'image_path' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800'], ['is_primary' => true, 'sort_order' => 1]);

        // Product 3: Organic Canvas Jacket
        $p3 = Product::updateOrCreate(['sku' => 'APP-JKT-002'], [
            'name' => 'Handcrafted Heavyweight Organic Canvas Jacket',
            'slug' => 'handcrafted-heavyweight-organic-canvas-jacket',
            'category_id' => $subJackets->id,
            'brand_id' => $brandCraft->id,
            'price' => 6999.00,
            'sale_price' => 5999.00,
            'cost_price' => 2800.00,
            'stock' => 60,
            'min_stock_warning' => 4,
            'description' => 'Tailored from 100% GOTS certified organic 14oz heavy cotton canvas with custom brass buttons and weather-resistant finish.',
            'specifications' => [
                'Fabric Weight' => '14 oz Organic Canvas',
                'Hardware' => 'Antiqued Solid Brass',
                'Pockets' => '4 Utility Pockets + 1 Internal Secret Pocket'
            ],
            'is_active' => true,
            'is_featured' => true,
            'has_variants' => false,
            'rating_avg' => 4.70,
            'reviews_count' => 5,
        ]);

        ProductImage::firstOrCreate(['product_id' => $p3->id, 'image_path' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800'], ['is_primary' => true, 'sort_order' => 1]);
    }
}
