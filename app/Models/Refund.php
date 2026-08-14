<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'payment_id', 'refund_transaction_id', 'amount', 'reason', 'status', 'processed_by'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
