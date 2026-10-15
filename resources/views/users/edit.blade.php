@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Edit User
        </h3>

        <p class="text-muted mb-0">
            Update {{ $user->name }}'s account information and access.
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please correct the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('users.update', $user) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @include('users._form')

            </form>

        </div>

    </div>

</div>

@endsection