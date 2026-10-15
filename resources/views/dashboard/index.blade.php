<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EES Technologies Ghana | IT Solutions</title>

    <meta name="description"
          content="EES Technologies Ghana provides software development, cloud solutions, IT security, IT consulting and digital transformation services.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --ees-navy: #05285b;
            --ees-dark: #031b3f;
            --ees-blue: #0878d1;
            --ees-light-blue: #1e9cf0;
            --ees-light: #f5f9fd;
            --ees-text: #17324d;
            --ees-muted: #6c8092;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: var(--ees-text);
            background: #fff;
        }

        a { text-decoration: none; }

        /* NAVBAR */
        .navbar {
            padding: 17px 0;
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 30px rgba(0,40,90,.08);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--ees-navy) !important;
            line-height: 1.05;
        }

        .navbar-brand span { color: var(--ees-blue); }

        .brand-small {
            display: block;
            font-size: .59rem;
            letter-spacing: 2px;
            font-weight: 600;
            color: #71859a;
            margin-top: 4px;
        }

        .navbar .nav-link {
            color: #24425e;
            font-weight: 600;
            margin: 0 7px;
            transition: .3s;
        }

        .navbar .nav-link:hover { color: var(--ees-blue); }

        .nav-cta {
            background: var(--ees-blue);
            color: white !important;
            padding: 11px 21px !important;
            border-radius: 8px;
        }

        .nav-cta:hover {
            background: var(--ees-navy);
            transform: translateY(-2px);
        }

        /* HERO */
        .hero {
            min-height: 88vh;
            padding: 125px 0 75px;
            display: flex;
            align-items: center;
            background:
                radial-gradient(circle at 12% 20%, rgba(8,120,209,.09), transparent 34%),
                linear-gradient(135deg,#fff 0%,#f7fbff 65%,#eef7ff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 430px;
            height: 430px;
            border-radius: 50%;
            background: rgba(12,126,211,.06);
            top: -170px;
            left: -130px;
        }

        .hero-content { position: relative; z-index: 2; }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 16px;
            border-radius: 50px;
            color: var(--ees-blue);
            background: rgba(8,120,209,.09);
            font-size: .86rem;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .hero h1 {
            color: var(--ees-navy);
            font-size: clamp(2.6rem,5vw,4.7rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
        }

        .hero h1 span { color: var(--ees-blue); }

        .hero-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #62788e;
            max-width: 630px;
            margin-top: 24px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 34px;
        }

        .btn-primary-custom {
            display: inline-block;
            background: linear-gradient(135deg,var(--ees-blue),#045da7);
            color: #fff;
            padding: 14px 28px;
            border-radius: 9px;
            font-weight: 700;
            border: 0;
            box-shadow: 0 10px 30px rgba(8,120,209,.25);
            transition: .3s;
        }

        .btn-primary-custom:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(8,120,209,.33);
        }

        .btn-outline-custom {
            display: inline-block;
            padding: 13px 28px;
            border-radius: 9px;
            border: 2px solid var(--ees-navy);
            color: var(--ees-navy);
            font-weight: 700;
            transition: .3s;
        }

        .btn-outline-custom:hover {
            background: var(--ees-navy);
            color: #fff;
        }

        .hero-image-wrapper {
            position: relative;
            z-index: 2;
        }

        .hero-image {
            width: 100%;
            border-radius: 26px;
            box-shadow: 0 30px 70px rgba(2,35,75,.24);
            transition: .4s;
        }

        .hero-image:hover { transform: translateY(-5px); }

        /* TRUST BAR */
        .trust-bar {
            background: var(--ees-navy);
            color: #fff;
            padding: 25px 0;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trust-item i {
            color: #49b6ff;
            font-size: 1.5rem;
        }

        .trust-item span {
            font-size: .9rem;
            font-weight: 600;
        }

        /* GLOBAL SECTIONS */
        section { padding: 95px 0; }

        .section-label {
            color: var(--ees-blue);
            text-transform: uppercase;
            font-size: .78rem;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .section-title {
            color: var(--ees-navy);
            font-size: clamp(2rem,4vw,3rem);
            font-weight: 800;
            margin: 10px 0 18px;
        }

        .section-description {
            color: var(--ees-muted);
            font-size: 1.04rem;
            line-height: 1.8;
            max-width: 720px;
        }

        /* SERVICES */
        .services { background: #fff; }

        .service-card {
            height: 100%;
            padding: 34px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e9f0f6;
            box-shadow: 0 10px 35px rgba(3,40,91,.06);
            transition: .35s;
        }

        .service-card:hover {
            transform: translateY(-9px);
            box-shadow: 0 20px 50px rgba(3,40,91,.12);
            border-color: rgba(8,120,209,.25);
        }

        .service-icon {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,rgba(8,120,209,.13),rgba(8,120,209,.04));
            color: var(--ees-blue);
            font-size: 1.8rem;
            margin-bottom: 24px;
        }

        .service-card h4 {
            font-size: 1.2rem;
            color: var(--ees-navy);
            font-weight: 750;
            margin-bottom: 14px;
        }

        .service-card p {
            color: #708497;
            line-height: 1.7;
            font-size: .95rem;
        }

        .service-link {
            color: var(--ees-blue);
            font-weight: 700;
            font-size: .9rem;
        }

        /* ABOUT */
        .about { background: var(--ees-light); }

        .about-box {
            background: var(--ees-navy);
            min-height: 480px;
            border-radius: 28px;
            padding: 50px;
            color: #fff;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .about-box::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border: 70px solid rgba(255,255,255,.05);
            border-radius: 50%;
            top: -170px;
            right: -130px;
        }

        .about-box-content {
            position: relative;
            z-index: 2;
        }

        .about-box h3 {
            font-weight: 800;
            font-size: 2rem;
        }

        .about-box p {
            color: rgba(255,255,255,.72);
            line-height: 1.8;
        }

        .about-check {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            color: #526a7d;
        }

        .about-check i {
            color: var(--ees-blue);
            font-size: 1.25rem;
        }

        /* TEAM */
        .team-section {
            background: #fff;
        }

        .team-card {
            height: 100%;
            background: #fff;
            border: 1px solid #e7eef5;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(3,40,91,.07);
            transition: .35s;
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 50px rgba(3,40,91,.13);
        }

        .team-photo-wrapper {
            position: relative;
            padding: 24px 24px 0;
            background:
                linear-gradient(135deg,#f4f9fe 0%,#eaf4fd 100%);
        }

        .team-photo {
            display: block;
            width: 100%;
            height: 330px;
            object-fit: cover;
            object-position: center top;
            border-radius: 16px 16px 0 0;
        }

        .team-info {
            padding: 24px;
            text-align: center;
        }

        .team-info h4 {
            color: var(--ees-navy);
            font-size: 1.18rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .team-role {
            color: var(--ees-blue);
            font-size: .84rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 13px;
        }

        .team-info p {
            color: #708497;
            font-size: .92rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 18px;
        }

        .team-social a {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ees-navy);
            background: #eef6fc;
            transition: .3s;
        }

        .team-social a:hover {
            background: var(--ees-blue);
            color: #fff;
        }

        /* WHY US */
        .why-card { padding: 24px 10px; }

        .why-number {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--ees-navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .why-card h5 {
            color: var(--ees-navy);
            font-weight: 750;
        }

        .why-card p {
            color: #708497;
            line-height: 1.7;
        }

        /* CTA */
        .cta-section { padding: 70px 0; }

        .cta-box {
            border-radius: 28px;
            padding: 65px 55px;
            color: #fff;
            background:
                radial-gradient(circle at 90% 30%,rgba(39,165,247,.35),transparent 30%),
                linear-gradient(135deg,#031b3f,#07589e);
            position: relative;
            overflow: hidden;
        }

        .cta-box h2 {
            font-weight: 800;
            font-size: clamp(2rem,4vw,3rem);
        }

        .cta-box p {
            color: rgba(255,255,255,.78);
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .btn-white {
            display: inline-block;
            background: #fff;
            color: var(--ees-navy);
            padding: 14px 28px;
            font-weight: 700;
            border-radius: 9px;
        }

        .btn-white:hover {
            background: #eaf5ff;
            color: var(--ees-navy);
        }

        /* FOOTER */
        footer {
            background: #02152f;
            color: #fff;
            padding: 75px 0 25px;
        }

        .footer-brand {
            font-weight: 800;
            font-size: 1.6rem;
        }

        footer p {
            color: #91a3b7;
            line-height: 1.8;
        }

        footer h6 {
            font-weight: 750;
            margin-bottom: 22px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li { margin-bottom: 12px; }

        footer ul li a {
            color: #91a3b7;
            transition: .3s;
        }

        footer ul li a:hover { color: #fff; }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            background: rgba(255,255,255,.08);
            display: inline-flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            margin-right: 7px;
        }

        .social-icon:hover {
            background: var(--ees-blue);
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.09);
            margin-top: 45px;
            padding-top: 25px;
            color: #71889f;
            font-size: .88rem;
        }

        @media (max-width: 991px) {
            .hero { padding-top: 130px; }
            .hero-image-wrapper { margin-top: 50px; }
            .about-box { margin-bottom: 40px; }
        }

        @media (max-width: 576px) {
            section { padding: 70px 0; }

            .hero { min-height: auto; }

            .hero h1 {
                font-size: 2.65rem;
                letter-spacing: -1px;
            }

            .hero-description { font-size: 1rem; }

            .hero-buttons a {
                width: 100%;
                text-align: center;
            }

            .about-box {
                padding: 32px;
                min-height: 380px;
            }

            .team-photo { height: 300px; }

            .cta-box { padding: 45px 25px; }
        }


        /* =========================
           PREMIUM MOTION SYSTEM
        ========================== */
        :root {
            --ease-premium: cubic-bezier(.22,1,.36,1);
            --ease-soft: cubic-bezier(.4,0,.2,1);
        }

        body {
            overflow-x: hidden;
        }

        .navbar {
            transition: padding .35s var(--ease-soft),
                        box-shadow .35s var(--ease-soft),
                        background .35s var(--ease-soft),
                        transform .35s var(--ease-soft);
        }

        .navbar.scrolled {
            padding: 10px 0;
            background: rgba(255,255,255,.93);
            box-shadow: 0 10px 35px rgba(0,40,90,.12);
        }

        .navbar .nav-link {
            position: relative;
        }

        .navbar .nav-link:not(.nav-cta)::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 2px;
            width: 0;
            height: 2px;
            background: var(--ees-blue);
            border-radius: 999px;
            transform: translateX(-50%);
            transition: width .3s var(--ease-premium);
        }

        .navbar .nav-link:not(.nav-cta):hover::after,
        .navbar .nav-link.active:not(.nav-cta)::after {
            width: 68%;
        }

        .hero {
            isolation: isolate;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 620px;
            height: 620px;
            right: -240px;
            bottom: -260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30,156,240,.14), transparent 68%);
            animation: heroOrb 9s ease-in-out infinite alternate;
            z-index: 0;
        }

        @keyframes heroOrb {
            from { transform: translate3d(0,0,0) scale(1); }
            to   { transform: translate3d(-35px,-25px,0) scale(1.08); }
        }

        .hero-badge {
            animation: badgeFloat 4s ease-in-out infinite;
        }

        @keyframes badgeFloat {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .hero h1 span {
            position: relative;
            display: inline-block;
        }

        .hero h1 span::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -7px;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, rgba(8,120,209,.22), rgba(30,156,240,.04));
            border-radius: 999px;
            transform: scaleX(0);
            transform-origin: left;
            animation: underlineReveal 1s .9s var(--ease-premium) forwards;
        }

        @keyframes underlineReveal {
            to { transform: scaleX(1); }
        }

        .hero-image-wrapper::before,
        .hero-image-wrapper::after {
            content: "";
            position: absolute;
            border-radius: 22px;
            z-index: -1;
        }

        .hero-image-wrapper::before {
            inset: 28px -18px -18px 30px;
            border: 1px solid rgba(8,120,209,.18);
            background: rgba(8,120,209,.05);
            transform: rotate(2.5deg);
        }

        .hero-image-wrapper::after {
            width: 110px;
            height: 110px;
            right: -24px;
            top: -24px;
            background-image: radial-gradient(rgba(8,120,209,.28) 1.3px, transparent 1.3px);
            background-size: 12px 12px;
            opacity: .75;
        }

        .hero-image {
            will-change: transform;
            animation: heroImageIn 1.05s .18s var(--ease-premium) both;
        }

        @keyframes heroImageIn {
            from { opacity: 0; transform: translate3d(45px,18px,0) scale(.97); }
            to   { opacity: 1; transform: translate3d(0,0,0) scale(1); }
        }

        .hero .col-lg-6:first-child > * {
            opacity: 0;
            transform: translateY(24px);
            animation: heroTextIn .8s var(--ease-premium) forwards;
        }

        .hero .col-lg-6:first-child > *:nth-child(1) { animation-delay: .08s; }
        .hero .col-lg-6:first-child > *:nth-child(2) { animation-delay: .2s; }
        .hero .col-lg-6:first-child > *:nth-child(3) { animation-delay: .34s; }
        .hero .col-lg-6:first-child > *:nth-child(4) { animation-delay: .48s; }

        @keyframes heroTextIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-primary-custom,
        .btn-outline-custom,
        .btn-white,
        .nav-cta {
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .btn-primary-custom::before,
        .btn-white::before,
        .nav-cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 20%, rgba(255,255,255,.28) 45%, transparent 70%);
            transform: translateX(-140%);
            transition: transform .7s var(--ease-premium);
            z-index: -1;
        }

        .btn-primary-custom:hover::before,
        .btn-white:hover::before,
        .nav-cta:hover::before {
            transform: translateX(140%);
        }

        .trust-item {
            transition: transform .3s var(--ease-premium), opacity .3s ease;
        }

        .trust-item:hover {
            transform: translateY(-4px);
        }

        .trust-item i {
            transition: transform .35s var(--ease-premium);
        }

        .trust-item:hover i {
            transform: scale(1.14) rotate(-5deg);
        }

        .service-card,
        .team-card,
        .why-card,
        .about-box,
        .cta-box {
            will-change: transform;
        }

        .service-card {
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(8,120,209,.055), transparent 52%);
            opacity: 0;
            transition: opacity .35s ease;
        }

        .service-card:hover::before { opacity: 1; }

        .service-icon {
            transition: transform .4s var(--ease-premium),
                        background .4s var(--ease-premium),
                        color .4s var(--ease-premium);
        }

        .service-card:hover .service-icon {
            transform: translateY(-4px) rotate(-4deg) scale(1.06);
            background: var(--ees-blue);
            color: #fff;
        }

        .service-link i,
        .btn-primary-custom i,
        .btn-white i {
            display: inline-block;
            transition: transform .3s var(--ease-premium);
        }

        .service-link:hover i,
        .btn-primary-custom:hover i,
        .btn-white:hover i {
            transform: translateX(5px);
        }

        .about-box::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(115deg, transparent 20%, rgba(255,255,255,.12), transparent 70%);
            transform: translateX(-120%);
            animation: aboutSweep 7s ease-in-out infinite;
        }

        @keyframes aboutSweep {
            0%, 35% { transform: translateX(-120%); }
            60%,100% { transform: translateX(120%); }
        }

        .about-check {
            transition: transform .3s var(--ease-premium), color .3s ease;
        }

        .about-check:hover {
            transform: translateX(8px);
            color: var(--ees-navy);
        }

        .team-photo {
            transition: transform .65s var(--ease-premium), filter .45s ease;
        }

        .team-card:hover .team-photo {
            transform: scale(1.045);
            filter: saturate(1.05) contrast(1.02);
        }

        .team-social a {
            transition: transform .3s var(--ease-premium), background .3s ease, color .3s ease;
        }

        .team-social a:hover {
            transform: translateY(-4px) rotate(3deg);
        }

        .why-card {
            border-radius: 18px;
            transition: transform .35s var(--ease-premium), background .35s ease, box-shadow .35s ease;
        }

        .why-card:hover {
            transform: translateY(-8px);
            background: #fff;
            box-shadow: 0 18px 45px rgba(3,40,91,.08);
        }

        .why-number {
            position: relative;
            transition: transform .35s var(--ease-premium), background .35s ease;
        }

        .why-card:hover .why-number {
            transform: scale(1.08) rotate(-6deg);
            background: var(--ees-blue);
        }

        .cta-box::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 50%;
            left: -100px;
            bottom: -130px;
            animation: ctaPulse 5s ease-in-out infinite;
        }

        @keyframes ctaPulse {
            0%,100% { transform: scale(1); opacity: .55; }
            50% { transform: scale(1.12); opacity: 1; }
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translate3d(0,34px,0);
            transition:
                opacity .8s var(--ease-premium),
                transform .8s var(--ease-premium);
        }

        .reveal.reveal-left { transform: translate3d(-45px,0,0); }
        .reveal.reveal-right { transform: translate3d(45px,0,0); }
        .reveal.reveal-scale { transform: scale(.94); }

        .reveal.is-visible {
            opacity: 1;
            transform: translate3d(0,0,0) scale(1);
        }

        .reveal-delay-1 { transition-delay: .08s; }
        .reveal-delay-2 { transition-delay: .16s; }
        .reveal-delay-3 { transition-delay: .24s; }
        .reveal-delay-4 { transition-delay: .32s; }

        /* subtle page progress indicator */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0;
            background: linear-gradient(90deg, var(--ees-blue), var(--ees-light-blue));
            z-index: 2000;
            box-shadow: 0 0 12px rgba(30,156,240,.5);
        }

        /* floating back-to-top button */
        .back-to-top {
            position: fixed;
            right: 22px;
            bottom: 22px;
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 50%;
            background: var(--ees-navy);
            color: #fff;
            display: grid;
            place-items: center;
            box-shadow: 0 12px 30px rgba(3,40,91,.22);
            opacity: 0;
            visibility: hidden;
            transform: translateY(14px);
            transition: .35s var(--ease-premium);
            z-index: 1200;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            background: var(--ees-blue);
            transform: translateY(-4px);
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .001ms !important;
                scroll-behavior: auto !important;
            }
        }

    </style>
</head>

<body>

<div class="scroll-progress" id="scrollProgress"></div>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <a class="navbar-brand" href="/">
            eeS <span>Technologies Ghana</span>
            <small class="brand-small">INNOVATE • INTEGRATE • ELEVATE</small>
        </a>

        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#team">Our Team</a></li>
                <li class="nav-item"><a class="nav-link" href="#solutions">Solutions</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="nav-link nav-cta" href="#contact">Get a Quote</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
    <div class="container hero-content">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Your Trusted IT Solutions Partner
                </div>

                <h1>
                    Technology that helps your
                    <span>business move forward.</span>
                </h1>

                <p class="hero-description">
                    EES Technologies Ghana provides innovative and reliable
                    technology solutions that help organisations improve
                    efficiency, strengthen security and accelerate digital
                    transformation.
                </p>

                <div class="hero-buttons">
                    <a href="#services" class="btn-primary-custom">
                        Explore Our Services
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                    <a href="#team" class="btn-outline-custom">
                        Meet Our Team
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('img/ees-tech-hero.jpeg') }}"
                         alt="EES Technologies Ghana"
                         class="hero-image">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-3 col-6">
                <div class="trust-item">
                    <i class="bi bi-code-slash"></i>
                    <span>Software Development</span>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="trust-item">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <span>Cloud Solutions</span>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="trust-item">
                    <i class="bi bi-shield-lock"></i>
                    <span>IT Security</span>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="trust-item">
                    <i class="bi bi-bar-chart"></i>
                    <span>IT Consulting</span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SERVICES -->
<section class="services" id="services">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-label">What We Do</span>

            <h2 class="section-title">
                Technology solutions built for your organisation
            </h2>

            <p class="section-description mx-auto">
                From custom software to cloud infrastructure and cybersecurity,
                we provide practical technology solutions designed around your
                organisation's goals.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6 reveal">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-code-square"></i>
                    </div>
                    <h4>Software Development</h4>
                    <p>
                        Custom web applications, management systems and digital
                        platforms designed to solve real business problems.
                    </p>
                    <a href="#contact" class="service-link">
                        Learn more <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-cloud-check"></i>
                    </div>
                    <h4>Cloud Solutions</h4>
                    <p>
                        Modern cloud infrastructure, migrations, hosting and
                        scalable digital services for growing organisations.
                    </p>
                    <a href="#contact" class="service-link">
                        Learn more <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>IT Security</h4>
                    <p>
                        Protect your systems, networks and business information
                        with modern cybersecurity practices and controls.
                    </p>
                    <a href="#contact" class="service-link">
                        Learn more <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4>IT Consulting</h4>
                    <p>
                        Strategic technology guidance that helps your organisation
                        select, implement and optimise the right IT solutions.
                    </p>
                    <a href="#contact" class="service-link">
                        Learn more <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6 reveal reveal-left">
                <div class="about-box">
                    <div class="about-box-content">

                        <span class="section-label text-info">
                            EES Technologies Ghana
                        </span>

                        <h3 class="mt-3">
                            Innovate. Integrate. Elevate.
                        </h3>

                        <p class="mt-3 mb-0">
                            We combine technology, experience and innovation
                            to develop solutions that empower organisations
                            to operate smarter and achieve more.
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal reveal-right">

                <span class="section-label">About Us</span>

                <h2 class="section-title">
                    Your technology partner for a digital future
                </h2>

                <p class="section-description">
                    EES Technologies Ghana is an IT solutions company focused
                    on helping businesses and institutions use technology more
                    effectively.
                </p>

                <p class="section-description">
                    Our approach combines innovation with practical
                    implementation, giving our clients solutions that are
                    secure, scalable and aligned with their objectives.
                </p>

                <div class="mt-4">

                    <div class="about-check">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Solutions tailored to your organisation</span>
                    </div>

                    <div class="about-check">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Reliable technical support and guidance</span>
                    </div>

                    <div class="about-check">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Modern, secure and scalable technologies</span>
                    </div>

                    <div class="about-check">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Long-term technology partnerships</span>
                    </div>

                </div>

                <a href="#contact" class="btn-primary-custom mt-3">
                    Learn More About Us
                </a>

            </div>

        </div>
    </div>
</section>

<!-- OUR TEAM -->
<section class="team-section" id="team">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-label">Meet The Team</span>

            <h2 class="section-title">
                The people behind EES Technologies
            </h2>

            <p class="section-description mx-auto">
                Our team brings together technology, creativity and practical
                business thinking to deliver solutions that create value for
                our clients.
            </p>
        </div>

        <div class="row g-4 justify-content-center">


            <!-- TEAM MEMBER 1 -->
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/el.png') }}"
                             alt="EES Technologies team member"
                             class="team-photo">
                    </div>

                    <div class="team-info">
                        <h4>CEO</h4>
                        <div class="team-role">Technology & Development</div>

                        <p>
                            Focused on software engineering, digital systems
                            and innovative technology solutions.
                        </p>

                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" aria-label="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- TEAM MEMBER 2 -->
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/sey.png') }}"
                             alt="EES Technologies team member"
                             class="team-photo">
                    </div>

                    <div class="team-info">
                        <h4>COO</h4>
                        <div class="team-role">Leadership & Strategy</div>

                        <p>
                            Driving organisational direction, client
                            relationships and technology strategy.
                        </p>

                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" aria-label="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            

            <!-- TEAM MEMBER 3 -->
            <div class="col-lg-4 col-md-6 reveal reveal-scale">
                <div class="team-card">

                    <div class="team-photo-wrapper">
                        <img src="{{ asset('img/rich.png') }}"
                             alt="EES Technologies team member"
                             class="team-photo">
                    </div>

                    <div class="team-info">
                        <h4>Chief Associate</h4>
                        <div class="team-role">IT Solutions & Consulting</div>

                        <p>
                            Helping organisations translate technology needs
                            into practical and sustainable solutions.
                        </p>

                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" aria-label="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section id="solutions">
    <div class="container">

        <div class="row mb-5 reveal">
            <div class="col-lg-7">

                <span class="section-label">
                    Why EES Technologies
                </span>

                <h2 class="section-title">
                    More than technology. We build solutions that work.
                </h2>

            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6 reveal">
                <div class="why-card">
                    <div class="why-number">01</div>
                    <h5>Understand</h5>
                    <p>
                        We begin by understanding your organisation,
                        challenges and technology requirements.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="why-card">
                    <div class="why-number">02</div>
                    <h5>Innovate</h5>
                    <p>
                        We identify modern technologies and ideas that
                        can create measurable value.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="why-card">
                    <div class="why-number">03</div>
                    <h5>Integrate</h5>
                    <p>
                        We implement solutions that work effectively
                        with your existing operations.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="why-card">
                    <div class="why-number">04</div>
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

<!-- CTA -->
<section class="cta-section" id="contact">
    <div class="container">

        <div class="cta-box reveal reveal-scale">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <span class="section-label text-info">
                        Let's Work Together
                    </span>

                    <h2 class="mt-3">
                        Ready to transform your organisation with technology?
                    </h2>

                    <p class="mt-3 mb-lg-0">
                        Speak with EES Technologies Ghana about your next
                        software, cloud, security or IT infrastructure project.
                    </p>

                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    <a href="mailto:info@eestechnologies.com"
                       class="btn-white">
                        Contact Our Team
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                </div>

            </div>

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">

        <div class="row g-5">

            <div class="col-lg-4 reveal">

                <div class="footer-brand">
                    eeS Technologies Ghana
                </div>

                <p class="mt-3">
                    Innovative technology solutions designed to help
                    organisations grow, operate efficiently and succeed
                    in a rapidly evolving digital world.
                </p>

                <div class="mt-4">

                    <a href="#" class="social-icon">
                        <i class="bi bi-linkedin"></i>
                    </a>

                    <a href="#" class="social-icon">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" class="social-icon">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" class="social-icon">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                </div>
            </div>

            <div class="col-lg-2 col-md-4 reveal reveal-delay-1">
                <h6>Company</h6>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 reveal reveal-delay-2">
                <h6>Our Services</h6>
                <ul>
                    <li><a href="#services">Software Development</a></li>
                    <li><a href="#services">Cloud Solutions</a></li>
                    <li><a href="#services">IT Security</a></li>
                    <li><a href="#services">IT Consulting</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 reveal reveal-delay-2">
                <h6>Contact</h6>

                <p>
                    <i class="bi bi-geo-alt me-2"></i>
                    Ghana
                </p>

                <p>
                    <i class="bi bi-envelope me-2"></i>
                    info@eestechnologies.com
                </p>

                <p>
                    <i class="bi bi-telephone me-2"></i>
                    +233 542 013 350
                </p>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="row">

                <div class="col-md-6">
                    &copy; {{ date('Y') }} EES Technologies Ghana.
                    All Rights Reserved.
                </div>

                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    Innovate • Integrate • Elevate
                </div>

            </div>
        </div>

    </div>
</footer>

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

        // Give repeated card groups a natural stagger.
        document.querySelectorAll('.services .reveal, .team-section .reveal, #solutions .reveal').forEach((el, i) => {
            el.style.transitionDelay = `${Math.min((i % 4) * 90, 270)}ms`;
        });

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -45px 0px'
        });

        revealItems.forEach(item => revealObserver.observe(item));

        const updateOnScroll = () => {
            const y = window.scrollY;
            const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
            const pct = pageHeight > 0 ? (y / pageHeight) * 100 : 0;

            progress.style.width = `${pct}%`;
            navbar.classList.toggle('scrolled', y > 30);
            backToTop.classList.toggle('show', y > 520);

            let current = '';
            sections.forEach(section => {
                if (y >= section.offsetTop - 170) current = section.id;
            });

            navLinks.forEach(link => {
                link.classList.toggle('active', link.getAttribute('href') === `#${current}`);
            });
        };

        window.addEventListener('scroll', updateOnScroll, { passive: true });
        updateOnScroll();

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Close mobile navigation after a menu selection.
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const menu = document.getElementById('mainNavbar');
                if (menu && menu.classList.contains('show')) {
                    bootstrap.Collapse.getOrCreateInstance(menu).hide();
                }
            });
        });

        // Gentle pointer parallax on the hero image (desktop only).
        const hero = document.querySelector('.hero');
        const heroImage = document.querySelector('.hero-image');
        if (hero && heroImage && window.matchMedia('(pointer:fine)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            hero.addEventListener('mousemove', (e) => {
                const rect = hero.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width - .5) * 10;
                const y = ((e.clientY - rect.top) / rect.height - .5) * 8;
                heroImage.style.transform = `translate3d(${x}px, ${y}px, 0) scale(1.01)`;
            });
            hero.addEventListener('mouseleave', () => {
                heroImage.style.transform = '';
            });
        }
    });
</script>

</body>
</html>
