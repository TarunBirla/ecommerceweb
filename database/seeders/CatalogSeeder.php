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
        $catElectronics = Category::create([
            'name' => 'Electronics & Accessories',
            'slug' => 'electronics-accessories',
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
            'banner' => 'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=1200',
            'description' => 'High quality audio equipment, smart gadgets, and accessories.',
            'sort_order' => 1,
            'status' => true,
        ]);

        $catApparel = Category::create([
            'name' => 'Men & Women Apparel',
            'slug' => 'apparel',
            'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800',
            'banner' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200',
            'description' => 'Premium cotton apparel, jackets, and footwear.',
            'sort_order' => 2,
            'status' => true,
        ]);

        $catIndustrial = Category::create([
            'name' => 'Petchem & Industrial Parts',
            'slug' => 'petchem-industrial-parts',
            'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800',
            'description' => 'Heavy machine parts, valves, pumps, and petrochemical equipment.',
            'sort_order' => 3,
            'status' => true,
        ]);

        // Subcategories
        $subAudio = Category::create([
            'name' => 'Headphones & Audio',
            'slug' => 'headphones-audio',
            'parent_id' => $catElectronics->id,
            'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800',
            'sort_order' => 1,
        ]);

        $subJackets = Category::create([
            'name' => 'Jackets & Outerwear',
            'slug' => 'jackets-outerwear',
            'parent_id' => $catApparel->id,
            'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800',
            'sort_order' => 1,
        ]);

        // 2. Brands
        $brandSony = Brand::create([
            'name' => 'NexAudio Pro',
            'slug' => 'nexaudio-pro',
            'logo' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=300',
            'description' => 'Precision engineered audio solutions.'
        ]);

        $brandCraft = Brand::create([
            'name' => 'Heritage Apparel Co',
            'slug' => 'heritage-apparel-co',
            'logo' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=300',
            'description' => 'Sustainable handcrafted clothing.'
        ]);

        $brandPetchem = Brand::create([
            'name' => 'PetChem Global Parts',
            'slug' => 'petchem-global-parts',
            'description' => 'Industrial grade valves and chemical pipeline components.'
        ]);

        // 3. Attributes & Values
        $attrSize = Attribute::create(['name' => 'Size', 'slug' => 'size', 'type' => 'button']);
        $sizeS = AttributeValue::create(['attribute_id' => $attrSize->id, 'value' => 'Small']);
        $sizeM = AttributeValue::create(['attribute_id' => $attrSize->id, 'value' => 'Medium']);
        $sizeL = AttributeValue::create(['attribute_id' => $attrSize->id, 'value' => 'Large']);

        $attrColor = Attribute::create(['name' => 'Color', 'slug' => 'color', 'type' => 'color']);
        $colorBlack = AttributeValue::create(['attribute_id' => $attrColor->id, 'value' => 'Midnight Black', 'color_code' => '#14150F']);
        $colorGreen = AttributeValue::create(['attribute_id' => $attrColor->id, 'value' => 'Forest Green', 'color_code' => '#0E3D2A']);
        $colorBrass = AttributeValue::create(['attribute_id' => $attrColor->id, 'value' => 'Brass Gold', 'color_code' => '#AD8036']);

        // 4. Products

        // Product 1: High-end ANC Headphones
        $p1 = Product::create([
            'name' => 'Acoustic Master ANC Wireless Headphones',
            'slug' => 'acoustic-master-anc-wireless-headphones',
            'sku' => 'AUD-ANC-001',
            'category_id' => $subAudio->id,
            'brand_id' => $brandSony->id,
            'price' => 14999.00,
            'sale_price' => 11999.00,
            'cost_price' => 7500.00,
            'stock' => 45,
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

        ProductImage::create(['product_id' => $p1->id, 'image_path' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800', 'is_primary' => true, 'sort_order' => 1]);
        ProductImage::create(['product_id' => $p1->id, 'image_path' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800', 'is_primary' => false, 'sort_order' => 2]);

        // Variants for P1
        $v1_1 = ProductVariant::create([
            'product_id' => $p1->id,
            'sku' => 'AUD-ANC-001-BLK',
            'variant_name' => 'Midnight Black',
            'price' => 14999.00,
            'sale_price' => 11999.00,
            'stock' => 25,
            'weight' => 0.25,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
            'attributes_json' => [
                ['attribute' => 'Color', 'value' => 'Midnight Black']
            ]
        ]);

        $v1_2 = ProductVariant::create([
            'product_id' => $p1->id,
            'sku' => 'AUD-ANC-001-GRN',
            'variant_name' => 'Forest Green',
            'price' => 15999.00,
            'sale_price' => 12999.00,
            'stock' => 20,
            'weight' => 0.25,
            'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800',
            'attributes_json' => [
                ['attribute' => 'Color', 'value' => 'Forest Green']
            ]
        ]);

        // Inventory records & stock audit trail
        Inventory::create(['product_id' => $p1->id, 'variant_id' => $v1_1->id, 'current_stock' => 25, 'low_stock_threshold' => 5]);
        InventoryTransaction::create([
            'product_id' => $p1->id, 'variant_id' => $v1_1->id, 'type' => 'opening', 'quantity' => 25,
            'stock_before' => 0, 'stock_after' => 25, 'reference_no' => 'PO-INIT-001', 'note' => 'Initial stock seed'
        ]);

        Inventory::create(['product_id' => $p1->id, 'variant_id' => $v1_2->id, 'current_stock' => 20, 'low_stock_threshold' => 5]);
        InventoryTransaction::create([
            'product_id' => $p1->id, 'variant_id' => $v1_2->id, 'type' => 'opening', 'quantity' => 20,
            'stock_before' => 0, 'stock_after' => 20, 'reference_no' => 'PO-INIT-002', 'note' => 'Initial stock seed'
        ]);


        // Product 2: Organic Cotton Heavyweight Jacket
        $p2 = Product::create([
            'name' => 'Vintage Field Jacket in Clay Orange',
            'slug' => 'vintage-field-jacket-clay-orange',
            'sku' => 'APP-JKT-002',
            'category_id' => $subJackets->id,
            'brand_id' => $brandCraft->id,
            'price' => 6999.00,
            'sale_price' => 4999.00,
            'cost_price' => 2400.00,
            'stock' => 30,
            'description' => 'Crafted from 100% organic heavy canvas cotton with brass snap buttons and tailored utility pockets.',
            'specifications' => [
                'Material' => '100% Organic Cotton Canvas',
                'Closure' => 'Brass YKK Zipper + Snap Buttons',
                'Fit' => 'Relaxed Fit'
            ],
            'is_active' => true,
            'is_featured' => true,
            'is_new_arrival' => true,
            'has_variants' => true,
            'rating_avg' => 4.90,
            'reviews_count' => 8,
            'warranty_info' => '1 Year Stitching & Fabric Warranty',
            'return_policy_info' => '14-day return and exchange policy'
        ]);

        ProductImage::create(['product_id' => $p2->id, 'image_path' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800', 'is_primary' => true, 'sort_order' => 1]);

        $v2_1 = ProductVariant::create([
            'product_id' => $p2->id,
            'sku' => 'APP-JKT-002-M',
            'variant_name' => 'Medium / Clay',
            'price' => 6999.00,
            'sale_price' => 4999.00,
            'stock' => 15,
            'attributes_json' => [['attribute' => 'Size', 'value' => 'Medium']]
        ]);
        $v2_2 = ProductVariant::create([
            'product_id' => $p2->id,
            'sku' => 'APP-JKT-002-L',
            'variant_name' => 'Large / Clay',
            'price' => 6999.00,
            'sale_price' => 4999.00,
            'stock' => 15,
            'attributes_json' => [['attribute' => 'Size', 'value' => 'Large']]
        ]);

        Inventory::create(['product_id' => $p2->id, 'variant_id' => $v2_1->id, 'current_stock' => 15]);
        Inventory::create(['product_id' => $p2->id, 'variant_id' => $v2_2->id, 'current_stock' => 15]);


        // Product 3: Industrial High-Pressure Chemical Pump Valve
        $p3 = Product::create([
            'name' => 'PetChem Stainless Steel Flanged Ball Valve 2-Inch',
            'slug' => 'petchem-stainless-steel-flanged-ball-valve-2-inch',
            'sku' => 'IND-VLV-003',
            'category_id' => $catIndustrial->id,
            'brand_id' => $brandPetchem->id,
            'price' => 24500.00,
            'sale_price' => 22000.00,
            'stock' => 10,
            'description' => 'Industrial grade SS316 2-inch 3-piece full port flanged ball valve built for high pressure chemical and oil processing pipelines.',
            'specifications' => [
                'Material' => 'Stainless Steel 316',
                'Pressure Rating' => '1000 WOG',
                'Flange Class' => 'ANSI 150#',
                'Temperature Range' => '-20°C to 200°C'
            ],
            'is_active' => true,
            'is_featured' => true,
            'has_variants' => false,
            'rating_avg' => 5.00,
            'reviews_count' => 4,
            'warranty_info' => '3 Years Industrial Warranty'
        ]);

        ProductImage::create(['product_id' => $p3->id, 'image_path' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800', 'is_primary' => true, 'sort_order' => 1]);
        Inventory::create(['product_id' => $p3->id, 'current_stock' => 10]);


        // Add sample customer review
        $customer = User::where('email', 'customer@eccommers.com')->first();
        if ($customer) {
            Review::create([
                'user_id' => $customer->id,
                'product_id' => $p1->id,
                'rating' => 5,
                'title' => 'Stunning quality and noise cancellation!',
                'comment' => 'The audio clarity is unbelievable. Soft earcups and gorgeous brass accents match my office setup perfectly.',
                'is_verified_purchase' => true,
                'status' => 'approved',
            ]);
        }
    }
}
