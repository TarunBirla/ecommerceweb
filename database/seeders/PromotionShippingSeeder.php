<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\ShippingMethod;
use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class PromotionShippingSeeder extends Seeder
{
    public function run(): void
    {
        // Coupons
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percentage',
            'value' => 10.00, // 10% OFF
            'min_order_amount' => 1000.00,
            'max_discount_amount' => 1500.00,
            'expires_at' => now()->addMonths(6),
            'usage_limit' => 1000,
            'per_user_limit' => 1,
            'status' => true,
        ]);

        Coupon::create([
            'code' => 'FLAT500',
            'type' => 'fixed',
            'value' => 500.00, // Flat £500 OFF
            'min_order_amount' => 3000.00,
            'expires_at' => now()->addMonths(3),
            'usage_limit' => 500,
            'per_user_limit' => 1,
            'status' => true,
        ]);

        // Shipping Methods
        ShippingMethod::create([
            'name' => 'Standard Ground Shipping',
            'description' => 'Reliable doorstep delivery in 3 to 5 business days.',
            'cost' => 150.00,
            'free_shipping_threshold' => 2000.00, // Free above £2000
            'estimated_days' => '3-5 Business Days',
            'is_active' => true,
        ]);

        ShippingMethod::create([
            'name' => 'Express Priority Air',
            'description' => 'Fast delivery guaranteed within 24 to 48 hours.',
            'cost' => 350.00,
            'free_shipping_threshold' => 10000.00,
            'estimated_days' => '1-2 Business Days',
            'is_active' => true,
        ]);

        // Shipping Zone
        ShippingZone::create([
            'name' => 'All UK Standard Zone',
            'pincodes' => ['400001', '110001', '560001', '700001', '600001', '122002'],
            'charge' => 0.00,
            'status' => true,
        ]);
    }
}
