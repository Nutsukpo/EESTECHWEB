@extends('layouts.public')

@section('title', 'Products for Sale | EES Technologies Ghana')

@section('content')
@php
    $activeSearch = trim((string) ($filters['search'] ?? ''));
    $activeCategory = (string) ($filters['category'] ?? '');
    $hasFilters = $activeSearch !== '' || $activeCategory !== '';
    $resultCount = method_exists($products, 'total') ? $products->total() : $products->count();
@endphp

<div class="ees-store-page">

    {{-- HERO --}}
    <section class="ps-hero" aria-labelledby="store-heading">
        <div class="ps-hero__orb ps-hero__orb--a" aria-hidden="true"></div>
        <div class="ps-hero__orb ps-hero__orb--b" aria-hidden="true"></div>
        <div class="ps-hero__grid" aria-hidden="true"></div>

        <div class="container position-relative">
            <p class="ps-kicker ps-in" style="--d: 0ms">EES-Tech store</p>

            <h1 id="store-heading" class="ps-hero__title">
                <span class="ps-line"><span style="--d: 80ms">Technology products</span></span>
                <span class="ps-line"><span style="--d: 200ms">&amp; solutions.</span></span>
            </h1>

            <p class="ps-hero__text ps-in" style="--d: 360ms">
                Explore our range of technology products, devices, networking
                equipment and accessories.
            </p>
        </div>
    </section>

    {{-- FILTER BAR --}}
    <section class="ps-filter-wrap" aria-label="Search and filter products">
        <div class="container">
            <form method="GET" action="{{ route('sales.index') }}" class="ps-filter ps-in" style="--d: 460ms" id="productFilter" role="search">

                <label class="ps-filter__search">
                    <span class="visually-hidden">Search products</span>
                    <i class="fas fa-magnifying-glass" aria-hidden="true"></i>
                    <input
                        type="search"
                        name="search"
                        placeholder="Search products..."
                        value="{{ $filters['search'] ?? '' }}"
                    >
                </label>

                <label class="ps-filter__select">
                    <span class="visually-hidden">Category</span>
                    <i class="fas fa-layer-group" aria-hidden="true"></i>
                    <select name="category" id="productCategory">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}"
                                @selected(($filters['category'] ?? '') === $category)>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <div class="ps-filter__actions">
                    <button type="submit" class="ps-btn ps-btn--solid">
                        Search
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>

                    <a href="{{ route('sales.index') }}" class="ps-reset" aria-label="Reset filters" title="Reset filters">
                        <i class="fas fa-rotate-right" aria-hidden="true"></i>
                    </a>
                </div>

            </form>
        </div>
    </section>

    {{-- PRODUCTS --}}
    <section class="ps-listing">
        <div class="container">

            <div class="ps-head" data-reveal>
                <div>
                    <h2>Our products</h2>
                    <p>Find the equipment and devices you need.</p>
                </div>

                <span class="ps-count">
                    <strong>{{ $resultCount }}</strong>
                    {{ $resultCount === 1 ? 'product' : 'products' }}
                </span>
            </div>

            @if($hasFilters)
                <div class="ps-active" data-reveal>
                    <span>Showing results</span>

                    @if($activeSearch !== '')
                        <span class="ps-chip"><i class="fas fa-magnifying-glass" aria-hidden="true"></i> “{{ $activeSearch }}”</span>
                    @endif

                    @if($activeCategory !== '')
                        <span class="ps-chip"><i class="fas fa-layer-group" aria-hidden="true"></i> {{ $activeCategory }}</span>
                    @endif

                    <a href="{{ route('sales.index') }}" class="ps-clear">Clear all</a>
                </div>
            @endif

            <div class="row g-4">
                @forelse ($products as $product)
                    @php
                        $inStock = $product->is_available
                            && $product->stock_quantity > 0;
                    @endphp

                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <article class="ps-card {{ $inStock ? '' : 'is-out' }}" data-reveal style="--i: {{ $loop->index % 4 }}">

                            <a href="{{ route('sales.show', $product->slug) }}"
                               class="ps-card__media"
                               aria-label="View {{ $product->name }}">

                                @if ($product->image_path)
                                    <img
                                        src="{{ asset('storage/' . $product->image_path) }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="ps-card__noimage">
                                        <i class="fas fa-image" aria-hidden="true"></i>
                                        <span>Product image coming soon</span>
                                    </div>
                                @endif

                                <span class="ps-stock {{ $inStock ? 'ps-stock--in' : 'ps-stock--out' }}">
                                    <span class="ps-stock__dot" aria-hidden="true"></span>
                                    {{ $inStock ? 'Available' : 'Out of stock' }}
                                </span>

                                <span class="ps-card__open" aria-hidden="true">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>

                            <div class="ps-card__body">
                                @if ($product->category)
                                    <span class="ps-card__category">{{ $product->category }}</span>
                                @endif

                                <h3>
                                    <a href="{{ route('sales.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <p class="ps-card__desc">
                                    {{ $product->short_description
                                        ?: 'Contact us for more information about this product.' }}
                                </p>

                                <div class="ps-card__footer">
                                    <div class="ps-card__price">
                                        @if ($product->is_price_visible && $product->price !== null)
                                            <span class="ps-price">
                                                GH₵ {{ number_format((float) $product->price, 2) }}
                                            </span>
                                        @else
                                            <span class="ps-price ps-price--enquiry">
                                                Contact for price
                                            </span>
                                        @endif
                                    </div>

                                    <a href="{{ route('sales.show', $product->slug) }}" class="ps-card__more">
                                        <span>View details</span>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ps-empty" data-reveal>
                            <div class="ps-empty__icon"><i class="fas fa-box-open" aria-hidden="true"></i></div>
                            <h3>No products found</h3>
                            <p>Please try a different search or check back later.</p>
                            <a href="{{ route('sales.index') }}" class="ps-btn ps-btn--solid">
                                View all products
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="ps-pagination" data-reveal>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="ps-cta">
        <div class="container">
            <div class="ps-cta__panel" data-reveal>
                <div class="ps-cta__copy">
                    <h2>Can't find what you need?</h2>
                    <p>Tell us what you're looking for and our team will source the right equipment for you.</p>
                </div>

                <a href="{{ url('/#contact') }}" class="ps-btn ps-btn--light">
                    Ask our team
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap');

    .ees-store-page {
        --navy: #061b3d;
        --navy-2: #0a2a5c;
        --blue: #0878d1;
        --blue-soft: #e7f2fc;
        --gold: #e9b13a;
        --paper: #f6f8fb;
        --ink: #0d1b2e;
        --muted: #56637a;
        --line: #dde4ee;
        --ease: cubic-bezier(.2, .7, .2, 1);

        --font-display: 'Bricolage Grotesque', 'Figtree', system-ui, sans-serif;
        --font-body: 'Figtree', system-ui, -apple-system, 'Segoe UI', sans-serif;

        font-family: var(--font-body);
        color: var(--ink);
        overflow: clip;
    }

    .ees-store-page .container { max-width: 1280px; }

    .ees-store-page h1,
    .ees-store-page h2,
    .ees-store-page h3 {
        font-family: var(--font-display);
        margin: 0;
    }

    .ees-store-page a:focus-visible,
    .ees-store-page button:focus-visible,
    .ees-store-page select:focus-visible {
        outline: 3px solid var(--gold);
        outline-offset: 3px;
    }

    /* ---------- Shared ---------- */
    .ps-kicker {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 22px;
        color: #9cc8f3;
        font-size: 15px;
        font-weight: 700;
    }

    .ps-kicker::before {
        content: "";
        width: 28px;
        height: 3px;
        border-radius: 2px;
        background: var(--gold);
    }

    .ps-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 54px;
        padding: 12px 28px;
        border: 0;
        border-radius: 999px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .25s ease, color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
    }

    .ps-btn i { font-size: 13px; transition: transform .3s var(--ease); }
    .ps-btn:hover { transform: translateY(-2px); }
    .ps-btn:hover i.fa-arrow-right { transform: translateX(5px); }

    .ps-btn--solid { color: #fff; background: var(--blue); }
    .ps-btn--solid:hover { color: #fff; background: var(--navy); box-shadow: 0 16px 32px -14px rgba(6, 27, 61, .55); }

    .ps-btn--light { color: var(--navy); background: #fff; }
    .ps-btn--light:hover { color: var(--navy); background: var(--gold); }

    .ps-in {
        animation: ps-fade-up .85s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes ps-fade-up {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: none; }
    }

    /* ---------- Hero ---------- */
    .ps-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(64px, 8vw, 112px) 0 clamp(120px, 12vw, 168px);
        color: #fff;
        background: var(--navy);
    }

    .ps-hero__orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
    }

    .ps-hero__orb--a {
        width: 500px;
        height: 500px;
        top: -210px;
        right: 5%;
        background: rgba(8, 120, 209, .5);
        animation: ps-drift-a 16s ease-in-out infinite alternate;
    }

    .ps-hero__orb--b {
        width: 340px;
        height: 340px;
        bottom: -190px;
        left: 6%;
        background: rgba(233, 177, 58, .15);
        animation: ps-drift-b 20s ease-in-out infinite alternate;
    }

    .ps-hero__grid {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, .12) 1px, transparent 1px);
        background-size: 30px 30px;
        mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        -webkit-mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        pointer-events: none;
    }

    @keyframes ps-drift-a {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(-60px, 50px, 0) scale(1.12); }
    }

    @keyframes ps-drift-b {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(70px, -40px, 0) scale(1.1); }
    }

    .ps-hero__title {
        max-width: 900px;
        color: #fff;
        font-size: clamp(40px, 6.2vw, 88px);
        font-weight: 800;
        line-height: 1.02;
        letter-spacing: -.04em;
    }

    .ps-line { display: block; overflow: hidden; padding-bottom: .08em; }

    .ps-line > span {
        display: block;
        animation: ps-line-up .9s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes ps-line-up {
        from { transform: translateY(110%); }
        to   { transform: translateY(0); }
    }

    .ps-hero__text {
        max-width: 54ch;
        margin: 26px 0 0;
        color: rgba(255, 255, 255, .8);
        font-size: clamp(16px, 1.4vw, 19px);
        line-height: 1.7;
    }

    /* ---------- Filter bar (floats over the hero) ---------- */
    .ps-filter-wrap {
        position: relative;
        z-index: 3;
        margin-top: calc(-1 * clamp(40px, 5vw, 56px));
    }

    .ps-filter {
        display: grid;
        grid-template-columns: 1fr 260px auto;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        box-shadow: 0 30px 70px -26px rgba(6, 27, 61, .4);
    }

    .ps-filter__search,
    .ps-filter__select {
        position: relative;
        display: block;
        margin: 0;
    }

    .ps-filter__search > i,
    .ps-filter__select > i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--blue);
        font-size: 15px;
        pointer-events: none;
        transition: color .25s ease;
    }

    .ps-filter__search input,
    .ps-filter__select select {
        width: 100%;
        height: 54px;
        padding: 0 20px 0 50px;
        color: var(--ink);
        background: var(--paper);
        border: 1.5px solid transparent;
        border-radius: 999px;
        font-family: inherit;
        font-size: 1rem;
        transition: background-color .25s ease, border-color .25s ease, box-shadow .3s ease;
    }

    .ps-filter__select select {
        appearance: none;
        -webkit-appearance: none;
        padding-right: 44px;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%230878d1' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
    }

    .ps-filter__search input::placeholder { color: #94a1b5; }

    .ps-filter__search input:hover,
    .ps-filter__select select:hover { border-color: var(--line); }

    .ps-filter__search input:focus,
    .ps-filter__select select:focus {
        outline: none;
        background-color: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 5px rgba(8, 120, 209, .12);
    }

    .ps-filter__actions { display: flex; align-items: center; gap: 8px; }

    .ps-filter__actions .ps-btn { min-height: 54px; }

    .ps-reset {
        width: 54px;
        height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: var(--paper);
        border: 1.5px solid var(--line);
        border-radius: 50%;
        text-decoration: none;
        transition: color .25s ease, background-color .25s ease, border-color .25s ease;
    }

    .ps-reset i { transition: transform .5s var(--ease); }
    .ps-reset:hover { color: #fff; background: var(--navy); border-color: var(--navy); }
    .ps-reset:hover i { transform: rotate(180deg); }

    /* ---------- Listing ---------- */
    .ps-listing {
        padding: clamp(48px, 6vw, 88px) 0 clamp(56px, 7vw, 104px);
        background: #fff;
    }

    .ps-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: clamp(24px, 3vw, 36px);
    }

    .ps-head h2 {
        color: var(--navy);
        font-size: clamp(32px, 4vw, 52px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
    }

    .ps-head p { margin: 14px 0 0; color: var(--muted); font-size: 17px; }

    .ps-count {
        flex-shrink: 0;
        padding: 10px 18px;
        color: var(--muted);
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 999px;
        font-size: 15px;
        font-weight: 600;
    }

    .ps-count strong {
        margin-right: 4px;
        color: var(--navy);
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 800;
    }

    .ps-active {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 28px;
        color: var(--muted);
        font-size: .95rem;
        font-weight: 600;
    }

    .ps-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        color: var(--navy-2);
        background: var(--blue-soft);
        border-radius: 999px;
        font-weight: 700;
    }

    .ps-chip i { color: var(--blue); font-size: .8rem; }

    .ps-clear {
        color: var(--blue);
        font-weight: 700;
        text-decoration: none;
        background-image: linear-gradient(var(--blue), var(--blue));
        background-repeat: no-repeat;
        background-position: 0 100%;
        background-size: 0 2px;
        transition: background-size .35s var(--ease), color .2s ease;
    }

    .ps-clear:hover { color: var(--navy); background-size: 100% 2px; }

    /* ---------- Product card ---------- */
    .ps-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 24px;
        transition: transform .4s var(--ease), box-shadow .4s ease, border-color .3s ease;
    }

    .ps-card:hover {
        transform: translateY(-8px);
        border-color: transparent;
        box-shadow: 0 30px 60px -24px rgba(6, 27, 61, .35);
    }

    .ps-card__media {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 240px;
        padding: 26px;
        overflow: hidden;
        background:
            radial-gradient(circle at 50% 40%, #fff 0%, var(--paper) 70%);
    }

    .ps-card__media img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform .7s var(--ease), filter .4s ease;
    }

    .ps-card:hover .ps-card__media img { transform: scale(1.08) translateY(-4px); }

    .ps-card.is-out .ps-card__media img { filter: grayscale(.85); opacity: .75; }

    .ps-card__noimage {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        color: #a2adba;
        font-size: .85rem;
        font-weight: 600;
        text-align: center;
    }

    .ps-card__noimage i { font-size: 2.8rem; }

    .ps-stock {
        position: absolute;
        z-index: 2;
        top: 14px;
        left: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 13px;
        font-size: .8rem;
        font-weight: 700;
        border-radius: 999px;
        backdrop-filter: blur(6px);
    }

    .ps-stock__dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }

    .ps-stock--in { color: #0f6b3f; background: rgba(220, 247, 232, .95); }
    .ps-stock--in .ps-stock__dot { animation: ps-blink 2s ease-in-out infinite; }

    .ps-stock--out { color: #8a1c1c; background: rgba(253, 232, 232, .95); }

    @keyframes ps-blink { 50% { opacity: .35; } }

    .ps-card__open {
        position: absolute;
        z-index: 2;
        right: 14px;
        bottom: 14px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: var(--gold);
        border-radius: 50%;
        font-size: 14px;
        opacity: 0;
        transform: translateY(14px) scale(.8);
        transition: opacity .35s ease, transform .45s var(--ease);
    }

    .ps-card:hover .ps-card__open,
    .ps-card__media:focus-visible .ps-card__open { opacity: 1; transform: none; }

    .ps-card__body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 22px 24px 22px;
    }

    .ps-card__category {
        align-self: flex-start;
        margin-bottom: 10px;
        padding: 4px 12px;
        color: var(--blue);
        background: var(--blue-soft);
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 700;
    }

    .ps-card h3 {
        font-size: 1.28rem;
        font-weight: 700;
        line-height: 1.25;
        letter-spacing: -.015em;
    }

    .ps-card h3 a {
        color: var(--navy);
        text-decoration: none;
        background-image: linear-gradient(var(--blue), var(--blue));
        background-repeat: no-repeat;
        background-position: 0 100%;
        background-size: 0 2px;
        transition: background-size .4s var(--ease), color .25s ease;
    }

    .ps-card:hover h3 a { color: var(--blue); background-size: 100% 2px; }

    .ps-card__desc {
        flex: 1;
        margin: 12px 0 0;
        color: var(--muted);
        font-size: .95rem;
        line-height: 1.65;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 4.95em;
    }

    .ps-card__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid var(--line);
    }

    .ps-price {
        display: block;
        color: var(--navy);
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: -.01em;
    }

    .ps-price--enquiry {
        color: var(--blue);
        font-family: var(--font-body);
        font-size: .95rem;
        font-weight: 700;
        letter-spacing: 0;
    }

    .ps-card__more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--blue);
        font-size: .92rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .ps-card__more i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
        background: var(--blue-soft);
        border-radius: 50%;
        font-size: 11px;
        transition: background-color .3s ease, color .3s ease, transform .4s var(--ease);
    }

    .ps-card:hover .ps-card__more i { color: #fff; background: var(--blue); transform: translateX(4px); }

    /* ---------- Empty state ---------- */
    .ps-empty {
        max-width: 640px;
        margin: 0 auto;
        padding: clamp(44px, 6vw, 80px) 28px;
        text-align: center;
        background: var(--paper);
        border: 1px dashed #c4d0e0;
        border-radius: 28px;
    }

    .ps-empty__icon {
        width: 84px;
        height: 84px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 26px;
        color: var(--blue);
        background: #fff;
        border-radius: 24px;
        font-size: 34px;
        box-shadow: 0 18px 40px -18px rgba(6, 27, 61, .3);
        animation: ps-float 3.6s ease-in-out infinite;
    }

    @keyframes ps-float {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50%      { transform: translateY(-10px) rotate(3deg); }
    }

    .ps-empty h3 { color: var(--navy); font-size: 30px; font-weight: 800; letter-spacing: -.02em; }
    .ps-empty p { max-width: 42ch; margin: 14px auto 28px; color: var(--muted); font-size: 17px; line-height: 1.7; }

    /* ---------- Pagination (Bootstrap 5) ---------- */
    .ps-pagination { display: flex; justify-content: center; margin-top: clamp(36px, 5vw, 64px); }
    .ps-pagination nav { max-width: 100%; }
    .ps-pagination .pagination { flex-wrap: wrap; justify-content: center; gap: 6px; margin: 0; }
    .ps-pagination p.small { text-align: center; color: var(--muted); }

    .ps-pagination .page-link {
        min-width: 44px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px !important;
        font-weight: 700;
        transition: background-color .2s ease, color .2s ease, transform .2s ease;
    }

    .ps-pagination .page-link:hover {
        color: #fff;
        background: var(--blue);
        border-color: var(--blue);
        transform: translateY(-2px);
    }

    .ps-pagination .page-item.active .page-link { color: #fff; background: var(--navy); border-color: var(--navy); }
    .ps-pagination .page-item.disabled .page-link { color: #a3aec0; background: transparent; }

    /* ---------- CTA ---------- */
    .ps-cta { padding: 0 0 clamp(56px, 7vw, 104px); background: #fff; }

    .ps-cta__panel {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: clamp(28px, 5vw, 72px);
        padding: clamp(32px, 6vw, 72px);
        color: #fff;
        border-radius: 32px;
        background:
            radial-gradient(circle at 100% 0%, rgba(8, 120, 209, .55), transparent 50%),
            var(--navy);
    }

    .ps-cta__panel::after {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        left: -120px;
        bottom: -200px;
        border-radius: 50%;
        background: rgba(233, 177, 58, .14);
        filter: blur(40px);
        animation: ps-drift-b 14s ease-in-out infinite alternate;
        pointer-events: none;
    }

    .ps-cta__copy,
    .ps-cta__panel .ps-btn { position: relative; z-index: 1; }

    .ps-cta__panel .ps-btn { flex-shrink: 0; }

    .ps-cta__panel h2 {
        color: #fff;
        font-size: clamp(30px, 4vw, 52px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
    }

    .ps-cta__panel p {
        max-width: 46ch;
        margin: 16px 0 0;
        color: rgba(255, 255, 255, .8);
        font-size: 17px;
        line-height: 1.7;
    }

    /* ---------- Scroll reveal (enabled only when JS runs) ---------- */
    .ps-js [data-reveal] {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity .8s var(--ease), transform .8s var(--ease);
        transition-delay: calc(var(--i, 0) * 90ms);
    }

    .ps-js [data-reveal].is-visible { opacity: 1; transform: none; }

    /* Once revealed, cards switch to their snappy hover timing. */
    .ps-js .ps-card.is-visible {
        transition:
            opacity .8s var(--ease),
            transform .4s var(--ease),
            box-shadow .4s ease,
            border-color .3s ease;
        transition-delay: 0s;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .ps-filter {
            grid-template-columns: 1fr 1fr;
            border-radius: 28px;
        }

        .ps-filter__actions { grid-column: 1 / -1; }
        .ps-filter__actions .ps-btn { flex: 1; }
    }

    @media (max-width: 767.98px) {
        .ps-head { flex-direction: column; align-items: flex-start; }

        .ps-cta__panel {
            flex-direction: column;
            align-items: flex-start;
            border-radius: 24px;
        }

        .ps-cta__panel .ps-btn { width: 100%; }
    }

    @media (max-width: 575.98px) {
        .ps-filter { grid-template-columns: 1fr; padding: 10px; }
        .ps-card { border-radius: 20px; }
        .ps-card__media { height: 210px; }
    }

    /* Touch screens have no hover, so keep the open button visible. */
    @media (hover: none) {
        .ps-card__open { opacity: 1; transform: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ees-store-page *,
        .ees-store-page *::before,
        .ees-store-page *::after {
            animation: none !important;
            transition-duration: .01ms !important;
            transition-delay: 0s !important;
        }

        .ps-js [data-reveal] { opacity: 1; transform: none; }
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        var root = document.querySelector('.ees-store-page');
        if (!root) { return; }

        /* ---------- Apply the category as soon as it changes. ---------- */
        var category = document.getElementById('productCategory');
        var filter = document.getElementById('productFilter');

        if (category && filter) {
            category.addEventListener('change', function () { filter.submit(); });
        }

        /* ---------- Scroll reveal. Content stays visible without JS. ---------- */
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }
        if (!('IntersectionObserver' in window)) { return; }

        root.classList.add('ps-js');

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        root.querySelectorAll('[data-reveal]').forEach(function (el) { observer.observe(el); });
    })();
</script>
@endpush