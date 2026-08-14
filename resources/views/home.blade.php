@extends('layouts.app')

@section('title', 'Eccommers Web | Handcrafted Lifestyle & PetChem Industrial Parts')

@section('content')

<!-- Hero Promotional Section -->
<section style="background: linear-gradient(135deg, var(--green-3) 0%, var(--green) 100%); color: var(--paper-2); padding: 80px 24px; position: relative; overflow: hidden;">
    <div style="max-width: 1320px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; align-items: center;">
        <div>
            <span style="background: var(--brass-dim); color: var(--brass-2); padding: 6px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 20px;">
                Exclusive 2026 Collection
            </span>
            <h1 style="font-size: 3.2rem; line-height: 1.15; color: var(--white); margin-bottom: 20px;">
                Crafted for Excellence.<br>Built to Last.
            </h1>
            <p style="font-size: 1.1rem; color: var(--muted-2); margin-bottom: 36px; max-width: 540px;">
                Discover studio-grade acoustics, heavy organic canvas apparel, and industrial petrochemical equipment precision engineered for performance.
            </p>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                <a href="{{ route('products.index') }}" class="btn btn-brass" style="font-size: 1.05rem; padding: 14px 32px;">
                    Explore Catalog
                </a>
                <a href="{{ route('products.index', ['category' => 'petchem-industrial-parts']) }}" class="btn btn-outline" style="color: var(--white); border-color: rgba(255,255,255,0.3);">
                    Industrial Equipment
                </a>
            </div>
        </div>
        <div style="position: relative; text-align: center;">
            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800" alt="Hero ANC Headphones" 
                 style="max-width: 100%; border-radius: 12px; box-shadow: var(--shadow-lg); border: 2px solid rgba(255,255,255,0.1);">
        </div>
    </div>
</section>

<!-- Trusted Clients / Brands Showcase Bar -->
<section style="background-color: var(--white); border-bottom: 1px solid var(--line); padding: 28px 24px;">
    <div style="max-width: 1320px; margin: 0 auto; text-align: center;">
        <div style="font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 16px;">
            Trusted by Industry Leaders & Global Clients
        </div>
        <div style="display: flex; justify-content: center; align-items: center; gap: 48px; flex-wrap: wrap; opacity: 0.75;">
            @foreach($brands as $brand)
                <div style="font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 700; color: var(--ink-soft); display: flex; align-items: center; gap: 8px;">
                    <span>🛡️</span> {{ $brand->name }}
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Split 50/50 Feature Section with Custom Image Slider -->
<section class="split-feature-section">
    <div class="split-feature-container">
        <!-- Left Half: Text Content -->
        <div>
            <span class="pro-badge-brass" style="margin-bottom: 16px;">
                Engineered Craftsmanship
            </span>
            <h2 style="font-size: 2.6rem; line-height: 1.2; margin-bottom: 18px; color: var(--ink);">
                Uncompromising Quality.<br>From Factory Floor to Studio.
            </h2>
            <p style="color: var(--ink-soft); font-size: 1.05rem; line-height: 1.7; margin-bottom: 24px;">
                Whether outfitting a petrochemical refinery with SS316 ANSI flanged valves or delivering studio-grade active noise cancelling acoustics, we maintain zero-tolerance quality benchmarks.
            </p>

            <ul class="feature-list">
                <li class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div>
                        <strong style="color: var(--ink); display: block;">ISO 9001 Certified Manufacturing</strong>
                        <span style="font-size: 0.9rem; color: var(--muted);">Tested for extreme 800 WOG pressure containment.</span>
                    </div>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div>
                        <strong style="color: var(--ink); display: block;">Sustainable Materials & Brass Alloys</strong>
                        <span style="font-size: 0.9rem; color: var(--muted);">100% recyclable components and organic heavy canvas fabrics.</span>
                    </div>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div>
                        <strong style="color: var(--ink); display: block;">Express Global Fulfillment & Logistics</strong>
                        <span style="font-size: 0.9rem; color: var(--muted);">Real-time tracking timeline with end-to-end AWB assignment.</span>
                    </div>
                </li>
            </ul>

            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Explore All Collections
                </a>
                <a href="{{ route('blog.index') }}" class="btn btn-outline">
                    Read Engineering Guides
                </a>
            </div>
        </div>

        <!-- Right Half: Interactive Pro Image Slider -->
        <div x-data="imageSlider()" x-init="startAutoPlay()" class="slider-wrapper">
            <!-- Slides Loop -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentIndex === index" 
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     style="position: absolute; inset: 0; width: 100%; height: 100%;">
                    
                    <img :src="slide.image" :alt="slide.title" class="slider-slide">
                    
                    <div class="slider-caption-overlay">
                        <span style="font-size: 0.75rem; background: var(--brass); color: var(--white); padding: 3px 10px; border-radius: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;" x-text="slide.tag"></span>
                        <h3 style="font-size: 1.4rem; color: var(--white); margin-top: 6px;" x-text="slide.title"></h3>
                        <p style="font-size: 0.88rem; color: rgba(255,255,255,0.8); margin-top: 4px;" x-text="slide.desc"></p>
                    </div>
                </div>
            </template>

            <!-- Navigation Controls -->
            <button type="button" @click="prevSlide()" class="slider-btn slider-btn-prev" title="Previous Slide">‹</button>
            <button type="button" @click="nextSlide()" class="slider-btn slider-btn-next" title="Next Slide">›</button>

            <!-- Indicator Dots -->
            <div class="slider-dots">
                <template x-for="(slide, index) in slides" :key="index">
                    <div @click="goToSlide(index)" class="slider-dot" :class="{ 'active': currentIndex === index }"></div>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section style="max-width: 1320px; margin: 60px auto; padding: 0 24px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 2.2rem; margin-bottom: 8px;">Explore Categories</h2>
        <p style="color: var(--muted);">Curated product lines for industrial and lifestyle requirements</p>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
               style="background-color: var(--white); border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s var(--ease);"
               onmouseover="this.style.borderColor='var(--green)'; this.style.transform='translateY(-4px)';"
               onmouseout="this.style.borderColor='var(--line)'; this.style.transform='none';">
                <div style="height: 180px; background-color: var(--paper-2); overflow: hidden; position: relative;">
                    <img src="{{ $category->image ?: 'https://via.placeholder.com/400' }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px; text-align: center;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 4px;">{{ $category->name }}</h3>
                    <span style="font-size: 0.85rem; color: var(--muted);">{{ $category->products_count }} Products</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

<!-- Flash Sale Section with Live Countdown Timer -->
<section style="background-color: var(--paper-2); border-y: 1px solid var(--line); padding: 50px 24px; margin: 60px 0;" x-data="countdownTimer()">
    <div style="max-width: 1320px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
        <div>
            <span style="background: var(--clay); color: var(--white); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                ⚡ Limited Time Flash Sale
            </span>
            <h2 style="font-size: 2rem; margin-top: 8px;">Save up to 40% on Premium ANC Audio</h2>
        </div>
        <div style="display: flex; gap: 16px; align-items: center;">
            <div style="background: var(--white); border: 1px solid var(--line); padding: 12px 18px; border-radius: var(--radius); text-align: center;">
                <span style="font-size: 1.6rem; font-weight: 700; color: var(--green);" x-text="hours">08</span>
                <div style="font-size: 0.72rem; color: var(--muted); text-transform: uppercase;">Hours</div>
            </div>
            <div style="background: var(--white); border: 1px solid var(--line); padding: 12px 18px; border-radius: var(--radius); text-align: center;">
                <span style="font-size: 1.6rem; font-weight: 700; color: var(--green);" x-text="minutes">42</span>
                <div style="font-size: 0.72rem; color: var(--muted); text-transform: uppercase;">Mins</div>
            </div>
            <div style="background: var(--white); border: 1px solid var(--line); padding: 12px 18px; border-radius: var(--radius); text-align: center;">
                <span style="font-size: 1.6rem; font-weight: 700; color: var(--green);" x-text="seconds">15</span>
                <div style="font-size: 0.72rem; color: var(--muted); text-transform: uppercase;">Secs</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section style="max-width: 1320px; margin: 60px auto; padding: 0 24px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
        <div>
            <h2 style="font-size: 2.2rem; margin-bottom: 4px;">Featured Products</h2>
            <p style="color: var(--muted);">Handpicked items with exceptional ratings and craftsmanship</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm">View All Catalog</a>
    </div>

    <div class="product-grid">
        @foreach($featuredProducts as $product)
            @php
                $inCart = in_array($product->id, $userCartProductIds ?? []);
                $inWishlist = in_array($product->id, $userWishlistProductIds ?? []);
            @endphp
            <div class="product-card">
                @if($product->discount_percentage > 0)
                    <span class="badge-discount">{{ $product->discount_percentage }}% OFF</span>
                @endif

                <!-- Wishlist Toggle Button -->
                <form action="{{ route('account.wishlist.toggle') }}" method="POST" style="position: absolute; top: 12px; right: 12px; z-index: 5;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-wishlist" style="{{ $inWishlist ? 'color: var(--clay); background: var(--white);' : '' }}" title="{{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                        {{ $inWishlist ? '♥' : '♡' }}
                    </button>
                </form>

                <div class="media-wrapper">
                    <img src="{{ $product->primaryImage ? $product->primaryImage->image_path : 'https://via.placeholder.com/400' }}" alt="{{ $product->name }}">
                </div>
                <div class="content">
                    <span class="category-name">{{ $product->category ? $product->category->name : '' }}</span>
                    <a href="{{ route('products.show', $product->slug) }}" class="title">{{ $product->name }}</a>
                    <div class="rating-stars">
                        <span>★</span> <span>{{ number_format($product->rating_avg, 1) }}</span>
                        <span style="color: var(--muted); font-size: 0.8rem;">({{ $product->reviews_count }})</span>
                    </div>
                    <div class="price-row">
                        <span class="price">£{{ number_format($product->effective_price, 2) }}</span>
                        @if($product->sale_price && $product->sale_price < $product->price)
                            <span class="original-price">£{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Single Add to Cart / Added to Cart Button -->
                    @if($inCart)
                        <a href="{{ route('cart.index') }}" class="btn btn-outline btn-sm btn-block" style="margin-top: 14px; color: var(--green); border-color: var(--green); background: var(--green-dim);">
                            ✓ Added in Cart (View Cart)
                        </a>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 14px;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">
                                🛒 Add to Cart
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Client Testimonials Showcase Section -->
<section style="background-color: var(--white); border-y: 1px solid var(--line); padding: 70px 24px; margin: 60px 0;">
    <div style="max-width: 1320px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 48px;">
            <span style="color: var(--brass); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Client Feedback</span>
            <h2 style="font-size: 2.4rem; margin-top: 6px;">What Our Corporate & Retail Clients Say</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
            @foreach(\App\Models\Testimonial::where('status', true)->get() as $t)
                <div style="background-color: var(--paper); border: 1px solid var(--line); border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
                    <div class="rating-stars" style="margin-bottom: 16px;">
                        @for($i=0; $i<$t->rating; $i++) ★ @endfor
                    </div>
                    <p style="font-size: 1rem; color: var(--ink-soft); font-style: italic; margin-bottom: 24px; flex: 1; line-height: 1.7;">
                        "{{ $t->content }}"
                    </p>
                    <div style="display: flex; align-items: center; gap: 14px; border-top: 1px solid var(--line-soft); padding-top: 16px;">
                        <img src="{{ $t->client_avatar ?: 'https://via.placeholder.com/50' }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <div style="font-weight: 700; color: var(--ink);">{{ $t->client_name }}</div>
                            <div style="font-size: 0.82rem; color: var(--muted);">{{ $t->client_title }} • <strong>{{ $t->company_name }}</strong></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent Blog Articles Section -->
<section style="max-width: 1320px; margin: 60px auto; padding: 0 24px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
        <div>
            <h2 style="font-size: 2.2rem; margin-bottom: 4px;">Latest Blog Articles</h2>
            <p style="color: var(--muted);">Technical guides, acoustic engineering, and lifestyle trends</p>
        </div>
        <a href="{{ route('blog.index') }}" class="btn btn-outline btn-sm">Read All Blogs</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
        @foreach(\App\Models\Blog::where('is_published', true)->latest()->take(3)->get() as $b)
            <div style="background: var(--white); border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden;">
                <div style="height: 180px; background: var(--paper-2); overflow: hidden;">
                    <img src="{{ $b->featured_image }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 8px;"><a href="{{ route('blog.show', $b->slug) }}">{{ $b->title }}</a></h3>
                    <p style="font-size: 0.88rem; color: var(--muted); margin-bottom: 16px;">{{ Str::limit($b->excerpt, 90) }}</p>
                    <a href="{{ route('blog.show', $b->slug) }}" class="btn btn-outline btn-sm">Read Article →</a>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection

@section('scripts')
<script>
    function imageSlider() {
        return {
            currentIndex: 0,
            autoPlayTimer: null,
            slides: [
                {
                    tag: 'Petchem Engineering',
                    title: 'High-Pressure Stainless Steel SS316 Valves',
                    desc: 'Engineered to withstand 800 WOG pressure containment in chemical plants.',
                    image: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1000'
                },
                {
                    tag: 'Studio Acoustics',
                    title: 'Active Noise Cancelling Master Headset',
                    desc: 'Hybrid digital ANC with 40,000Hz sampling rate and 40-hour battery life.',
                    image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=1000'
                },
                {
                    tag: 'Handcrafted Apparel',
                    title: 'Heavyweight Organic Canvas Field Jackets',
                    desc: 'Tailored using 100% sustainable organic cotton and brass alloy hardware.',
                    image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=1000'
                },
                {
                    tag: 'Precision Hardware',
                    title: 'ANSI Flanged Industrial Pipeline Fittings',
                    desc: 'Precision machined corrosion-resistant industrial pipeline components.',
                    image: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1000'
                }
            ],
            nextSlide() {
                this.currentIndex = (this.currentIndex + 1) % this.slides.length;
            },
            prevSlide() {
                this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            },
            goToSlide(index) {
                this.currentIndex = index;
            },
            startAutoPlay() {
                this.autoPlayTimer = setInterval(() => {
                    this.nextSlide();
                }, 4000);
            }
        }
    }

    function countdownTimer() {
        return {
            hours: '08',
            minutes: '42',
            seconds: '15',
            init() {
                let totalSecs = 8 * 3600 + 42 * 60 + 15;
                setInterval(() => {
                    if (totalSecs <= 0) return;
                    totalSecs--;
                    let h = Math.floor(totalSecs / 3600);
                    let m = Math.floor((totalSecs % 3600) / 60);
                    let s = totalSecs % 60;
                    this.hours = h < 10 ? '0' + h : h;
                    this.minutes = m < 10 ? '0' + m : m;
                    this.seconds = s < 10 ? '0' + s : s;
                }, 1000);
            }
        }
    }
</script>
@endsection
