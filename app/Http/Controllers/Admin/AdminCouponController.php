<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
        ]);

        Coupon::create(array_merge($request->all(), ['code' => strtoupper($request->code)]));
        return back()->with('success', 'Coupon created successfully.');
    }

    public function destroy($id)
    {
        Coupon::destroy($id);
        return back()->with('success', 'Coupon deleted.');
    }
}
