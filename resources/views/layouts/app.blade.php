<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | EES-Tech Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Names kept so existing admin pages keep working. */
            --ees-primary: #061b3d;
            --ees-secondary: #0a2a5c;
            --ees-accent: #0878d1;
            --ees-accent-light: #e7f2fc;
            --ees-light: #f6f8fb;
            --ees-border: #e3e9f1;
            --ees-text: #14233a;
            --ees-muted: #637389;
            --ees-success: #16a34a;
            --ees-danger: #dc2626;

            --ees-gold: #e9b13a;
            --ees-sidebar-width: 268px;
            --ees-ease: cubic-bezier(.22, 1, .36, 1);
            --ees-font-display: 'Bricolage Grotesque', 'Figtree', system-ui, sans-serif;
            --ees-font-body: 'Figtree', system-ui, -apple-system, 'Segoe UI', sans-serif;

            /* Align Bootstrap's primary colour with the brand. */
            --bs-primary: #0878d1;
            --bs-primary-rgb: 8, 120, 209;
            --bs-link-color: #0878d1;
            --bs-link-color-rgb: 8, 120, 209;
            --bs-link-hover-color: #061b3d;
            --bs-body-font-family: var(--ees-font-body);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--ees-text);
            background: #f4f7fb;
            font-family: var(--ees-font-body);
            -webkit-font-smoothing: antialiased;
        }

        body.ees-sidebar-open { overflow: hidden; }

        a { text-decoration: none; }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--ees-gold);
            outline-offset: 2px;
        }

        .btn-primary {
            --bs-btn-bg: #0878d1;
            --bs-btn-border-color: #0878d1;
            --bs-btn-hover-bg: #061b3d;
            --bs-btn-hover-border-color: #061b3d;
            --bs-btn-active-bg: #061b3d;
            --bs-btn-active-border-color: #061b3d;
            --bs-btn-disabled-bg: #0878d1;
            --bs-btn-disabled-border-color: #0878d1;
        }

        .btn-outline-primary {
            --bs-btn-color: #0878d1;
            --bs-btn-border-color: #0878d1;
            --bs-btn-hover-bg: #0878d1;
            --bs-btn-hover-border-color: #0878d1;
            --bs-btn-active-bg: #0878d1;
            --bs-btn-active-border-color: #0878d1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0878d1;
            box-shadow: 0 0 0 .2rem rgba(8, 120, 209, .15);
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */
        .ees-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            width: var(--ees-sidebar-width);
            display: flex;
            flex-direction: column;
            color: #fff;
            background:
                radial-gradient(circle at 0% 0%, rgba(8, 120, 209, .28), transparent 42%),
                linear-gradient(180deg, #061b3d 0%, #041229 100%);
            overflow-y: auto;
            transition: transform .35s var(--ees-ease);
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .16) transparent;
        }

        .ees-sidebar::-webkit-scrollbar { width: 5px; }
        .ees-sidebar::-webkit-scrollbar-track { background: transparent; }
        .ees-sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, .16); border-radius: 10px; }

        /* Brand */
        .ees-brand {
            flex-shrink: 0;
            height: 76px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .ees-brand-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #061b3d;
            background: var(--ees-gold);
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(233, 177, 58, .25);
            transition: transform .4s var(--ees-ease);
        }

        .ees-brand:hover .ees-brand-icon { transform: rotate(-8deg) scale(1.06); }

        .ees-brand-icon i { font-size: 17px; }

        .ees-brand-text {
            font-family: var(--ees-font-display);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.02em;
            line-height: 1.1;
        }

        .ees-brand-subtitle {
            display: block;
            margin-top: 3px;
            color: rgba(255, 255, 255, .55);
            font-family: var(--ees-font-body);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .02em;
        }

        /* Navigation */
        .ees-sidebar-body { flex: 1; padding-bottom: 24px; }

        .ees-sidebar-section {
            padding: 24px 24px 8px;
            color: rgba(255, 255, 255, .42);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
        }

        .ees-nav { padding: 0 12px; }

        .ees-nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3px;
            padding: 11px 14px;
            color: rgba(255, 255, 255, .74);
            border-radius: 12px;
            font-size: 14.5px;
            font-weight: 500;
            transition: background-color .25s ease, color .25s ease, transform .3s var(--ees-ease);
        }

        .ees-nav-link i {
            width: 20px;
            flex-shrink: 0;
            text-align: center;
            font-size: 15px;
            transition: color .25s ease, transform .3s var(--ees-ease);
        }

        .ees-nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .08);
            transform: translateX(3px);
        }

        .ees-nav-link:hover i { transform: scale(1.12); }

        .ees-nav-link.active {
            color: #fff;
            font-weight: 600;
            background: linear-gradient(135deg, rgba(8, 120, 209, .95), rgba(8, 120, 209, .7));
            box-shadow: 0 8px 22px rgba(8, 120, 209, .3);
        }

        .ees-nav-link.active::before {
            content: "";
            position: absolute;
            left: -12px;
            top: 10px;
            bottom: 10px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: var(--ees-gold);
        }

        .ees-nav-link.active i { color: var(--ees-gold); }

        .ees-nav-link .ees-ext {
            margin-left: auto;
            width: auto;
            font-size: 11px;
            opacity: .55;
        }

        /* =========================================================
           MAIN
        ========================================================= */
        .ees-main {
            min-height: 100vh;
            margin-left: var(--ees-sidebar-width);
            transition: margin-left .35s var(--ees-ease);
        }

        /* Topbar */
        .ees-topbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            background: rgba(255, 255, 255, .88);
            border-bottom: 1px solid var(--ees-border);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .ees-page-title {
            margin: 0;
            color: var(--ees-primary);
            font-family: var(--ees-font-display);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .ees-topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ees-site-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            color: var(--ees-primary);
            background: #fff;
            border: 1px solid var(--ees-border);
            border-radius: 999px;
            font-size: 13.5px;
            font-weight: 600;
            transition: color .25s ease, background-color .25s ease, border-color .25s ease, transform .3s var(--ees-ease);
        }

        .ees-site-link:hover {
            color: #fff;
            background: var(--ees-primary);
            border-color: var(--ees-primary);
            transform: translateY(-1px);
        }

        .ees-mobile-toggle {
            display: none;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            color: var(--ees-primary);
            background: #fff;
            border: 1px solid var(--ees-border);
            border-radius: 12px;
            font-size: 17px;
            transition: background-color .25s ease, color .25s ease;
        }

        .ees-mobile-toggle:hover { color: #fff; background: var(--ees-accent); border-color: var(--ees-accent); }

        /* User menu */
        .ees-user-button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 5px 6px;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 999px;
            transition: background-color .25s ease, border-color .25s ease;
        }

        .ees-user-button:hover,
        .ees-user-button.show { background: #fff; border-color: var(--ees-border); }

        .ees-user-button:focus { box-shadow: none; }
        .ees-user-button::after { margin-left: 2px; color: var(--ees-muted); }

        .ees-avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, #0878d1, #061b3d);
            border-radius: 50%;
            font-weight: 700;
            object-fit: cover;
        }

        .ees-user-name {
            color: var(--ees-primary);
            font-size: 13.5px;
            font-weight: 700;
            line-height: 1.25;
            text-align: left;
        }

        .ees-user-role {
            display: block;
            margin-top: 1px;
            color: var(--ees-muted);
            font-size: 12px;
            font-weight: 500;
        }

        .ees-main .dropdown-menu {
            min-width: 250px;
            padding: 8px;
            border: 1px solid var(--ees-border);
            border-radius: 16px;
            box-shadow: 0 24px 60px -14px rgba(6, 27, 61, .25);
        }

        .ees-main .dropdown-item {
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: background-color .2s ease, color .2s ease;
        }

        .ees-main .dropdown-item:hover { background: var(--ees-light); }
        .ees-main .dropdown-item.text-danger:hover { background: #fef2f2; }
        .ees-main .dropdown-item-text { padding: 8px 12px; }

        /* =========================================================
           CONTENT
        ========================================================= */
        .ees-content {
            padding: 32px;
            animation: eesFadeIn .45s var(--ees-ease);
        }

        .ees-card {
            background: #fff;
            border: 1px solid var(--ees-border);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(6, 27, 61, .04);
        }

        .ees-alert {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(6, 27, 61, .06);
        }

        @keyframes eesFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* =========================================================
           MOBILE
        ========================================================= */
        .ees-sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 1035;
            background: rgba(4, 18, 41, .55);
            backdrop-filter: blur(2px);
            opacity: 0;
            visibility: hidden;
            transition: opacity .3s ease, visibility .3s ease;
        }

        .ees-sidebar-overlay.show { opacity: 1; visibility: visible; }

        @media (max-width: 991.98px) {
            .ees-sidebar { transform: translateX(-100%); box-shadow: none; }
            .ees-sidebar.show { transform: translateX(0); box-shadow: 0 0 60px rgba(0, 0, 0, .35); }

            .ees-main { margin-left: 0; }

            .ees-mobile-toggle { display: inline-flex; }
            .ees-topbar { padding: 0 18px; }
            .ees-content { padding: 22px 18px; }
            .ees-user-details { display: none; }
            .ees-site-link span { display: none; }
            .ees-site-link { padding: 9px 12px; }
        }

        @media (max-width: 575.98px) {
            .ees-topbar { height: 68px; }
            .ees-page-title { font-size: 18px; }
            .ees-content { padding: 16px 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }

            *, *::before, *::after {
                animation-duration: .001ms !important;
                transition-duration: .001ms !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Sidebar overlay (mobile) -->
    <div class="ees-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->
    <aside class="ees-sidebar" id="eesSidebar" aria-label="Admin navigation">

        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="ees-brand" aria-label="EES-Tech dashboard">
            <span class="ees-brand-icon"><i class="fa-solid fa-bolt"></i></span>

            <span class="ees-brand-text">
                EES-Tech
                <span class="ees-brand-subtitle">Management System</span>
            </span>
        </a>

        <div class="ees-sidebar-body">

            <!-- MAIN -->
            <div class="ees-sidebar-section">Main</div>

            <nav class="ees-nav">
                <a href="{{ route('dashboard') }}"
                   class="ees-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    Dashboard
                </a>
            </nav>


            <!-- MANAGEMENT -->
            @canany(['view users', 'view departments', 'view staff'])
                <div class="ees-sidebar-section">Management</div>

                <nav class="ees-nav">

                    @can('view users')
                        <a href="{{ route('users.index') }}"
                           class="ees-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            Users
                        </a>
                    @endcan

                    @can('view departments')
                        <a href="{{ route('departments.index') }}"
                           class="ees-nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building"></i>
                            Departments
                        </a>
                    @endcan

                    @can('view staff')
                        <a href="{{ route('staff.index') }}"
                           class="ees-nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-tie"></i>
                            Staff
                        </a>
                    @endcan

                    <a href="{{ route('admin.sales.index') }}"
                       class="ees-nav-link {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-images"></i>
                        Sales Management
                    </a>

                </nav>
            @endcanany


            <!-- WEBSITE CONTENT -->
            @can('view staff')
                <div class="ees-sidebar-section">Website content</div>

                <nav class="ees-nav">

                    <a href="{{ route('admin.hero-slides.index') }}"
                       class="ees-nav-link {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-images"></i>
                        Hero Slides
                    </a>

                    <a href="{{ url('/admin/website/about') }}"
                       class="ees-nav-link {{ request()->is('admin/website/about*') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-info"></i>
                        About Us
                    </a>

                    <a href="{{ url('/admin/company-contacts') }}"
                       class="ees-nav-link {{ request()->is('admin/company-contacts*') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-book"></i>
                        Contact Us
                    </a>

                    <a href="{{ url('/admin/projects') }}"
                       class="ees-nav-link {{ request()->is('admin/projects*') ? 'active' : '' }}">
                        <i class="fa-solid fa-diagram-project"></i>
                        Our Projects
                    </a>

                    <a href="{{ url('/admin/website/team') }}"
                       class="ees-nav-link {{ request()->is('admin/website/team*') ? 'active' : '' }}">
                        <i class="fa-solid fa-people-group"></i>
                        Team Members
                    </a>

                </nav>
            @endcan


            <!-- REPORTS -->
            @can('view reports')
                <div class="ees-sidebar-section">Reports</div>

                <nav class="ees-nav">
                    <a href="#" class="ees-nav-link">
                        <i class="fa-solid fa-chart-column"></i>
                        Reports
                    </a>
                </nav>

                <nav class="ees-nav">
                    <a href="{{ route('admin.contact-enquiries.index') }}" class="ees-nav-link">
                        <i class="fa-solid fa-chart-column"></i>
                        Contact Enquiries
                    </a>
                </nav>
            @endcan


            <!-- SYSTEM -->
            @can('view settings')
                <div class="ees-sidebar-section">System</div>

                <nav class="ees-nav">
                    <a href="{{ url('/admin/website/settings') }}"
                       class="ees-nav-link {{ request()->is('admin/website/settings*') ? 'active' : '' }}">
                        <i class="fa-solid fa-gear"></i>
                        Settings
                    </a>
                </nav>
            @endcan


            <!-- PUBLIC WEBSITE -->
            <div class="ees-sidebar-section">Website</div>

            <nav class="ees-nav">
                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="ees-nav-link">
                    <i class="fa-solid fa-globe"></i>
                    View Website
                    <i class="fa-solid fa-arrow-up-right-from-square ees-ext"></i>
                </a>
            </nav>

        </div>

    </aside>


    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->
    <main class="ees-main">

        <!-- Topbar -->
        <header class="ees-topbar">

            <div class="d-flex align-items-center gap-3">

                <button class="ees-mobile-toggle"
                        type="button"
                        onclick="toggleSidebar()"
                        aria-label="Open navigation"
                        aria-controls="eesSidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1 class="ees-page-title">@yield('title', 'Dashboard')</h1>

            </div>


            <div class="ees-topbar-right">

                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="ees-site-link">
                    <i class="fa-solid fa-globe"></i>
                    <span>View website</span>
                </a>

                <!-- User dropdown -->
                <div class="dropdown">

                    <button class="ees-user-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                 class="ees-avatar"
                                 alt="{{ auth()->user()->name }}">
                        @else
                            <div class="ees-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="ees-user-details">
                            <div class="ees-user-name">
                                {{ auth()->user()->name }}
                                <span class="ees-user-role">
                                    {{ auth()->user()->getRoleNames()->first() ?? 'User' }}
                                </span>
                            </div>
                        </div>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <span class="dropdown-item-text">
                                <strong>{{ auth()->user()->name }}</strong>
                                <br>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </span>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-user me-2"></i>
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-gear me-2"></i>
                                Account Settings
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        {{-- IMPORTANT: admin.logout --}}
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>

                    </ul>

                </div>

            </div>

        </header>


        <!-- Page content -->
        <div class="ees-content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show ees-alert" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show ees-alert" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show ees-alert" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show ees-alert" role="alert">
                    <i class="fa-solid fa-circle-info me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show ees-alert" role="alert">
                    <div class="fw-semibold mb-2">
                        <i class="fa-solid fa-circle-exclamation me-2"></i>
                        Please correct the following errors:
                    </div>

                    <ul class="mb-0 ps-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')

        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const eesSidebar = () => document.getElementById('eesSidebar');
        const eesOverlay = () => document.getElementById('sidebarOverlay');

        function closeSidebar() {
            const sidebar = eesSidebar();
            const overlay = eesOverlay();

            if (sidebar) sidebar.classList.remove('show');
            if (overlay) overlay.classList.remove('show');

            document.body.classList.remove('ees-sidebar-open');
        }

        function toggleSidebar() {
            const sidebar = eesSidebar();
            const overlay = eesOverlay();

            if (!sidebar || !overlay) return;

            const open = sidebar.classList.toggle('show');
            overlay.classList.toggle('show', open);
            document.body.classList.toggle('ees-sidebar-open', open);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = eesSidebar();
            if (!sidebar) return;

            // Close the sidebar after choosing a link on mobile.
            sidebar.querySelectorAll('.ees-nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 991) closeSidebar();
                });
            });

            // Keep the active link visible in a long sidebar.
            const active = sidebar.querySelector('.ees-nav-link.active');
            if (active && typeof active.scrollIntoView === 'function') {
                active.scrollIntoView({ block: 'nearest' });
            }
        });

        // Close with the Escape key.
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeSidebar();
        });

        // Reset the mobile state when resizing to desktop.
        window.addEventListener('resize', function () {
            if (window.innerWidth > 991) closeSidebar();
        });
    </script>

    @stack('scripts')

</body>
</html>