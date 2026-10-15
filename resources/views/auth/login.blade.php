<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>EES-Tech | Admin Login</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            min-height: 100vh;
            background:
                linear-gradient(
                    135deg,
                    #0f172a 0%,
                    #1e293b 50%,
                    #0f172a 100%
                );
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .login-header {
            padding: 35px 30px 25px;
            text-align: center;
            background: #ffffff;
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            color: #ffffff;
            font-size: 28px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #0f172a;
        }

        .brand-subtitle {
            color: #64748b;
            margin-bottom: 0;
        }

        .login-body {
            padding: 30px;
            background: #ffffff;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .input-group-text {
            background: #f8fafc;
            border-right: none;
            color: #64748b;
        }

        .form-control {
            border-left: none;
            padding: 12px 14px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group:focus-within .input-group-text {
            border-color: #86b7fe;
        }

        .login-button {
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
        }

        .login-footer {
            background: #f8fafc;
            padding: 18px 30px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }

    </style>

</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- HEADER -->
        <div class="login-header">

            <div class="brand-icon">
                <i class="fa-solid fa-building"></i>
            </div>

            <div class="brand-title">
                EES-Tech
            </div>

            <p class="brand-subtitle">
                Management System
            </p>

        </div>


        <!-- LOGIN BODY -->
        <div class="login-body">

            <h4 class="fw-bold mb-1">
                Welcome Back
            </h4>

            <p class="text-muted mb-4">
                Sign in to access the administration system.
            </p>


            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check me-2"></i>

                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROR MESSAGE -->
            @if($errors->any())

                <div class="alert alert-danger">

                    <i class="fa-solid fa-circle-exclamation me-2"></i>

                    {{ $errors->first() }}

                </div>

            @endif


            <!-- LOGIN FORM -->
            <form
                method="POST"
                action="{{ route('login.authenticate') }}"
            >

                @csrf


                <!-- EMAIL -->
                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label"
                    >
                        <!-- Email Address -->
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fa-solid fa-envelope"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="admin@ees-tech.com"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                <!-- PASSWORD -->
                <div class="mb-3">

                    <label
                        for="password"
                        class="form-label"
                    >
                        <!-- Password -->
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                    </div>

                </div>


                <!-- REMEMBER ME -->
                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        value="1"
                        id="remember"
                    >

                    <label
                        class="form-check-label"
                        for="remember"
                    >
                        Remember me
                    </label>

                </div>


                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="btn btn-dark w-100 login-button"
                >

                    <i class="fa-solid fa-right-to-bracket me-2"></i>

                    Sign In

                </button>

            </form>

        </div>


        <!-- FOOTER -->
        <div class="login-footer">

            &copy; {{ date('Y') }} EES-Tech.
            All rights reserved.

        </div>

    </div>

</div>

</body>

</html>