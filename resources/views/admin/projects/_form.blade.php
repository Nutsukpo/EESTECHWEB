@php
    $project = $project ?? null;
    $existingImage = $project?->cover_image;
    $technologiesValue = is_array($project?->technologies)
        ? implode(', ', $project->technologies)
        : '';
@endphp

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Project Information</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Project Title <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $project?->title) }}"
                        placeholder="e.g. School Management System"
                        required
                        maxlength="255"
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <input
                            type="text"
                            name="category"
                            id="category"
                            class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category', $project?->category) }}"
                            placeholder="e.g. Web Development"
                            maxlength="150"
                        >
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="client_name" class="form-label">Client / Organisation</label>
                        <input
                            type="text"
                            name="client_name"
                            id="client_name"
                            class="form-control @error('client_name') is-invalid @enderror"
                            value="{{ old('client_name', $project?->client_name) }}"
                            placeholder="Client name"
                            maxlength="255"
                        >
                        @error('client_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <label for="short_description" class="form-label">
                        Short Description
                    </label>
                    <textarea
                        name="short_description"
                        id="short_description"
                        rows="3"
                        maxlength="500"
                        class="form-control @error('short_description') is-invalid @enderror"
                        placeholder="A brief summary shown on the public projects page."
                    >{{ old('short_description', $project?->short_description) }}</textarea>
                    <div class="form-text">Maximum 500 characters.</div>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Full Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Describe the project, its purpose and scope."
                    >{{ old('description', $project?->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="challenge" class="form-label">Challenge</label>
                    <textarea
                        name="challenge"
                        id="challenge"
                        rows="4"
                        class="form-control @error('challenge') is-invalid @enderror"
                        placeholder="What problem or challenge needed to be solved?"
                    >{{ old('challenge', $project?->challenge) }}</textarea>
                    @error('challenge')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="solution" class="form-label">Solution</label>
                    <textarea
                        name="solution"
                        id="solution"
                        rows="4"
                        class="form-control @error('solution') is-invalid @enderror"
                        placeholder="How did EES Technologies address the challenge?"
                    >{{ old('solution', $project?->solution) }}</textarea>
                    @error('solution')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="results" class="form-label">Results / Impact</label>
                    <textarea
                        name="results"
                        id="results"
                        rows="4"
                        class="form-control @error('results') is-invalid @enderror"
                        placeholder="Describe the outcome or benefits of the project."
                    >{{ old('results', $project?->results) }}</textarea>
                    @error('results')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="technologies" class="form-label">Technologies Used</label>
                    <input
                        type="text"
                        name="technologies"
                        id="technologies"
                        class="form-control @error('technologies') is-invalid @enderror"
                        value="{{ old('technologies', $technologiesValue) }}"
                        placeholder="Laravel, PHP, MySQL, Bootstrap"
                    >
                    <div class="form-text">
                        Separate technologies with commas.
                    </div>
                    @error('technologies')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Cover Image</h5>
            </div>

            <div class="card-body">
                <div
                    id="imagePreviewContainer"
                    class="mb-3 {{ $existingImage ? '' : 'd-none' }}"
                >
                    <img
                        id="imagePreview"
                        src="{{ $existingImage ? asset('storage/' . $existingImage) : '' }}"
                        alt="Project cover preview"
                        class="img-fluid rounded border w-100"
                        style="max-height: 240px; object-fit: cover;"
                    >
                </div>

                <label for="cover_image" class="form-label">Upload Image</label>
                <input
                    type="file"
                    name="cover_image"
                    id="cover_image"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="form-control @error('cover_image') is-invalid @enderror"
                >
                <div class="form-text">
                    JPG, PNG or WebP. Maximum size: 4 MB.
                </div>
                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($existingImage)
                    <div class="small text-muted mt-2">
                        Leave this field empty to keep the current image.
                    </div>
                @endif
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Project Settings</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="project_url" class="form-label">Project Website URL</label>
                    <input
                        type="url"
                        name="project_url"
                        id="project_url"
                        class="form-control @error('project_url') is-invalid @enderror"
                        value="{{ old('project_url', $project?->project_url) }}"
                        placeholder="https://example.com"
                    >
                    @error('project_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="display_order" class="form-label">Display Order</label>
                    <input
                        type="number"
                        name="display_order"
                        id="display_order"
                        min="0"
                        max="1000000"
                        class="form-control @error('display_order') is-invalid @enderror"
                        value="{{ old('display_order', $project?->display_order ?? 0) }}"
                        required
                    >
                    <div class="form-text">Lower numbers appear first.</div>
                    @error('display_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <input type="hidden" name="is_featured" value="0">
                <div class="form-check form-switch mb-3">
                    <input
                        type="checkbox"
                        name="is_featured"
                        id="is_featured"
                        value="1"
                        class="form-check-input"
                        @checked((bool) old('is_featured', $project?->is_featured ?? false))
                    >
                    <label class="form-check-label" for="is_featured">
                        <strong>Featured Project</strong>
                    </label>
                    <div class="form-text">
                        Highlight this project on the website.
                    </div>
                </div>

                <input type="hidden" name="is_published" value="0">
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="is_published"
                        id="is_published"
                        value="1"
                        class="form-check-input"
                        @checked((bool) old('is_published', $project?->is_published ?? false))
                    >
                    <label class="form-check-label" for="is_published">
                        <strong>Publish Project</strong>
                    </label>
                    <div class="form-text">
                        Published projects can appear on the public website once their publication date is reached.
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>{{ $submitLabel ?? 'Save Project' }}
            </button>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                Cancel
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('cover_image');
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('imagePreviewContainer');

    if (!input || !preview || !container) return;

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            this.value = '';
            return;
        }

        preview.src = URL.createObjectURL(file);
        container.classList.remove('d-none');
    });
});
</script>
@endpush
