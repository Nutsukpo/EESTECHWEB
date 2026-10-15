@csrf

<div class="row g-4">

    {{-- PERSONAL INFORMATION --}}

    <div class="col-12">

        <h5 class="fw-bold border-bottom pb-2">
            <i class="fa-solid fa-user me-2"></i>
            Personal Information
        </h5>

    </div>


    <div class="col-md-4">

        <label class="form-label">
            First Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="first_name"
            class="form-control"
            value="{{ old('first_name', $staff->first_name ?? '') }}"
            required
        >

        @error('first_name')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    <div class="col-md-4">

        <label class="form-label">
            Last Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="last_name"
            class="form-control"
            value="{{ old('last_name', $staff->last_name ?? '') }}"
            required
        >

        @error('last_name')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    <div class="col-md-4">

        <label class="form-label">
            Other Name
        </label>

        <input
            type="text"
            name="other_name"
            class="form-control"
            value="{{ old('other_name', $staff->other_name ?? '') }}"
        >

    </div>


    <div class="col-md-4">

        <label class="form-label">
            Gender
        </label>

        <select
            name="gender"
            class="form-select"
        >

            <option value="">
                Select Gender
            </option>

            <option
                value="Male"
                @selected(old('gender', $staff->gender ?? '') === 'Male')
            >
                Male
            </option>

            <option
                value="Female"
                @selected(old('gender', $staff->gender ?? '') === 'Female')
            >
                Female
            </option>

            <option
                value="Other"
                @selected(old('gender', $staff->gender ?? '') === 'Other')
            >
                Other
            </option>

        </select>

    </div>


    <div class="col-md-4">

        <label class="form-label">
            Date of Birth
        </label>

        <input
            type="date"
            name="date_of_birth"
            class="form-control"
            value="{{ old('date_of_birth', isset($staff->date_of_birth) ? $staff->date_of_birth->format('Y-m-d') : '') }}"
        >

    </div>


    <div class="col-md-4">

        <label class="form-label">
            Profile Photo
        </label>

        <input
            type="file"
            name="profile_photo"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp"
        >

    </div>


    <div class="col-12">

        <label class="form-label">
            Address
        </label>

        <textarea
            name="address"
            rows="3"
            class="form-control"
            placeholder="Residential address"
        >{{ old('address', $staff->address ?? '') }}</textarea>

    </div>


    {{-- CONTACT --}}

    <div class="col-12 mt-4">

        <h5 class="fw-bold border-bottom pb-2">
            <i class="fa-solid fa-address-book me-2"></i>
            Contact Information
        </h5>

    </div>


    <div class="col-md-6">

        <label class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email', $staff->email ?? '') }}"
            required
        >

    </div>


    <div class="col-md-6">

        <label class="form-label">
            Phone
        </label>

        <input
            type="text"
            name="phone"
            class="form-control"
            value="{{ old('phone', $staff->phone ?? '') }}"
        >

    </div>


    {{-- EMPLOYMENT --}}

    <div class="col-12 mt-4">

        <h5 class="fw-bold border-bottom pb-2">
            <i class="fa-solid fa-briefcase me-2"></i>
            Employment Information
        </h5>

    </div>


    <div class="col-md-6">

        <label class="form-label">
            Department
        </label>

        <select
            name="department_id"
            class="form-select"
        >

            <option value="">
                Select Department
            </option>

            @foreach($departments as $department)

                <option
                    value="{{ $department->id }}"
                    @selected(old('department_id', $staff->department_id ?? '') == $department->id)
                >
                    {{ $department->name }}
                </option>

            @endforeach

        </select>

    </div>


    <div class="col-md-6">

        <label class="form-label">
            Position <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="position"
            class="form-control"
            value="{{ old('position', $staff->position ?? '') }}"
            placeholder="e.g. Software Developer"
            required
        >

    </div>


    <div class="col-md-6">

        <label class="form-label">
            Salary
        </label>

        <div class="input-group">

            <span class="input-group-text">
                GHS
            </span>

            <input
                type="number"
                name="salary"
                class="form-control"
                value="{{ old('salary', $staff->salary ?? '') }}"
                min="0"
                step="0.01"
            >

        </div>

    </div>


    <div class="col-md-3">

        <label class="form-label">
            Employment Date
        </label>

        <input
            type="date"
            name="employment_date"
            class="form-control"
            value="{{ old('employment_date', isset($staff->employment_date) ? $staff->employment_date->format('Y-m-d') : '') }}"
        >

    </div>


    <div class="col-md-3">

        <label class="form-label">
            Status
        </label>

        <select
            name="status"
            class="form-select"
        >

            <option
                value="active"
                @selected(old('status', $staff->status ?? 'active') === 'active')
            >
                Active
            </option>

            <option
                value="inactive"
                @selected(old('status', $staff->status ?? '') === 'inactive')
            >
                Inactive
            </option>

        </select>

    </div>

</div>