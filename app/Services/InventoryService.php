<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class InventoryService
{
    /**
     * Adjust stock for product or variant and record audit trail.
     */
    public function adjustStock(int $productId, ?int $variantId, int $quantityChange, string $type, ?string $referenceNo = null, ?string $note = null): bool
    {
        $product = Product::findOrFail($productId);
        $variant = $variantId ? ProductVariant::find($variantId) : null;

        $stockBefore = $variant ? $variant->stock : $product->stock;
        $stockAfter = max(0, $stockBefore + $quantityChange);

        if ($variant) {
            $variant->update(['stock' => $stockAfter]);
        } else {
            $product->update(['stock' => $stockAfter]);
        }

        // Record Inventory Transaction Audit Trail
        InventoryTransaction::create([
            'product_id' => $productId,
            'variant_id' => $variantId,
            'type' => $type,
            'quantity' => $quantityChange,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'reference_no' => $referenceNo,
            'note' => $note,
            'created_by' => Auth::id(),
        ]);

        return true;
    }
}
