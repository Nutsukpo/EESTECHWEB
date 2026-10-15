@extends('layouts.public')

@section('title', $project->title . ' | EES Technologies Ghana')

@section('content')

<div class="ees-project">

    <div class="pd-progress" aria-hidden="true"><span></span></div>

    {{-- HERO --}}
    <section class="pd-hero" aria-labelledby="project-title">
        <div class="pd-hero__orb pd-hero__orb--a" aria-hidden="true"></div>
        <div class="pd-hero__orb pd-hero__orb--b" aria-hidden="true"></div>
        <div class="pd-hero__grid" aria-hidden="true"></div>

        <div class="container position-relative">
            <a href="{{ route('projects.index') }}" class="pd-back pd-in" style="--d: 0ms">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                All projects
            </a>

            @if($project->category)
                <span class="pd-category pd-in" style="--d: 80ms">{{ $project->category }}</span>
            @endif

            <h1 id="project-title" class="pd-hero__title pd-in" style="--d: 160ms">
                {{ $project->title }}
            </h1>

            @if($project->short_description)
                <p class="pd-hero__text pd-in" style="--d: 280ms">{{ $project->short_description }}</p>
            @endif

            @if($project->client_name)
                <p class="pd-hero__client pd-in" style="--d: 380ms">
                    <i class="fas fa-building" aria-hidden="true"></i>
                    Delivered for <strong>{{ $project->client_name }}</strong>
                </p>
            @endif
        </div>
    </section>

    {{-- MAIN --}}
    <section class="pd-main">
        <div class="container">

            <figure class="pd-cover pd-in" style="--d: 420ms">
                @if($project->cover_image)
                    <img
                        src="{{ asset('storage/' . $project->cover_image) }}"
                        alt="{{ $project->title }}"
                        fetchpriority="high"
                    >
                @else
                    <div class="pd-cover__placeholder">
                        <i class="fas fa-laptop-code" aria-hidden="true"></i>
                    </div>
                @endif
            </figure>

            <div class="row g-5 pd-layout">

                {{-- STORY --}}
                <div class="col-lg-8">

                    <article class="pd-block" data-reveal>
                        <p class="pd-label">Overview</p>
                        <h2>About this project</h2>
                        @if($project->description)
                            <div class="pd-copy">{{ $project->description }}</div>
                        @else
                            <p class="pd-copy pd-copy--muted">Project details will be updated soon.</p>
                        @endif
                    </article>

                    @if($project->challenge || $project->solution || $project->results)
                        <div class="pd-journey">

                            @if($project->challenge)
                                <article class="pd-step" data-reveal>
                                    <span class="pd-step__marker" aria-hidden="true">
                                        <i class="fas fa-triangle-exclamation"></i>
                                    </span>
                                    <p class="pd-label">The challenge</p>
                                    <h2>The problem we addressed</h2>
                                    <div class="pd-copy">{{ $project->challenge }}</div>
                                </article>
                            @endif

                            @if($project->solution)
                                <article class="pd-step" data-reveal>
                                    <span class="pd-step__marker" aria-hidden="true">
                                        <i class="fas fa-lightbulb"></i>
                                    </span>
                                    <p class="pd-label">Our approach</p>
                                    <h2>The solution</h2>
                                    <div class="pd-copy">{{ $project->solution }}</div>
                                </article>
                            @endif

                            @if($project->results)
                                <article class="pd-step pd-step--result" data-reveal>
                                    <span class="pd-step__marker" aria-hidden="true">
                                        <i class="fas fa-chart-line"></i>
                                    </span>
                                    <p class="pd-label">The impact</p>
                                    <h2>Results and outcomes</h2>
                                    <div class="pd-copy">{{ $project->results }}</div>
                                </article>
                            @endif

                        </div>
                    @endif

                </div>

                {{-- SIDEBAR --}}
                <aside class="col-lg-4">
                    <div class="pd-side">

                        <div class="pd-snapshot" data-reveal>
                            <h3>Project snapshot</h3>

                            <dl class="pd-meta">
                                @if($project->client_name)
                                    <div>
                                        <dt>Client</dt>
                                        <dd>{{ $project->client_name }}</dd>
                                    </div>
                                @endif

                                @if($project->category)
                                    <div>
                                        <dt>Category</dt>
                                        <dd>{{ $project->category }}</dd>
                                    </div>
                                @endif

                                @if($project->published_at)
                                    <div>
                                        <dt>Published</dt>
                                        <dd>{{ $project->published_at->format('M Y') }}</dd>
                                    </div>
                                @endif
                            </dl>

                            @if(is_array($project->technologies) && count($project->technologies))
                                <h4>Technologies used</h4>
                                <ul class="pd-tags">
                                    @foreach($project->technologies as $technology)
                                        <li>{{ $technology }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($project->project_url)
                                <a
                                    href="{{ $project->project_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="pd-btn pd-btn--solid"
                                >
                                    Visit project website
                                    <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>

                        <div class="pd-contact" data-reveal style="--i: 1">
                            <h3>Have a similar challenge?</h3>
                            <p>Let's talk about how technology can help your organisation.</p>
                            <a href="{{ url('/#contact') }}" class="pd-btn pd-btn--gold">
                                Talk to our team
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- RELATED --}}
    @if($relatedProjects->count())
        <section class="pd-related" aria-labelledby="related-heading">
            <div class="container">

                <div class="pd-related__head" data-reveal>
                    <h2 id="related-heading">Related projects</h2>
                    <a href="{{ route('projects.index') }}" class="pd-related__all">
                        View all projects
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="row g-4 g-xl-5">
                    @foreach($relatedProjects as $related)
                        <div class="col-md-6 col-lg-4">
                            <a
                                href="{{ route('projects.show', $related->slug) }}"
                                class="pd-rcard"
                                data-reveal
                                style="--i: {{ $loop->index % 3 }}"
                            >
                                <span class="pd-rcard__media">
                                    @if($related->cover_image)
                                        <img
                                            src="{{ asset('storage/' . $related->cover_image) }}"
                                            alt="{{ $related->title }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <span class="pd-rcard__placeholder">
                                            <i class="fas fa-laptop-code" aria-hidden="true"></i>
                                        </span>
                                    @endif

                                    @if($related->category)
                                        <span class="pd-rcard__category">{{ $related->category }}</span>
                                    @endif
                                </span>

                                <span class="pd-rcard__body">
                                    <h3>{{ $related->title }}</h3>
                                    <span class="pd-rcard__more">
                                        View project
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

</div>

<script>
    (function () {
        var root = document.querySelector('.ees-project');
        if (!root) { return; }

        // Reading progress bar.
        var bar = root.querySelector('.pd-progress span');
        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (bar) {
            var ticking = false;
            var update = function () {
                var doc = document.documentElement;
                var max = doc.scrollHeight - window.innerHeight;
                var pct = max > 0 ? Math.min(window.scrollY / max, 1) : 0;
                bar.style.transform = 'scaleX(' + pct + ')';
                ticking = false;
            };
            window.addEventListener('scroll', function () {
                if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
            }, { passive: true });
            update();
        }

        // Scroll reveal. Content stays visible without JavaScript or IntersectionObserver.
        if (reduce || !('IntersectionObserver' in window)) { return; }

        root.classList.add('pd-js');

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        root.querySelectorAll('[data-reveal]').forEach(function (el) { observer.observe(el); });
    })();
</script>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Figtree:wght@400;500;600;700&display=swap');

    .ees-project {
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

    .ees-project .container { max-width: 1200px; }

    .ees-project h1,
    .ees-project h2,
    .ees-project h3,
    .ees-project h4 {
        font-family: var(--font-display);
        margin: 0;
    }

    .ees-project a:focus-visible {
        outline: 3px solid var(--gold);
        outline-offset: 3px;
    }

    /* ---------- Reading progress ---------- */
    .pd-progress {
        position: fixed;
        z-index: 1040;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        pointer-events: none;
    }

    .pd-progress span {
        display: block;
        height: 100%;
        background: linear-gradient(90deg, var(--blue), var(--gold));
        transform: scaleX(0);
        transform-origin: 0 50%;
    }

    /* ---------- Shared ---------- */
    .pd-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 12px;
        color: var(--blue);
        font-size: 15px;
        font-weight: 700;
    }

    .pd-label::before {
        content: "";
        width: 24px;
        height: 3px;
        border-radius: 2px;
        background: var(--gold);
    }

    .pd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 52px;
        padding: 12px 22px;
        border-radius: 999px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .25s ease, color .25s ease, transform .25s var(--ease), box-shadow .25s ease;
    }

    .pd-btn i { font-size: 13px; transition: transform .25s var(--ease); }
    .pd-btn:hover { transform: translateY(-2px); }
    .pd-btn:hover i.fa-arrow-right { transform: translateX(4px); }
    .pd-btn:hover i.fa-arrow-up-right-from-square { transform: translate(2px, -2px); }

    .pd-btn--solid { color: #fff; background: var(--blue); }
    .pd-btn--solid:hover { color: #fff; background: var(--navy); }

    .pd-btn--gold { color: var(--navy); background: var(--gold); }
    .pd-btn--gold:hover { color: var(--navy); background: #f3c25b; box-shadow: 0 12px 28px rgba(233, 177, 58, .3); }

    .pd-in {
        animation: pd-fade-up .85s var(--ease) both;
        animation-delay: var(--d, 0ms);
    }

    @keyframes pd-fade-up {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: none; }
    }

    /* ---------- Hero ---------- */
    .pd-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(36px, 5vw, 64px) 0 clamp(96px, 11vw, 150px);
        color: #fff;
        background: var(--navy);
    }

    .pd-hero__orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
    }

    .pd-hero__orb--a {
        width: 480px;
        height: 480px;
        top: -200px;
        right: 6%;
        background: rgba(8, 120, 209, .5);
        animation: pd-drift-a 16s ease-in-out infinite alternate;
    }

    .pd-hero__orb--b {
        width: 340px;
        height: 340px;
        bottom: -190px;
        left: 6%;
        background: rgba(233, 177, 58, .15);
        animation: pd-drift-b 20s ease-in-out infinite alternate;
    }

    .pd-hero__grid {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, .12) 1px, transparent 1px);
        background-size: 30px 30px;
        mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        -webkit-mask-image: linear-gradient(180deg, #000 0%, transparent 85%);
        pointer-events: none;
    }

    @keyframes pd-drift-a {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(-60px, 50px, 0) scale(1.12); }
    }

    @keyframes pd-drift-b {
        from { transform: translate3d(0, 0, 0) scale(1); }
        to   { transform: translate3d(70px, -40px, 0) scale(1.1); }
    }

    .pd-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: clamp(32px, 5vw, 56px);
        color: #9cc8f3;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: color .2s ease;
    }

    .pd-back i { transition: transform .3s var(--ease); }
    .pd-back:hover { color: #fff; }
    .pd-back:hover i { transform: translateX(-5px); }

    .pd-category {
        display: block;
        width: fit-content;
        margin-bottom: 22px;
        padding: 7px 16px;
        color: var(--navy);
        background: var(--gold);
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
    }

    .pd-hero__title {
        max-width: 18ch;
        color: #fff;
        font-size: clamp(38px, 5.6vw, 80px);
        font-weight: 800;
        line-height: 1.04;
        letter-spacing: -.035em;
        text-wrap: balance;
    }

    .pd-hero__text {
        max-width: 60ch;
        margin: 26px 0 0;
        color: rgba(255, 255, 255, .8);
        font-size: clamp(16px, 1.4vw, 19px);
        line-height: 1.7;
    }

    .pd-hero__client {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 26px 0 0;
        color: #b9cde6;
        font-size: 16px;
    }

    .pd-hero__client i { color: var(--gold); }
    .pd-hero__client strong { color: #fff; font-weight: 700; }

    /* ---------- Main ---------- */
    .pd-main {
        padding: 0 0 clamp(56px, 7vw, 104px);
        background: #fff;
    }

    .pd-cover {
        position: relative;
        margin: calc(-1 * clamp(56px, 7vw, 96px)) 0 0;
        overflow: hidden;
        border-radius: 28px;
        background: var(--blue-soft);
        box-shadow: 0 40px 80px -30px rgba(6, 27, 61, .45);
    }

    .pd-cover img {
        display: block;
        width: 100%;
        max-height: 620px;
        object-fit: cover;
        animation: pd-cover-zoom 1.8s var(--ease) both;
    }

    @keyframes pd-cover-zoom {
        from { transform: scale(1.08); }
        to   { transform: scale(1); }
    }

    .pd-cover__placeholder {
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8ea5c4;
        font-size: 64px;
        background: linear-gradient(135deg, #eaf2fc, #d7e5f6);
    }

    .pd-layout {
        margin-top: clamp(24px, 4vw, 48px);
    }

    .pd-block {
        margin-bottom: clamp(40px, 5vw, 64px);
    }

    .pd-block h2,
    .pd-step h2 {
        margin-bottom: 18px;
        color: var(--navy);
        font-size: clamp(28px, 3.2vw, 40px);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -.025em;
    }

    .pd-copy {
        max-width: 68ch;
        color: #3d4a60;
        font-size: 17.5px;
        line-height: 1.85;
        white-space: pre-line;
    }

    .pd-copy--muted { color: var(--muted); }

    /* Challenge, solution and results read as a story with a connecting line. */
    .pd-journey {
        position: relative;
        padding-left: clamp(52px, 6vw, 76px);
    }

    .pd-journey::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 10px;
        bottom: 10px;
        width: 2px;
        background: linear-gradient(180deg, var(--blue), var(--gold));
        opacity: .35;
        border-radius: 2px;
    }

    @media (min-width: 768px) {
        .pd-journey::before { left: 26px; }
    }

    .pd-step {
        position: relative;
        margin-bottom: clamp(40px, 5vw, 60px);
    }

    .pd-step:last-child { margin-bottom: 0; }

    .pd-step__marker {
        position: absolute;
        left: calc(-1 * clamp(52px, 6vw, 76px));
        top: -4px;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
        background: #fff;
        border: 2px solid var(--blue-soft);
        border-radius: 50%;
        font-size: 17px;
        box-shadow: 0 0 0 6px #fff;
        transition: color .3s ease, background-color .3s ease, border-color .3s ease, transform .4s var(--ease);
    }

    @media (min-width: 768px) {
        .pd-step__marker { width: 54px; height: 54px; font-size: 19px; }
    }

    .pd-step:hover .pd-step__marker {
        color: #fff;
        background: var(--blue);
        border-color: var(--blue);
        transform: scale(1.08);
    }

    .pd-step--result .pd-step__marker {
        color: var(--navy);
        background: var(--gold);
        border-color: var(--gold);
    }

    .pd-step--result:hover .pd-step__marker {
        color: var(--navy);
        background: #f3c25b;
        border-color: #f3c25b;
    }

    /* ---------- Sidebar ---------- */
    .pd-side {
        position: sticky;
        top: 108px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .pd-snapshot {
        padding: 28px;
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 24px;
    }

    .pd-snapshot h3 {
        margin-bottom: 8px;
        color: var(--navy);
        font-size: 22px;
        font-weight: 800;
    }

    .pd-meta { margin: 0; }

    .pd-meta > div {
        padding: 16px 0;
        border-bottom: 1px solid var(--line);
    }

    .pd-meta dt {
        margin-bottom: 4px;
        color: var(--muted);
        font-size: 14px;
        font-weight: 600;
    }

    .pd-meta dd {
        margin: 0;
        color: var(--navy);
        font-size: 17px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .pd-snapshot h4 {
        margin: 24px 0 14px;
        color: var(--navy);
        font-size: 17px;
        font-weight: 700;
    }

    .pd-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .pd-tags li {
        padding: 6px 13px;
        color: var(--navy-2);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        transition: color .25s ease, background-color .25s ease, border-color .25s ease, transform .25s var(--ease);
    }

    .pd-tags li:hover {
        color: #fff;
        background: var(--navy-2);
        border-color: var(--navy-2);
        transform: translateY(-2px);
    }

    .pd-snapshot .pd-btn { margin-top: 26px; }

    .pd-contact {
        position: relative;
        overflow: hidden;
        padding: 28px;
        color: #fff;
        background:
            radial-gradient(circle at 100% 0%, rgba(8, 120, 209, .55), transparent 55%),
            var(--navy);
        border-radius: 24px;
    }

    .pd-contact h3 {
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -.015em;
    }

    .pd-contact p {
        margin: 12px 0 22px;
        color: rgba(255, 255, 255, .8);
        font-size: 16px;
        line-height: 1.65;
    }

    /* ---------- Related ---------- */
    .pd-related {
        padding: clamp(56px, 7vw, 104px) 0;
        background: var(--paper);
    }

    .pd-related__head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: clamp(28px, 4vw, 48px);
    }

    .pd-related__head h2 {
        color: var(--navy);
        font-size: clamp(30px, 3.8vw, 48px);
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -.03em;
    }

    .pd-related__all {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        color: var(--blue);
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
    }

    .pd-related__all i { transition: transform .3s var(--ease); }
    .pd-related__all:hover { color: var(--navy); }
    .pd-related__all:hover i { transform: translateX(5px); }

    .pd-rcard {
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        color: inherit;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 24px;
        text-decoration: none;
        transition: transform .4s var(--ease), box-shadow .4s ease, border-color .3s ease;
    }

    .pd-rcard:hover {
        color: inherit;
        transform: translateY(-8px);
        border-color: transparent;
        box-shadow: 0 30px 60px -24px rgba(6, 27, 61, .35);
    }

    .pd-rcard__media {
        position: relative;
        display: block;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: var(--blue-soft);
    }

    .pd-rcard__media img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform .8s var(--ease);
    }

    .pd-rcard:hover .pd-rcard__media img { transform: scale(1.07); }

    .pd-rcard__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8ea5c4;
        font-size: 44px;
        background: linear-gradient(135deg, #eaf2fc, #d7e5f6);
    }

    .pd-rcard__category {
        position: absolute;
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

    .pd-rcard__body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 24px;
    }

    .pd-rcard__body h3 {
        flex: 1;
        color: var(--navy);
        font-size: 22px;
        font-weight: 700;
        line-height: 1.25;
        letter-spacing: -.015em;
        transition: color .25s ease;
    }

    .pd-rcard:hover .pd-rcard__body h3 { color: var(--blue); }

    .pd-rcard__more {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 16px;
        color: var(--blue);
        border-top: 1px solid var(--line);
        font-size: 15px;
        font-weight: 700;
    }

    .pd-rcard__more i {
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

    .pd-rcard:hover .pd-rcard__more i {
        color: #fff;
        background: var(--blue);
        transform: translateX(4px);
    }

    /* ---------- Scroll reveal (enabled only when JS runs) ---------- */
    .pd-js [data-reveal] {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity .8s var(--ease), transform .8s var(--ease);
        transition-delay: calc(var(--i, 0) * 110ms);
    }

    .pd-js [data-reveal].is-visible {
        opacity: 1;
        transform: none;
    }

    .pd-js .pd-rcard.is-visible {
        transition:
            opacity .8s var(--ease),
            transform .4s var(--ease),
            box-shadow .4s ease,
            border-color .3s ease;
        transition-delay: 0s;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .pd-side { position: static; }
    }

    @media (max-width: 767.98px) {
        .pd-related__head {
            flex-direction: column;
            align-items: flex-start;
        }

        .pd-cover { border-radius: 20px; }
        .pd-cover img { max-height: 360px; }
        .pd-snapshot,
        .pd-contact { padding: 24px; border-radius: 20px; }
        .pd-copy { font-size: 16.5px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ees-project *,
        .ees-project *::before,
        .ees-project *::after {
            animation: none !important;
            transition-duration: .01ms !important;
            transition-delay: 0s !important;
        }

        .pd-js [data-reveal] { opacity: 1; transform: none; }
    }
</style>
@endpush