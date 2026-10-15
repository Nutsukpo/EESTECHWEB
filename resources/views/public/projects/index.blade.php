@extends('layouts.public')

@section('title', 'Our Projects | EES Technologies Ghana')

@section('content')

<div class="ees-projects">

    {{-- HERO --}}
    <section class="pj-hero" aria-labelledby="projects-heading">
        <div class="pj-hero__orb pj-hero__orb--a" aria-hidden="true"></div>
        <div class="pj-hero__orb pj-hero__orb--b" aria-hidden="true"></div>
        <div class="pj-hero__grid" aria-hidden="true"></div>

        <div class="container position-relative">
            <p class="pj-kicker pj-in" style="--d: 0ms">Our work and impact</p>

            <h1 id="projects-heading" class="pj-hero__title">
                <span class="pj-line"><span style="--d: 80ms">Projects that move</span></span>
                <span class="pj-line"><span style="--d: 200ms">business forward.</span></span>
            </h1>

            <p class="pj-hero__text pj-in" style="--d: 360ms">
                Explore technology solutions delivered by EES Technologies Ghana to solve
                real challenges, improve operations and support digital transformation.
            </p>

            <div class="pj-hero__actions pj-in" style="--d: 480ms">
                <a href="{{ url('/#contact') }}" class="pj-btn pj-btn--gold">
                    Discuss your project
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="#portfolio" class="pj-btn pj-btn--outline">
                    Browse projects
                    <i class="fas fa-arrow-down" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- LISTING --}}
    <section class="pj-listing" id="portfolio">
        <div class="container">

            <div class="pj-head" data-reveal>
                <div>
                    <h2>Selected projects</h2>
                    <p>The work, solutions and technologies behind what we build.</p>
                </div>
                <span class="pj-count">
                    <strong>{{ $projects->total() }}</strong>
                    {{ $projects->total() === 1 ? 'project' : 'projects' }}
                </span>
            </div>

            @if($projects->count())
                <div class="row g-4 g-xl-5">
                    @foreach($projects as $project)
                        <div class="col-md-6 col-lg-4">
                            <article class="pj-card" data-reveal style="--i: {{ $loop->index % 3 }}">

                                <a
                                    href="{{ route('projects.show', $project->slug) }}"
                                    class="pj-card__media"
                                    aria-label="View {{ $project->title }}"
                                >
                                    @if($project->cover_image)
                                        <img
                                            src="{{ asset('storage/' . $project->cover_image) }}"
                                            alt="{{ $project->title }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="pj-card__placeholder">
                                            <i class="fas fa-laptop-code" aria-hidden="true"></i>
                                        </div>
                                    @endif

                                    @if($project->category)
                                        <span class="pj-card__category">{{ $project->category }}</span>
                                    @endif

                                    <span class="pj-card__open" aria-hidden="true">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </span>
                                </a>

                                <div class="pj-card__body">
                                    @if($project->is_featured)
                                        <span class="pj-card__featured">
                                            <i class="fas fa-star" aria-hidden="true"></i>
                                            Featured project
                                        </span>
                                    @endif

                                    <h3>
                                        <a href="{{ route('projects.show', $project->slug) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h3>

                                    @if($project->client_name)
                                        <p class="pj-card__client">
                                            <i class="fas fa-building" aria-hidden="true"></i>
                                            {{ $project->client_name }}
                                        </p>
                                    @endif

                                    <p class="pj-card__desc">
                                        {{ $project->short_description ?: \Illuminate\Support\Str::limit(strip_tags($project->description), 145) }}
                                    </p>

                                    @if(is_array($project->technologies) && count($project->technologies))
                                        <ul class="pj-card__tags" aria-label="Technologies used">
                                            @foreach(array_slice($project->technologies, 0, 3) as $technology)
                                                <li>{{ $technology }}</li>
                                            @endforeach

                                            @if(count($project->technologies) > 3)
                                                <li>+{{ count($project->technologies) - 3 }}</li>
                                            @endif
                                        </ul>
                                    @endif

                                    <a
                                        href="{{ route('projects.show', $project->slug) }}"
                                        class="pj-card__more"
                                    >
                                        <span>Explore project</span>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>

                            </article>
                        </div>
                    @endforeach
                </div>

                <div class="pj-pagination" data-reveal>
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="pj-empty" data-reveal>
                    <div class="pj-empty__icon"><i class="fas fa-layer-group" aria-hidden="true"></i></div>
                    <h3>Our portfolio is growing</h3>
                    <p>
                        We're preparing our project showcase. Check back soon to explore
                        our latest technology solutions.
                    </p>
                    <a href="{{ url('/#contact') }}" class="pj-btn pj-btn--solid">
                        Talk to our team
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            @endif

        </div>
    </section>

    {{-- CTA --}}
    <section class="pj-cta">
        <div class="container">
            <div class="pj-cta__panel" data-reveal>
                <div class="pj-cta__copy">
                    <h2>Let's build your next solution.</h2>
                    <p>Tell us what you want to achieve. We'll help you find the right technology to get there.</p>
                </div>
                <a href="{{ url('/#contact') }}" class="pj-btn pj-btn--light">
                    Start a conversation
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

</div>

<script>
    // Scroll reveal. Content stays visible if JavaScript or IntersectionObserver is unavailable.
    (function () {
        var root = document.querySelector('.ees-projects');
        if (!root || !('IntersectionObserver' in window)) { return; }
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }

        var items = root.querySelectorAll('[data-reveal]');
        root.classList.add('pj-js');

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        items.forEach(function (el) { observer.observe(el); });
    })();
</script>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap');

    .ees-projects {
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

    .ees-projects .container { max-width: 1280px; }

    .ees-projects h1,
    .ees-projects h2,
    .ees-projects h3 {
        font-family: var(--font-display);
        margin: 0;
    }

    .ees-projects a:focus-visible {
        outline: 3px solid var(--gold);
        outline-offset: 3px;
    }

    /* ---------- Buttons ---------- */
    .pj-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 52px;
        padding: 12px 26px;
        border: 2px solid transparent;
        border-radius: 999px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .25s ease, color .25s ease, border-color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
    }

    .pj-btn i { font-size: 13px; transition: transform .25s var(--ease); }
    .pj-btn:hover { transform: translateY(-2px); }
    .pj-btn:hover i.fa-arrow-right { transform: translateX(4px); }
    .pj-btn:hover i.fa-arrow-down { transform: translateY(3px); }

    .pj-btn--gold { color: var(--navy); background: var(--gold); }
    .pj-btn--gold:hover { color: var(--navy); background: #f3c25b; box-shadow: 0 12px 28px rgba(233, 177, 58, .35); }

    .pj-btn--outline { color: #fff; border-color: rgba(255, 255, 255, .35); }
    .pj-btn--outline:hover { color: var(--navy); background: #fff; border-color: #fff; }

    .pj-btn--solid { color: #fff; background: var(--blue); }
    .pj-btn--solid:hover { color: #fff; background: var(--navy); }

    .pj-btn--light { color: var(--navy); background: #fff; }
    .pj-btn--light:hover { color: var(--navy); background: var(--gold); }

    /* ---------- Hero ---------- */
    .pj-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(72px, 10vw, 132px) 0 clamp(72px, 9vw, 120px);
        color: #fff;
        background: var(--navy);
    }

    .pj-hero__orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
    }

    .pj-hero__orb--a {
        width: 520px;
        height: 520px;
        top: -220px;
        right: 4%;
        background: rgba(8, 120, 209, .5);
        animation: pj-drift-a 16s ease-in-out infinite alternate;
    }

    .pj-hero__orb--b {
        width: 380px;
        height: 380px;
        bottom: -200px;
        left: 8%;
        background: rgba(233, 177, 58, .16);
        animation: pj-drift-b 20s ease-in-out infinite alternate;
    }

    .pj-hero__grid {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, .13) 1px, transparent 1px);
        background-size: 30px 30px;
        mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        -webkit-mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        pointer-events: none;
    }

    @keyframes pj-drift-a {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(-70px, 60px, 0) scale(1.12); }
    }

    @keyframes pj-drift-b {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(80px, -50px, 0) scale(1.1); }
    }

    .pj-kicker {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 24px;
        color: #9cc8f3;
        font-size: 15px;
        font-weight: 700;
    }

    .pj-kicker::before {
        content: "";
        width: 28px;
        height: 3px;
        border-radius: 2px;
        background: var(--gold);
    }

    .pj-hero__title {
        max-width: 900px;
        color: #fff;
        font-size: clamp(42px, 6.4vw, 92px);
        font-weight: 800;
        line-height: 1.02;
        letter-spacing: -.04em;
    }

    /* Headline lines slide up from behind a mask. */
    .pj-line {
        display: block;
        overflow: hidden;
        padding-bottom: .08em;
    }

    .pj-line > span {
        display: block;
        animation: pj-line-up .9s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes pj-line-up {
        from { transform: translateY(110%); }
        to   { transform: translateY(0); }
    }

    .pj-in {
        animation: pj-fade-up .8s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes pj-fade-up {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: none; }
    }

    .pj-hero__text {
        max-width: 56ch;
        margin: 28px 0 0;
        color: rgba(255, 255, 255, .78);
        font-size: clamp(16px, 1.4vw, 19px);
        line-height: 1.7;
    }

    .pj-hero__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 36px;
    }

    /* ---------- Listing ---------- */
    .pj-listing {
        padding: clamp(56px, 7vw, 104px) 0;
        background: var(--paper);
    }

    .pj-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: clamp(32px, 4vw, 52px);
    }

    .pj-head h2 {
        color: var(--navy);
        font-size: clamp(32px, 4vw, 52px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
    }

    .pj-head p {
        margin: 14px 0 0;
        color: var(--muted);
        font-size: 17px;
    }

    .pj-count {
        flex-shrink: 0;
        padding: 10px 18px;
        color: var(--muted);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        font-size: 15px;
        font-weight: 600;
    }

    .pj-count strong {
        margin-right: 4px;
        color: var(--navy);
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 800;
    }

    /* ---------- Card ---------- */
    .pj-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 24px;
        transition: transform .4s var(--ease), box-shadow .4s ease, border-color .3s ease;
    }

    .pj-card:hover {
        transform: translateY(-8px);
        border-color: transparent;
        box-shadow: 0 30px 60px -24px rgba(6, 27, 61, .35);
    }

    .pj-card__media {
        position: relative;
        display: block;
        aspect-ratio: 16 / 11;
        overflow: hidden;
        background: var(--blue-soft);
    }

    .pj-card__media img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform .8s var(--ease);
    }

    .pj-card:hover .pj-card__media img { transform: scale(1.07); }

    .pj-card__media::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 45%, rgba(6, 27, 61, .55) 100%);
        opacity: 0;
        transition: opacity .4s ease;
    }

    .pj-card:hover .pj-card__media::after { opacity: 1; }

    .pj-card__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8ea5c4;
        font-size: 52px;
        background: linear-gradient(135deg, #eaf2fc, #d7e5f6);
    }

    .pj-card__category {
        position: absolute;
        z-index: 2;
        left: 16px;
        top: 16px;
        padding: 7px 14px;
        color: var(--navy);
        background: rgba(255, 255, 255, .94);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }

    .pj-card__open {
        position: absolute;
        z-index: 2;
        right: 16px;
        bottom: 16px;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: var(--gold);
        border-radius: 50%;
        font-size: 15px;
        opacity: 0;
        transform: translateY(14px) scale(.8);
        transition: opacity .35s ease, transform .45s var(--ease);
    }

    .pj-card:hover .pj-card__open,
    .pj-card__media:focus-visible .pj-card__open {
        opacity: 1;
        transform: none;
    }

    .pj-card__body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 26px 26px 24px;
    }

    .pj-card__featured {
        align-self: flex-start;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 12px;
        padding: 5px 12px;
        color: #8a5a00;
        background: #fdf3da;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }

    .pj-card__featured i { color: var(--gold); font-size: 11px; }

    .pj-card h3 {
        font-size: 23px;
        font-weight: 700;
        line-height: 1.22;
        letter-spacing: -.015em;
    }

    .pj-card h3 a {
        color: var(--navy);
        text-decoration: none;
        background-image: linear-gradient(var(--blue), var(--blue));
        background-repeat: no-repeat;
        background-position: 0 100%;
        background-size: 0 2px;
        transition: background-size .4s var(--ease), color .25s ease;
    }

    .pj-card:hover h3 a {
        color: var(--blue);
        background-size: 100% 2px;
    }

    .pj-card__client {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 10px 0 0;
        color: var(--muted);
        font-size: 14px;
        font-weight: 600;
    }

    .pj-card__client i { color: var(--blue); font-size: 13px; }

    .pj-card__desc {
        flex: 1;
        margin: 14px 0 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.65;
    }

    .pj-card__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 20px 0 0;
        padding: 0;
        list-style: none;
    }

    .pj-card__tags li {
        padding: 5px 12px;
        color: var(--navy-2);
        background: var(--blue-soft);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        transition: background-color .25s ease, color .25s ease;
    }

    .pj-card:hover .pj-card__tags li {
        color: #fff;
        background: var(--navy-2);
    }

    .pj-card__tags li:nth-child(2) { transition-delay: .04s; }
    .pj-card__tags li:nth-child(3) { transition-delay: .08s; }
    .pj-card__tags li:nth-child(4) { transition-delay: .12s; }

    .pj-card__more {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 22px;
        padding-top: 18px;
        color: var(--blue);
        border-top: 1px solid var(--line);
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
    }

    .pj-card__more i {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
        background: var(--blue-soft);
        border-radius: 50%;
        font-size: 12px;
        transition: background-color .3s ease, color .3s ease, transform .4s var(--ease);
    }

    .pj-card__more:hover i,
    .pj-card:hover .pj-card__more i {
        color: #fff;
        background: var(--blue);
        transform: translateX(4px);
    }

    /* ---------- Pagination (Bootstrap 5) ---------- */
    .pj-pagination {
        display: flex;
        justify-content: center;
        margin-top: clamp(40px, 5vw, 64px);
    }

    .pj-pagination .pagination { gap: 6px; margin: 0; }

    .pj-pagination .page-link {
        min-width: 44px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px !important;
        font-weight: 700;
        transition: background-color .2s ease, color .2s ease, transform .2s ease;
    }

    .pj-pagination .page-link:hover {
        color: #fff;
        background: var(--blue);
        border-color: var(--blue);
        transform: translateY(-2px);
    }

    .pj-pagination .page-item.active .page-link {
        color: #fff;
        background: var(--navy);
        border-color: var(--navy);
    }

    .pj-pagination .page-item.disabled .page-link {
        color: #a3aec0;
        background: transparent;
    }

    /* ---------- Empty state ---------- */
    .pj-empty {
        max-width: 720px;
        margin: 0 auto;
        padding: clamp(48px, 7vw, 88px) 28px;
        text-align: center;
        background: #fff;
        border: 1px dashed #c4d0e0;
        border-radius: 28px;
    }

    .pj-empty__icon {
        width: 84px;
        height: 84px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 26px;
        color: var(--blue);
        background: var(--blue-soft);
        border-radius: 24px;
        font-size: 34px;
        animation: pj-float 3.6s ease-in-out infinite;
    }

    @keyframes pj-float {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50%      { transform: translateY(-10px) rotate(3deg); }
    }

    .pj-empty h3 {
        color: var(--navy);
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.02em;
    }

    .pj-empty p {
        max-width: 46ch;
        margin: 14px auto 28px;
        color: var(--muted);
        font-size: 17px;
        line-height: 1.7;
    }

    /* ---------- CTA ---------- */
    .pj-cta {
        padding: clamp(40px, 5vw, 72px) 0 clamp(56px, 7vw, 104px);
        background: var(--paper);
    }

    .pj-cta__panel {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: clamp(28px, 5vw, 72px);
        padding: clamp(32px, 6vw, 72px);
        border-radius: 32px;
        color: #fff;
        background:
            radial-gradient(circle at 100% 0%, rgba(8, 120, 209, .55), transparent 50%),
            var(--navy);
    }

    .pj-cta__panel::after {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        left: -120px;
        bottom: -200px;
        border-radius: 50%;
        background: rgba(233, 177, 58, .14);
        filter: blur(40px);
        animation: pj-drift-b 14s ease-in-out infinite alternate;
        pointer-events: none;
    }

    .pj-cta__copy { position: relative; z-index: 1; }

    .pj-cta__panel h2 {
        color: #fff;
        font-size: clamp(30px, 4vw, 52px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
    }

    .pj-cta__panel p {
        max-width: 46ch;
        margin: 16px 0 0;
        color: rgba(255, 255, 255, .8);
        font-size: 17px;
        line-height: 1.7;
    }

    .pj-cta__panel .pj-btn {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
    }

    /* ---------- Scroll reveal (enabled only when JS runs) ---------- */
    .pj-js [data-reveal] {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity .8s var(--ease), transform .8s var(--ease);
        transition-delay: calc(var(--i, 0) * 110ms);
    }

    .pj-js [data-reveal].is-visible {
        opacity: 1;
        transform: none;
    }

    /* Once revealed, cards switch to their snappy hover timing. */
    .pj-js .pj-card.is-visible {
        transition:
            opacity .8s var(--ease),
            transform .4s var(--ease),
            box-shadow .4s ease,
            border-color .3s ease;
        transition-delay: 0s;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 767.98px) {
        .pj-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .pj-cta__panel {
            flex-direction: column;
            align-items: flex-start;
            border-radius: 24px;
        }

        .pj-cta__panel .pj-btn { width: 100%; }
    }

    @media (max-width: 575.98px) {
        .pj-hero__actions .pj-btn { width: 100%; }
        .pj-card { border-radius: 20px; }
    }

    /* Touch screens have no hover, so keep the open button visible. */
    @media (hover: none) {
        .pj-card__open { opacity: 1; transform: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ees-projects *,
        .ees-projects *::before,
        .ees-projects *::after {
            animation: none !important;
            transition-duration: .01ms !important;
            transition-delay: 0s !important;
        }

        .pj-js [data-reveal] { opacity: 1; transform: none; }
    }
</style>
@endpush