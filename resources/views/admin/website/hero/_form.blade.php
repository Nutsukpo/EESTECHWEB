@csrf

<div class="row g-4">

    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Badge
        </label>

        <input
            type="text"
            name="badge"
            class="form-control"
            value="{{ old('badge', $heroSlide->badge ?? '') }}"
            placeholder="Your Trusted IT Solutions Partner"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Display Order
        </label>

        <input
            type="number"
            name="display_order"
            class="form-control"
            min="0"
            value="{{ old('display_order', $heroSlide->display_order ?? 0) }}"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Main Title
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="title"
            class="form-control"
            value="{{ old('title', $heroSlide->title ?? '') }}"
            placeholder="Technology that helps your"
            required
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Highlighted Title
        </label>

        <input
            type="text"
            name="highlight"
            class="form-control"
            value="{{ old('highlight', $heroSlide->highlight ?? '') }}"
            placeholder="business move forward."
        >

    </div>


    <div class="col-12">

        <label class="form-label fw-semibold">
            Description
        </label>

        <textarea
            name="description"
            rows="4"
            class="form-control"
        >{{ old('description', $heroSlide->description ?? '') }}</textarea>

    </div>


    <div class="col-12">

        <label class="form-label fw-semibold">
            Hero Image
            @if(!isset($heroSlide))
                <span class="text-danger">*</span>
            @endif
        </label>

        <input
            type="file"
            name="image"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp"
            {{ isset($heroSlide) ? '' : 'required' }}
        >

        <small class="text-muted">
            Recommended: high-resolution landscape image.
        </small>


        @if(isset($heroSlide) && $heroSlide->image)

            <div class="mt-3">

                <img
                    src="{{ asset('storage/' . $heroSlide->image) }}"
                    style="width:300px;height:160px;object-fit:cover;border-radius:10px;"
                    alt=""
                >

            </div>

        @endif

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Primary Button Text
        </label>

        <input
            type="text"
            name="primary_button_text"
            class="form-control"
            value="{{ old('primary_button_text', $heroSlide->primary_button_text ?? '') }}"
            placeholder="Explore Our Services"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Primary Button URL
        </label>

        <input
            type="text"
            name="primary_button_url"
            class="form-control"
            value="{{ old('primary_button_url', $heroSlide->primary_button_url ?? '') }}"
            placeholder="#services"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Secondary Button Text
        </label>

        <input
            type="text"
            name="secondary_button_text"
            class="form-control"
            value="{{ old('secondary_button_text', $heroSlide->secondary_button_text ?? '') }}"
            placeholder="Meet Our Team"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Secondary Button URL
        </label>

        <input
            type="text"
            name="secondary_button_url"
            class="form-control"
            value="{{ old('secondary_button_url', $heroSlide->secondary_button_url ?? '') }}"
            placeholder="#team"
        >

    </div>


    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Slide Duration
        </label>

        <select
            name="duration"
            class="form-select"
        >

            <option
                value="3000"
                @selected(old('duration', $heroSlide->duration ?? 5000) == 3000)
            >
                3 seconds
            </option>

            <option
                value="5000"
                @selected(old('duration', $heroSlide->duration ?? 5000) == 5000)
            >
                5 seconds
            </option>

            <option
                value="7000"
                @selected(old('duration', $heroSlide->duration ?? 5000) == 7000)
            >
                7 seconds
            </option>

            <option
                value="10000"
                @selected(old('duration', $heroSlide->duration ?? 5000) == 10000)
            >
                10 seconds
            </option>

        </select>

    </div>


    <div class="col-md-6 d-flex align-items-end">

        <div class="form-check form-switch mb-2">

            <input
                type="checkbox"
                name="is_active"
                value="1"
                class="form-check-input"
                id="is_active"
                @checked(old('is_active', $heroSlide->is_active ?? true))
            >

            <label
                class="form-check-label fw-semibold"
                for="is_active"
            >
                Active Slide
            </label>

        </div>

    </div>

</div>