@php
    $companyName = $companyName ?? ($settings?->company_name ?? 'EES Technologies Ghana');
    $tagline = $tagline ?? ($settings?->tagline ?? 'INNOVATE • INTEGRATE • ELEVATE');

    $companyDescription = $companyDescription
        ?? ($settings?->description
        ?? 'EES Technologies Ghana provides innovative and reliable technology solutions that help organisations improve efficiency, strengthen security and accelerate digital transformation.');

    $email = $email ?? ($settings?->email ?? 'info@eestechnologies.com');
    $phone = $phone ?? ($settings?->phone ?? '+233 542 013 350');
    $address = $address ?? ($settings?->address ?? 'Ghana');

    $linkedin = $linkedin ?? ($settings?->linkedin_url ?? null);
    $facebook = $facebook ?? ($settings?->facebook_url ?? null);
    $instagram = $instagram ?? ($settings?->instagram_url ?? null);
    $twitter = $twitter ?? ($settings?->twitter_url ?? null);

    $logoUrl = $logoUrl
        ?? (($settings?->logo)
            ? asset('storage/' . $settings->logo)
            : asset('img/logo.png'));

    $faviconUrl = $faviconUrl
        ?? (($settings?->favicon)
            ? asset('storage/' . $settings->favicon)
            : asset('favicon.ico'));

    $phoneLink = preg_replace('/[^0-9+]/', '', (string) $phone);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $companyName }} | IT Solutions</title>

    <meta name="description" content="{{ $companyDescription }}">
    <meta name="author" content="{{ $companyName }}">

    {{-- Dynamic favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 90px; }

        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background: #fff;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; }

        h1, h2, h3, h4, h5 {
            font-family: var(--font-display);
            color: var(--navy);
            margin: 0;
        }

        section { padding: clamp(64px, 8vw, 120px) 0; }

        .container { max-width: 1240px; }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--gold);
            outline-offset: 3px;
        }

        /* =========================================================
           SHARED
        ========================================================= */
        .section-title {
            font-size: clamp(32px, 4.2vw, 56px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -.03em;
            text-wrap: balance;
        }

        .section-description {
            max-width: 56ch;
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 17.5px;
            line-height: 1.75;
        }

        .btn-ees {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            padding: 12px 28px;
            border: 2px solid transparent;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 700;
            transition: background-color .25s ease, color .25s ease, border-color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
        }

        .btn-ees i { transition: transform .3s var(--ease); }
        .btn-ees:hover { transform: translateY(-2px); }
        .btn-ees:hover i.bi-arrow-right { transform: translateX(5px); }

        .btn-ees--solid { color: #fff; background: var(--blue); }
        .btn-ees--solid:hover { color: #fff; background: var(--navy); }

        .btn-ees--gold { color: var(--navy); background: var(--gold); }
        .btn-ees--gold:hover { color: var(--navy); background: #f3c25b; box-shadow: 0 14px 30px rgba(233, 177, 58, .32); }

        .btn-ees--light { color: var(--navy); background: #fff; }
        .btn-ees--light:hover { color: var(--navy); background: var(--gold); }

        /* =========================================================
           NAVBAR
        ========================================================= */
        .navbar {
            padding: 14px 0;
            background: rgba(255, 255, 255, .94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid transparent;
            transition: padding .3s var(--ease), box-shadow .3s ease, border-color .3s ease;
        }

        .navbar.scrolled {
            padding: 8px 0;
            border-bottom-color: var(--line);
            box-shadow: 0 10px 34px rgba(6, 27, 61, .08);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            object-fit: contain;
            flex-shrink: 0;
            transition: transform .4s var(--ease), width .3s ease, height .3s ease;
        }

        .navbar.scrolled .brand-logo { width: 50px; height: 50px; }
        .navbar-brand:hover .brand-logo { transform: scale(1.07) rotate(-3deg); }

        .brand-content { display: flex; flex-direction: column; min-width: 0; }

        .brand-name {
            color: var(--navy);
            font-family: var(--font-display);
            font-size: 1.32rem;
            font-weight: 800;
            letter-spacing: -.02em;
            line-height: 1.05;
            white-space: nowrap;
        }

        .brand-small {
            margin-top: 5px;
            color: var(--blue);
            font-size: .56rem;
            font-weight: 700;
            letter-spacing: 1.8px;
            line-height: 1;
            white-space: nowrap;
        }

        .navbar .navbar-nav .nav-link {
            position: relative;
            margin: 0 6px;
            padding: 10px 4px;
            color: var(--ink);
            font-size: .96rem;
            font-weight: 600;
            transition: color .25s ease;
        }

        .navbar .navbar-nav .nav-link:not(.nav-cta)::after {
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

        .navbar .navbar-nav .nav-link:hover,
        .navbar .navbar-nav .nav-link.active { color: var(--blue); }

        .navbar .navbar-nav .nav-link:not(.nav-cta):hover::after,
        .navbar .navbar-nav .nav-link.active:not(.nav-cta)::after { transform: scaleX(1); }

        .navbar .navbar-nav .nav-link.nav-cta {
            margin-left: 12px;
            padding: 12px 24px !important;
            color: #fff;
            background: var(--navy);
            border-radius: 999px;
            font-size: .92rem;
            transition: background-color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
        }

        .navbar .navbar-nav .nav-link.nav-cta:hover {
            color: var(--navy);
            background: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(233, 177, 58, .3);
        }

        .navbar-toggler { padding: 6px; }
        .navbar-toggler:focus { box-shadow: none; }
        .navbar-toggler i { color: var(--navy); }

        /* Services dropdown */
        .services-dropdown > .nav-link { display: inline-flex; align-items: center; gap: 7px; }

        .services-dropdown > .nav-link::before {
            content: "";
            order: 2;
            border-top: .32em solid currentColor;
            border-right: .28em solid transparent;
            border-left: .28em solid transparent;
            transition: transform .3s var(--ease);
        }

        .services-dropdown > .nav-link::after { order: 3; }
        .services-dropdown > .dropdown-toggle::after { display: none; }

        .services-dropdown.show > .nav-link::before,
        .services-dropdown:hover > .nav-link::before { transform: rotate(180deg); }

        .services-dropdown .dropdown-menu {
            min-width: 270px;
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

        .services-dropdown .dropdown-item:hover i { color: #fff; background: var(--blue); }

        @media (min-width: 992px) {
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
            .navbar-collapse { padding: 14px 0 8px; }
            .navbar .navbar-nav .nav-link { margin: 2px 0; padding: 11px 4px; }
            .navbar .navbar-nav .nav-link:not(.nav-cta)::after { display: none; }
            .navbar .navbar-nav .nav-link.nav-cta { display: inline-flex; margin: 8px 0 0; }

            .services-dropdown { width: 100%; }
            .services-dropdown > .nav-link { display: flex; justify-content: space-between; width: 100%; }

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

        /* =========================================================
           HERO SLIDER
        ========================================================= */
        .hero-slider {
            position: relative;
            height: 92vh;
            min-height: 700px;
            padding: 0;
            overflow: hidden;
            isolation: isolate;
            background: var(--navy);
        }

        .hero-slide,
        .hero-fallback {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero-slide {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: scale(1.06);
            transition: opacity 1s ease, visibility 1s ease, transform 8s ease-out;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: scale(1);
        }

        .hero-slide::before,
        .hero-fallback::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                linear-gradient(180deg, rgba(6, 27, 61, .55) 0%, rgba(6, 27, 61, .35) 45%, rgba(6, 27, 61, .78) 100%),
                radial-gradient(circle at 50% 45%, rgba(8, 120, 209, .2), transparent 55%);
        }

        .hero-slide .container,
        .hero-fallback .container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
        }

        .hero-slide-content {
            width: min(940px, 94%);
            padding: 96px 0 150px;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 26px;
            padding: 10px 20px;
            color: #fff;
            font-size: .92rem;
            font-weight: 600;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 999px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .hero-badge i { color: var(--gold); }

        .hero-slide h1,
        .hero-fallback h1 {
            max-width: 1000px;
            color: #fff;
            font-size: clamp(2.7rem, 6.2vw, 5.6rem);
            font-weight: 800;
            line-height: 1.02;
            letter-spacing: -.04em;
            text-shadow: 0 8px 40px rgba(0, 0, 0, .3);
            text-wrap: balance;
        }

        .hero-slide h1 span,
        .hero-fallback h1 span {
            display: block;
            color: #ffd77a;
        }

        .hero-description {
            max-width: 700px;
            margin: 26px auto 0;
            color: rgba(255, 255, 255, .92);
            font-size: clamp(1rem, 1.6vw, 1.2rem);
            line-height: 1.7;
            text-shadow: 0 4px 18px rgba(0, 0, 0, .3);
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 38px;
        }

        /* Transparent, white-outlined buttons. */
        .hero-buttons .btn-primary-custom,
        .hero-buttons .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 210px;
            min-height: 56px;
            padding: 14px 30px;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            background: rgba(6, 27, 61, .14);
            border: 1.5px solid rgba(255, 255, 255, .95);
            border-radius: 999px;
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            transition: background-color .3s ease, color .3s ease, transform .3s var(--ease);
        }

        .hero-buttons .btn-primary-custom:hover,
        .hero-buttons .btn-outline-custom:hover {
            color: var(--navy);
            background: #fff;
            transform: translateY(-3px);
        }

        .hero-buttons .btn-primary-custom i { transition: transform .3s var(--ease); }
        .hero-buttons .btn-primary-custom:hover i { transform: translateX(5px); }

        /* Content choreography for the active slide. */
        .hero-slide .hero-badge,
        .hero-slide h1,
        .hero-slide .hero-description,
        .hero-slide .hero-buttons {
            opacity: 0;
            transform: translateY(28px);
        }

        .hero-slide.active .hero-badge { animation: heroIn .8s var(--ease) .15s forwards; }
        .hero-slide.active h1 { animation: heroIn .9s var(--ease) .28s forwards; }
        .hero-slide.active .hero-description { animation: heroIn .8s var(--ease) .45s forwards; }
        .hero-slide.active .hero-buttons { animation: heroIn .8s var(--ease) .6s forwards; }

        @keyframes heroIn { to { opacity: 1; transform: none; } }

        /* Slider controls */
        .hero-controls {
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            bottom: 96px;
        }

        .hero-controls .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .hero-dots { display: flex; align-items: center; gap: 9px; }

        .hero-dot {
            width: 10px;
            height: 10px;
            padding: 0;
            border: 0;
            border-radius: 999px;
            background: rgba(255, 255, 255, .45);
            cursor: pointer;
            transition: width .4s var(--ease), background .3s ease;
        }

        .hero-dot:hover { background: rgba(255, 255, 255, .85); }
        .hero-dot.active { width: 44px; background: var(--gold); }

        .hero-side { display: flex; align-items: center; gap: 16px; }

        .hero-count {
            color: rgba(255, 255, 255, .75);
            font-size: .85rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .hero-count .current { color: #fff; font-size: 1.1rem; }

        .hero-arrows { display: flex; gap: 8px; }

        .hero-arrow {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 50%;
            cursor: pointer;
            backdrop-filter: blur(8px);
            transition: background-color .25s ease, color .25s ease, transform .3s var(--ease);
        }

        .hero-arrow:hover { color: var(--navy); background: #fff; transform: scale(1.08); }

        .hero-progress {
            position: absolute;
            z-index: 10;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 0;
            background: linear-gradient(90deg, var(--blue), var(--gold));
        }

        @media (max-width: 991.98px) {
            .hero-slider { height: auto; min-height: 720px; }
        }

        @media (max-width: 575.98px) {
            .hero-slider { min-height: 760px; }
            .hero-slide-content { padding: 104px 0 170px; }
            .hero-slide h1 { font-size: 2.55rem; letter-spacing: -.03em; }
            .hero-buttons { flex-direction: column; align-items: stretch; width: min(420px, 100%); }
            .hero-buttons a { width: 100%; min-width: 0; }
            .hero-count { display: none; }
            .hero-controls .container { justify-content: center; }
            .hero-side { display: none; }
        }

        /* =========================================================
           TRUST BAR (floating over the hero)
        ========================================================= */
        .trust-bar { position: relative; z-index: 12; padding: 0; margin-top: -64px; }

        .trust-panel {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: 0 30px 70px -26px rgba(6, 27, 61, .38);
            overflow: hidden;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 26px 28px;
            color: var(--navy);
            font-size: 1rem;
            font-weight: 700;
            border-right: 1px solid var(--line);
            transition: background-color .3s ease, color .3s ease;
        }

        .trust-item:last-child { border-right: 0; }

        .trust-item i {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            background: var(--blue-soft);
            border-radius: 16px;
            font-size: 1.4rem;
            transition: transform .4s var(--ease), background-color .3s ease, color .3s ease;
        }

        .trust-item:hover { color: var(--blue); background: var(--paper); }
        .trust-item:hover i { color: #fff; background: var(--blue); transform: translateY(-3px) rotate(-6deg); }

        @media (max-width: 991.98px) {
            .trust-panel { grid-template-columns: repeat(2, 1fr); }
            .trust-item:nth-child(2) { border-right: 0; }
            .trust-item:nth-child(-n+2) { border-bottom: 1px solid var(--line); }
        }

        @media (max-width: 575.98px) {
            .trust-bar { margin-top: -48px; }
            .trust-panel { border-radius: 22px; }
            .trust-item { flex-direction: column; align-items: flex-start; gap: 12px; padding: 20px; font-size: .92rem; }
        }

        /* =========================================================
           SERVICES
        ========================================================= */
        .services { background: #fff; }

        .services-intro { position: sticky; top: 120px; }

        .svc-list { display: flex; flex-direction: column; gap: 14px; }

        .svc {
            position: relative;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 24px;
            padding: 28px 30px;
            color: var(--ink);
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 24px;
            overflow: hidden;
            transition: background-color .45s var(--ease), border-color .45s ease, transform .45s var(--ease), box-shadow .45s ease;
        }

        .svc::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: var(--gold);
            transform: scaleY(0);
            transform-origin: 50% 100%;
            transition: transform .45s var(--ease);
        }

        .svc:hover {
            background: var(--navy);
            border-color: var(--navy);
            transform: translateX(8px);
            box-shadow: 0 28px 56px -24px rgba(6, 27, 61, .5);
        }

        .svc:hover::before { transform: scaleY(1); }

        .svc-icon {
            width: 68px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            background: #fff;
            border-radius: 20px;
            font-size: 1.8rem;
            transition: transform .45s var(--ease), color .35s ease, background-color .35s ease;
        }

        .svc:hover .svc-icon { color: var(--navy); background: var(--gold); transform: rotate(-6deg) scale(1.06); }

        .svc h4 {
            margin-bottom: 8px;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -.015em;
            transition: color .3s ease;
        }

        .svc p {
            max-width: 52ch;
            margin: 0;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.65;
            transition: color .3s ease;
        }

        .svc:hover h4 { color: #fff; }
        .svc:hover p { color: rgba(255, 255, 255, .78); }

        .svc-link {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 50%;
            transition: transform .45s var(--ease), color .3s ease, background-color .3s ease, border-color .3s ease;
        }

        .svc:hover .svc-link { color: var(--navy); background: var(--gold); border-color: var(--gold); transform: rotate(-45deg); }

        @media (max-width: 991.98px) {
            .services-intro { position: static; }
        }

        @media (max-width: 575.98px) {
            .svc { grid-template-columns: auto 1fr; padding: 22px; gap: 18px; }
            .svc-link { display: none; }
            .svc-icon { width: 56px; height: 56px; font-size: 1.5rem; border-radius: 16px; }
            .svc h4 { font-size: 1.2rem; }
        }

        /* =========================================================
           ABOUT
        ========================================================= */
        .about { background: var(--paper); }

        .about-box {
            position: relative;
            min-height: 560px;
            display: flex;
            align-items: flex-end;
            padding: clamp(28px, 4vw, 52px);
            color: #fff;
            border-radius: 32px;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(6, 27, 61, .35) 0%, rgba(6, 27, 61, .92) 78%),
                url('{{ asset('img/ees-tech-hero.jpeg') }}') center / cover no-repeat,
                var(--navy);
            box-shadow: 0 40px 80px -34px rgba(6, 27, 61, .5);
        }

        .about-box::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            top: -150px;
            right: -120px;
            border: 64px solid rgba(255, 255, 255, .06);
            border-radius: 50%;
            animation: orbit 14s ease-in-out infinite alternate;
        }

        @keyframes orbit {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(-30px, 30px) scale(1.12); }
        }

        .about-box-content { position: relative; z-index: 1; }

        .about-name {
            display: inline-block;
            margin-bottom: 14px;
            padding: 7px 16px;
            color: var(--navy);
            background: var(--gold);
            border-radius: 999px;
            font-size: .9rem;
            font-weight: 700;
        }

        .about-box h3 {
            color: #fff;
            font-size: clamp(1.7rem, 2.8vw, 2.4rem);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -.02em;
        }

        .about-box p {
            max-width: 52ch;
            margin: 16px 0 0;
            color: rgba(255, 255, 255, .82);
            line-height: 1.75;
        }

        .about-checks { margin: 30px 0 34px; padding: 0; list-style: none; }

        .about-check {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            color: var(--ink);
            font-size: 1.05rem;
            font-weight: 600;
            border-bottom: 1px solid var(--line);
            transition: transform .35s var(--ease), color .3s ease;
        }

        .about-check:first-child { border-top: 1px solid var(--line); }
        .about-check:hover { color: var(--blue); transform: translateX(8px); }

        .about-check i {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: var(--blue);
            border-radius: 50%;
            font-size: .95rem;
            transition: background-color .3s ease, transform .4s var(--ease);
        }

        .about-check:hover i { color: var(--navy); background: var(--gold); transform: scale(1.12) rotate(8deg); }

        /* =========================================================
           TEAM
        ========================================================= */
        .team-section { background: #fff; }

        .team-head { max-width: 680px; margin-bottom: clamp(36px, 5vw, 64px); }

        .team-card { height: 100%; display: flex; flex-direction: column; }

        .team-photo-wrapper {
            position: relative;
            aspect-ratio: 4 / 4.7;
            overflow: hidden;
            padding: 24px 24px 0;
            border-radius: 28px;
            background: linear-gradient(135deg, #f4f9fe 0%, #dcebfa 100%);
            transition: box-shadow .45s ease, transform .45s var(--ease);
        }

        .team-card:hover .team-photo-wrapper {
            transform: translateY(-6px);
            box-shadow: 0 30px 60px -26px rgba(6, 27, 61, .4);
        }

        .team-photo {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            border-radius: 18px 18px 0 0;
            transition: transform .8s var(--ease);
        }

        .team-card:hover .team-photo { transform: scale(1.045); }

        .team-info { padding: 24px 4px 0; }

        .team-info h4 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -.015em;
        }

        .team-role {
            margin: 6px 0 12px;
            color: var(--blue);
            font-size: 1rem;
            font-weight: 700;
        }

        .team-info p {
            max-width: 44ch;
            margin: 0;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.65;
        }

        .team-social { display: flex; gap: 8px; margin-top: 18px; }

        .team-social a {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 50%;
            transition: transform .3s var(--ease), background-color .25s ease, color .25s ease, border-color .25s ease;
        }

        .team-social a:hover { color: #fff; background: var(--blue); border-color: var(--blue); transform: translateY(-4px); }

        /* =========================================================
           PROCESS
        ========================================================= */
        .process { background: var(--paper); }

        .process-head { max-width: 760px; margin-bottom: clamp(40px, 5vw, 72px); }

        .process-steps { position: relative; }

        @media (min-width: 992px) {
            .process-steps::before {
                content: "";
                position: absolute;
                z-index: 0;
                top: 33px;
                left: 8%;
                right: 8%;
                height: 2px;
                background: linear-gradient(90deg, var(--blue), var(--gold));
                opacity: .35;
            }
        }

        .step { position: relative; z-index: 1; height: 100%; padding-right: 12px; }

        .step-number {
            width: 68px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 26px;
            color: var(--navy);
            background: #fff;
            border: 2px solid var(--line);
            border-radius: 50%;
            box-shadow: 0 0 0 8px var(--paper);
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 800;
            transition: color .35s ease, background-color .35s ease, border-color .35s ease, transform .5s var(--ease);
        }

        .step:hover .step-number { color: #fff; background: var(--blue); border-color: var(--blue); transform: scale(1.1) rotate(-8deg); }

        .step h5 { margin-bottom: 10px; font-size: 1.5rem; font-weight: 700; letter-spacing: -.015em; }

        .step p { max-width: 30ch; margin: 0; color: var(--muted); font-size: 1rem; line-height: 1.7; }

        /* =========================================================
           CTA
        ========================================================= */
        .cta-section { padding: clamp(56px, 7vw, 104px) 0; background: #fff; }

        .cta-box {
            position: relative;
            overflow: hidden;
            padding: clamp(36px, 6vw, 80px);
            color: #fff;
            border-radius: 36px;
            background:
                radial-gradient(circle at 92% 12%, rgba(8, 120, 209, .6), transparent 48%),
                var(--navy);
        }

        .cta-box::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            left: -130px;
            bottom: -200px;
            border-radius: 50%;
            background: rgba(233, 177, 58, .16);
            filter: blur(40px);
            animation: orbit 12s ease-in-out infinite alternate;
        }

        .cta-box .row { position: relative; z-index: 1; }

        .cta-box h2 {
            color: #fff;
            font-size: clamp(2rem, 4.4vw, 3.6rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -.03em;
            text-wrap: balance;
        }

        .cta-box p {
            max-width: 52ch;
            margin: 18px 0 0;
            color: rgba(255, 255, 255, .8);
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* =========================================================
           FOOTER
        ========================================================= */
        footer {
            padding: clamp(56px, 7vw, 88px) 0 28px;
            color: #fff;
            background: #041229;
        }

        .footer-brand {
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        footer p { color: #98a9be; line-height: 1.8; }

        footer h6 {
            margin: 0 0 22px;
            color: #fff;
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
        }

        footer ul { margin: 0; padding: 0; list-style: none; }
        footer ul li { margin-bottom: 12px; }

        footer ul li a {
            position: relative;
            color: #98a9be;
            transition: color .25s ease, padding-left .3s var(--ease);
        }

        footer ul li a:hover { color: #fff; padding-left: 8px; }

        footer .contact-line { display: flex; gap: 12px; margin-bottom: 14px; }
        footer .contact-line i { color: var(--gold); margin-top: 3px; }
        footer .contact-line a { color: #cdd8e6; transition: color .25s ease; }
        footer .contact-line a:hover { color: #fff; }

        .social-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            color: #fff;
            background: rgba(255, 255, 255, .08);
            border-radius: 50%;
            transition: background-color .25s ease, color .25s ease, transform .3s var(--ease);
        }

        .social-icon:hover { color: var(--navy); background: var(--gold); transform: translateY(-4px); }

        .footer-bottom {
            margin-top: 52px;
            padding-top: 26px;
            color: #7d92aa;
            font-size: .92rem;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        /* =========================================================
           SCROLL UI
        ========================================================= */
        .scroll-progress {
            position: fixed;
            z-index: 2000;
            top: 0;
            left: 0;
            height: 3px;
            width: 0;
            background: linear-gradient(90deg, var(--blue), var(--gold));
        }

        .back-to-top {
            position: fixed;
            z-index: 1200;
            right: 22px;
            bottom: 22px;
            width: 50px;
            height: 50px;
            display: grid;
            place-items: center;
            color: var(--navy);
            background: var(--gold);
            border: 0;
            border-radius: 50%;
            box-shadow: 0 14px 30px rgba(6, 27, 61, .25);
            opacity: 0;
            visibility: hidden;
            transform: translateY(16px);
            transition: opacity .35s ease, visibility .35s ease, transform .4s var(--ease), background-color .25s ease;
        }

        .back-to-top.show { opacity: 1; visibility: visible; transform: none; }
        .back-to-top:hover { background: #f3c25b; transform: translateY(-4px); }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translate3d(0, 34px, 0);
            transition: opacity .9s var(--ease), transform .9s var(--ease);
        }

        .reveal.reveal-left { transform: translate3d(-48px, 0, 0); }
        .reveal.reveal-right { transform: translate3d(48px, 0, 0); }
        .reveal.reveal-scale { transform: scale(.94); }

        .reveal.is-visible { opacity: 1; transform: none; }

        /* =========================================================
           PRELOADER
        ========================================================= */
        body.preloader-active { overflow: hidden; }

        #ees-preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(circle at 50% 42%, rgba(8, 120, 209, .24), transparent 45%),
                linear-gradient(135deg, #03152f 0%, #061b3d 58%, #031b3f 100%);
            transition: opacity .7s ease, visibility .7s ease;
        }

        #ees-preloader.is-loaded { opacity: 0; visibility: hidden; pointer-events: none; }

        .ees-loader-content {
            width: min(100%, 390px);
            color: #fff;
            text-align: center;
            animation: loaderEnter .7s var(--ease) both;
        }

        .ees-loader-mark {
            position: relative;
            width: 112px;
            height: 112px;
            margin: 0 auto 27px;
            display: grid;
            place-items: center;
        }

        .ees-loader-ring,
        .ees-loader-ring-inner { position: absolute; border-radius: 50%; }

        .ees-loader-ring {
            inset: 0;
            border: 2px solid rgba(255, 255, 255, .12);
            border-top-color: var(--gold);
            border-right-color: var(--blue);
            animation: loaderSpin 1.15s linear infinite;
        }

        .ees-loader-ring-inner {
            inset: 9px;
            border: 1px solid rgba(73, 182, 255, .22);
            border-bottom-color: #49b6ff;
            animation: loaderSpin 1.8s linear infinite reverse;
        }

        .ees-loader-logo {
            position: relative;
            z-index: 1;
            width: 68px;
            height: 68px;
            object-fit: contain;
        }

        .ees-loader-name {
            margin: 0;
            color: #fff;
            font-family: var(--font-display);
            font-size: clamp(1.2rem, 4vw, 1.65rem);
            font-weight: 800;
            letter-spacing: -.01em;
        }

        .ees-loader-tagline {
            margin: 10px 0 29px;
            color: #80ccff;
            font-size: .66rem;
            font-weight: 700;
            letter-spacing: 2.4px;
        }

        .ees-loader-track {
            width: 185px;
            max-width: 100%;
            height: 3px;
            margin: 0 auto 15px;
            overflow: hidden;
            border-radius: 99px;
            background: rgba(255, 255, 255, .14);
        }

        .ees-loader-track span {
            display: block;
            width: 38%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            animation: loaderProgress 1.35s ease-in-out infinite;
        }

        .ees-loader-status {
            margin: 0;
            color: rgba(255, 255, 255, .68);
            font-size: .78rem;
            letter-spacing: .6px;
            animation: loaderPulse 1.6s ease-in-out infinite;
        }

        @keyframes loaderSpin { to { transform: rotate(360deg); } }
        @keyframes loaderProgress { from { transform: translateX(-110%); } to { transform: translateX(370%); } }
        @keyframes loaderPulse { 50% { opacity: .55; } }
        @keyframes loaderEnter { from { opacity: 0; transform: translateY(12px) scale(.98); } to { opacity: 1; transform: none; } }

        /* =========================================================
           MOBILE BRAND
        ========================================================= */
        @media (max-width: 575.98px) {
            .brand-logo { width: 46px; height: 46px; }
            .navbar-brand { gap: 12px; }
            .brand-name { font-size: 1.05rem; }
            .brand-small { font-size: .46rem; letter-spacing: 1.2px; }
        }

        /* =========================================================
           REDUCED MOTION
        ========================================================= */
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }

            *, *::before, *::after {
                animation-duration: .001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .001ms !important;
                transition-delay: 0s !important;
            }

            .hero-slide { transform: none !important; }

            .hero-slide.active .hero-badge,
            .hero-slide.active h1,
            .hero-slide.active .hero-description,
            .hero-slide.active .hero-buttons { opacity: 1; transform: none; }

            .reveal { opacity: 1; transform: none; }
        }
    </style>
</head>

<body class="preloader-active">

    <div id="ees-preloader" role="status" aria-live="polite" aria-label="Loading {{ $companyName }}">
        <div class="ees-loader-content">
            <div class="ees-loader-mark" aria-hidden="true">
                <span class="ees-loader-ring"></span>
                <span class="ees-loader-ring-inner"></span>
                <img src="{{ $logoUrl }}" alt="" class="ees-loader-logo" onerror="this.style.display='none'">
            </div>
            <p class="ees-loader-name">{{ $companyName }}</p>
            <p class="ees-loader-tagline">{{ $tagline }}</p>
            <div class="ees-loader-track" aria-hidden="true"><span></span></div>
            <p class="ees-loader-status">Preparing your experience…</p>
        </div>
    </div>

    <noscript>
        <style>
            #ees-preloader { display: none !important; }
            body.preloader-active { overflow: auto !important; }
            .reveal { opacity: 1 !important; transform: none !important; }
            .hero-slide .hero-badge, .hero-slide h1, .hero-slide .hero-description, .hero-slide .hero-buttons { opacity: 1 !important; transform: none !important; }
        </style>
    </noscript>

    {{-- Global page scroll progress --}}
    <div id="scrollProgress" class="scroll-progress" aria-hidden="true"></div>


{{-- ================================================================
     NAVIGATION
================================================================ --}}
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}" aria-label="{{ $companyName }}">
            <img src="{{ $logoUrl }}" alt="{{ $companyName }} Logo" class="brand-logo">

            <span class="brand-content">
                <span class="brand-name">{{ $companyName }}</span>
                <small class="brand-small">{{ $tagline }}</small>
            </span>
        </a>

        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About Us</a>
                </li>
                <li class="nav-item dropdown services-dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#services"
                       id="servicesDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Services
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li>
                            <a class="dropdown-item" href="#service-software">
                                <i class="bi bi-code-square" aria-hidden="true"></i>
                                <span>Software Development</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#service-cloud">
                                <i class="bi bi-cloud-check" aria-hidden="true"></i>
                                <span>Cloud Solutions</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#service-security">
                                <i class="bi bi-shield-check" aria-hidden="true"></i>
                                <span>IT Security</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#service-consulting">
                                <i class="bi bi-graph-up-arrow" aria-hidden="true"></i>
                                <span>IT Consulting</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#services">
                                <i class="bi bi-grid" aria-hidden="true"></i>
                                <span>View All Services</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projects">Our Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">We Sell</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-cta" href="#contact">Get a Quote</a>
                </li>
            </ul>
        </div>

    </div>
</nav>


{{-- ================================================================
     HERO SLIDER
================================================================ --}}
<section class="hero-slider" id="home">

    @if(isset($heroSlides) && $heroSlides->count())

        @foreach($heroSlides as $index => $slide)

            <div
                class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                data-duration="{{ (int) ($slide->duration ?: 5000) }}"
                aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                style="background-image: url('{{ asset('storage/' . $slide->image) }}');"
            >
                <div class="container">
                    <div class="hero-slide-content">

                        @if($slide->badge)
                            <div class="hero-badge">
                                <i class="bi bi-stars"></i>
                                {{ $slide->badge }}
                            </div>
                        @endif

                        <h1>
                            {{ $slide->title }}

                            @if($slide->highlight)
                                <span>{{ $slide->highlight }}</span>
                            @endif
                        </h1>

                        @if($slide->description)
                            <p class="hero-description">{{ $slide->description }}</p>
                        @endif

                        @if(
                            ($slide->primary_button_text && $slide->primary_button_url) ||
                            ($slide->secondary_button_text && $slide->secondary_button_url)
                        )
                            <div class="hero-buttons">

                                @if($slide->primary_button_text && $slide->primary_button_url)
                                    <a href="{{ $slide->primary_button_url }}" class="btn-primary-custom">
                                        {{ $slide->primary_button_text }}
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                @endif

                                @if($slide->secondary_button_text && $slide->secondary_button_url)
                                    <a href="{{ $slide->secondary_button_url }}" class="btn-outline-custom">
                                        {{ $slide->secondary_button_text }}
                                    </a>
                                @endif

                            </div>
                        @endif

                    </div>
                </div>
            </div>

        @endforeach

        @if($heroSlides->count() > 1)
            <div class="hero-controls">
                <div class="container">

                    <div class="hero-dots" aria-label="Hero slider controls">
                        @foreach($heroSlides as $index => $slide)
                            <button
                                type="button"
                                class="hero-dot {{ $index === 0 ? 'active' : '' }}"
                                data-hero-slide="{{ $index }}"
                                aria-label="Show slide {{ $index + 1 }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="hero-side">
                        <div class="hero-count" aria-live="polite">
                            <span class="current" id="heroCurrentNumber">01</span>
                            / {{ str_pad((string) $heroSlides->count(), 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="hero-arrows">
                            <button type="button" class="hero-arrow" data-hero-step="-1" aria-label="Previous slide">
                                <i class="bi bi-arrow-left"></i>
                            </button>
                            <button type="button" class="hero-arrow" data-hero-step="1" aria-label="Next slide">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="hero-progress" id="heroSliderProgress"></div>
        @endif

    @else

        {{-- Safe fallback when no active hero slides exist --}}
        <div class="hero-fallback" style="background-image: url('{{ asset('img/ees-tech-hero.jpeg') }}');">
            <div class="container">
                <div class="hero-slide-content">

                    <div class="hero-badge">
                        <i class="bi bi-stars"></i>
                        {{ $companyName }}
                    </div>

                    <h1>
                        Technology that helps your
                        <span>business move forward.</span>
                    </h1>

                    <p class="hero-description">{{ $companyDescription }}</p>

                    <div class="hero-buttons">
                        <a href="#services" class="btn-primary-custom">
                            Explore Our Services
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <a href="#team" class="btn-outline-custom">Meet Our Team</a>
                    </div>

                </div>
            </div>
        </div>

    @endif

</section>


{{-- ================================================================
     TRUST BAR
================================================================ --}}
<div class="trust-bar">
    <div class="container">
        <div class="trust-panel reveal reveal-scale">

            <a href="#service-software" class="trust-item">
                <i class="bi bi-code-slash"></i>
                <span>Software Development</span>
            </a>

            <a href="#service-cloud" class="trust-item">
                <i class="bi bi-cloud-arrow-up"></i>
                <span>Cloud Solutions</span>
            </a>

            <a href="#service-security" class="trust-item">
                <i class="bi bi-shield-lock"></i>
                <span>IT Security</span>
            </a>

            <a href="#service-consulting" class="trust-item">
                <i class="bi bi-bar-chart"></i>
                <span>IT Consulting</span>
            </a>

        </div>
    </div>
</div>


{{-- ================================================================
     SERVICES
================================================================ --}}
<section class="services" id="services">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-4">
                <div class="services-intro reveal reveal-left">
                    <h2 class="section-title">
                        Technology solutions built for your organisation
                    </h2>

                    <p class="section-description">
                        From custom software to cloud infrastructure and cybersecurity,
                        we provide practical technology solutions designed around your
                        organisation's goals.
                    </p>

                    <a href="#contact" class="btn-ees btn-ees--solid mt-4">
                        Discuss your needs
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="svc-list">

                    <a href="#contact" class="svc reveal" id="service-software">
                        <span class="svc-icon"><i class="bi bi-code-square"></i></span>
                        <span>
                            <h4>Software Development</h4>
                            <p>
                                Custom web applications, management systems and digital
                                platforms designed to solve real business problems.
                            </p>
                        </span>
                        <span class="svc-link" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>

                    <a href="#contact" class="svc reveal" id="service-cloud">
                        <span class="svc-icon"><i class="bi bi-cloud-check"></i></span>
                        <span>
                            <h4>Cloud Solutions</h4>
                            <p>
                                Modern cloud infrastructure, migrations, hosting and
                                scalable digital services for growing organisations.
                            </p>
                        </span>
                        <span class="svc-link" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>

                    <a href="#contact" class="svc reveal" id="service-security">
                        <span class="svc-icon"><i class="bi bi-shield-check"></i></span>
                        <span>
                            <h4>IT Security</h4>
                            <p>
                                Protect your systems, networks and business information
                                with modern cybersecurity practices and controls.
                            </p>
                        </span>
                        <span class="svc-link" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>

                    <a href="#contact" class="svc reveal" id="service-consulting">
                        <span class="svc-icon"><i class="bi bi-graph-up-arrow"></i></span>
                        <span>
                            <h4>IT Consulting</h4>
                            <p>
                                Strategic technology guidance that helps your organisation
                                select, implement and optimise the right IT solutions.
                            </p>
                        </span>
                        <span class="svc-link" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     ABOUT
================================================================ --}}
<section class="about" id="about">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6 reveal reveal-left">
                <div class="about-box">
                    <div class="about-box-content">
                        <span class="about-name">{{ $companyName }}</span>
                        <h3>{{ $tagline }}</h3>
                        <p>{{ $companyDescription }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal reveal-right">

                <h2 class="section-title">
                    Your technology partner for a digital future
                </h2>

                <p class="section-description">
                    Our approach combines innovation with practical implementation,
                    giving our clients solutions that are secure, scalable and aligned
                    with their objectives.
                </p>

                <ul class="about-checks">
                    <li class="about-check">
                        <i class="bi bi-check-lg"></i>
                        <span>Solutions tailored to your organisation</span>
                    </li>
                    <li class="about-check">
                        <i class="bi bi-check-lg"></i>
                        <span>Reliable technical support and guidance</span>
                    </li>
                    <li class="about-check">
                        <i class="bi bi-check-lg"></i>
                        <span>Modern, secure and scalable technologies</span>
                    </li>
                    <li class="about-check">
                        <i class="bi bi-check-lg"></i>
                        <span>Long-term technology partnerships</span>
                    </li>
                </ul>

                <a href="/about" class="btn-ees btn-ees--solid">
                    Learn more about us
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     OUR TEAM
================================================================ --}}
<section class="team-section" id="team">
    <div class="container">

        <div class="team-head reveal">
            <h2 class="section-title">
                The people behind {{ $companyName }}
            </h2>

            <p class="section-description">
                Our team brings together technology, creativity and practical
                business thinking to deliver solutions that create value for
                our clients.
            </p>
        </div>

        <div class="row g-4 g-xl-5 justify-content-center">

            {{-- TEAM MEMBER 1 --}}
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/el.png') }}"
                             alt="{{ $companyName }} team member"
                             class="team-photo"
                             loading="lazy">
                    </div>

                    <div class="team-info">
                        <h4>CEO</h4>
                        <div class="team-role">Technology &amp; Development</div>
                        <p>
                            Focused on software engineering, digital systems
                            and innovative technology solutions.
                        </p>

                        <div class="team-social">
                            @if($linkedin)
                                <a href="{{ $linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif

                            @if($email)
                                <a href="mailto:{{ $email }}" aria-label="Email">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- TEAM MEMBER 2 --}}
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/sey.png') }}"
                             alt="{{ $companyName }} team member"
                             class="team-photo"
                             loading="lazy">
                    </div>

                    <div class="team-info">
                        <h4>COO</h4>
                        <div class="team-role">Leadership &amp; Strategy</div>
                        <p>
                            Driving organisational direction, client
                            relationships and technology strategy.
                        </p>

                        <div class="team-social">
                            @if($linkedin)
                                <a href="{{ $linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif

                            @if($email)
                                <a href="mailto:{{ $email }}" aria-label="Email">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- TEAM MEMBER 3 --}}
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/rich.png') }}"
                             alt="{{ $companyName }} team member"
                             class="team-photo"
                             loading="lazy">
                    </div>

                    <div class="team-info">
                        <h4>Chief Associate</h4>
                        <div class="team-role">IT Solutions &amp; Consulting</div>
                        <p>
                            Helping organisations translate technology needs
                            into practical and sustainable solutions.
                        </p>

                        <div class="team-social">
                            @if($linkedin)
                                <a href="{{ $linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif

                            @if($email)
                                <a href="mailto:{{ $email }}" aria-label="Email">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     HOW WE WORK
================================================================ --}}
<section class="process" id="solutions">
    <div class="container">

        <div class="process-head reveal">
            <h2 class="section-title">
                More than technology. We build solutions that work.
            </h2>
        </div>

        <div class="row g-4 g-lg-5 process-steps">

            <div class="col-lg-3 col-md-6 reveal">
                <div class="step">
                    <div class="step-number">1</div>
                    <h5>Understand</h5>
                    <p>
                        We begin by understanding your organisation,
                        challenges and technology requirements.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="step">
                    <div class="step-number">2</div>
                    <h5>Innovate</h5>
                    <p>
                        We identify modern technologies and ideas that
                        can create measurable value.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="step">
                    <div class="step-number">3</div>
                    <h5>Integrate</h5>
                    <p>
                        We implement solutions that work effectively
                        with your existing operations.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="step">
                    <div class="step-number">4</div>
                    <h5>Elevate</h5>
                    <p>
                        We support continuous improvement as your
                        business grows and technology evolves.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ================================================================
     CTA
================================================================ --}}
<section class="cta-section" id="contact">
    <div class="container">

        <div class="cta-box reveal reveal-scale">
            <div class="row align-items-center g-4">

                <div class="col-lg-8">
                    <h2>Ready to transform your organisation with technology?</h2>

                    <p>
                        Speak with {{ $companyName }} about your next
                        software, cloud, security or IT infrastructure project.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <a href="{{ $email ? 'mailto:' . $email : '#contact' }}" class="btn-ees btn-ees--gold">
                        Contact our team
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>


{{-- ================================================================
     FOOTER
================================================================ --}}
<footer>
    <div class="container">

        <div class="row g-5">

            {{-- Company --}}
            <div class="col-lg-4 reveal">

                <div class="footer-brand">{{ $companyName }}</div>

                <p class="mt-3">{{ $companyDescription }}</p>

                <div class="mt-4">

                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" rel="noopener" class="social-icon" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif

                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif

                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif

                    @if($twitter)
                        <a href="{{ $twitter }}" target="_blank" rel="noopener" class="social-icon" aria-label="X / Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    @endif

                </div>

            </div>

            {{-- Company navigation --}}
            <div class="col-lg-2 col-md-4 reveal">
                <h6>Company</h6>

                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="col-lg-3 col-md-4 reveal">
                <h6>Our Services</h6>

                <ul>
                    <li><a href="#service-software">Software Development</a></li>
                    <li><a href="#service-cloud">Cloud Solutions</a></li>
                    <li><a href="#service-security">IT Security</a></li>
                    <li><a href="#service-consulting">IT Consulting</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-3 col-md-4 reveal">
                <h6>Contact</h6>

                @if($address)
                    <div class="contact-line">
                        <i class="bi bi-geo-alt"></i>
                        <span style="color:#cdd8e6;">{{ $address }}</span>
                    </div>
                @endif

                @if($email)
                    <div class="contact-line">
                        <i class="bi bi-envelope"></i>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                @endif

                @if($phone)
                    <div class="contact-line">
                        <i class="bi bi-telephone"></i>
                        <a href="tel:{{ $phoneLink }}">{{ $phone }}</a>
                    </div>
                @endif
            </div>

        </div>

        <div class="footer-bottom">
            <div class="row">
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


{{-- BACK TO TOP --}}
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="bi bi-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.querySelector('.navbar');
        const progress = document.getElementById('scrollProgress');
        const backToTop = document.getElementById('backToTop');
        const revealItems = document.querySelectorAll('.reveal');
        const navLinks = document.querySelectorAll('.navbar .nav-link[href^="#"]');
        const sections = [...document.querySelectorAll('section[id]')];
        const serviceDropdownLinks = document.querySelectorAll('.services-dropdown .dropdown-item[href^="#"]');
        const menu = document.getElementById('mainNavbar');

        /* ---------- Scroll reveal with natural stagger ---------- */
        document.querySelectorAll('.svc-list .reveal, .team-section .reveal-scale, .process-steps .reveal, footer .reveal').forEach((el, i) => {
            el.style.transitionDelay = `${Math.min((i % 4) * 90, 270)}ms`;
        });

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);

                    // Hand hover timing back once the entrance has finished.
                    entry.target.addEventListener('transitionend', function done(e) {
                        if (e.propertyName === 'opacity') {
                            entry.target.style.transitionDelay = '';
                            entry.target.removeEventListener('transitionend', done);
                        }
                    });
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -45px 0px' });

        revealItems.forEach(item => revealObserver.observe(item));

        /* ---------- Scroll-linked UI ---------- */
        let ticking = false;

        const updateOnScroll = () => {
            const y = window.scrollY;
            const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
            const pct = pageHeight > 0 ? (y / pageHeight) * 100 : 0;

            if (progress) progress.style.width = `${pct}%`;

            navbar.classList.toggle('scrolled', y > 30);
            backToTop.classList.toggle('show', y > 520);

            let current = '';
            sections.forEach(section => {
                if (y >= section.offsetTop - 170) current = section.id;
            });

            navLinks.forEach(link => {
                link.classList.toggle('active', link.getAttribute('href') === `#${current}`);
            });

            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                ticking = true;
                window.requestAnimationFrame(updateOnScroll);
            }
        }, { passive: true });

        updateOnScroll();

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        /* ---------- Close mobile navigation after a menu selection ---------- */
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (menu && menu.classList.contains('show')) {
                    bootstrap.Collapse.getOrCreateInstance(menu).hide();
                }
            });
        });

        serviceDropdownLinks.forEach(link => {
            link.addEventListener('click', () => {
                const dropdownToggle = document.getElementById('servicesDropdown');

                if (dropdownToggle) {
                    bootstrap.Dropdown.getOrCreateInstance(dropdownToggle).hide();
                }

                if (menu && menu.classList.contains('show')) {
                    bootstrap.Collapse.getOrCreateInstance(menu).hide();
                }
            });
        });

        /* =========================================================
           HERO SLIDESHOW
           Automatic rotation, dots, arrows, progress, pause/resume
        ========================================================= */
        const heroSlides = Array.from(document.querySelectorAll('.hero-slide'));
        const heroDots = Array.from(document.querySelectorAll('[data-hero-slide]'));
        const heroSteps = Array.from(document.querySelectorAll('[data-hero-step]'));
        const heroProgress = document.getElementById('heroSliderProgress');
        const heroCurrentNumber = document.getElementById('heroCurrentNumber');
        const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

        let heroIndex = 0;
        let heroTimer = null;
        let heroProgressAnimation = null;

        // Duration comes from the database in milliseconds.
        const getHeroDuration = (index) => {
            const slide = heroSlides[index];
            if (!slide) return 7000;

            const duration = Number.parseInt(slide.dataset.duration || '7000', 10);
            if (!Number.isFinite(duration)) return 7000;

            return Math.min(Math.max(duration, 3000), 30000);
        };

        const stopHeroTimer = () => {
            if (heroTimer !== null) {
                window.clearTimeout(heroTimer);
                heroTimer = null;
            }
        };

        const stopHeroProgress = () => {
            if (heroProgressAnimation) {
                try { heroProgressAnimation.cancel(); } catch (error) { /* unsupported */ }
                heroProgressAnimation = null;
            }
        };

        const startHeroProgress = (duration) => {
            if (!heroProgress) return;

            stopHeroProgress();
            heroProgress.style.width = '0%';

            if (reducedMotionQuery.matches) {
                heroProgress.style.width = '100%';
                return;
            }

            if (typeof heroProgress.animate === 'function') {
                heroProgressAnimation = heroProgress.animate(
                    [{ width: '0%' }, { width: '100%' }],
                    { duration: duration, easing: 'linear', fill: 'forwards' }
                );
                return;
            }

            // Fallback for browsers without the Web Animations API.
            heroProgress.style.transition = 'none';
            heroProgress.style.width = '0%';

            window.requestAnimationFrame(() => {
                heroProgress.style.transition = `width ${duration}ms linear`;
                heroProgress.style.width = '100%';
            });
        };

        const updateHeroIndicators = () => {
            heroDots.forEach((dot, index) => {
                const active = index === heroIndex;
                dot.classList.toggle('active', active);
                dot.setAttribute('aria-current', active ? 'true' : 'false');
            });

            if (heroCurrentNumber) {
                heroCurrentNumber.textContent = String(heroIndex + 1).padStart(2, '0');
            }
        };

        const startHeroTimer = () => {
            stopHeroTimer();

            if (heroSlides.length <= 1 || document.hidden) return;

            heroTimer = window.setTimeout(() => {
                showHeroSlide(heroIndex + 1);
            }, getHeroDuration(heroIndex));
        };

        const showHeroSlide = (index) => {
            if (heroSlides.length === 0) return;

            // Wrap around at either end.
            heroIndex = ((index % heroSlides.length) + heroSlides.length) % heroSlides.length;

            heroSlides.forEach((slide, slideIndex) => {
                const active = slideIndex === heroIndex;
                slide.classList.toggle('active', active);
                slide.setAttribute('aria-hidden', active ? 'false' : 'true');
            });

            updateHeroIndicators();
            startHeroProgress(getHeroDuration(heroIndex));
            startHeroTimer();
        };

        heroDots.forEach((dot, index) => {
            dot.addEventListener('click', () => showHeroSlide(index));
        });

        heroSteps.forEach(button => {
            button.addEventListener('click', () => {
                const step = Number.parseInt(button.dataset.heroStep || '1', 10);
                showHeroSlide(heroIndex + step);
            });
        });

        // Pause while the tab is hidden, resume on return.
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopHeroTimer();

                if (heroProgressAnimation) {
                    try { heroProgressAnimation.pause(); } catch (error) { /* ignore */ }
                }

                return;
            }

            if (heroSlides.length > 1) {
                if (heroProgressAnimation) {
                    try { heroProgressAnimation.play(); } catch (error) { /* ignore */ }
                }

                startHeroTimer();
            }
        });

        if (typeof reducedMotionQuery.addEventListener === 'function') {
            reducedMotionQuery.addEventListener('change', () => {
                if (heroSlides.length > 0) startHeroProgress(getHeroDuration(heroIndex));
            });
        }

        if (heroSlides.length > 0) showHeroSlide(0);
    });
</script>

<script>
    (function () {
        const preloader = document.getElementById('ees-preloader');
        if (!preloader) return;

        let dismissed = false;
        let fallbackTimer;

        function dismissPreloader() {
            if (dismissed) return;
            dismissed = true;
            window.clearTimeout(fallbackTimer);
            preloader.classList.add('is-loaded');
            document.body.classList.remove('preloader-active');
            window.setTimeout(() => { if (preloader.isConnected) preloader.remove(); }, 750);
        }

        if (document.readyState === 'complete') {
            window.requestAnimationFrame(dismissPreloader);
        } else {
            window.addEventListener('load', dismissPreloader, { once: true });
        }

        fallbackTimer = window.setTimeout(dismissPreloader, 8000);
    })();
</script>

</body>
</html>