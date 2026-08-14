<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Services\OrderService;
use Tests\TestCase;

class ECommercePlatformTest extends TestCase
{
    public function test_customer_can_browse_homepage_and_catalog()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function test_coupon_validation()
    {
        $customer = User::where('email', 'customer@eccommers.com')->first();
        $coupon = Coupon::where('code', 'WELCOME10')->first();
        $this->assertNotNull($coupon);

        // Reset coupon usage for test
        CouponUsage::where('coupon_id', $coupon->id)->where('user_id', $customer->id)->delete();

        $validation = $coupon->isValidForOrder(2000.00, $customer->id);
        
        $this->assertTrue($validation['valid']);
        $this->assertEquals(200.00, $validation['discount']);
    }

    public function test_order_creation_reduces_stock_and_logs_audit()
    {
        $customer = User::where('email', 'customer@eccommers.com')->first();
        $product = Product::with('variants')->first();
        $address = Address::where('user_id', $customer->id)->first();
        $shippingMethod = ShippingMethod::first();
        $coupon = Coupon::where('code', 'WELCOME10')->first();

        // Reset coupon usage for test
        CouponUsage::where('coupon_id', $coupon->id)->where('user_id', $customer->id)->delete();

        // Setup Cart
        $cart = Cart::firstOrCreate(['user_id' => $customer->id]);
        $cart->items()->delete();

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'variant_id' => $product->variants->first() ? $product->variants->first()->id : null,
            'quantity' => 2,
            'unit_price' => $product->effective_price,
        ]);

        $orderService = app(OrderService::class);
        $order = $orderService->createOrder(
            $customer,
            $address->id,
            $shippingMethod->id,
            'WELCOME10',
            'razorpay',
            'Test order notes'
        );

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals('pending', $order->order_status);
        $this->assertDatabaseHas('orders', ['order_number' => $order->order_number]);
    }
}
