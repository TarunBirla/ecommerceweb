<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin'], [
            'display_name' => 'Super Admin',
            'description' => 'Full administrative access to entire platform'
        ]);

        $staffRole = Role::firstOrCreate(['name' => 'staff'], [
            'display_name' => 'Staff Member',
            'description' => 'Configurable staff access'
        ]);

        $customerRole = Role::firstOrCreate(['name' => 'customer'], [
            'display_name' => 'Customer',
            'description' => 'Standard customer store user'
        ]);

        $permissions = [
            // Products
            ['name' => 'view_products', 'group' => 'products', 'display_name' => 'View Products'],
            ['name' => 'create_products', 'group' => 'products', 'display_name' => 'Create Products'],
            ['name' => 'edit_products', 'group' => 'products', 'display_name' => 'Edit Products'],
            ['name' => 'delete_products', 'group' => 'products', 'display_name' => 'Delete Products'],
            
            // Orders
            ['name' => 'view_orders', 'group' => 'orders', 'display_name' => 'View Orders'],
            ['name' => 'update_orders', 'group' => 'orders', 'display_name' => 'Update Order Status'],
            ['name' => 'process_refunds', 'group' => 'orders', 'display_name' => 'Process Refunds'],
            
            // Customers
            ['name' => 'view_customers', 'group' => 'customers', 'display_name' => 'View Customers'],
            ['name' => 'manage_customers', 'group' => 'customers', 'display_name' => 'Manage Customers'],

            // Inventory & Coupons
            ['name' => 'manage_inventory', 'group' => 'inventory', 'display_name' => 'Manage Stock & Inventory'],
            ['name' => 'manage_coupons', 'group' => 'coupons', 'display_name' => 'Manage Discount Coupons'],

            // Analytics & Settings
            ['name' => 'view_reports', 'group' => 'reports', 'display_name' => 'View Reports & Analytics'],
            ['name' => 'manage_settings', 'group' => 'settings', 'display_name' => 'Manage System Settings'],
        ];

        foreach ($permissions as $permData) {
            $perm = Permission::firstOrCreate(['name' => $permData['name']], $permData);
            if (!$adminRole->permissions()->where('permission_id', $perm->id)->exists()) {
                $adminRole->permissions()->attach($perm->id);
            }
            if (in_array($permData['name'], ['view_products', 'create_products', 'edit_products', 'view_orders', 'update_orders', 'manage_inventory'])) {
                if (!$staffRole->permissions()->where('permission_id', $perm->id)->exists()) {
                    $staffRole->permissions()->attach($perm->id);
                }
            }
        }
    }
}
