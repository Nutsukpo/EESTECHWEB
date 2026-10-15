@extends('layouts.public')

@section('title', 'Contact Us | EES Technologies Ghana')

@section('content')
@php
    $officeAddress = $contact
        ? collect([
            $contact->address,
            $contact->city,
            $contact->region,
            $contact->country,
        ])->filter()->join(', ')
        : '';

    $mapUrl = $contact?->google_maps_embed;
    $mapUrlIsSafe = is_string($mapUrl)
        && filter_var($mapUrl, FILTER_VALIDATE_URL)
        && parse_url($mapUrl, PHP_URL_SCHEME) === 'https'
        && in_array(
            strtolower((string) parse_url($mapUrl, PHP_URL_HOST)),
            ['www.google.com', 'google.com', 'maps.google.com'],
            true
        )
        && str_starts_with((string) parse_url($mapUrl, PHP_URL_PATH), '/maps/embed');

    $mapLink = $contact?->google_maps_url;
    $mapLinkIsSafe = is_string($mapLink)
        && filter_var($mapLink, FILTER_VALIDATE_URL)
        && parse_url($mapLink, PHP_URL_SCHEME) === 'https'
        && in_array(
            strtolower((string) parse_url($mapLink, PHP_URL_HOST)),
            ['www.google.com', 'google.com', 'maps.google.com', 'maps.app.goo.gl'],
            true
        );
@endphp

<div class="ees-contact-page">

    {{-- HERO --}}
    <section class="pc-hero" aria-labelledby="contact-heading">
        <div class="pc-hero__orb pc-hero__orb--a" aria-hidden="true"></div>
        <div class="pc-hero__orb pc-hero__orb--b" aria-hidden="true"></div>
        <div class="pc-hero__grid" aria-hidden="true"></div>

        <div class="container position-relative">
            <p class="pc-kicker pc-in" style="--d: 0ms">Let's connect</p>

            <h1 id="contact-heading" class="pc-hero__title">
                <span class="pc-line"><span style="--d: 80ms">Contact us</span></span>
            </h1>

            <p class="pc-hero__text pc-in" style="--d: 260ms">
                Have a project in mind? Talk to our team about technology solutions
                for your organisation.
            </p>
        </div>
    </section>

    {{-- CONTACT DETAILS --}}
    <section class="pc-info" aria-label="Contact details">
        <div class="container">
            <div class="pc-info__panel pc-in" style="--d: 380ms">

                <article class="pc-info__item">
                    <span class="pc-info__icon"><i class="fas fa-headset" aria-hidden="true"></i></span>
                    <h2>Call us now</h2>

                    @if($contact?->primary_phone)
                        <a class="pc-info__link" href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->primary_phone) }}">
                            {{ $contact->primary_phone }}
                        </a>
                    @endif

                    @if($contact?->secondary_phone)
                        <a class="pc-info__link" href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->secondary_phone) }}">
                            {{ $contact->secondary_phone }}
                        </a>
                    @endif

                    @if(!$contact?->primary_phone && !$contact?->secondary_phone)
                        <p class="pc-info__muted">Phone details coming soon.</p>
                    @endif

                    @if($contact?->email)
                        <a class="pc-info__link pc-info__link--email" href="mailto:{{ $contact->email }}">
                            {{ $contact->email }}
                        </a>
                    @endif
                </article>

                <article class="pc-info__item">
                    <span class="pc-info__icon"><i class="fas fa-map-marked-alt" aria-hidden="true"></i></span>
                    <h2>Visit us</h2>

                    @if($officeAddress)
                        <p>{{ $officeAddress }}</p>
                    @else
                        <p class="pc-info__muted">Our office address will be published here.</p>
                    @endif

                    @if($mapLinkIsSafe)
                        <a
                            class="pc-info__action"
                            href="{{ $mapLink }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Get directions
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    @endif
                </article>

                <article class="pc-info__item">
                    <span class="pc-info__icon"><i class="fas fa-clock" aria-hidden="true"></i></span>
                    <h2>Working hours</h2>

                    <dl class="pc-hours">
                        <div>
                            <dt>Mon – Fri</dt>
                            <dd>{{ $contact?->weekday_hours ?: 'Please contact us' }}</dd>
                        </div>
                        <div>
                            <dt>Saturday</dt>
                            <dd>{{ $contact?->saturday_hours ?: 'Please contact us' }}</dd>
                        </div>
                        <div>
                            <dt>Sunday</dt>
                            <dd>{{ $contact?->sunday_hours ?: 'Please contact us' }}</dd>
                        </div>
                    </dl>
                </article>

            </div>
        </div>
    </section>

    {{-- MAP AND FORM --}}
    <section class="pc-main">
        <div class="container">
            <div class="pc-main__panel" data-reveal>

                <div class="pc-map">
                    @if($mapUrlIsSafe)
                        <iframe
                            class="pc-map__frame"
                            src="{{ $mapUrl }}"
                            title="EES Technologies office location"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>

                        @if($officeAddress)
                            <div class="pc-map__chip">
                                <i class="fas fa-location-dot" aria-hidden="true"></i>
                                <span>{{ $officeAddress }}</span>
                            </div>
                        @endif
                    @elseif($mapLinkIsSafe)
                        <div class="pc-map__placeholder">
                            <span class="pc-map__pin"><i class="fas fa-map-marked-alt" aria-hidden="true"></i></span>
                            <h3>Find our office</h3>
                            <p>{{ $officeAddress ?: 'View our office location on Google Maps.' }}</p>
                            <a href="{{ $mapLink }}" target="_blank" rel="noopener noreferrer" class="pc-btn pc-btn--solid">
                                Open Google Maps
                                <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                            </a>
                        </div>
                    @else
                        <div class="pc-map__placeholder">
                            <span class="pc-map__pin"><i class="fas fa-map-marked-alt" aria-hidden="true"></i></span>
                            <h3>Our location</h3>
                            <p>{{ $officeAddress ?: 'Our office location will be updated soon.' }}</p>
                        </div>
                    @endif
                </div>

                <div class="pc-form" id="contact-form">
                    <p class="pc-label">Get in touch</p>
                    <h2>Send us a message</h2>
                    <p class="pc-form__intro">
                        Complete the form below to send us an enquiry. Our team will get in touch with you.
                    </p>

                    @if(session('enquiry_success'))
                        <div class="pc-alert pc-alert--success" role="alert">
                            <span class="pc-alert__icon"><i class="fas fa-check" aria-hidden="true"></i></span>
                            <div>{{ session('enquiry_success') }}</div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="pc-alert pc-alert--error" role="alert">
                            <span class="pc-alert__icon"><i class="fas fa-exclamation" aria-hidden="true"></i></span>
                            <div>
                                <strong>Please review your submission.</strong>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="pc-form__body" id="contactForm">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="pc-field">
                                    <label for="contact_name">
                                        Contact person's name <span class="pc-req" aria-hidden="true">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="contact_name"
                                        name="contact_name"
                                        value="{{ old('contact_name') }}"
                                        required
                                        maxlength="255"
                                        autocomplete="name"
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="pc-field">
                                    <label for="contact_email">
                                        Email address <span class="pc-req" aria-hidden="true">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        id="contact_email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        maxlength="255"
                                        autocomplete="email"
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="pc-field">
                                    <label for="contact_company_name">Company name</label>
                                    <input
                                        type="text"
                                        id="contact_company_name"
                                        name="company_name"
                                        value="{{ old('company_name') }}"
                                        maxlength="255"
                                        autocomplete="organization"
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="pc-field">
                                    <label for="contact_phone">Phone number</label>
                                    <input
                                        type="tel"
                                        id="contact_phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        maxlength="50"
                                        autocomplete="tel"
                                    >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="pc-field">
                                    <label for="contact_subject">Subject</label>
                                    <input
                                        type="text"
                                        id="contact_subject"
                                        name="subject"
                                        value="{{ old('subject') }}"
                                        maxlength="255"
                                        placeholder="How can we help?"
                                    >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="pc-field">
                                    <label for="contact_message">
                                        Your message <span class="pc-req" aria-hidden="true">*</span>
                                    </label>
                                    <textarea
                                        id="contact_message"
                                        name="message"
                                        rows="5"
                                        required
                                        maxlength="5000"
                                        placeholder="Tell us about your enquiry or project..."
                                    >{{ old('message') }}</textarea>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="pc-submit" id="contactSubmit">
                            <span class="pc-submit__label">
                                Send enquiry
                                <i class="fas fa-paper-plane" aria-hidden="true"></i>
                            </span>
                            <span class="pc-submit__busy" aria-hidden="true">
                                <span class="pc-spinner"></span>
                                Sending
                            </span>
                        </button>

                        <p class="pc-privacy">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                            Please do not include passwords or other sensitive information in your message.
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    {{-- SOCIAL --}}
    @if($contact && ($contact->linkedin_url || $contact->facebook_url || $contact->instagram_url || $contact->x_url))
        <section class="pc-social" data-reveal>
            <div class="container">
                <h2>Connect with us</h2>

                <div class="pc-social__links">
                    @foreach([
                        'LinkedIn' => [$contact->linkedin_url, 'fab fa-linkedin-in'],
                        'Facebook' => [$contact->facebook_url, 'fab fa-facebook-f'],
                        'Instagram' => [$contact->instagram_url, 'fab fa-instagram'],
                        'X' => [$contact->x_url, 'fab fa-x-twitter'],
                    ] as $network => [$url, $icon])
                        @if($url && filter_var($url, FILTER_VALIDATE_URL) && parse_url($url, PHP_URL_SCHEME) === 'https')
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                <i class="{{ $icon }}" aria-hidden="true"></i>
                                {{ $network }}
                                <i class="fas fa-arrow-up-right-from-square pc-social__ext" aria-hidden="true"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap');

    .ees-contact-page {
        --navy: #061b3d;
        --navy-2: #0a2a5c;
        --blue: #0878d1;
        --blue-soft: #e7f2fc;
        --gold: #e9b13a;
        --paper: #f6f8fb;
        --ink: #0d1b2e;
        --muted: #56637a;
        --line: #dde4ee;
        --ease: cubic-bezier(.2, .7, .2, 1);

        --font-display: 'Bricolage Grotesque', 'Figtree', system-ui, sans-serif;
        --font-body: 'Figtree', system-ui, -apple-system, 'Segoe UI', sans-serif;

        font-family: var(--font-body);
        color: var(--ink);
        overflow: clip;
    }

    .ees-contact-page .container { max-width: 1240px; }

    .ees-contact-page h1,
    .ees-contact-page h2,
    .ees-contact-page h3 {
        font-family: var(--font-display);
        margin: 0;
    }

    .ees-contact-page a:focus-visible,
    .ees-contact-page button:focus-visible {
        outline: 3px solid var(--gold);
        outline-offset: 3px;
    }

    /* ---------- Shared ---------- */
    .pc-label,
    .pc-kicker {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 14px;
        font-size: 15px;
        font-weight: 700;
    }

    .pc-label { color: var(--blue); }
    .pc-kicker { margin-bottom: 22px; color: #9cc8f3; }

    .pc-label::before,
    .pc-kicker::before {
        content: "";
        width: 28px;
        height: 3px;
        border-radius: 2px;
        background: var(--gold);
    }

    .pc-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 50px;
        padding: 12px 26px;
        border-radius: 999px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .25s ease, color .25s ease, transform .25s var(--ease);
    }

    .pc-btn i { font-size: 13px; transition: transform .25s var(--ease); }
    .pc-btn:hover { transform: translateY(-2px); }
    .pc-btn--solid { color: #fff; background: var(--blue); }
    .pc-btn--solid:hover { color: #fff; background: var(--navy); }
    .pc-btn--solid:hover i { transform: translate(2px, -2px); }

    .pc-in {
        animation: pc-fade-up .85s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes pc-fade-up {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: none; }
    }

    /* ---------- Hero ---------- */
    .pc-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(64px, 8vw, 112px) 0 clamp(120px, 12vw, 170px);
        color: #fff;
        background: var(--navy);
    }

    .pc-hero__orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
    }

    .pc-hero__orb--a {
        width: 480px;
        height: 480px;
        top: -200px;
        right: 6%;
        background: rgba(8, 120, 209, .5);
        animation: pc-drift-a 16s ease-in-out infinite alternate;
    }

    .pc-hero__orb--b {
        width: 340px;
        height: 340px;
        bottom: -190px;
        left: 6%;
        background: rgba(233, 177, 58, .15);
        animation: pc-drift-b 20s ease-in-out infinite alternate;
    }

    .pc-hero__grid {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, .12) 1px, transparent 1px);
        background-size: 30px 30px;
        mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        -webkit-mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        pointer-events: none;
    }

    @keyframes pc-drift-a {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(-60px, 50px, 0) scale(1.12); }
    }

    @keyframes pc-drift-b {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(70px, -40px, 0) scale(1.1); }
    }

    .pc-hero__title {
        color: #fff;
        font-size: clamp(44px, 7vw, 96px);
        font-weight: 800;
        line-height: 1.02;
        letter-spacing: -.04em;
    }

    .pc-line { display: block; overflow: hidden; padding-bottom: .08em; }

    .pc-line > span {
        display: block;
        animation: pc-line-up .9s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes pc-line-up {
        from { transform: translateY(110%); }
        to   { transform: translateY(0); }
    }

    .pc-hero__text {
        max-width: 54ch;
        margin: 26px 0 0;
        color: rgba(255, 255, 255, .8);
        font-size: clamp(16px, 1.4vw, 19px);
        line-height: 1.7;
    }

    /* ---------- Contact details ---------- */
    .pc-info {
        position: relative;
        z-index: 2;
        margin-top: calc(-1 * clamp(64px, 7vw, 92px));
    }

    .pc-info__panel {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 28px;
        box-shadow: 0 30px 70px -26px rgba(6, 27, 61, .38);
        overflow: hidden;
    }

    .pc-info__item {
        padding: clamp(26px, 3vw, 40px);
        border-right: 1px solid var(--line);
        transition: background-color .3s ease;
    }

    .pc-info__item:last-child { border-right: 0; }
    .pc-info__item:hover { background: var(--paper); }

    .pc-info__icon {
        width: 56px;
        height: 56px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: var(--blue);
        background: var(--blue-soft);
        border-radius: 18px;
        font-size: 1.4rem;
        transition: color .3s ease, background-color .3s ease, transform .45s var(--ease);
    }

    .pc-info__item:hover .pc-info__icon {
        color: var(--navy);
        background: var(--gold);
        transform: translateY(-4px) rotate(-6deg);
    }

    .pc-info__item h2 {
        margin-bottom: 14px;
        color: var(--navy);
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: -.015em;
    }

    .pc-info__item p {
        margin: 0;
        color: var(--ink);
        font-size: 1.02rem;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .pc-info__item .pc-info__muted { color: var(--muted); }

    .pc-info__link {
        display: block;
        margin-bottom: 8px;
        color: var(--ink);
        font-size: 1.1rem;
        font-weight: 700;
        overflow-wrap: anywhere;
        text-decoration: none;
        transition: color .2s ease, transform .3s var(--ease);
    }

    .pc-info__link:hover { color: var(--blue); transform: translateX(4px); }

    .pc-info__link--email {
        margin: 14px 0 0;
        color: var(--muted);
        font-size: .98rem;
        font-weight: 600;
    }

    .pc-info__action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 18px;
        color: var(--blue);
        font-weight: 700;
        text-decoration: none;
    }

    .pc-info__action i { transition: transform .3s var(--ease); }
    .pc-info__action:hover { color: var(--navy); }
    .pc-info__action:hover i { transform: translateX(5px); }

    .pc-hours { margin: 0; }

    .pc-hours > div {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 11px 0;
        border-bottom: 1px solid var(--line);
    }

    .pc-hours > div:last-child { border-bottom: 0; padding-bottom: 0; }
    .pc-hours dt { color: var(--muted); font-weight: 600; }
    .pc-hours dd { margin: 0; color: var(--navy); font-weight: 700; text-align: right; }

    /* ---------- Map and form ---------- */
    .pc-main { padding: clamp(40px, 5vw, 72px) 0 clamp(56px, 7vw, 104px); }

    .pc-main__panel {
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 32px;
        box-shadow: 0 40px 80px -40px rgba(6, 27, 61, .3);
    }

    .pc-map {
        position: relative;
        min-height: 640px;
        background: var(--blue-soft);
    }

    .pc-map__frame {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .pc-map__chip {
        position: absolute;
        left: 20px;
        right: 20px;
        bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        width: fit-content;
        max-width: calc(100% - 40px);
        padding: 13px 20px;
        color: var(--navy);
        background: rgba(255, 255, 255, .95);
        border-radius: 999px;
        font-size: .95rem;
        font-weight: 700;
        box-shadow: 0 14px 34px rgba(6, 27, 61, .2);
        backdrop-filter: blur(8px);
        pointer-events: none;
    }

    .pc-map__chip i { color: var(--gold); }

    .pc-map__placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 36px;
        text-align: center;
        background:
            radial-gradient(circle at 100% 0%, rgba(8, 120, 209, .16), transparent 55%),
            linear-gradient(145deg, #edf5ff, #f9fbfe);
    }

    .pc-map__pin {
        width: 88px;
        height: 88px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 26px;
        color: var(--blue);
        background: #fff;
        border-radius: 26px;
        box-shadow: 0 18px 40px -16px rgba(6, 27, 61, .3);
        font-size: 2.2rem;
        animation: pc-float 3.6s ease-in-out infinite;
    }

    @keyframes pc-float {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50%      { transform: translateY(-10px) rotate(3deg); }
    }

    .pc-map__placeholder h3 { color: var(--navy); font-size: 1.9rem; font-weight: 800; letter-spacing: -.02em; }

    .pc-map__placeholder p {
        max-width: 38ch;
        margin: 12px 0 26px;
        color: var(--muted);
        line-height: 1.7;
    }

    .pc-map__placeholder p:last-child { margin-bottom: 0; }

    .pc-form { padding: clamp(28px, 4.5vw, 64px); }

    .pc-form h2 {
        color: var(--navy);
        font-size: clamp(30px, 3.4vw, 46px);
        font-weight: 800;
        line-height: 1.06;
        letter-spacing: -.03em;
    }

    .pc-form__intro {
        max-width: 48ch;
        margin: 14px 0 30px;
        color: var(--muted);
        font-size: 1.05rem;
        line-height: 1.7;
    }

    /* Alerts */
    .pc-alert {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 26px;
        padding: 16px 18px;
        border-radius: 16px;
        font-size: .98rem;
        line-height: 1.6;
        animation: pc-alert-in .6s var(--ease) both;
    }

    .pc-alert ul { margin: 6px 0 0; padding-left: 18px; }

    .pc-alert__icon {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-radius: 50%;
        font-size: .85rem;
    }

    .pc-alert--success { color: #0f5132; background: #e8f7ee; border: 1px solid #bfe6cf; }
    .pc-alert--success .pc-alert__icon { background: #16a34a; animation: pc-pop .6s .25s var(--ease) both; }

    .pc-alert--error { color: #7f1d1d; background: #fdecec; border: 1px solid #f6c4c4; }
    .pc-alert--error .pc-alert__icon { background: #dc2626; }

    @keyframes pc-alert-in {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes pc-pop {
        0%   { transform: scale(0); }
        70%  { transform: scale(1.25); }
        100% { transform: scale(1); }
    }

    /* Fields */
    .pc-field { position: relative; }

    .pc-field label {
        display: block;
        margin-bottom: 8px;
        color: var(--navy);
        font-size: .95rem;
        font-weight: 700;
        transition: color .25s ease;
    }

    .pc-field:focus-within label { color: var(--blue); }

    .pc-req { color: #dc2626; }

    .pc-field input,
    .pc-field textarea {
        width: 100%;
        min-height: 54px;
        padding: 14px 18px;
        color: var(--ink);
        background: var(--paper);
        border: 1.5px solid transparent;
        border-radius: 16px;
        font-family: inherit;
        font-size: 1rem;
        transition: background-color .25s ease, border-color .25s ease, box-shadow .3s ease, transform .3s var(--ease);
    }

    .pc-field textarea { min-height: 150px; resize: vertical; line-height: 1.6; }

    .pc-field input::placeholder,
    .pc-field textarea::placeholder { color: #94a1b5; }

    .pc-field input:hover,
    .pc-field textarea:hover { border-color: var(--line); }

    .pc-field input:focus,
    .pc-field textarea:focus {
        outline: none;
        background: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 5px rgba(8, 120, 209, .12), 0 14px 30px -18px rgba(8, 120, 209, .55);
        transform: translateY(-1px);
    }

    .pc-field input:user-invalid,
    .pc-field textarea:user-invalid { border-color: #dc2626; background: #fff; }

    /* Submit */
    .pc-submit {
        position: relative;
        width: 100%;
        min-height: 58px;
        margin-top: 26px;
        padding: 14px 24px;
        color: #fff;
        background: var(--blue);
        border: 0;
        border-radius: 999px;
        font-size: 1.05rem;
        font-weight: 700;
        overflow: hidden;
        transition: background-color .3s ease, transform .3s var(--ease), box-shadow .3s ease;
    }

    .pc-submit::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(110deg, transparent 25%, rgba(255, 255, 255, .28) 50%, transparent 75%);
        transform: translateX(-130%);
        transition: transform .8s var(--ease);
    }

    .pc-submit:hover:not(:disabled) {
        background: var(--navy);
        transform: translateY(-2px);
        box-shadow: 0 18px 36px -14px rgba(6, 27, 61, .55);
    }

    .pc-submit:hover:not(:disabled)::before { transform: translateX(130%); }

    .pc-submit__label,
    .pc-submit__busy {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .pc-submit__label i { transition: transform .4s var(--ease); }
    .pc-submit:hover:not(:disabled) .pc-submit__label i { transform: translate(5px, -4px) rotate(8deg); }

    .pc-submit__busy { display: none; }
    .pc-submit.is-loading { cursor: progress; opacity: .92; }
    .pc-submit.is-loading .pc-submit__label { display: none; }
    .pc-submit.is-loading .pc-submit__busy { display: inline-flex; }

    .pc-spinner {
        width: 18px;
        height: 18px;
        border: 2.5px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: pc-spin .8s linear infinite;
    }

    @keyframes pc-spin { to { transform: rotate(360deg); } }

    .pc-privacy {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 18px 0 0;
        color: var(--muted);
        font-size: .88rem;
        line-height: 1.6;
    }

    .pc-privacy i { margin-top: 3px; color: var(--gold); }

    /* ---------- Social ---------- */
    .pc-social {
        padding: 0 0 clamp(56px, 7vw, 104px);
        text-align: center;
    }

    .pc-social h2 {
        color: var(--navy);
        font-size: clamp(28px, 3.2vw, 40px);
        font-weight: 800;
        letter-spacing: -.025em;
    }

    .pc-social__links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 26px;
    }

    .pc-social__links a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 22px;
        color: var(--navy);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        font-weight: 700;
        text-decoration: none;
        transition: color .25s ease, background-color .25s ease, border-color .25s ease, transform .3s var(--ease);
    }

    .pc-social__ext { font-size: .7rem; opacity: .55; }

    .pc-social__links a:hover {
        color: #fff;
        background: var(--navy);
        border-color: var(--navy);
        transform: translateY(-3px);
    }

    /* ---------- Scroll reveal (enabled only when JS runs) ---------- */
    .pc-js [data-reveal] {
        opacity: 0;
        transform: translateY(34px);
        transition: opacity .9s var(--ease), transform .9s var(--ease);
    }

    .pc-js [data-reveal].is-visible { opacity: 1; transform: none; }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .pc-info__panel { grid-template-columns: 1fr; }
        .pc-info__item { border-right: 0; border-bottom: 1px solid var(--line); }
        .pc-info__item:last-child { border-bottom: 0; }

        .pc-main__panel { grid-template-columns: 1fr; }
        .pc-map { min-height: 380px; }
    }

    @media (max-width: 575.98px) {
        .pc-info__panel,
        .pc-main__panel { border-radius: 22px; }

        .pc-map { min-height: 300px; }
        .pc-map__chip { left: 12px; bottom: 12px; max-width: calc(100% - 24px); border-radius: 18px; }
        .pc-social__links a { width: 100%; justify-content: center; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ees-contact-page *,
        .ees-contact-page *::before,
        .ees-contact-page *::after {
            animation: none !important;
            transition-duration: .01ms !important;
            transition-delay: 0s !important;
        }

        .pc-js [data-reveal] { opacity: 1; transform: none; }
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        var root = document.querySelector('.ees-contact-page');
        if (!root) { return; }

        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        /* ---------- Scroll reveal. Content stays visible without JS. ---------- */
        if (!reduce && 'IntersectionObserver' in window) {
            root.classList.add('pc-js');

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

            root.querySelectorAll('[data-reveal]').forEach(function (el) { observer.observe(el); });
        }

        /* ---------- Bring the result into view after a submission. ---------- */
        var feedback = root.querySelector('.pc-alert');
        if (feedback) {
            window.setTimeout(function () {
                feedback.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
            }, 350);
        }

        /* ---------- Prevent double submissions. ---------- */
        var form = document.getElementById('contactForm');
        var button = document.getElementById('contactSubmit');

        if (form && button) {
            form.addEventListener('submit', function () {
                // The browser has already validated required fields at this point.
                button.classList.add('is-loading');
                button.disabled = true;
                button.setAttribute('aria-busy', 'true');
            });

            // Restore the button if the visitor returns with the back button.
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    button.classList.remove('is-loading');
                    button.disabled = false;
                    button.removeAttribute('aria-busy');
                }
            });
        }
    })();
</script>
@endpush