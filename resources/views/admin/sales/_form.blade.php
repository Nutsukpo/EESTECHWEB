@php
    $product = $product ?? null;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please correct the following errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Product Information</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="name">Product Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $product?->name) }}"
                        required
                        maxlength="255"
                    >
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="sku">SKU / Product Code</label>
                        <input
                            type="text"
                            id="sku"
                            name="sku"
                            class="form-control"
                            value="{{ old('sku', $product?->sku) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="category">Category</label>
                        <input
                            type="text"
                            id="category"
                            name="category"
                            class="form-control"
                            placeholder="e.g. Laptops, Networking"
                            value="{{ old('category', $product?->category) }}"
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="short_description">
                        Short Description
                    </label>
                    <textarea
                        id="short_description"
                        name="short_description"
                        class="form-control"
                        rows="3"
                        maxlength="500"
                    >{{ old('short_description', $product?->short_description) }}</textarea>
                    <small class="text-muted">Maximum 500 characters.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">
                        Full Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="6"
                    >{{ old('description', $product?->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Product Image</h5>
            </div>

            <div class="card-body">
                @if ($product?->image_path)
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $product->image_path) }}"
                            alt="{{ $product->name }}"
                            style="max-width: 240px; max-height: 180px; object-fit: contain;"
                            class="img-thumbnail"
                        >
                        <p class="small text-muted mt-2">
                            Upload a new image to replace the current one.
                        </p>
                    </div>
                @endif

                <label class="form-label" for="image">Upload Image</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >
                <small class="text-muted">
                    JPG, PNG or WebP. Maximum size: 5 MB.
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Price & Stock</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="price">
                        Price (GH₵)
                    </label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('price', $product?->price) }}"
                    >
                </div>

                <input type="hidden" name="is_price_visible" value="0">
                <div class="form-check form-switch mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="is_price_visible"
                        name="is_price_visible"
                        value="1"
                        @checked(old('is_price_visible', $product?->is_price_visible ?? true))
                    >
                    <label class="form-check-label" for="is_price_visible">
                        Display price publicly
                    </label>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label" for="stock_quantity">
                        Stock Quantity
                    </label>
                    <input
                        type="number"
                        id="stock_quantity"
                        name="stock_quantity"
                        class="form-control"
                        min="0"
                        step="1"
                        required
                        value="{{ old('stock_quantity', $product?->stock_quantity ?? 0) }}"
                    >
                </div>

                <input type="hidden" name="is_available" value="0">
                <div class="form-check form-switch mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="is_available"
                        name="is_available"
                        value="1"
                        @checked(old('is_available', $product?->is_available ?? true))
                    >
                    <label class="form-check-label" for="is_available">
                        Mark as available
                    </label>
                </div>
                <small class="text-muted">
                    A quantity of zero will be displayed as out of stock.
                </small>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Publication</h5>
            </div>

            <div class="card-body">
                <input type="hidden" name="is_published" value="0">
                <div class="form-check form-switch mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="is_published"
                        name="is_published"
                        value="1"
                        @checked(old('is_published', $product?->is_published ?? false))
                    >
                    <label class="form-check-label" for="is_published">
                        Publish product
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="display_order">
                        Display Order
                    </label>
                    <input
                        type="number"
                        id="display_order"
                        name="display_order"
                        class="form-control"
                        min="0"
                        value="{{ old('display_order', $product?->display_order ?? 0) }}"
                        required
                    >
                    <small class="text-muted">
                        Lower numbers appear first.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>{{ $buttonText ?? 'Save Product' }}
    </button>

    <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-secondary">
        Cancel
    </a>
</div>
