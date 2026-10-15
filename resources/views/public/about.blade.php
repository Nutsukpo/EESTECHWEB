@extends('layouts.public')

@section('title', 'About Us | EES Technologies Ghana')

@section('content')

<div class="ees-about">

    {{-- HERO --}}
    <section class="ees-hero" aria-labelledby="about-heading">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-5">
                    <div class="ees-hero__copy">
                        <p class="ees-kicker">
                            {{ $about?->subtitle ?: 'About EES Technologies Ghana' }}
                        </p>

                        <h1 id="about-heading">
                            {{ $about?->title ?? 'Pioneering the next wave of digital innovation.' }}
                        </h1>

                        @if($about?->description)
                            <p class="ees-lead">{{ $about->description }}</p>
                        @else
                            <p class="ees-lead">
                                EES Technologies Ghana builds reliable, secure and practical digital
                                solutions that help organisations work more efficiently, strengthen
                                their operations and move confidently into the digital age.
                            </p>
                        @endif

                        <div class="ees-hero__actions">
                            <a href="#team" class="ees-btn ees-btn--solid">
                                Meet the team
                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/#contact') }}" class="ees-btn ees-btn--ghost">
                                Work with us
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="ees-hero__visual">
                        <figure class="ees-hero__frame">
                            <img
                                src="{{ $about?->image ? asset('storage/' . $about->image) : asset('img/ees-tech-hero.jpeg') }}"
                                alt="The EES Technologies Ghana team collaborating in a technology workspace"
                                fetchpriority="high"
                            >
                        </figure>

                        <div class="ees-hero__chip">
                            <span class="ees-pulse" aria-hidden="true"></span>
                            Based in Accra, serving Africa
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- WHO WE ARE --}}
    @if($about?->description_two)
        <section class="ees-story">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="ees-story__title">Your technology partner for a digital future</h2>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <p class="ees-story__body">{{ $about->description_two }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- MISSION AND VISION --}}
    <section class="ees-purpose" aria-label="Our mission and vision">
        <div class="container">
            <div class="ees-purpose__panel">
                <div class="row g-0">

                    <article class="col-lg-6 ees-purpose__item">
                        <span class="ees-purpose__icon"><i class="fas fa-bullseye" aria-hidden="true"></i></span>
                        <p class="ees-purpose__label">Our mission</p>
                        <h2>{{ $about?->mission_title ?? 'Our Mission' }}</h2>
                        <p>{{ $about?->mission ?? 'To deliver reliable, secure and practical technology solutions that help organisations work smarter and grow.' }}</p>
                    </article>

                    <article class="col-lg-6 ees-purpose__item ees-purpose__item--divided">
                        <span class="ees-purpose__icon"><i class="fas fa-eye" aria-hidden="true"></i></span>
                        <p class="ees-purpose__label">Our vision</p>
                        <h2>{{ $about?->vision_title ?? 'Our Vision' }}</h2>
                        <p>{{ $about?->vision ?? 'To be a trusted technology partner advancing digital innovation for businesses, schools and communities.' }}</p>
                    </article>

                </div>
            </div>
        </div>
    </section>

    {{-- TEAM --}}
    <section class="ees-team" id="team" aria-labelledby="team-heading">
        <div class="container">

            <div class="ees-team__head">
                <h2 id="team-heading">The people behind EES-Tech</h2>
                <p>
                    Engineers, designers and strategists working together to turn
                    technology into results for the organisations we serve.
                </p>
            </div>

            <div class="row g-4 g-xl-5">
                @forelse($teamMembers as $member)
                    <div class="col-lg-4 col-md-6">
                        <article class="ees-member">

                            <div class="ees-member__photo">
                                @if($member->photo)
                                    <img
                                        src="{{ asset('storage/' . $member->photo) }}"
                                        alt="{{ $member->name }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="ees-member__placeholder">
                                        <i class="fas fa-user" aria-hidden="true"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="ees-member__info">
                                <h3>{{ $member->name }}</h3>
                                <p class="ees-member__role">
                                    {{ $member->position }}@if($member->department), {{ $member->department }}@endif
                                </p>

                                @if($member->description)
                                    <p class="ees-member__bio">{{ $member->description }}</p>
                                @endif

                                @if($member->linkedin_url || $member->facebook_url || $member->instagram_url)
                                    <div class="ees-member__socials">
                                        @if($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member->name }} on LinkedIn">
                                                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        @if($member->facebook_url)
                                            <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member->name }} on Facebook">
                                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        @if($member->instagram_url)
                                            <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member->name }} on Instagram">
                                                <i class="fab fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>

                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ees-team__empty">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <h3>Our team profiles are on the way</h3>
                            <p>Check back soon to meet the people behind EES-Tech.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- CALL TO ACTION --}}
    <section class="ees-cta">
        <div class="container">
            <div class="ees-cta__panel">
                <h2>Ready to transform your organisation with technology?</h2>
                <div class="ees-cta__side">
                    <p>
                        Tell us what you want to improve. We'll help you build secure,
                        scalable technology that fits how you work.
                    </p>
                    <a href="{{ url('/#contact') }}" class="ees-btn ees-btn--light">
                        Start a conversation
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap');

    .ees-about {
        --navy: #061b3d;
        --navy-2: #0a2a5c;
        --blue: #0878d1;
        --blue-soft: #e7f2fc;
        --gold: #e9b13a;
        --paper: #f6f8fb;
        --ink: #0d1b2e;
        --muted: #56637a;
        --line: #dde4ee;

        --font-display: 'Bricolage Grotesque', 'Figtree', system-ui, sans-serif;
        --font-body: 'Figtree', system-ui, -apple-system, 'Segoe UI', sans-serif;

        font-family: var(--font-body);
        color: var(--ink);
        overflow: clip;
    }

    .ees-about .container {
        max-width: 1280px;
    }

    .ees-about h1,
    .ees-about h2,
    .ees-about h3 {
        font-family: var(--font-display);
        color: var(--navy);
        margin: 0;
    }

    .ees-about a:focus-visible {
        outline: 3px solid var(--blue);
        outline-offset: 3px;
    }

    /* ---------- Shared pieces ---------- */
    .ees-kicker {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 22px;
        color: var(--blue);
        font-size: 15px;
        font-weight: 700;
    }

    .ees-kicker::before {
        content: "";
        width: 28px;
        height: 3px;
        border-radius: 2px;
        background: var(--gold);
    }

    .ees-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 50px;
        padding: 12px 24px;
        border: 2px solid transparent;
        border-radius: 999px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .ees-btn i {
        font-size: 13px;
    }

    .ees-btn--solid {
        color: #fff;
        background: var(--blue);
        border-color: var(--blue);
    }

    .ees-btn--solid:hover {
        color: #fff;
        background: var(--navy);
        border-color: var(--navy);
    }

    .ees-btn--ghost {
        color: var(--navy);
        border-color: var(--navy);
    }

    .ees-btn--ghost:hover {
        color: #fff;
        background: var(--navy);
    }

    .ees-btn--light {
        color: var(--navy);
        background: #fff;
    }

    .ees-btn--light:hover {
        color: var(--navy);
        background: var(--gold);
    }

    /* ---------- Hero ---------- */
    .ees-hero {
        padding: clamp(40px, 6vw, 88px) 0 clamp(48px, 6vw, 80px);
        background:
            linear-gradient(180deg, var(--paper) 0%, #fff 100%);
    }

    .ees-hero .row {
        --bs-gutter-x: clamp(28px, 5vw, 80px);
        --bs-gutter-y: 40px;
    }

    .ees-hero__copy {
        max-width: 560px;
        animation: ees-rise .8s cubic-bezier(.2, .7, .2, 1) both;
    }

    .ees-hero h1 {
        font-size: clamp(40px, 5vw, 72px);
        font-weight: 800;
        line-height: 1.02;
        letter-spacing: -.035em;
        text-wrap: balance;
    }

    .ees-lead {
        max-width: 52ch;
        margin: 24px 0 0;
        color: var(--muted);
        font-size: clamp(16px, 1.3vw, 18px);
        line-height: 1.7;
    }

    .ees-hero__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 34px;
    }

    .ees-hero__visual {
        position: relative;
        padding-bottom: 28px;
        animation: ees-rise .8s .12s cubic-bezier(.2, .7, .2, 1) both;
    }

    /* Image keeps its natural ratio so nothing is cropped. */
    .ees-hero__frame {
        position: relative;
        margin: 0;
        border-radius: 28px 28px 28px 96px;
        overflow: hidden;
        background: var(--blue-soft);
        box-shadow: 0 30px 60px -20px rgba(6, 27, 61, .35);
    }

    .ees-hero__frame img {
        display: block;
        width: 100%;
        height: auto;
    }

    .ees-hero__chip {
        position: absolute;
        right: 24px;
        bottom: 0;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        max-width: calc(100% - 48px);
        padding: 13px 20px;
        color: var(--navy);
        background: #fff;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 14px 34px rgba(6, 27, 61, .18);
    }

    .ees-pulse {
        position: relative;
        width: 10px;
        height: 10px;
        flex: 0 0 10px;
        border-radius: 50%;
        background: #22b45e;
    }

    .ees-pulse::after {
        content: "";
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        border: 2px solid #22b45e;
        opacity: 0;
        animation: ees-ping 2.4s ease-out infinite;
    }

    @keyframes ees-rise {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes ees-ping {
        0%   { opacity: .7; transform: scale(.6); }
        100% { opacity: 0;  transform: scale(1.6); }
    }

    /* ---------- Story ---------- */
    .ees-story {
        padding: clamp(40px, 6vw, 88px) 0;
        background: #fff;
    }

    .ees-story .row {
        --bs-gutter-y: 24px;
    }

    .ees-story__title {
        font-size: clamp(28px, 3vw, 40px);
        font-weight: 700;
        line-height: 1.12;
        letter-spacing: -.025em;
        text-wrap: balance;
    }

    .ees-story__body {
        margin: 0;
        max-width: 62ch;
        color: var(--ink);
        font-size: clamp(18px, 1.7vw, 22px);
        line-height: 1.7;
        font-weight: 500;
    }

    /* ---------- Mission and vision ---------- */
    .ees-purpose {
        padding: clamp(24px, 4vw, 48px) 0 clamp(56px, 7vw, 104px);
        background: #fff;
    }

    .ees-purpose__panel {
        position: relative;
        overflow: hidden;
        border-radius: 32px;
        background:
            radial-gradient(circle at 100% 0%, rgba(8, 120, 209, .45), transparent 45%),
            var(--navy);
        color: #fff;
    }

    .ees-purpose__item {
        padding: clamp(32px, 5vw, 64px);
    }

    .ees-purpose__item--divided {
        border-top: 1px solid rgba(255, 255, 255, .14);
    }

    @media (min-width: 992px) {
        .ees-purpose__item--divided {
            border-top: 0;
            border-left: 1px solid rgba(255, 255, 255, .14);
        }
    }

    .ees-purpose__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        margin-bottom: 28px;
        color: var(--gold);
        background: rgba(255, 255, 255, .08);
        border-radius: 14px;
        font-size: 20px;
    }

    .ees-purpose__label {
        margin: 0 0 10px;
        color: #9cc8f3;
        font-size: 15px;
        font-weight: 600;
    }

    .ees-purpose__item h2 {
        margin-bottom: 16px;
        color: #fff;
        font-size: clamp(28px, 3vw, 40px);
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -.025em;
    }

    .ees-purpose__item > p:last-child {
        max-width: 46ch;
        margin: 0;
        color: rgba(255, 255, 255, .8);
        font-size: 17px;
        line-height: 1.7;
    }

    /* ---------- Team ---------- */
    .ees-team {
        padding: clamp(56px, 7vw, 104px) 0;
        background: var(--paper);
    }

    .ees-team__head {
        max-width: 640px;
        margin: 0 0 clamp(36px, 5vw, 64px);
    }

    .ees-team__head h2 {
        font-size: clamp(32px, 4vw, 52px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
        text-wrap: balance;
    }

    .ees-team__head p {
        margin: 18px 0 0;
        color: var(--muted);
        font-size: 17px;
        line-height: 1.7;
    }

    .ees-member {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .ees-member__photo {
        aspect-ratio: 4 / 5;
        overflow: hidden;
        border-radius: 24px;
        background: #e6ecf4;
    }

    .ees-member__photo img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        object-position: center top;
        transition: transform .6s ease;
    }

    .ees-member:hover .ees-member__photo img {
        transform: scale(1.04);
    }

    .ees-member__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9eacc0;
        font-size: 64px;
    }

    .ees-member__info {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 22px 4px 0;
    }

    .ees-member__info h3 {
        font-size: 24px;
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -.01em;
    }

    .ees-member__role {
        margin: 6px 0 0;
        color: var(--blue);
        font-size: 15px;
        font-weight: 700;
    }

    .ees-member__bio {
        flex: 1;
        margin: 14px 0 0;
        max-width: 48ch;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.65;
    }

    .ees-member__socials {
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .ees-member__socials a {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 50%;
        font-size: 14px;
        text-decoration: none;
        transition: color .2s ease, background-color .2s ease, border-color .2s ease;
    }

    .ees-member__socials a:hover {
        color: #fff;
        background: var(--blue);
        border-color: var(--blue);
    }

    .ees-team__empty {
        padding: 56px 24px;
        text-align: center;
        background: #fff;
        border: 1px dashed var(--line);
        border-radius: 24px;
    }

    .ees-team__empty i {
        margin-bottom: 16px;
        color: #9eacc0;
        font-size: 40px;
    }

    .ees-team__empty h3 {
        font-size: 22px;
        font-weight: 700;
    }

    .ees-team__empty p {
        margin: 8px 0 0;
        color: var(--muted);
    }

    /* ---------- CTA ---------- */
    .ees-cta {
        padding: clamp(56px, 7vw, 104px) 0;
        background: #fff;
    }

    .ees-cta__panel {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: clamp(28px, 5vw, 72px);
        align-items: end;
        padding: clamp(32px, 6vw, 72px);
        border-radius: 32px;
        background:
            linear-gradient(135deg, var(--blue) 0%, var(--navy-2) 70%);
    }

    .ees-cta__panel h2 {
        color: #fff;
        font-size: clamp(30px, 4vw, 54px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
        text-wrap: balance;
    }

    .ees-cta__side p {
        margin: 0 0 24px;
        max-width: 42ch;
        color: rgba(255, 255, 255, .86);
        font-size: 17px;
        line-height: 1.7;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .ees-hero__copy {
            max-width: 720px;
        }

        .ees-cta__panel {
            grid-template-columns: 1fr;
            align-items: start;
        }
    }

    @media (max-width: 575.98px) {
        .ees-hero__actions .ees-btn {
            width: 100%;
        }

        .ees-hero__frame {
            border-radius: 20px 20px 20px 56px;
        }

        .ees-hero__chip {
            right: 12px;
            max-width: calc(100% - 24px);
            font-size: 13px;
        }

        .ees-purpose__panel,
        .ees-cta__panel {
            border-radius: 24px;
        }

        .ees-cta__side .ees-btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .ees-about *,
        .ees-about *::before,
        .ees-about *::after {
            animation: none !important;
            transition-duration: .01ms !important;
        }
    }
</style>
@endpush