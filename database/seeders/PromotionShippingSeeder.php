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
        // Update or create Coupons with friendly limits for testing
        Coupon::updateOrCreate(['code' => 'WELCOME10'], [
            'type' => 'percentage',
            'value' => 10.00, // 10% OFF
            'min_order_amount' => 1.00,
            'max_discount_amount' => 1500.00,
            'expires_at' => now()->addMonths(12),
            'usage_limit' => 10000,
            'per_user_limit' => 100,
            'status' => true,
        ]);

        Coupon::updateOrCreate(['code' => 'FLAT500'], [
            'type' => 'fixed',
            'value' => 500.00, // Flat £500 OFF
            'min_order_amount' => 1000.00,
            'expires_at' => now()->addMonths(12),
            'usage_limit' => 5000,
            'per_user_limit' => 100,
            'status' => true,
        ]);

        // Shipping Methods
        ShippingMethod::updateOrCreate(['name' => 'Standard Ground Shipping'], [
            'description' => 'Reliable doorstep delivery in 3 to 5 business days.',
            'cost' => 150.00,
            'free_shipping_threshold' => 2000.00, // Free above £2000
            'estimated_days' => '3-5 Business Days',
            'is_active' => true,
        ]);

        ShippingMethod::updateOrCreate(['name' => 'Express Priority Air'], [
            'description' => 'Fast delivery guaranteed within 24 to 48 hours.',
            'cost' => 350.00,
            'free_shipping_threshold' => 10000.00,
            'estimated_days' => '1-2 Business Days',
            'is_active' => true,
        ]);

        // Shipping Zone
        ShippingZone::updateOrCreate(['name' => 'All UK Standard Zone'], [
            'pincodes' => ['400001', '110001', '560001', '700001', '600001', '122002'],
            'charge' => 0.00,
            'status' => true,
        ]);
    }
}
