<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'type', 'value', 'min_order_amount', 'max_discount_amount',
        'start_date', 'expires_at', 'usage_limit', 'used_count', 'per_user_limit', 'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'expires_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function isValidForOrder(float $orderSubtotal, int $userId): array
    {
        if (!$this->status) {
            return ['valid' => false, 'message' => 'Coupon is inactive.'];
        }

        if ($this->expires_at && now()->greaterThan($this->expires_at)) {
            return ['valid' => false, 'message' => 'Coupon has expired.'];
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'Coupon total usage limit reached.'];
        }

        if ($orderSubtotal < $this->min_order_amount) {
            return ['valid' => false, 'message' => "Minimum order amount of £{$this->min_order_amount} required."];
        }

        $userUsageCount = CouponUsage::where('coupon_id', $this->id)->where('user_id', $userId)->count();
        if ($userUsageCount >= $this->per_user_limit) {
            return ['valid' => false, 'message' => 'You have reached maximum usage limit for this coupon.'];
        }

        // Calculate discount amount
        if ($this->type === 'percentage') {
            $discount = ($orderSubtotal * $this->value) / 100;
            if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
                $discount = $this->max_discount_amount;
            }
        } else {
            $discount = min($this->value, $orderSubtotal);
        }

        return ['valid' => true, 'discount' => round($discount, 2), 'message' => 'Coupon applied successfully!'];
    }
}
