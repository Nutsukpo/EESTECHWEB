@csrf

@if(isset($department))
    @method('PUT')
@endif

<div class="row g-4">

    {{-- Department Name --}}
    <div class="col-md-8">
        <label for="name" class="form-label">
            Department Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $department->name ?? '') }}"
            placeholder="e.g. Information Technology"
            required
        >

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    {{-- Department Code --}}
    <div class="col-md-4">
        <label for="code" class="form-label">
            Department Code
        </label>

        <input
            type="text"
            name="code"
            id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $department->code ?? '') }}"
            placeholder="e.g. IT"
            maxlength="50"
        >

        @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Optional short code for the department.
        </div>
    </div>


    {{-- Description --}}
    <div class="col-12">
        <label for="description" class="form-label">
            Description
        </label>

        <textarea
            name="description"
            id="description"
            rows="5"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Enter a brief description of this department..."
        >{{ old('description', $department->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    {{-- Status --}}
    <div class="col-md-4">
        <label for="status" class="form-label">
            Status <span class="text-danger">*</span>
        </label>

        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
            required
        >
            <option value="active"
                {{ old('status', $department->status ?? 'active') === 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="inactive"
                {{ old('status', $department->status ?? '') === 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>
        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

</div>


<div class="d-flex justify-content-end gap-2 mt-4">

    <a
        href="{{ route('departments.index') }}"
        class="btn btn-light border"
    >
        <i class="fas fa-arrow-left me-1"></i>
        Cancel
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i>

        {{ isset($department) ? 'Update Department' : 'Create Department' }}
    </button>

</div>