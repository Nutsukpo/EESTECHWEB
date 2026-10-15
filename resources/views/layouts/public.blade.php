@php
    $siteSettings = $settings ?? null;

    $companyName = $companyName ?? ($siteSettings?->company_name ?? 'EES Technologies Ghana');
    $tagline = $tagline ?? ($siteSettings?->tagline ?? 'INNOVATE • INTEGRATE • ELEVATE');

    $companyDescription = $companyDescription
        ?? ($siteSettings?->description
        ?? 'EES Technologies Ghana provides innovative and reliable technology solutions that help organisations improve efficiency, strengthen security and accelerate digital transformation.');

    $email = $email ?? ($siteSettings?->email ?? 'info@eestechnologies.com');
    $phone = $phone ?? ($siteSettings?->phone ?? '+233 542 013 350');
    $address = $address ?? ($siteSettings?->address ?? 'Ghana');

    $linkedin = $linkedin ?? ($siteSettings?->linkedin_url ?? null);
    $facebook = $facebook ?? ($siteSettings?->facebook_url ?? null);
    $instagram = $instagram ?? ($siteSettings?->instagram_url ?? null);
    $twitter = $twitter ?? ($siteSettings?->twitter_url ?? null);

    $logoUrl = $logoUrl
        ?? ($siteSettings?->logo
            ? asset('storage/' . $siteSettings->logo)
            : asset('img/logo.png'));

    $phoneLink = preg_replace('/[^0-9+]/', '', (string) $phone);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'EES Technologies Ghana')</title>

    <meta name="description"
          content="@yield('meta_description', 'EES Technologies Ghana provides software development, cloud solutions, IT security, IT consulting and digital transformation services.')">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons: Font Awesome (page content) and Bootstrap Icons (navbar and footer) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- Bricolage Grotesque for headings and the wordmark, Figtree for body text --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #061b3d;
            --navy-2: #0a2a5c;
            --blue: #0878d1;
            --blue-soft: #e7f2fc;
            --gold: #e9b13a;
            --paper: #f6f8fb;
            --ink: #0d1b2e;
            --muted: #56637a;
            --line: #dde4ee;
            --ease: cubic-bezier(.22, 1, .36, 1);

            --font-display: 'Bricolage Grotesque', 'Figtree', system-ui, sans-serif;
            --font-body: 'Figtree', system-ui, -apple-system, 'Segoe UI', sans-serif;

            /* Legacy names, kept so older page styles keep working. */
            --ees-navy: #061b3d;
            --ees-dark: #031b3f;
            --ees-blue: #0878d1;
            --ees-light-blue: #1e9cf0;
            --ees-light: #f6f8fb;
            --ees-text: #0d1b2e;
            --ees-muted: #56637a;
            --ees-border: #dde4ee;
            --ees-white: #fff;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; scroll-padding-top: 96px; }

        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background: #fff;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--gold);
            outline-offset: 3px;
        }

        main { min-height: 60vh; }

        /* =====================================================
           NAVBAR
        ===================================================== */
        .ees-navbar {
            padding: 14px 0;
            background: rgba(255, 255, 255, .94);
            border-bottom: 1px solid transparent;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            z-index: 1030;
            transition: padding .3s var(--ease), box-shadow .3s ease, border-color .3s ease;
        }

        .ees-navbar.scrolled {
            padding: 8px 0;
            border-bottom-color: var(--line);
            box-shadow: 0 10px 34px rgba(6, 27, 61, .08);
        }

        .ees-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0;
        }

        .ees-logo {
            width: 58px;
            height: 58px;
            display: block;
            flex-shrink: 0;
            object-fit: contain;
            transition: transform .4s var(--ease), width .3s ease, height .3s ease;
        }

        .ees-navbar.scrolled .ees-logo { width: 50px; height: 50px; }
        .ees-brand:hover .ees-logo { transform: scale(1.07) rotate(-3deg); }

        .ees-brand-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        }

        .ees-brand-name {
            display: block;
            color: var(--navy);
            font-family: var(--font-display);
            font-size: 1.32rem;
            font-weight: 800;
            letter-spacing: -.02em;
            line-height: 1.05;
            white-space: nowrap;
        }

        .ees-brand-tagline {
            display: block;
            margin-top: 5px;
            color: var(--blue);
            font-size: .56rem;
            font-weight: 700;
            letter-spacing: 1.8px;
            line-height: 1;
            white-space: nowrap;
        }

        .ees-navbar .navbar-nav .nav-link {
            position: relative;
            margin: 0 6px;
            padding: 10px 4px !important;
            color: var(--ink);
            font-size: .96rem;
            font-weight: 600;
            transition: color .25s ease;
        }

        .ees-navbar .navbar-nav .nav-link:not(.quote-btn)::after {
            content: "";
            position: absolute;
            left: 4px;
            right: 4px;
            bottom: 4px;
            height: 2px;
            border-radius: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: 0 50%;
            transition: transform .35s var(--ease);
        }

        .ees-navbar .navbar-nav .nav-link:hover,
        .ees-navbar .navbar-nav .nav-link.active { color: var(--blue); }

        .ees-navbar .navbar-nav .nav-link:not(.quote-btn):hover::after,
        .ees-navbar .navbar-nav .nav-link.active:not(.quote-btn)::after { transform: scaleX(1); }

        .ees-navbar .quote-btn {
            margin-left: 12px;
            padding: 12px 24px !important;
            color: #fff !important;
            background: var(--navy);
            border-radius: 999px;
            font-size: .92rem;
            transition: background-color .25s ease, color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
        }

        .ees-navbar .quote-btn:hover {
            color: var(--navy) !important;
            background: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(233, 177, 58, .3);
        }

        .ees-navbar .navbar-toggler {
            padding: 8px;
            border: 0;
            box-shadow: none !important;
        }

        .ees-navbar .navbar-toggler i { color: var(--navy); }

        /* ---------- Services dropdown ---------- */
        .services-dropdown > .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .services-dropdown > .dropdown-toggle::after { display: none; }

        .services-dropdown > .nav-link::before {
            content: "";
            order: 2;
            border-top: .32em solid currentColor;
            border-right: .28em solid transparent;
            border-left: .28em solid transparent;
            transition: transform .3s var(--ease);
        }

        .services-dropdown.show > .nav-link::before,
        .services-dropdown:hover > .nav-link::before { transform: rotate(180deg); }

        .services-dropdown .dropdown-menu {
            min-width: 280px;
            margin-top: 12px;
            padding: 10px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 60px -12px rgba(6, 27, 61, .25);
        }

        .services-dropdown .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 12px;
            color: var(--ink);
            font-size: .93rem;
            font-weight: 600;
            white-space: normal;
            transition: color .2s ease, background .2s ease, padding-left .25s var(--ease);
        }

        .services-dropdown .dropdown-item i {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--blue);
            background: var(--blue-soft);
            border-radius: 10px;
            font-size: .95rem;
            transition: color .2s ease, background .2s ease;
        }

        .services-dropdown .dropdown-item:hover,
        .services-dropdown .dropdown-item:focus {
            padding-left: 16px;
            color: var(--blue);
            background: var(--paper);
        }

        .services-dropdown .dropdown-item:hover i,
        .services-dropdown .dropdown-item:focus i { color: #fff; background: var(--blue); }

        .services-dropdown .dropdown-divider { margin: 8px 6px; border-color: var(--line); }

        @media (min-width: 992px) {
            /* Opens on hover and on keyboard focus; Bootstrap handles click and touch. */
            .services-dropdown .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transform: translateY(10px);
                transition: opacity .25s ease, transform .3s var(--ease), visibility .25s ease;
            }

            .services-dropdown:hover > .dropdown-menu,
            .services-dropdown:focus-within > .dropdown-menu,
            .services-dropdown.show > .dropdown-menu {
                opacity: 1;
                visibility: visible;
                transform: none;
            }
        }

        @media (max-width: 991.98px) {
            .ees-navbar .navbar-collapse { padding: 14px 0 8px; }

            .ees-navbar .navbar-nav .nav-link { margin: 2px 0; padding: 11px 4px !important; }
            .ees-navbar .navbar-nav .nav-link:not(.quote-btn)::after { display: none; }

            .ees-navbar .quote-btn {
                display: inline-flex;
                margin: 8px 0 0;
            }

            .services-dropdown { width: 100%; }

            .services-dropdown > .nav-link {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }

            .services-dropdown .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
                margin: 4px 0 8px;
                padding: 6px;
                border: 0;
                background: var(--paper);
                box-shadow: none;
            }
        }

        @media (max-width: 575.98px) {
            .ees-logo { width: 46px; height: 46px; }
            .ees-brand { gap: 12px; }
            .ees-brand-name { font-size: 1.05rem; }
            .ees-brand-tagline { font-size: .46rem; letter-spacing: 1.2px; }
        }

        /* =====================================================
           FOOTER
        ===================================================== */
        .ees-footer {
            padding: clamp(56px, 7vw, 88px) 0 28px;
            color: #fff;
            background: #041229;
        }

        .ees-footer-brand {
            color: #fff;
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .ees-footer p {
            margin: 0;
            color: #98a9be;
            line-height: 1.8;
        }

        .ees-footer-about { max-width: 42ch; margin-top: 16px !important; }

        .ees-footer h5 {
            margin: 0 0 22px;
            color: #fff;
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .ees-footer-links {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .ees-footer-links li { margin-bottom: 12px; }

        .ees-footer-links a {
            color: #98a9be;
            transition: color .25s ease, padding-left .3s var(--ease);
        }

        .ees-footer-links a:hover { color: #fff; padding-left: 8px; }

        .ees-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .ees-contact-item i {
            margin-top: 3px;
            color: var(--gold);
        }

        .ees-contact-item a,
        .ees-contact-item span {
            color: #cdd8e6;
            transition: color .25s ease;
        }

        .ees-contact-item a:hover { color: #fff; }

        .ees-socials {
            display: flex;
            gap: 8px;
            margin-top: 28px;
        }

        .ees-socials a {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: rgba(255, 255, 255, .08);
            border-radius: 50%;
            transition: background-color .25s ease, color .25s ease, transform .3s var(--ease);
        }

        .ees-socials a:hover {
            color: var(--navy);
            background: var(--gold);
            transform: translateY(-4px);
        }

        .ees-footer-bottom {
            margin-top: 52px;
            padding-top: 26px;
            color: #7d92aa;
            font-size: .92rem;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        /* =====================================================
           PAGE PRELOADER
        ===================================================== */
        html.ees-preloading,
        body.ees-loading { overflow: hidden !important; }

        .ees-preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(circle at 50% 38%, rgba(30, 156, 240, .16), transparent 34%),
                linear-gradient(145deg, #03152f 0%, #061b3d 58%, #031b3f 100%);
            opacity: 1;
            visibility: visible;
            transition: opacity .55s ease, visibility .55s ease;
        }

        .ees-preloader.is-hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .ees-preloader-content {
            width: min(100%, 360px);
            text-align: center;
            color: #fff;
            animation: ees-preloader-rise .7s ease both;
        }

        .ees-preloader-mark {
            position: relative;
            display: grid;
            place-items: center;
            width: 88px;
            height: 88px;
            margin: 0 auto 25px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 24px;
            background: rgba(255, 255, 255, .07);
            box-shadow: 0 18px 55px rgba(0, 0, 0, .22);
            backdrop-filter: blur(10px);
        }

        .ees-preloader-mark::before,
        .ees-preloader-mark::after {
            position: absolute;
            content: "";
            border: 2px solid transparent;
            border-top-color: var(--gold);
            border-right-color: rgba(233, 177, 58, .4);
            border-radius: 50%;
            animation: ees-preloader-spin 1.25s linear infinite;
        }

        .ees-preloader-mark::before { inset: -8px; }

        .ees-preloader-mark::after {
            inset: 7px;
            border-top-color: #fff;
            border-right-color: transparent;
            animation-duration: 1.8s;
            animation-direction: reverse;
        }

        .ees-preloader-mark i {
            font-size: 31px;
            color: #fff;
            text-shadow: 0 0 24px rgba(85, 197, 255, .65);
        }

        .ees-preloader-name {
            margin: 0;
            color: #fff;
            font-family: var(--font-display);
            font-size: clamp(1.25rem, 4vw, 1.65rem);
            font-weight: 800;
            letter-spacing: .12em;
            line-height: 1.3;
        }

        .ees-preloader-name span { color: var(--gold); }

        .ees-preloader-subtitle {
            margin: 9px 0 27px;
            color: rgba(255, 255, 255, .7);
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .ees-preloader-track {
            width: 100%;
            height: 4px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, .16);
        }

        .ees-preloader-progress {
            width: 0;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            box-shadow: 0 0 16px rgba(233, 177, 58, .45);
            animation: ees-preloader-progress 2.4s ease-in-out forwards;
        }

        .ees-preloader-status {
            margin: 13px 0 0;
            color: rgba(255, 255, 255, .62);
            font-size: .78rem;
            letter-spacing: .03em;
        }

        .ees-preloader-status::after {
            display: inline-block;
            width: 1.25em;
            text-align: left;
            content: "";
            animation: ees-preloader-dots 1.3s steps(4, end) infinite;
        }

        @keyframes ees-preloader-spin { to { transform: rotate(360deg); } }

        @keyframes ees-preloader-progress {
            0%   { width: 0; }
            65%  { width: 72%; }
            100% { width: 92%; }
        }

        @keyframes ees-preloader-dots {
            0%        { content: ""; }
            25%       { content: "."; }
            50%       { content: ".."; }
            75%, 100% { content: "..."; }
        }

        @keyframes ees-preloader-rise {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }

            .ees-preloader,
            .ees-preloader-content {
                animation: none !important;
                transition-duration: .01ms !important;
            }

            .ees-preloader-mark::before,
            .ees-preloader-mark::after,
            .ees-preloader-progress,
            .ees-preloader-status::after { animation: none !important; }

            .ees-preloader-progress { width: 90%; }

            .ees-navbar,
            .ees-navbar * { transition-duration: .01ms !important; }
        }
    </style>

    @stack('styles')
</head>

<body class="ees-loading">

    <!-- EES-Tech page preloader -->
    <div class="ees-preloader" id="eesPreloader" role="status" aria-live="polite" aria-label="Loading EES Technologies Ghana">
        <div class="ees-preloader-content">
            <div class="ees-preloader-mark" aria-hidden="true">
                <i class="fas fa-bolt"></i>
            </div>
            <h1 class="ees-preloader-name">EES <span>TECH</span></h1>
            <p class="ees-preloader-subtitle">EES Technologies Ghana</p>
            <div class="ees-preloader-track" aria-hidden="true">
                <div class="ees-preloader-progress" id="eesPreloaderProgress"></div>
            </div>
            <p class="ees-preloader-status">Preparing your experience</p>
        </div>
    </div>

    <noscript>
        <style>
            .ees-preloader { display: none !important; }
            body.ees-loading { overflow: auto !important; }
        </style>
    </noscript>


{{-- =====================================================
     NAVBAR
===================================================== --}}
<nav class="navbar navbar-expand-lg sticky-top ees-navbar" id="eesNavbarWrap">
    <div class="container">

        <a href="{{ route('home') }}"
           class="navbar-brand ees-brand"
           aria-label="{{ $companyName }}">

            <img src="{{ $logoUrl }}"
                 alt="{{ $companyName }} Logo"
                 class="ees-logo">

            <span class="ees-brand-text">
                <span class="ees-brand-name">{{ $companyName }}</span>
                <small class="ees-brand-tagline">{{ $tagline }}</small>
            </span>
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#eesNavbar"
                aria-controls="eesNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars fs-4"></i>
        </button>

        <div class="collapse navbar-collapse" id="eesNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        About Us
                    </a>
                </li>

                {{-- Services dropdown --}}
                <li class="nav-item dropdown services-dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="{{ url('/#services') }}"
                       id="servicesDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Services
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/#service-software') }}">
                                <i class="bi bi-code-square" aria-hidden="true"></i>
                                <span>Software Development</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/#service-cloud') }}">
                                <i class="bi bi-cloud-check" aria-hidden="true"></i>
                                <span>Cloud Solutions</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/#service-security') }}">
                                <i class="bi bi-shield-check" aria-hidden="true"></i>
                                <span>IT Security</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/#service-consulting') }}">
                                <i class="bi bi-graph-up-arrow" aria-hidden="true"></i>
                                <span>IT Consulting</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/#services') }}">
                                <i class="bi bi-grid" aria-hidden="true"></i>
                                <span>View All Services</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
                       href="{{ route('projects.index') }}">
                        Our Projects
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">
                        We Sell
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}"
                        href="{{ route('contact.index') }}"
                    >
                        Contact Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link quote-btn" href="{{ url('/#contact') }}">
                        Get a Quote
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

{{-- =====================================================
     FOOTER
===================================================== --}}
<footer class="ees-footer">
    <div class="container">

        <div class="row g-5">

            {{-- Company --}}
            <div class="col-lg-4">
                <div class="ees-footer-brand">{{ $companyName }}</div>

                <p class="ees-footer-about">{{ $companyDescription }}</p>

                <div class="ees-socials">

                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif

                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif

                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif

                    @if($twitter)
                        <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer" aria-label="X / Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    @endif

                </div>
            </div>

            {{-- Company navigation --}}
            <div class="col-lg-2 col-md-4">
                <h5>Company</h5>

                <ul class="ees-footer-links">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ url('/#services') }}">Services</a></li>
                    <li><a href="{{ url('/#team') }}">Our Team</a></li>
                    <li><a href="{{ url('/#contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="col-lg-3 col-md-4">
                <h5>Our Services</h5>

                <ul class="ees-footer-links">
                    <li><a href="{{ url('/#service-software') }}">Software Development</a></li>
                    <li><a href="{{ url('/#service-cloud') }}">Cloud Solutions</a></li>
                    <li><a href="{{ url('/#service-security') }}">IT Security</a></li>
                    <li><a href="{{ url('/#service-consulting') }}">IT Consulting</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-3 col-md-4">
                <h5>Contact</h5>

                @if($address)
                    <div class="ees-contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>{{ $address }}</span>
                    </div>
                @endif

                @if($email)
                    <div class="ees-contact-item">
                        <i class="bi bi-envelope"></i>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                @endif

                @if($phone)
                    <div class="ees-contact-item">
                        <i class="bi bi-telephone"></i>
                        <a href="tel:{{ $phoneLink }}">{{ $phone }}</a>
                    </div>
                @endif
            </div>

        </div>

        <div class="ees-footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    &copy; {{ date('Y') }} {{ $companyName }}. All Rights Reserved.
                </div>

                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    {{ $tagline }}
                </div>
            </div>
        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<!-- Navbar behaviour -->
<script>
    (() => {
        const navbar = document.getElementById('eesNavbarWrap');
        const menu = document.getElementById('eesNavbar');
        if (!navbar) return;

        let ticking = false;
        const update = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                ticking = true;
                window.requestAnimationFrame(update);
            }
        }, { passive: true });

        update();

        // Close the mobile menu and any open dropdown after choosing a link.
        navbar.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item').forEach(link => {
            link.addEventListener('click', () => {
                const toggle = document.getElementById('servicesDropdown');

                if (toggle) {
                    bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
                }

                if (menu && menu.classList.contains('show')) {
                    bootstrap.Collapse.getOrCreateInstance(menu).hide();
                }
            });
        });
    })();
</script>

<!-- EES-Tech preloader controller -->
<script>
    (() => {
        const preloader = document.getElementById('eesPreloader');
        const progress = document.getElementById('eesPreloaderProgress');

        if (!preloader) {
            document.body.classList.remove('ees-loading');
            return;
        }

        document.documentElement.classList.add('ees-preloading');

        let dismissed = false;

        const dismissPreloader = () => {
            if (dismissed) return;
            dismissed = true;

            if (progress) {
                progress.style.animation = 'none';
                progress.style.width = '100%';
                progress.style.transition = 'width .25s ease';
            }

            window.setTimeout(() => {
                preloader.classList.add('is-hidden');
                document.body.classList.remove('ees-loading');
                document.documentElement.classList.remove('ees-preloading');

                window.setTimeout(() => {
                    if (preloader && preloader.parentNode) {
                        preloader.parentNode.removeChild(preloader);
                    }
                }, 650);
            }, 180);
        };

        if (document.readyState === 'complete') {
            window.setTimeout(dismissPreloader, 250);
        } else {
            window.addEventListener('load', () => {
                window.setTimeout(dismissPreloader, 250);
            }, { once: true });
        }

        // Fail-safe: a slow or blocked resource must never trap the visitor.
        window.setTimeout(dismissPreloader, 7000);
    })();
</script>

</body>
</html>