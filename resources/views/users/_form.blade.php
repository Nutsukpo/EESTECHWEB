@csrf

@if(isset($user))
    @method('PUT')
@endif


<div class="row g-4">

    {{-- Basic Information --}}

    <div class="col-12">

        <h5 class="fw-bold mb-1">
            Basic Information
        </h5>

        <p class="text-muted small">
            Enter the user's personal and contact information.
        </p>

    </div>


    {{-- Name --}}

    <div class="col-md-6">

        <label class="form-label">
            Full Name
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name ?? '') }}"
            placeholder="Enter full name"
            required
        >

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Email --}}

    <div class="col-md-6">

        <label class="form-label">
            Email Address
            <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email ?? '') }}"
            placeholder="user@ees-tech.com"
            required
        >

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Phone --}}

    <div class="col-md-6">

        <label class="form-label">
            Phone Number
        </label>

        <input
            type="text"
            name="phone"
            class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $user->phone ?? '') }}"
            placeholder="e.g. 024 XXX XXXX"
        >

        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Department --}}

    <div class="col-md-6">

        <label class="form-label">
            Department
        </label>

        <select
            name="department_id"
            class="form-select @error('department_id') is-invalid @enderror"
        >

            <option value="">
                Select Department
            </option>

            @foreach($departments as $department)

                <option
                    value="{{ $department->id }}"
                    @selected(
                        old(
                            'department_id',
                            $user->department_id ?? ''
                        ) == $department->id
                    )
                >

                    {{ $department->name }}

                    @if($department->code)
                        ({{ $department->code }})
                    @endif

                </option>

            @endforeach

        </select>

        @error('department_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Access Information --}}

    <div class="col-12 mt-4">

        <hr>

        <h5 class="fw-bold mb-1">
            Access & Permissions
        </h5>

        <p class="text-muted small">
            Configure the user's role and account status.
        </p>

    </div>


    {{-- Role --}}

    <div class="col-md-6">

        <label class="form-label">
            Role
            <span class="text-danger">*</span>
        </label>

        <select
            name="role"
            class="form-select @error('role') is-invalid @enderror"
            required
        >

            <option value="">
                Select Role
            </option>

            @foreach($roles as $role)

                <option
                    value="{{ $role->name }}"
                    @selected(
                        old(
                            'role',
                            isset($user)
                                ? $user->roles->first()?->name
                                : ''
                        ) === $role->name
                    )
                >

                    {{ $role->name }}

                </option>

            @endforeach

        </select>

        @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Status --}}

    <div class="col-md-6">

        <label class="form-label">
            Account Status
            <span class="text-danger">*</span>
        </label>

        <select
            name="status"
            class="form-select @error('status') is-invalid @enderror"
            required
        >

            <option
                value="active"
                @selected(
                    old(
                        'status',
                        $user->status ?? 'active'
                    ) === 'active'
                )
            >
                Active
            </option>

            <option
                value="inactive"
                @selected(
                    old(
                        'status',
                        $user->status ?? ''
                    ) === 'inactive'
                )
            >
                Inactive
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Password --}}

    <div class="col-md-6">

        <label class="form-label">

            Password

            @if(isset($user))
                <span class="text-muted">
                    (leave blank to keep current password)
                </span>
            @else
                <span class="text-danger">*</span>
            @endif

        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Minimum 8 characters"
            {{ isset($user) ? '' : 'required' }}
        >

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Confirm Password --}}

    <div class="col-md-6">

        <label class="form-label">

            Confirm Password

            @if(!isset($user))
                <span class="text-danger">*</span>
            @endif

        </label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Repeat password"
            {{ isset($user) ? '' : 'required' }}
        >

    </div>


    {{-- Profile Photo --}}

    <div class="col-md-6">

        <label class="form-label">
            Profile Photo
        </label>

        <input
            type="file"
            name="profile_photo"
            class="form-control @error('profile_photo') is-invalid @enderror"
            accept=".jpg,.jpeg,.png,.webp"
        >

        @error('profile_photo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @if(isset($user) && $user->profile_photo)

            <div class="mt-3">

                <img
                    src="{{ asset('storage/' . $user->profile_photo) }}"
                    alt="{{ $user->name }}"
                    width="80"
                    height="80"
                    class="rounded-circle"
                    style="object-fit:cover;"
                >

            </div>

        @endif

    </div>


    {{-- Submit --}}

    <div class="col-12 mt-4">

        <hr>

        <div class="d-flex justify-content-between">

            <a
                href="{{ route('users.index') }}"
                class="btn btn-light border"
            >

                <i class="fa-solid fa-arrow-left me-2"></i>

                Cancel

            </a>


            <button
                type="submit"
                class="btn btn-dark px-4"
            >

                <i class="fa-solid fa-floppy-disk me-2"></i>

                {{ isset($user) ? 'Update User' : 'Create User' }}

            </button>

        </div>

    </div>

</div>