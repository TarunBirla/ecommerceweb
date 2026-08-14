<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'store_name', 'value' => 'Eccommers Web', 'group' => 'general'],
            ['key' => 'store_email', 'value' => 'phil.andreson@nexteck.uk', 'group' => 'general'],
            ['key' => 'store_phone', 'value' => '+91 9876543210', 'group' => 'general'],
            ['key' => 'store_address', 'value' => 'PetChem Industrial Hub, Tower A, Sector 62, Noida, UP', 'group' => 'general'],
            
            // Currency & Tax
            ['key' => 'currency_code', 'value' => 'GBP', 'group' => 'currency'],
            ['key' => 'currency_symbol', 'value' => '£', 'group' => 'currency'],
            ['key' => 'tax_rate_percent', 'value' => '18', 'group' => 'tax'], // 18% GST

            // Payment Gateway
            ['key' => 'razorpay_enabled', 'value' => '1', 'group' => 'payment'],
            ['key' => 'razorpay_key_id', 'value' => 'rzp_test_samplekey123', 'group' => 'payment'],
            ['key' => 'razorpay_key_secret', 'value' => 'sample_razorpay_secret_456', 'group' => 'payment'],
            ['key' => 'cod_enabled', 'value' => '1', 'group' => 'payment'],

            // SMTP
            ['key' => 'smtp_host', 'value' => 'mail.nexteck.uk', 'group' => 'mail'],
            ['key' => 'smtp_port', 'value' => '465', 'group' => 'mail'],
            ['key' => 'smtp_username', 'value' => 'phil.andreson@nexteck.uk', 'group' => 'mail'],
            ['key' => 'smtp_encryption', 'value' => 'ssl', 'group' => 'mail'],
        ];

        foreach ($settings as $setting) {
            Setting::set($setting['key'], $setting['value'], $setting['group']);
        }
    }
}
