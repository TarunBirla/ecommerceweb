@extends('layouts.app')

@section('title', $product->name . ' | Eccommers Web')

@section('content')

<div style="max-width: 1320px; margin: 40px auto; padding: 0 24px;" x-data="productDetail()">
    <!-- Breadcrumb -->
    <div style="font-size: 0.88rem; color: var(--muted); margin-bottom: 24px;">
        <a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp; 
        <a href="{{ route('products.index') }}">Catalog</a> &nbsp;/&nbsp; 
        <span style="color: var(--ink); font-weight: 600;">{{ $product->name }}</span>
    </div>

    <!-- Product Main Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 36px; box-shadow: var(--shadow-sm); margin-bottom: 48px;">
        <!-- Images Gallery -->
        <div>
            <div style="height: 480px; background-color: var(--paper-2); border-radius: var(--radius); overflow: hidden; margin-bottom: 16px; position: relative;">
                <img :src="activeImage" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div style="display: flex; gap: 12px; overflow-x: auto;">
                @foreach($product->images as $img)
                    <div @click="activeImage = '{{ $img->image_path }}'" 
                         style="width: 80px; height: 80px; border-radius: var(--radius); overflow: hidden; border: 2px solid var(--line); cursor: pointer;"
                         :style="activeImage === '{{ $img->image_path }}' ? 'border-color: var(--green);' : ''">
                        <img src="{{ $img->image_path }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Product Details & Variant Picker -->
        <div>
            <div style="font-size: 0.85rem; color: var(--brass); text-transform: uppercase; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px;">
                {{ $product->brand ? $product->brand->name : 'Eccommers Exclusive' }}
            </div>
            <h1 style="font-size: 2.2rem; line-height: 1.2; margin-bottom: 12px;">{{ $product->name }}</h1>
            
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div class="rating-stars">
                    <span>★</span> <span>{{ number_format($product->rating_avg, 1) }}</span>
                    <span style="color: var(--muted); font-size: 0.85rem;">({{ $product->reviews_count }} Verified Reviews)</span>
                </div>
                <span style="font-size: 0.85rem; color: var(--muted);">| SKU: <strong x-text="sku"></strong></span>
            </div>

            <!-- Price Container -->
            <div style="background-color: var(--paper); border: 1px solid var(--line); border-radius: var(--radius); padding: 18px 24px; margin-bottom: 24px; display: flex; align-items: baseline; gap: 16px;">
                <span style="font-size: 2.2rem; font-weight: 700; color: var(--green);" x-text="'£' + Number(price).toLocaleString('en-IN')"></span>
                <span x-show="salePrice && salePrice < price" style="font-size: 1.2rem; color: var(--muted); text-decoration: line-through;" x-text="'£' + Number(price).toLocaleString('en-IN')"></span>
                <span style="font-size: 0.85rem; color: var(--muted);">Inclusive of 18% GST</span>
            </div>

            <p style="color: var(--ink-soft); font-size: 0.95rem; margin-bottom: 24px; line-height: 1.7;">
                {{ $product->description }}
            </p>

            <!-- Variants Selector -->
            @if($product->has_variants && $product->variants->count() > 0)
                <div style="margin-bottom: 24px;">
                    <label style="font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 10px;">Select Variant:</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        @foreach($product->variants as $variant)
                            <button type="button" class="btn btn-outline btn-sm"
                                    @click="selectVariant({{ json_encode($variant) }})"
                                    :style="selectedVariantId === {{ $variant->id }} ? 'background: var(--green-dim2); border-color: var(--green); color: var(--green); font-weight: 700;' : ''">
                                {{ $variant->variant_name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Stock Availability -->
            <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                <span style="font-weight: 600; font-size: 0.9rem;">Availability:</span>
                <template x-if="stock > 0">
                    <span class="badge-status badge-success">In Stock (<span x-text="stock"></span> units available)</span>
                </template>
                <template x-if="stock <= 0">
                    <span class="badge-status badge-danger">Out of Stock</span>
                </template>
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add') }}" method="POST" style="display: flex; gap: 16px; margin-bottom: 32px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" :value="selectedVariantId">

                <div style="display: flex; align-items: center; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden;">
                    <button type="button" @click="if(quantity > 1) quantity--" style="padding: 10px 16px; background: var(--paper); border: none; cursor: pointer;">-</button>
                    <input type="number" name="quantity" x-model="quantity" readonly style="width: 50px; text-align: center; border: none; font-weight: 600;">
                    <button type="button" @click="quantity++" style="padding: 10px 16px; background: var(--paper); border: none; cursor: pointer;">+</button>
                </div>

                <button type="submit" class="btn btn-primary" style="flex: 1;" :disabled="stock <= 0">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span>Add to Shopping Cart</span>
                </button>
            </form>

            <!-- Policy Assurances -->
            <div style="border-top: 1px solid var(--line-soft); padding-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: 0.85rem; color: var(--muted);">
                <div>🛡️ {{ $product->warranty_info ?: 'Manufacturer Guarantee Included' }}</div>
                <div>🚚 {{ $product->return_policy_info ?: '7-day easy return policy' }}</div>
            </div>
        </div>
    </div>

    <!-- Product Specifications & Customer Reviews -->
    <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); padding: 36px; box-shadow: var(--shadow-sm);">
        <h2 style="font-size: 1.6rem; margin-bottom: 20px;">Technical Specifications</h2>
        @if($product->specifications)
            <table class="custom-table" style="margin-bottom: 40px;">
                <tbody>
                    @foreach($product->specifications as $key => $val)
                        <tr>
                            <td style="width: 30%; font-weight: 600; background: var(--paper);">{{ $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h2 style="font-size: 1.6rem; margin-bottom: 20px;">Customer Reviews & Ratings</h2>
        
        <!-- Review Submission Form for Logged in Users -->
        @auth
            <form action="{{ route('account.review.submit') }}" method="POST" style="background: var(--paper); border: 1px solid var(--line); padding: 24px; border-radius: var(--radius); margin-bottom: 32px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <h4 style="margin-bottom: 12px;">Write a Verified Review</h4>
                
                <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600;">Rating (1-5 Stars)</label>
                        <select name="rating" style="padding: 8px; border: 1px solid var(--line); border-radius: var(--radius);">
                            <option value="5">5 - Outstanding</option>
                            <option value="4">4 - Good</option>
                            <option value="3">3 - Average</option>
                            <option value="2">2 - Poor</option>
                            <option value="1">1 - Terrible</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 16px;">
                    <textarea name="comment" rows="3" placeholder="Share your experience regarding sound quality, stitching, or pressure handling..." required style="width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: var(--radius); font-size: 0.9rem;"></textarea>
                </div>

                <button type="submit" class="btn btn-brass btn-sm">Submit Review</button>
            </form>
        @endauth

        <!-- Reviews List -->
        @if($product->reviews->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach($product->reviews as $rev)
                    <div style="border-bottom: 1px solid var(--line-soft); padding-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <div style="font-weight: 600; color: var(--ink);">{{ $rev->user ? $rev->user->name : 'Anonymous Customer' }}</div>
                            <span style="font-size: 0.8rem; color: var(--muted);">{{ $rev->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="rating-stars" style="margin-bottom: 8px;">
                            @for($i=0; $i<$rev->rating; $i++) ★ @endfor
                            <span style="color: var(--green); font-size: 0.78rem; font-weight: 600; margin-left: 8px;">✓ Verified Purchase</span>
                        </div>
                        <p style="font-size: 0.92rem; color: var(--ink-soft);">{{ $rev->comment }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: var(--muted);">No reviews written yet for this product. Be the first to leave a review!</p>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    function productDetail() {
        return {
            activeImage: '{{ $product->primaryImage ? $product->primaryImage->image_path : "https://via.placeholder.com/400" }}',
            sku: '{{ $product->sku }}',
            price: {{ $product->effective_price }},
            salePrice: {{ $product->sale_price ?: 0 }},
            stock: {{ $product->stock }},
            selectedVariantId: null,
            quantity: 1,
            selectVariant(v) {
                this.selectedVariantId = v.id;
                this.sku = v.sku;
                this.price = v.sale_price ? v.sale_price : v.price;
                this.stock = v.stock;
                if (v.image) {
                    this.activeImage = v.image;
                }
            }
        }
    }
</script>
@endsection
