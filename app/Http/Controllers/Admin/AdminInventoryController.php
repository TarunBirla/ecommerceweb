<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class AdminInventoryController extends Controller
{
    protected InventoryService $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function index()
    {
        $products = Product::with('primaryImage')->latest()->paginate(15);
        $transactions = InventoryTransaction::with('product', 'creator')->latest()->take(20)->get();

        return view('admin.inventory.index', compact('products', 'transactions'));
    }

    public function adjust(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'type' => 'required|in:purchase,damaged,adjustment,return',
            'note' => 'nullable|string',
        ]);

        $this->inventoryService->adjustStock(
            $request->product_id,
            null,
            $request->quantity,
            $request->type,
            'MANUAL-' . time(),
            $request->note
        );

        return back()->with('success', 'Stock adjusted successfully.');
    }
}
