@extends('layouts.app')

@section('styles')
<style>
    /* 1. Project Cards */
    .home-project-card { aspect-ratio: 3 / 4.2; }
    .serif-title { font-family: 'Cinzel', serif; }

    /* 2. Services */
    .service-container-row { display: flex; flex-wrap: nowrap; gap: 0; }
    .service-block { position: relative; height: 520px; overflow: hidden; flex: 1 1 0; min-width: 0; }
@media (max-width: 1100px) { .service-container-row { flex-wrap: wrap; } .service-block { flex: 1 0 33.333%; min-width: 33.333%; } }
@media (max-width: 640px)  { .service-block { flex: 1 0 100%; min-width: 100%; } }
    .service-block img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.5s ease; }
    .service-block:hover img { transform: scale(1.1); }
    .service-block-overlay {
        position: absolute; inset: 0;
        background: rgba(0,0,0,0.4);
        transition: background 0.5s ease;
        display: flex; flex-direction: column;
        justify-content: center; align-items: center;
        text-align: center; padding: 40px; z-index: 10;
    }
    .service-block:hover .service-block-overlay { background: rgba(244,164,28,0.3); }

    /* ===== TESTIMONIALS SECTION ===== */
    .ts-section {
        background: #1a2235;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    .ts-geo-bg {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0;
        width: 100%; height: 100%;
    }
    .ts-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 56px;
        position: relative; z-index: 2;
    }
    .ts-eyebrow { display: flex; align-items: center; gap: 14px; margin-bottom: 14px; }
    .ts-eyebrow-line { width: 38px; height: 2px; background: #f4a41c; flex-shrink: 0; }
    .ts-eyebrow span {
        font-size: 10px; font-weight: 700;
        letter-spacing: 0.5em; text-transform: uppercase; color: #f4a41c;
    }
    .ts-main-heading {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.9rem, 4vw, 3.2rem);
        font-weight: 900; color: #ffffff;
        text-transform: uppercase; line-height: 1.1; letter-spacing: -0.01em;
    }
    .ts-main-heading em { color: #f4a41c; font-style: normal; }
    .ts-counter-block { text-align: right; padding-bottom: 4px; }
    .ts-counter-num {
        font-family: 'Cinzel', serif;
        font-size: 54px; font-weight: 900; color: #ffffff; line-height: 1;
    }
    .ts-counter-label {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.4em; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-top: 5px;
    }
    .ts-card {
        display: grid; grid-template-columns: 1.15fr 1fr;
        position: relative; z-index: 2;
        box-shadow: 0 24px 64px rgba(0,0,0,0.4);
    }
    .ts-media-side {
        position: relative; overflow: hidden;
        background: #ddd4c5; min-height: 460px;
    }
    .ts-media-side img {
        width: 100%; height: 100%; object-fit: cover;
        display: block; transition: transform 1.2s ease;
    }
    .ts-media-side:hover img { transform: scale(1.04); }
    .ts-media-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(10,22,40,0.72) 0%, rgba(10,22,40,0.04) 55%);
        pointer-events: none;
    }
    .ts-play-btn {
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 64px; height: 64px;
        border: 2px solid rgba(255,255,255,0.9); border-radius: 50%;
        background: rgba(244,164,28,0.18);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s ease; z-index: 10;
    }
    .ts-play-btn:hover {
        background: #f4a41c; border-color: #f4a41c;
        transform: translate(-50%, -50%) scale(1.1);
    }
    .ts-play-btn svg { width: 22px; height: 22px; fill: #fff; margin-left: 4px; }
    .ts-media-caption {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 28px 32px;
        background: linear-gradient(to top, rgba(10,22,40,0.88) 0%, transparent 100%);
        z-index: 5;
    }
    .ts-caption-badge {
        display: inline-block; background: #f4a41c; color: #0a1628;
        font-size: 8px; font-weight: 800;
        letter-spacing: 0.35em; text-transform: uppercase;
        padding: 4px 12px; margin-bottom: 10px;
    }
    .ts-caption-text {
        color: rgba(255,255,255,0.92); font-size: 13px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.05em;
        line-height: 1.45; max-width: 300px;
    }
    .ts-content-side {
        background: #0a1628; padding: 48px 52px;
        display: flex; flex-direction: column; justify-content: space-between;
        border-top: 3px solid #f4a41c;
    }
    .ts-quote-icon {
        font-family: 'Cinzel', serif; font-size: 80px; line-height: 0.75;
        color: #f4a41c; opacity: 0.3; margin-bottom: 10px; display: block;
    }
    .ts-quote-text {
        color: rgba(255,255,255,0.8); font-size: 14.5px; line-height: 1.85;
        font-weight: 400; font-style: italic; margin-bottom: 28px;
        transition: opacity 0.25s ease;
    }
    .ts-stars { display: flex; gap: 4px; margin-bottom: 22px; }
    .ts-stars svg { width: 16px; height: 16px; fill: #f4a41c; }
    .ts-author { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
    .ts-avatar {
        width: 50px; height: 50px; border-radius: 50%;
        background: #f4a41c;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Cinzel', serif; font-size: 16px; font-weight: 900;
        color: #0a1628; flex-shrink: 0;
    }
    .ts-author-name {
        font-family: 'Cinzel', serif; font-size: 15px; font-weight: 800;
        color: #ffffff; text-transform: uppercase; letter-spacing: 0.06em;
    }
    .ts-author-role {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.3em; text-transform: uppercase; color: #f4a41c; margin-top: 4px;
    }
    .ts-card-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);
    }
    .ts-progress-dots { display: flex; gap: 7px; align-items: center; }
    .ts-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: rgba(255,255,255,0.2); border: none; cursor: pointer;
        transition: all 0.3s ease; padding: 0;
    }
    .ts-dot.active { background: #f4a41c; width: 22px; border-radius: 4px; }
    .ts-navs { display: flex; gap: 10px; }
    .ts-nav-btn {
        width: 46px; height: 46px; border: 1.5px solid rgba(255,255,255,0.15);
        background: transparent; color: #ffffff; font-size: 20px;
        cursor: pointer; display: flex; align-items: center;
        justify-content: center; transition: all 0.25s ease;
    }
    .ts-nav-btn:hover { background: #f4a41c; border-color: #f4a41c; color: #0a1628; }
    .ts-iframe-wrap { position: absolute; inset: 0; }
    .ts-iframe-wrap iframe { width: 100%; height: 100%; border: none; display: block; }

    @media (max-width: 1024px) {
        .ts-card { grid-template-columns: 1fr; }
        .ts-media-side { min-height: 320px; aspect-ratio: 16/9; }
        .ts-content-side { padding: 36px 32px; }
        .ts-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        .ts-counter-block { text-align: left; }
    }
    @media (max-width: 640px) {
        .ts-section { padding: 64px 0; }
        .ts-content-side { padding: 28px 20px; }
        .ts-main-heading { font-size: 1.8rem; }
    }

    /* ===== MAP SECTION ===== */
    .map-section {
        position: relative;
        background: #e8e4de;
        overflow: hidden;
        min-height: 700px;
    }
    .map-arch-bg {
        position: absolute; inset: 0;
        width: 100%; height: 100%;
        pointer-events: none; z-index: 0;
    }
    .map-watermark {
        position: absolute; top: 50%; right: -2%;
        transform: translateY(-50%);
        font-family: 'Cinzel', serif;
        font-size: clamp(80px, 12vw, 160px);
        font-weight: 900;
        color: rgba(10, 22, 40, 0.055);
        text-transform: uppercase; letter-spacing: 0.08em;
        pointer-events: none; z-index: 1; line-height: 1; white-space: nowrap;
    }
    .map-filter-bar {
        position: absolute; bottom: 0; left: 50%;
        transform: translateX(-50%);
        z-index: 20; display: flex; gap: 0;
        background: rgba(10,22,40,0.88);
        backdrop-filter: blur(8px);
        border-top: 2px solid #f4a41c;
        width: 100%; max-width: 820px;
        box-shadow: 0 -8px 40px rgba(10,22,40,0.18);
    }
    .map-filter-item { flex: 1; position: relative; }
    .map-filter-item + .map-filter-item { border-left: 1px solid rgba(255,255,255,0.08); }
    .map-filter-select {
        width: 100%; background: transparent; border: none;
        color: #fff; font-family: inherit; font-size: 10px; font-weight: 700;
        letter-spacing: 0.35em; text-transform: uppercase;
        padding: 22px 44px 22px 24px;
        appearance: none; cursor: pointer; outline: none; transition: background 0.2s;
    }
    .map-filter-select:hover { background: rgba(244,164,28,0.12); }
    .map-filter-select option { background: #0a1628; color: #fff; font-size: 12px; }
    .map-filter-chevron {
        position: absolute; right: 18px; top: 50%;
        transform: translateY(-50%); pointer-events: none; color: #f4a41c;
    }
    .map-filter-chevron svg { width: 14px; height: 14px; }
    .map-embed-wrapper {
        position: relative; z-index: 5; height: 520px;
        filter: grayscale(0.55) contrast(1.08) sepia(0.18);
        transition: filter 0.4s;
    }
    .map-embed-wrapper:hover { filter: grayscale(0.25) contrast(1.1) sepia(0.1); }
    .map-embed-wrapper iframe { width: 100%; height: 100%; border: none; display: block; }
    .map-outer { position: relative; z-index: 4; }
    .map-frame-border {
        position: relative;
        border: 1.5px solid rgba(244,164,28,0.3);
        box-shadow: 0 32px 80px rgba(10,22,40,0.18), inset 0 0 0 1px rgba(255,255,255,0.04);
    }
    .map-corner { position: absolute; width: 28px; height: 28px; z-index: 10; pointer-events: none; }
    .map-corner-tl { top: -1px; left: -1px; border-top: 3px solid #f4a41c; border-left: 3px solid #f4a41c; }
    .map-corner-tr { top: -1px; right: -1px; border-top: 3px solid #f4a41c; border-right: 3px solid #f4a41c; }
    .map-corner-bl { bottom: -1px; left: -1px; border-bottom: 3px solid #f4a41c; border-left: 3px solid #f4a41c; }
    .map-corner-br { bottom: -1px; right: -1px; border-bottom: 3px solid #f4a41c; border-right: 3px solid #f4a41c; }

    @media (max-width: 768px) {
        .map-embed-wrapper { height: 360px; }
        .map-filter-bar { max-width: 100%; flex-direction: column; }
        .map-filter-item + .map-filter-item { border-left: none; border-top: 1px solid rgba(255,255,255,0.08); }
        .map-watermark { font-size: 52px; }
    }

    /* ===== SCHEDULE A MEETING SECTION ===== */
.sam-section {
    position: relative;
    background: #f5f1eb;
    overflow: hidden;
    padding: 80px 0;           /* padding top/bottom so section has breathing room */
}
.sam-bg-svg {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    pointer-events: none; z-index: 0;
}
.sam-inner {
    position: relative; z-index: 2;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;       /* vertically center both columns */
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ── IMAGE COLUMN ── */
.sam-image-col {
    position: relative;
}
.sam-image-frame {
    position: relative;
    width: 100%;
    height: 520px;             /* FIXED HEIGHT — matches reference */
    border-radius: 2px;
    overflow: hidden;
    /* shadow like the reference screenshot */
    box-shadow:
        0 20px 60px rgba(10, 22, 40, 0.22),
        0 8px 24px  rgba(10, 22, 40, 0.14),
        6px 6px 0   rgba(244, 164, 28, 0.35);  /* gold offset shadow */
}
.sam-image-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 1.4s ease;
}
.sam-image-col:hover .sam-image-frame img {
    transform: scale(1.04);
}

/* subtle dark gradient at bottom of image */
.sam-image-frame::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(
        to bottom,
        transparent 55%,
        rgba(10, 22, 40, 0.35) 100%
    );
    pointer-events: none;
}

.sam-image-tag {
    position: absolute; bottom: 24px; left: 24px;
    display: flex; align-items: center; gap: 10px;
    background: #f4a41c; padding: 10px 20px; z-index: 5;
}
.sam-image-tag svg { width: 18px; height: 18px; flex-shrink: 0; }
.sam-image-tag span {
    font-size: 9px; font-weight: 800;
    letter-spacing: 0.35em; text-transform: uppercase; color: #0a1628;
}

/* ── FORM COLUMN ── */
.sam-form-col {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.sam-eyebrow { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; }
.sam-eyebrow-line { width: 38px; height: 2px; background: #f4a41c; flex-shrink: 0; }
.sam-eyebrow span {
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.5em; text-transform: uppercase; color: #f4a41c;
}
.sam-heading {
    font-family: 'Cinzel', serif;
    font-size: clamp(1.8rem, 3vw, 2.8rem);
    font-weight: 900; color: #0a1628;
    text-transform: uppercase; line-height: 1.1; margin-bottom: 14px;
}
.sam-heading em { color: #f4a41c; font-style: normal; }
.sam-subtext {
    font-size: 13px; color: #6b7a8d;
    line-height: 1.7; margin-bottom: 32px; max-width: 400px;
}
.sam-form { display: flex; flex-direction: column; gap: 16px; }
.sam-field { position: relative; }
.sam-input {
    width: 100%; background: #ffffff;
    border: 1.5px solid #e2dbd0; color: #0a1628;
    font-family: inherit; font-size: 13px; font-weight: 500;
    padding: 14px 18px; outline: none;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
    border-radius: 0; appearance: none;
}
.sam-input::placeholder {
    color: #9ca3a8; font-size: 12px;
    font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;
}
.sam-input:focus {
    border-color: #f4a41c;
    box-shadow: 0 0 0 3px rgba(244,164,28,0.1);
}
.sam-select-wrap { position: relative; }
.sam-select { cursor: pointer; padding-right: 44px; color: #9ca3a8; }
.sam-select:focus, .sam-select:valid { color: #0a1628; }
.sam-select-chevron {
    position: absolute; right: 16px; top: 50%;
    transform: translateY(-50%); pointer-events: none; color: #f4a41c;
}
.sam-select-chevron svg { width: 16px; height: 16px; }
.sam-btn {
    display: flex; align-items: center; justify-content: center;
    gap: 10px; padding: 16px 36px;
    background: #0a1628; color: #ffffff;
    border: 2px solid #0a1628;
    font-family: inherit; font-size: 10px; font-weight: 800;
    letter-spacing: 0.4em; text-transform: uppercase;
    cursor: pointer; transition: all 0.3s ease;
    margin-top: 8px; width: 100%;
}
.sam-btn svg { width: 16px; height: 16px; transition: transform 0.3s ease; }
.sam-btn:hover { background: #f4a41c; border-color: #f4a41c; color: #0a1628; }
.sam-btn:hover svg { transform: translateX(4px); }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .sam-inner {
        grid-template-columns: 1fr;
        gap: 48px;
        padding: 0 32px;
    }
    .sam-image-frame { height: 400px; }
}
@media (max-width: 768px) {
    .sam-section { padding: 60px 0; }
    .sam-inner { padding: 0 20px; gap: 36px; }
    .sam-image-frame { height: 300px; }
    .sam-heading { font-size: 1.8rem; }
}
@media (max-width: 480px) {
    .sam-image-frame { height: 240px; }
}
</style>
@endsection

@section('content')

{{-- ============================================================
     SECTION 1: HERO SLIDER — bg: pure black
     ============================================================ --}}
<section class="relative h-screen w-full overflow-hidden bg-black">
    <div class="swiper heroSwiper h-full w-full">
        <div class="swiper-wrapper">
            @foreach($sliders ?? [] as $slide)
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-black/20 z-10"></div>
                @php
                    $slideImg = $slide->image;
                    $slideUrl = asset(ltrim(Str::replaceFirst('storage/', '', $slideImg), '/'));
                @endphp
                <img src="{{ $slideUrl }}" class="w-full h-full object-cover" alt="Slider"
                     onerror="this.onerror=null;this.src='https://placehold.co/1920x1080?text=Slider+Image';">
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-6">
                    <h2 class="serif text-white text-4xl md:text-6xl font-bold tracking-tight mb-4" data-aos="fade-up">
                        {{ $slide->title }}
                    </h2>
                    <p class="text-white text-lg font-medium max-w-2xl" data-aos="fade-up" data-aos-delay="200">
                        {{ $slide->subtitle ?? 'Excellence in Every Square Foot' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination !bottom-10"></div>
    </div>
</section>

{{-- ============================================================
     SECTION 2: WELCOME — bg: #0d1b2e (slightly lighter navy)
     ============================================================ --}}
<section class="relative py-24 overflow-hidden" style="background:#0d1b2e;">
    <div class="absolute right-0 top-0 h-full w-1/3 opacity-5 pointer-events-none">
        <svg viewBox="0 0 100 100" class="h-full w-full fill-white"><path d="M50 5 L95 95 L5 95 Z"/></svg>
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <h4 class="text-white text-xl font-bold mb-2">Welcome to</h4>
                <h2 class="text-[#f4a41c] text-3xl md:text-4xl font-extrabold uppercase mb-8">Trikon Holdings</h2>
                <div class="space-y-6 text-white/90 text-sm leading-relaxed font-light">
                    <p>Discover a new standard in real estate with Trikon Holdings, a trusted name in Bangladesh's real estate sector, specializing in property development, luxury residential apartments, commercial spaces, and land projects.</p>
                    <p>We are dedicated to delivering developments that combine quality construction, modern design, and long-term investment value.</p>
                    <p>Whether you are seeking your dream home, a functional office space, or a secure investment opportunity, Trikon Holdings offers reliable solutions tailored to your needs.</p>
                    <p>Experience premium living, exceptional opportunities, and smart investments with Trikon.</p>
                </div>
            </div>
            <div data-aos="fade-left">
                <div class="relative w-full overflow-hidden bg-black shadow-2xl border border-[#f4a41c]/20" style="padding-bottom:56.25%;">
                    @php
                        $settings = \App\Models\Setting::first();
                        $videoUrl = trim($settings->welcome_video_url ?? '');
                        $videoId  = null;
                        if ($videoUrl) {
                            if (preg_match('/youtu\.be\/([^\?\/]+)/', $videoUrl, $matches))       $videoId = $matches[1];
                            elseif (preg_match('/v=([^\&]+)/', $videoUrl, $matches))               $videoId = $matches[1];
                            elseif (preg_match('/embed\/([^\?\/]+)/', $videoUrl, $matches))        $videoId = $matches[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1"
                            title="Welcome Video" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-900">
                            <div class="text-center">
                                <p class="text-white/50 uppercase tracking-[0.3em] text-xs mb-3">Video Not Found</p>
                                <p class="text-white/30 text-[11px]">Please add a valid YouTube URL from admin panel</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 3: OUR PROJECTS — bg: #e8920a with artistic overlay
     ============================================================ --}}
<section class="py-24 bg-[#e8920a] relative overflow-hidden">

    {{-- Artistic SVG Background --}}
    <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;" viewBox="0 0 1440 780" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">

        {{-- Dark corner wedges --}}
        <polygon points="0,0 440,0 0,340" fill="#d4820a" opacity="0.55"/>
        <polygon points="1440,440 1440,780 1000,780" fill="#d4820a" opacity="0.5"/>
        <polygon points="0,0 240,0 0,170" fill="#c47208" opacity="0.65"/>
        <polygon points="1440,610 1440,780 1180,780" fill="#c47208" opacity="0.6"/>

        {{-- Diagonal ruled lines left side --}}
        <line x1="0" y1="0" x2="540" y2="780" stroke="#bf6c06" stroke-width="1.5" opacity="0.45"/>
        <line x1="80" y1="0" x2="620" y2="780" stroke="#bf6c06" stroke-width="1" opacity="0.3"/>
        <line x1="160" y1="0" x2="700" y2="780" stroke="#bf6c06" stroke-width="0.8" opacity="0.2"/>

        {{-- Diagonal ruled lines right side --}}
        <line x1="1440" y1="0" x2="900" y2="780" stroke="#bf6c06" stroke-width="1.5" opacity="0.45"/>
        <line x1="1360" y1="0" x2="820" y2="780" stroke="#bf6c06" stroke-width="1" opacity="0.3"/>
        <line x1="1280" y1="0" x2="740" y2="780" stroke="#bf6c06" stroke-width="0.8" opacity="0.2"/>

        {{-- Concentric circles --}}
        <circle cx="720" cy="390" r="440" fill="none" stroke="#f4a41c" stroke-width="1.5" opacity="0.16"/>
        <circle cx="720" cy="390" r="330" fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.11"/>
        <circle cx="720" cy="390" r="220" fill="none" stroke="#f4a41c" stroke-width="0.8" opacity="0.08"/>

        {{-- Triangle forms --}}
        <polygon points="720,28 900,320 540,320" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1.5"/>
        <polygon points="720,752 900,460 540,460" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="1"/>

        {{-- Light beam polygons --}}
        <polygon points="360,0 440,0 0,480 0,400" fill="rgba(255,255,255,0.04)"/>
        <polygon points="1080,780 1000,780 1440,300 1440,380" fill="rgba(255,255,255,0.04)"/>

        {{-- Giant watermark T --}}
        <text x="720" y="680" font-size="680" font-weight="900" fill="rgba(26,15,0,0.055)" font-family="serif" text-anchor="middle" letter-spacing="-30">T</text>

        {{-- Corner bracket top-left --}}
        <line x1="36" y1="36" x2="36" y2="105" stroke="rgba(26,15,0,0.12)" stroke-width="3"/>
        <line x1="36" y1="36" x2="105" y2="36" stroke="rgba(26,15,0,0.12)" stroke-width="3"/>

        {{-- Corner bracket bottom-right --}}
        <line x1="1404" y1="744" x2="1404" y2="675" stroke="rgba(26,15,0,0.08)" stroke-width="2.5"/>
        <line x1="1404" y1="744" x2="1335" y2="744" stroke="rgba(26,15,0,0.08)" stroke-width="2.5"/>

        {{-- Dot grid top-right --}}
        <g fill="rgba(26,15,0,0.09)">
            @for($r=0;$r<3;$r++) @for($c=0;$c<3;$c++)
            <circle cx="{{ 1130+$c*34 }}" cy="{{ 68+$r*34 }}" r="3"/>
            @endfor @endfor
        </g>

        {{-- Dot grid bottom-left --}}
        <g fill="rgba(26,15,0,0.06)">
            @for($r=0;$r<3;$r++) @for($c=0;$c<3;$c++)
            <circle cx="{{ 210+$c*34 }}" cy="{{ 648+$r*34 }}" r="3"/>
            @endfor @endfor
        </g>

        {{-- Horizontal accent lines --}}
        <rect x="0" y="386" width="100" height="2" fill="rgba(255,255,255,0.12)"/>
        <rect x="1340" y="386" width="100" height="2" fill="rgba(255,255,255,0.12)"/>
    </svg>

    {{-- Content (identical to your original) --}}
    <div class="max-w-7xl mx-auto px-6 relative" style="z-index:2;">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="serif-title text-white text-4xl md:text-6xl font-black uppercase tracking-widest">
                OUR <span class="text-gray-900">PROJECTS</span>
            </h2>
            <div class="w-16 h-1 bg-gray-900 mx-auto mt-4 mb-6"></div>
            <p class="text-gray-900 font-bold text-[10px] uppercase tracking-[0.3em] max-w-3xl mx-auto">
                Where excellence is redefined through top-tier property solutions.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($projects ?? [] as $project)
            <a href="{{ url('/project/' . $project->slug) }}" class="group relative block overflow-hidden shadow-2xl home-project-card bg-gray-800" data-aos="fade-up">
                @php
                    $projImg = $project->featured_image;
                    $projUrl = asset(ltrim(Str::replaceFirst('storage/', '', $projImg), '/'));
                @endphp
                <img src="{{ $projUrl }}"
                     class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-110"
                     alt="{{ $project->title }}"
                     onerror="this.onerror=null;this.src='https://placehold.co/600x800?text=Project+Image';">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 bg-black/50 backdrop-blur-[2px]">
                    <h3 class="text-white font-black text-2xl uppercase tracking-tighter mb-2">{{ $project->title }}</h3>
                    <div class="w-10 h-[1px] bg-[#f4a41c] mb-4"></div>
                    <p class="text-white/80 text-[10px] font-bold uppercase tracking-[0.3em]">
                        {{ $project->location ?? 'Bashundhara R/A' }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-16">
            <a href="{{ route('projects.residential') }}" class="inline-block px-12 py-4 bg-gray-900 text-white font-black uppercase text-[10px] tracking-[0.5em] hover:bg-white hover:text-gray-900 transition-all shadow-xl">
                Explore All Projects
            </a>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: OUR SERVICES — bg: warm white #f5f1eb
     ============================================================ --}}
<section class="svc-section relative overflow-hidden" style="background:#f5f1eb;">

    {{-- ===== ANIMATED ARTISTIC BACKGROUND ===== --}}
    <div class="svc-bg-canvas" aria-hidden="true">

        {{-- Floating animated orbs --}}
        <div class="svc-orb svc-orb-1"></div>
        <div class="svc-orb svc-orb-2"></div>
        <div class="svc-orb svc-orb-3"></div>

        {{-- Animated diagonal ruled lines --}}
        <svg class="svc-lines-svg" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <line class="svc-animated-line" x1="0" y1="200" x2="600" y2="900" stroke="#c8a96e" stroke-width="1.5" opacity="0"/>
            <line class="svc-animated-line" x1="100" y1="0" x2="700" y2="900" stroke="#c8a96e" stroke-width="1" opacity="0"/>
            <line class="svc-animated-line" x1="300" y1="0" x2="900" y2="900" stroke="#c8a96e" stroke-width="0.8" opacity="0"/>
            <line class="svc-animated-line" x1="1440" y1="200" x2="840" y2="900" stroke="#c8a96e" stroke-width="1.5" opacity="0"/>
            <line class="svc-animated-line" x1="1340" y1="0" x2="740" y2="900" stroke="#c8a96e" stroke-width="1" opacity="0"/>
            <line class="svc-animated-line" x1="1140" y1="0" x2="540" y2="900" stroke="#c8a96e" stroke-width="0.8" opacity="0"/>

            {{-- Concentric circles --}}
            <circle class="svc-ring svc-ring-1" cx="720" cy="460" r="500" fill="none" stroke="#f4a41c" stroke-width="1.5"/>
            <circle class="svc-ring svc-ring-2" cx="720" cy="460" r="360" fill="none" stroke="#f4a41c" stroke-width="1"/>
            <circle class="svc-ring svc-ring-3" cx="720" cy="460" r="220" fill="none" stroke="#f4a41c" stroke-width="1"/>

            {{-- Watermark T --}}
            <text x="720" y="820" font-size="680" font-weight="900" fill="rgba(180,150,90,0.06)" font-family="serif" text-anchor="middle">T</text>

            {{-- Corner brackets --}}
            <line x1="36" y1="36" x2="36" y2="86" stroke="#f4a41c" stroke-width="2.5" opacity="0.55"/>
            <line x1="36" y1="36" x2="86" y2="36" stroke="#f4a41c" stroke-width="2.5" opacity="0.55"/>
            <line x1="1404" y1="864" x2="1404" y2="814" stroke="#f4a41c" stroke-width="2" opacity="0.35"/>
            <line x1="1404" y1="864" x2="1354" y2="864" stroke="#f4a41c" stroke-width="2" opacity="0.35"/>

            {{-- Dot grids --}}
            @for($r=0;$r<4;$r++) @for($c=0;$c<4;$c++)
            <circle cx="{{ 1130+$c*28 }}" cy="{{ 70+$r*28 }}" r="2.5" fill="#c8a96e" opacity="0.3"/>
            @endfor @endfor
            @for($r=0;$r<3;$r++) @for($c=0;$c<3;$c++)
            <circle cx="{{ 200+$c*28 }}" cy="{{ 760+$r*28 }}" r="2.5" fill="#c8a96e" opacity="0.2"/>
            @endfor @endfor
        </svg>
    </div>

    {{-- ===== SECTION HEADER ===== --}}
    <div class="svc-header-wrap relative text-center pt-20 pb-14" style="z-index:2;" data-aos="fade-up">

        {{-- Animated eyebrow --}}
        <div class="svc-eyebrow-row">
            <div class="svc-eyebrow-line svc-eyebrow-line-left"></div>
            <span class="svc-eyebrow-text">What We Offer</span>
            <div class="svc-eyebrow-line svc-eyebrow-line-right"></div>
        </div>

        {{-- Main heading with animated underline --}}
        <h2 class="svc-main-heading">
            Our <span class="svc-heading-gold">Services</span>
        </h2>

        {{-- Animated triple-bar underline --}}
        <div class="svc-underline-group">
            <div class="svc-uline svc-uline-1"></div>
            <div class="svc-uline svc-uline-2"></div>
            <div class="svc-uline svc-uline-3"></div>
        </div>

        {{-- Subtext --}}
        <p class="svc-subtext" data-aos="fade-up" data-aos-delay="100">
            Where excellence is redefined through top-tier property solutions.
        </p>

        {{-- Floating stat badges --}}
        <div class="svc-stat-row" data-aos="fade-up" data-aos-delay="150">
            <div class="svc-stat-badge">
                <span class="svc-stat-num">10+</span>
                <span class="svc-stat-label">Years Experience</span>
            </div>
            <div class="svc-stat-divider"></div>
            <div class="svc-stat-badge">
                <span class="svc-stat-num">20+</span>
                <span class="svc-stat-label">Projects Delivered</span>
            </div>
            <div class="svc-stat-divider"></div>
            <div class="svc-stat-badge">
                <span class="svc-stat-num">100%</span>
                <span class="svc-stat-label">Client Satisfaction</span>
            </div>
        </div>

    </div>

    {{-- ===== SERVICE CARDS — UNCHANGED ===== --}}
    @php $services = \App\Models\Service::all(); $svcTotal = $services->count(); @endphp

    <div style="position:relative;z-index:10;display:flex;flex-wrap:nowrap;align-items:stretch;gap:0;">
        @foreach($services as $index => $service)
        @php
            $servImg = $service->hero_image;
            $servUrl = asset(ltrim(Str::replaceFirst('storage/', '', $servImg), '/'));
            $isOdd   = $index % 2 === 0;
            $isLast  = $index === $svcTotal - 1;

            if ($isLast) {
                $borderTop    = true;
                $borderBottom = false;
                $borderRight  = false;
            } elseif ($isOdd) {
                $borderTop    = true;
                $borderBottom = false;
                $borderRight  = true;
            } else {
                $borderTop    = false;
                $borderBottom = true;
                $borderRight  = true;
            }

            $borderStyle =
                'border-top:'    . ($borderTop    ? '6px solid #f4a41c' : 'none') . ';' .
                'border-bottom:' . ($borderBottom ? '6px solid #f4a41c' : 'none') . ';' .
                'border-right:'  . ($borderRight  ? '4px solid #f4a41c' : 'none') . ';' .
                'border-left:none;';
        @endphp

        <a href="{{ route('services.show', $service->slug) }}"
           class="svc-card group"
           style="position:relative;flex:1 1 0;min-width:0;display:block;
                  height:520px;overflow:hidden;text-decoration:none;
                  {{ $borderStyle }}
                  box-sizing:border-box;">

            <img src="{{ $servUrl }}" alt="{{ $service->name }}"
                 style="position:absolute;inset:0;width:100%;height:100%;
                        object-fit:cover;display:block;transition:transform 1.6s ease;"
                 class="svc-img"
                 onerror="this.onerror=null;this.src='https://placehold.co/600x800/1a2235/f4a41c?text=Service';">

            <div class="svc-overlay"
                 style="position:absolute;inset:0;z-index:2;
                        background:linear-gradient(to top,rgba(5,12,25,0.88) 0%,rgba(5,12,25,0.38) 55%,rgba(5,12,25,0.12) 100%);
                        transition:background 0.5s ease;"></div>

            <div style="position:absolute;top:20px;left:20px;z-index:8;">
                <span style="font-family:'Cinzel',serif;font-size:11px;font-weight:900;
                             color:rgba(244,164,28,0.65);letter-spacing:0.28em;">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <div style="position:absolute;bottom:0;left:0;right:0;
                        padding:0 22px 30px;z-index:8;text-align:center;">
                <h3 class="svc-title"
                    style="font-family:'Cinzel',serif;
                           font-size:clamp(11px,1.15vw,15px);
                           color:#ffffff;font-weight:800;
                           text-transform:uppercase;letter-spacing:0.2em;
                           line-height:1.4;margin:0 0 12px;
                           transition:color 0.4s ease;">
                    {{ $service->name }}
                </h3>
                <div class="svc-line"
                     style="width:24px;height:2px;background:#f4a41c;
                            margin:0 auto;transition:width 0.4s ease;"></div>
            </div>

            <div class="svc-bar"
                 style="position:absolute;bottom:0;left:0;right:0;height:3px;
                        background:#f4a41c;transform:scaleX(0);transform-origin:left;
                        transition:transform 0.4s ease;z-index:12;"></div>
        </a>
        @endforeach
    </div>

    {{-- ===== ANIMATED EXPLORE BUTTON ===== --}}
    <div class="text-center relative svc-btn-wrap" style="z-index:10;padding:60px 0 80px;" data-aos="fade-up">

        {{-- Decorative side lines --}}
        <div class="svc-btn-deco-left" aria-hidden="true">
            <div class="svc-deco-line"></div>
            <div class="svc-deco-dot"></div>
        </div>
        <div class="svc-btn-deco-right" aria-hidden="true">
            <div class="svc-deco-dot"></div>
            <div class="svc-deco-line"></div>
        </div>

        <a href="{{ url('/services') }}" class="svc-explore-btn">
            <span class="svc-btn-bg-sweep"></span>
            <span class="svc-btn-inner">
                <span class="svc-btn-text">Explore All Services</span>
                <span class="svc-btn-arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </span>
            </span>
        </a>
    </div>

</section>

<style>
/* ===== BACKGROUND ===== */
.svc-bg-canvas {
    position: absolute; inset: 0;
    pointer-events: none; z-index: 0; overflow: hidden;
}
.svc-lines-svg {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
}

/* Animated diagonal lines fade in on load */
.svc-animated-line {
    animation: svcLineFadeIn 2s ease forwards;
}
.svc-animated-line:nth-child(1) { animation-delay: 0.1s; }
.svc-animated-line:nth-child(2) { animation-delay: 0.3s; }
.svc-animated-line:nth-child(3) { animation-delay: 0.5s; }
.svc-animated-line:nth-child(4) { animation-delay: 0.2s; }
.svc-animated-line:nth-child(5) { animation-delay: 0.4s; }
.svc-animated-line:nth-child(6) { animation-delay: 0.6s; }
@keyframes svcLineFadeIn {
    to { opacity: var(--final-op, 0.28); }
}
.svc-animated-line:nth-child(1) { --final-op: 0.32; }
.svc-animated-line:nth-child(2) { --final-op: 0.22; }
.svc-animated-line:nth-child(3) { --final-op: 0.16; }
.svc-animated-line:nth-child(4) { --final-op: 0.32; }
.svc-animated-line:nth-child(5) { --final-op: 0.22; }
.svc-animated-line:nth-child(6) { --final-op: 0.16; }

/* Pulsing concentric rings */
.svc-ring {
    transform-origin: 720px 460px;
    animation: svcRingPulse 6s ease-in-out infinite;
}
.svc-ring-1 { animation-delay: 0s;   opacity: 0.1; }
.svc-ring-2 { animation-delay: 1s;   opacity: 0.08; }
.svc-ring-3 { animation-delay: 2s;   opacity: 0.07; }
@keyframes svcRingPulse {
    0%, 100% { transform: scale(1);    opacity: var(--ro, 0.1); }
    50%       { transform: scale(1.04); opacity: calc(var(--ro, 0.1) * 1.8); }
}
.svc-ring-1 { --ro: 0.1; }
.svc-ring-2 { --ro: 0.08; }
.svc-ring-3 { --ro: 0.07; }

/* Floating orbs */
.svc-orb {
    position: absolute; border-radius: 50%;
    pointer-events: none;
}
.svc-orb-1 {
    width: 420px; height: 420px;
    top: -120px; left: -80px;
    background: radial-gradient(circle, rgba(244,164,28,0.09) 0%, transparent 70%);
    animation: svcOrbFloat 9s ease-in-out infinite;
}
.svc-orb-2 {
    width: 340px; height: 340px;
    bottom: 80px; right: -60px;
    background: radial-gradient(circle, rgba(200,169,110,0.1) 0%, transparent 70%);
    animation: svcOrbFloat 12s ease-in-out infinite reverse;
}
.svc-orb-3 {
    width: 260px; height: 260px;
    top: 40%; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(244,164,28,0.07) 0%, transparent 70%);
    animation: svcOrbFloat 7s ease-in-out infinite 2s;
}
@keyframes svcOrbFloat {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-28px); }
}
.svc-orb-3 { animation-name: svcOrb3Float; }
@keyframes svcOrb3Float {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50%       { transform: translateX(-50%) translateY(-20px); }
}

/* ===== SECTION HEADER ===== */
.svc-header-wrap { position: relative; z-index: 2; }

/* Eyebrow row */
.svc-eyebrow-row {
    display: flex; align-items: center;
    justify-content: center; gap: 18px;
    margin-bottom: 18px;
}
.svc-eyebrow-line {
    height: 2px; background: #f4a41c;
    animation: svcEyebrowGrow 1.2s ease forwards;
    width: 0;
}
.svc-eyebrow-line-left  { animation-delay: 0.2s; }
.svc-eyebrow-line-right { animation-delay: 0.4s; }
@keyframes svcEyebrowGrow { to { width: 56px; } }
.svc-eyebrow-text {
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.5em; text-transform: uppercase;
    color: #f4a41c; white-space: nowrap;
}

/* Main heading */
.svc-main-heading {
    font-family: 'Cinzel', serif;
    font-size: clamp(2rem, 5vw, 3.6rem);
    font-weight: 900; color: #0a1628;
    text-transform: uppercase;
    letter-spacing: 0.05em; line-height: 1.1;
    margin: 0 0 20px;
    animation: svcHeadingReveal 0.9s cubic-bezier(0.22,1,0.36,1) forwards;
    opacity: 0; transform: translateY(24px);
    animation-delay: 0.15s;
}
@keyframes svcHeadingReveal {
    to { opacity: 1; transform: translateY(0); }
}
.svc-heading-gold { color: #f4a41c; }

/* Animated triple-bar underline */
.svc-underline-group {
    display: flex; flex-direction: column;
    align-items: center; gap: 5px;
    margin: 0 auto 20px;
}
.svc-uline {
    height: 3px; background: #f4a41c;
    animation: svcUlineGrow 0.8s ease forwards;
    width: 0;
}
.svc-uline-1 { animation-delay: 0.5s; }
.svc-uline-2 { animation-delay: 0.65s; background: rgba(244,164,28,0.5); }
.svc-uline-3 { animation-delay: 0.8s;  background: rgba(244,164,28,0.2); }
@keyframes svcUlineGrow {
    to { width: 54px; }
}
.svc-uline-2 { animation-name: svcUlineGrow2; }
.svc-uline-3 { animation-name: svcUlineGrow3; }
@keyframes svcUlineGrow2 { to { width: 36px; } }
@keyframes svcUlineGrow3 { to { width: 20px; } }

/* Subtext */
.svc-subtext {
    color: #6b7a8d; font-size: 10px; font-weight: 700;
    letter-spacing: 0.3em; text-transform: uppercase;
    max-width: 480px; margin: 0 auto 36px;
    line-height: 1.8;
}

/* Stat badges row */
.svc-stat-row {
    display: inline-flex; align-items: center;
    gap: 0;
    border: 1.5px solid rgba(244,164,28,0.35);
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(4px);
    padding: 0;
    position: relative;
    overflow: hidden;
}
.svc-stat-row::before {
    content: '';
    position: absolute; top: 0; left: -100%;
    width: 60%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(244,164,28,0.08), transparent);
    animation: svcStatShimmer 4s ease-in-out infinite 1.5s;
}
@keyframes svcStatShimmer {
    0%   { left: -100%; }
    100% { left: 200%; }
}
.svc-stat-badge {
    display: flex; flex-direction: column;
    align-items: center; padding: 18px 36px;
    position: relative; z-index: 1;
    transition: background 0.3s ease;
    cursor: default;
}
.svc-stat-badge:hover { background: rgba(244,164,28,0.08); }
.svc-stat-num {
    font-family: 'Cinzel', serif;
    font-size: 26px; font-weight: 900;
    color: #0a1628; line-height: 1;
    display: block;
    animation: svcNumCount 0.6s ease forwards;
}
.svc-stat-label {
    font-size: 9px; font-weight: 700;
    letter-spacing: 0.3em; text-transform: uppercase;
    color: #f4a41c; margin-top: 5px; display: block;
    white-space: nowrap;
}
.svc-stat-divider {
    width: 1.5px; height: 52px;
    background: rgba(244,164,28,0.3);
    flex-shrink: 0;
}

/* ===== EXPLORE BUTTON ===== */
.svc-btn-wrap { position: relative; }
.svc-btn-deco-left,
.svc-btn-deco-right {
    position: absolute; top: 50%;
    transform: translateY(-50%);
    display: flex; align-items: center; gap: 10px;
}
.svc-btn-deco-left  { right: calc(50% + 200px); }
.svc-btn-deco-right { left:  calc(50% + 200px); }
.svc-deco-line {
    width: 60px; height: 1.5px;
    background: linear-gradient(to right, transparent, rgba(244,164,28,0.5));
    animation: svcDecoLinePulse 3s ease-in-out infinite;
}
.svc-btn-deco-right .svc-deco-line {
    background: linear-gradient(to left, transparent, rgba(244,164,28,0.5));
}
.svc-deco-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: #f4a41c; opacity: 0.5;
    animation: svcDecoLinePulse 3s ease-in-out infinite 0.5s;
}
@keyframes svcDecoLinePulse {
    0%, 100% { opacity: 0.4; }
    50%       { opacity: 0.9; }
}

.svc-explore-btn {
    position: relative; display: inline-flex;
    align-items: center; overflow: hidden;
    text-decoration: none;
    border: 2px solid #0a1628;
    transition: border-color 0.35s ease, color 0.35s ease;
}
.svc-btn-bg-sweep {
    position: absolute; inset: 0;
    background: #f4a41c;
    transform: translateX(-101%);
    transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);
    z-index: 0;
}
.svc-explore-btn:hover .svc-btn-bg-sweep { transform: translateX(0); }
.svc-explore-btn:hover { border-color: #f4a41c; }
.svc-btn-inner {
    position: relative; z-index: 1;
    display: flex; align-items: center; gap: 12px;
    padding: 16px 48px;
}
.svc-btn-text {
    font-size: 10px; font-weight: 800;
    letter-spacing: 0.45em; text-transform: uppercase;
    color: #0a1628;
    transition: color 0.35s ease;
}
.svc-explore-btn:hover .svc-btn-text { color: #0a1628; }
.svc-btn-arrow {
    display: flex; color: #0a1628;
    transition: transform 0.35s ease, color 0.35s ease;
}
.svc-explore-btn:hover .svc-btn-arrow { transform: translateX(5px); }

/* ===== SERVICE CARD HOVERS — UNCHANGED ===== */
.svc-card:hover .svc-img     { transform: scale(1.08); }
.svc-card:hover .svc-overlay { background: linear-gradient(to top,rgba(5,12,25,0.92) 0%,rgba(5,12,25,0.55) 55%,rgba(5,12,25,0.22) 100%) !important; }
.svc-card:hover .svc-title   { color: #f4a41c !important; }
.svc-card:hover .svc-line    { width: 44px !important; }
.svc-card:hover .svc-bar     { transform: scaleX(1) !important; }

@media (max-width: 1100px) {
    .svc-card {
        flex: 1 0 calc(33.333% - 2px) !important;
        min-width: calc(33.333% - 2px) !important;
        height: 380px !important;
        border-top: 6px solid #f4a41c !important;
        border-bottom: none !important;
        border-right: 4px solid #f4a41c !important;
        border-left: none !important;
    }
    .svc-btn-deco-left, .svc-btn-deco-right { display: none; }
    .svc-stat-badge { padding: 14px 22px; }
}
@media (max-width: 640px) {
    .svc-card {
        flex: none !important;
        min-width: 100% !important;
        height: 260px !important;
        border-top: 6px solid #f4a41c !important;
        border-bottom: none !important;
        border-right: none !important;
        border-left: none !important;
    }
    .svc-stat-row { flex-direction: column; }
    .svc-stat-divider { width: 52px; height: 1.5px; }
}
</style>


{{-- ============================================================
     SECTION 4.5: FEATURED SHOWCASE — between Services & Testimonials
     ============================================================ --}}
@php
    $showcaseSlides = collect($settings->featured_showcase ?? [])
        ->filter(fn($s) => !empty($s['bg_image']))
        ->values();
@endphp

@if($showcaseSlides->count() > 0)
<section class="fsc-section" id="featured-showcase">

    {{-- SLIDES WRAPPER --}}
    <div class="fsc-slides-wrap" id="fscSlidesWrap">
        @foreach($showcaseSlides as $i => $slide)
        @php
            $rawBg  = $slide['bg_image'] ?? '';
            $bgUrl  = $rawBg
                ? (str_starts_with($rawBg, 'http') ? $rawBg : asset(ltrim($rawBg, '/')))
                : 'https://placehold.co/1920x1080/0a1628/f4a41c?text=Showcase';

            $vidId  = null;
            $vu     = $slide['video_url'] ?? '';
            if ($vu) {
                if (preg_match('/youtu\.be\/([^\?\/]+)/', $vu, $m))         $vidId = $m[1];
                elseif (preg_match('/v=([^\&]+)/', $vu, $m))                $vidId = $m[1];
                elseif (preg_match('/embed\/([^\?\/]+)/', $vu, $m))         $vidId = $m[1];
            }
            $thumb  = $vidId
                ? "https://img.youtube.com/vi/{$vidId}/maxresdefault.jpg"
                : null;
        @endphp

        <div class="fsc-slide {{ $i === 0 ? 'fsc-active' : '' }}"
             data-index="{{ $i }}"
             data-vid="{{ $vidId ?? '' }}">

            {{-- BG IMAGE WITH KEN BURNS --}}
            <div class="fsc-bg-wrap">
                <div class="fsc-bg-img" style="background-image:url('{{ $bgUrl }}');"></div>
            </div>

            {{-- DARK OVERLAY --}}
            <div class="fsc-overlay"></div>

            {{-- CONTENT --}}
            <div class="fsc-content-wrap">
                <div class="fsc-content">
                    @if(!empty($slide['badge']))
                    <div class="fsc-badge">{{ $slide['badge'] }}</div>
                    @endif

                    <h2 class="fsc-title">{{ $slide['title'] ?? '' }}</h2>

                    @if(!empty($slide['subtitle']))
                    <p class="fsc-subtitle">{{ $slide['subtitle'] }}</p>
                    @endif

                    @if(!empty($slide['location']))
                    <div class="fsc-location">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span>{{ $slide['location'] }}</span>
                    </div>
                    @endif

                    @if(!empty($slide['project_link']))
                    <a href="{{ $slide['project_link'] }}" class="fsc-cta">
                        <span>View Project</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- CORNER VIDEO BOX --}}
            @if($vidId)
            <div class="fsc-video-box" id="fscVideoBox{{ $i }}">
                <div class="fsc-video-thumb" id="fscThumb{{ $i }}">
                    <img src="{{ $thumb }}"
                         alt="Interior Video"
                         onerror="this.src='https://placehold.co/480x270/0a1628/f4a41c?text=Video';">
                    <button class="fsc-play-btn" onclick="fscPlayVideo({{ $i }}, '{{ $vidId }}')" aria-label="Play video">
                        <svg viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                    <div class="fsc-video-label">
                        <span>Interior Tour</span>
                    </div>
                </div>
                <div class="fsc-video-frame" id="fscFrame{{ $i }}" style="display:none;">
                    {{-- iframe injected by JS --}}
                </div>
            </div>
            @endif

        </div>
        @endforeach
    </div>

    {{-- SLIDE COUNTER --}}
    <div class="fsc-counter">
        <span id="fscCurNum">01</span>
        <span class="fsc-counter-sep"></span>
        <span class="fsc-counter-total">{{ str_pad($showcaseSlides->count(), 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- NAVIGATION --}}
    <div class="fsc-nav">
        <button class="fsc-nav-btn fsc-nav-prev" onclick="fscNav(-1)" aria-label="Previous slide">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </button>
        <button class="fsc-nav-btn fsc-nav-next" onclick="fscNav(1)" aria-label="Next slide">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
    </div>

    {{-- PROGRESS BAR --}}
    <div class="fsc-progress-wrap">
        <div class="fsc-progress-bar" id="fscProgressBar"></div>
    </div>

    {{-- DOTS --}}
    <div class="fsc-dots" id="fscDots">
        @foreach($showcaseSlides as $i => $slide)
        <button class="fsc-dot {{ $i === 0 ? 'fsc-dot-active' : '' }}"
                onclick="fscGoTo({{ $i }})"
                aria-label="Go to slide {{ $i + 1 }}">
        </button>
        @endforeach
    </div>

</section>

<style>
/* ===== FEATURED SHOWCASE SECTION ===== */
.fsc-section {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    max-height: 900px;
    overflow: hidden;
    background: #0a1628;
}

/* SLIDES */
.fsc-slides-wrap { position: absolute; inset: 0; }
.fsc-slide {
    position: absolute; inset: 0;
    opacity: 0; z-index: 1;
    transition: opacity 0.9s ease;
    pointer-events: none;
}
.fsc-slide.fsc-active { opacity: 1; z-index: 2; pointer-events: all; }

/* KEN BURNS BACKGROUND */
.fsc-bg-wrap {
    position: absolute; inset: 0; overflow: hidden;
}
.fsc-bg-img {
    position: absolute; inset: -5%;
    width: 110%; height: 110%;
    background-size: cover;
    background-position: center;
    animation: fscKenBurns 12s ease-in-out infinite alternate;
}
.fsc-slide.fsc-active .fsc-bg-img { animation-play-state: running; }
.fsc-slide:not(.fsc-active) .fsc-bg-img { animation-play-state: paused; }

@keyframes fscKenBurns {
    0%   { transform: scale(1)    translateX(0)     translateY(0); }
    33%  { transform: scale(1.06) translateX(-1%)   translateY(-1%); }
    66%  { transform: scale(1.04) translateX(1%)    translateY(0.5%); }
    100% { transform: scale(1.08) translateX(-0.5%) translateY(-0.5%); }
}

/* OVERLAY */
.fsc-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        105deg,
        rgba(10,22,40,0.78) 0%,
        rgba(10,22,40,0.45) 50%,
        rgba(10,22,40,0.2)  100%
    );
    z-index: 2;
}

/* CONTENT */
.fsc-content-wrap {
    position: absolute; inset: 0; z-index: 3;
    display: flex; align-items: flex-end;
    padding: 0 80px 100px;
}
.fsc-content { max-width: 620px; }

.fsc-badge {
    display: inline-block;
    background: #f4a41c; color: #0a1628;
    font-size: 9px; font-weight: 800;
    letter-spacing: 0.35em; text-transform: uppercase;
    padding: 5px 14px; margin-bottom: 20px;
    opacity: 0; transform: translateY(20px);
    transition: opacity 0.6s ease 0.2s, transform 0.6s ease 0.2s;
}
.fsc-active .fsc-badge { opacity: 1; transform: translateY(0); }

.fsc-title {
    font-family: 'Cinzel', serif;
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 900; color: #ffffff;
    text-transform: uppercase;
    line-height: 1.1; margin: 0 0 16px;
    opacity: 0; transform: translateY(30px);
    transition: opacity 0.7s ease 0.35s, transform 0.7s ease 0.35s;
}
.fsc-active .fsc-title { opacity: 1; transform: translateY(0); }

.fsc-subtitle {
    font-size: 14px; color: rgba(255,255,255,0.75);
    font-weight: 400; line-height: 1.7;
    margin: 0 0 18px; max-width: 480px;
    opacity: 0; transform: translateY(20px);
    transition: opacity 0.6s ease 0.5s, transform 0.6s ease 0.5s;
}
.fsc-active .fsc-subtitle { opacity: 1; transform: translateY(0); }

.fsc-location {
    display: flex; align-items: center; gap: 8px;
    color: #f4a41c; font-size: 11px; font-weight: 700;
    letter-spacing: 0.2em; text-transform: uppercase;
    margin-bottom: 28px;
    opacity: 0; transform: translateY(16px);
    transition: opacity 0.6s ease 0.6s, transform 0.6s ease 0.6s;
}
.fsc-active .fsc-location { opacity: 1; transform: translateY(0); }
.fsc-location svg { width: 14px; height: 14px; flex-shrink: 0; }

.fsc-cta {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 32px;
    background: transparent; color: #fff;
    border: 2px solid rgba(255,255,255,0.5);
    font-size: 10px; font-weight: 800;
    letter-spacing: 0.4em; text-transform: uppercase;
    text-decoration: none;
    transition: all 0.3s ease;
    opacity: 0; transform: translateY(16px);
    transition: opacity 0.6s ease 0.75s, transform 0.6s ease 0.75s,
                background 0.3s ease, border-color 0.3s ease;
}
.fsc-active .fsc-cta { opacity: 1; transform: translateY(0); }
.fsc-cta:hover { background: #f4a41c; border-color: #f4a41c; color: #0a1628; }
.fsc-cta svg { width: 16px; height: 16px; transition: transform 0.3s ease; }
.fsc-cta:hover svg { transform: translateX(4px); }

/* CORNER VIDEO BOX */
.fsc-video-box {
    position: absolute;
    bottom: 80px; right: 80px;
    width: 320px;
    z-index: 10;
    box-shadow: 0 24px 64px rgba(0,0,0,0.55);
    border: 2px solid rgba(244,164,28,0.4);
    opacity: 0; transform: translateX(30px);
    transition: opacity 0.7s ease 0.5s, transform 0.7s ease 0.5s;
    overflow: hidden;
}
.fsc-active .fsc-video-box { opacity: 1; transform: translateX(0); }

.fsc-video-thumb { position: relative; cursor: pointer; }
.fsc-video-thumb img {
    width: 100%; height: 180px;
    object-fit: cover; display: block;
    transition: transform 0.5s ease;
}
.fsc-video-thumb:hover img { transform: scale(1.05); }

.fsc-play-btn {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(244,164,28,0.85);
    border: 2px solid rgba(255,255,255,0.6);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.3s ease;
}
.fsc-play-btn:hover { background: #f4a41c; transform: translate(-50%, -50%) scale(1.1); }
.fsc-play-btn svg { width: 20px; height: 20px; margin-left: 3px; }

.fsc-video-label {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(10,22,40,0.9) 0%, transparent 100%);
    padding: 14px 14px 10px;
}
.fsc-video-label span {
    font-size: 9px; font-weight: 800;
    letter-spacing: 0.35em; text-transform: uppercase; color: #f4a41c;
}

.fsc-video-frame { width: 100%; }
.fsc-video-frame iframe { width: 100%; height: 180px; display: block; border: none; }

/* COUNTER */
.fsc-counter {
    position: absolute; top: 40px; right: 80px;
    z-index: 10; display: flex; align-items: center; gap: 12px;
}
#fscCurNum {
    font-family: 'Cinzel', serif;
    font-size: 52px; font-weight: 900; color: #fff; line-height: 1;
}
.fsc-counter-sep {
    width: 40px; height: 2px; background: #f4a41c;
}
.fsc-counter-total {
    font-family: 'Cinzel', serif;
    font-size: 18px; font-weight: 700;
    color: rgba(255,255,255,0.35);
}

/* NAVIGATION */
.fsc-nav {
    position: absolute; bottom: 40px; left: 80px;
    z-index: 10; display: flex; gap: 10px;
}
.fsc-nav-btn {
    width: 50px; height: 50px;
    border: 1.5px solid rgba(255,255,255,0.2);
    background: transparent; color: #fff; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.3s ease;
}
.fsc-nav-btn svg { width: 20px; height: 20px; }
.fsc-nav-btn:hover { background: #f4a41c; border-color: #f4a41c; color: #0a1628; }

/* PROGRESS BAR */
.fsc-progress-wrap {
    position: absolute; bottom: 0; left: 0; right: 0;
    height: 3px; background: rgba(255,255,255,0.1); z-index: 20;
}
.fsc-progress-bar {
    height: 100%; width: 0%; background: #f4a41c;
    transition: none;
}

/* DOTS */
.fsc-dots {
    position: absolute; bottom: 48px; left: 50%;
    transform: translateX(-50%);
    z-index: 10; display: flex; gap: 8px; align-items: center;
}
.fsc-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: rgba(255,255,255,0.25); border: none; cursor: pointer;
    transition: all 0.3s ease; padding: 0;
}
.fsc-dot-active { background: #f4a41c !important; width: 22px !important; border-radius: 4px !important; }

/* RESPONSIVE */
@media (max-width: 1024px) {
    .fsc-content-wrap { padding: 0 48px 120px; }
    .fsc-video-box { width: 260px; right: 48px; bottom: 120px; }
    .fsc-counter { right: 48px; top: 32px; }
    .fsc-nav { left: 48px; bottom: 48px; }
}
@media (max-width: 768px) {
    .fsc-section { max-height: 100vh; min-height: 560px; }
    .fsc-content-wrap { padding: 0 24px 130px; }
    .fsc-title { font-size: clamp(1.6rem, 6vw, 2.4rem); }
    .fsc-video-box {
        width: 180px; right: 20px; bottom: 120px;
    }
    .fsc-video-thumb img, .fsc-video-frame iframe { height: 110px; }
    .fsc-counter { right: 24px; top: 24px; }
    #fscCurNum { font-size: 36px; }
    .fsc-counter-sep { width: 24px; }
    .fsc-nav { left: 24px; bottom: 44px; }
    .fsc-nav-btn { width: 42px; height: 42px; }
}
@media (max-width: 480px) {
    .fsc-video-box { display: none; }
}
</style>

<script>
(function () {
    var total    = {{ $showcaseSlides->count() }};
    var cur      = 0;
    var autoMs   = 7000;
    var timer    = null;
    var progTimer = null;
    var progStart = null;

    var slides   = document.querySelectorAll('.fsc-slide');
    var dotsEl   = document.querySelectorAll('.fsc-dot');
    var curNumEl = document.getElementById('fscCurNum');
    var progBar  = document.getElementById('fscProgressBar');

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function goTo(idx) {
        if (idx === cur) return;
        // Stop any playing video on current slide before switching
        var oldFrame = document.getElementById('fscFrame' + cur);
        var oldThumb = document.getElementById('fscThumb' + cur);
        if (oldFrame) { oldFrame.innerHTML = ''; oldFrame.style.display = 'none'; }
        if (oldThumb) oldThumb.style.display = '';

        slides[cur].classList.remove('fsc-active');
        dotsEl[cur].classList.remove('fsc-dot-active');
        cur = idx;
        slides[cur].classList.add('fsc-active');
        dotsEl[cur].classList.add('fsc-dot-active');
        curNumEl.textContent = pad(cur + 1);
        resetProgress();
        resetAuto();
    }

    window.fscGoTo = goTo;

    window.fscNav = function (dir) {
        goTo((cur + dir + total) % total);
    };

    window.fscPlayVideo = function (idx, vidId) {
        var thumb = document.getElementById('fscThumb' + idx);
        var frame = document.getElementById('fscFrame' + idx);
        if (!frame) return;
        frame.innerHTML = '<iframe src="https://www.youtube.com/embed/' + vidId + '?autoplay=1&rel=0&modestbranding=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        frame.style.display = '';
        if (thumb) thumb.style.display = 'none';
    };

    /* PROGRESS BAR */
    function resetProgress() {
        progBar.style.transition = 'none';
        progBar.style.width = '0%';
        if (progTimer) cancelAnimationFrame(progTimer);
        setTimeout(function () {
            progBar.style.transition = 'width ' + autoMs + 'ms linear';
            progBar.style.width = '100%';
        }, 30);
    }

    /* AUTO ADVANCE */
    function resetAuto() {
        clearInterval(timer);
        timer = setInterval(function () {
            window.fscNav(1);
        }, autoMs);
    }

    if (total > 0) {
        resetProgress();
        resetAuto();
    }

    /* KEYBOARD */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft')  window.fscNav(-1);
        if (e.key === 'ArrowRight') window.fscNav(1);
    });
})();
</script>
@endif



{{-- ============================================================
     SECTION 5: CUSTOMER REVIEWS — bg: #1a2235 (dark navy)
     ============================================================ --}}
@php
    $testimonialsData = \App\Models\Testimonial::where('is_active', true)
        ->get()
        ->map(function($t) {
            $vId = '';
            if ($t->video_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $t->video_url, $m)) {
                $vId = $m[1];
            }
            $imagePath = $t->image;
            $imageUrl  = $imagePath
                ? asset(ltrim($imagePath, '/'))
                : 'https://placehold.co/800x600/ddd4c5/999?text=Review';
            return [
                'name'     => $t->name,
                'role'     => $t->role,
                'text'     => $t->content,
                'video_id' => $vId ?: null,
                'image'    => $imageUrl,
            ];
        })
        ->values();
@endphp

@if($testimonialsData->count() > 0)
<section class="ts-section" id="testimonials">
    <svg class="ts-geo-bg" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
        <polygon points="1050,0 1440,0 1440,380" fill="none" stroke="#f4a41c" stroke-width="1.5" opacity="0.1"/>
        <polygon points="1140,0 1440,0 1440,280" fill="#f4a41c" opacity="0.03"/>
        <polygon points="0,500 160,700 0,700" fill="none" stroke="#f4a41c" stroke-width="1.5" opacity="0.06"/>
        @for($row = 0; $row < 4; $row++)
            @for($col = 0; $col < 5; $col++)
                <circle cx="{{ 48 + $col * 44 }}" cy="{{ 48 + $row * 44 }}" r="2" fill="#f4a41c" opacity="0.1"/>
            @endfor
        @endfor
        <path d="M28,28 L28,80 M28,28 L80,28" stroke="#f4a41c" stroke-width="2.5" fill="none" opacity="0.3"/>
        <circle cx="1380" cy="110" r="90" fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.07"/>
        <circle cx="1380" cy="110" r="58" fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.05"/>
        <text x="860" y="640" font-size="520" font-weight="900" fill="#ffffff" opacity="0.015" font-family="serif">T</text>
    </svg>

    <div class="max-w-7xl mx-auto px-6" style="position:relative;z-index:2;">
        <div class="ts-header" data-aos="fade-up">
            <div>
                <div class="ts-eyebrow">
                    <div class="ts-eyebrow-line"></div>
                    <span>Client Testimonials</span>
                </div>
                <h2 class="ts-main-heading">
                    What Our <em>Clients</em><br>Say About Us
                </h2>
            </div>
            <div class="ts-counter-block">
                <div class="ts-counter-num">{{ $testimonialsData->count() }}+</div>
                <div class="ts-counter-label">Happy Clients</div>
            </div>
        </div>

        <div class="ts-card" data-aos="fade-up" data-aos-delay="100">
            <div class="ts-media-side" id="tsMediaSide">
                <div id="tsMediaContent" style="position:absolute;inset:0;">
                    <img id="tsImg" src="" alt="Testimonial"
                         onerror="this.src='https://placehold.co/800x600/ddd4c5/999?text=Review';">
                </div>
                <div class="ts-media-overlay" id="tsMediaOverlay"></div>
                <button class="ts-play-btn" id="tsPlayBtn" onclick="tsPlayVideo()" style="display:none;" aria-label="Play video">
                    <svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg>
                </button>
                <div class="ts-media-caption">
                    <div class="ts-caption-badge" id="tsCaptionBadge"></div>
                    <div class="ts-caption-text" id="tsCaptionText"></div>
                </div>
            </div>
            <div class="ts-content-side">
                <div id="tsContentInner" style="transition:opacity 0.25s ease;">
                    <span class="ts-quote-icon">"</span>
                    <p class="ts-quote-text" id="tsQuoteText"></p>
                    <div class="ts-stars">
                        @for($i = 0; $i < 5; $i++)
                        <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        @endfor
                    </div>
                    <div class="ts-author">
                        <div class="ts-avatar" id="tsAvatar"></div>
                        <div>
                            <div class="ts-author-name" id="tsAuthorName"></div>
                            <div class="ts-author-role" id="tsAuthorRole"></div>
                        </div>
                    </div>
                </div>
                <div class="ts-card-footer">
                    <div class="ts-progress-dots" id="tsDots"></div>
                    <div class="ts-navs">
                        <button class="ts-nav-btn" onclick="tsNav(-1)" aria-label="Previous">&#8592;</button>
                        <button class="ts-nav-btn" onclick="tsNav(1)" aria-label="Next">&#8594;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function(){
    var data = @json($testimonialsData);
    var cur = 0, videoOn = false, autoTimer = null;
    var imgEl        = document.getElementById('tsImg');
    var mediaContent = document.getElementById('tsMediaContent');
    var playBtn      = document.getElementById('tsPlayBtn');
    var overlay      = document.getElementById('tsMediaOverlay');
    var captBadge    = document.getElementById('tsCaptionBadge');
    var captText     = document.getElementById('tsCaptionText');
    var quoteText    = document.getElementById('tsQuoteText');
    var authorName   = document.getElementById('tsAuthorName');
    var authorRole   = document.getElementById('tsAuthorRole');
    var avatarEl     = document.getElementById('tsAvatar');
    var dotsEl       = document.getElementById('tsDots');
    var contentInner = document.getElementById('tsContentInner');

    function getInitials(name) {
        if (!name) return 'TH';
        var parts = name.trim().split(' ');
        return parts.length >= 2
            ? (parts[0][0] + parts[parts.length - 1][0]).toUpperCase()
            : name.substring(0, 2).toUpperCase();
    }
    function buildDots() {
        dotsEl.innerHTML = '';
        data.forEach(function(_, i) {
            var b = document.createElement('button');
            b.className = 'ts-dot' + (i === cur ? ' active' : '');
            b.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
            b.onclick = function() { goTo(i); };
            dotsEl.appendChild(b);
        });
    }
    function render(idx) {
        var r = data[idx];
        if (!r) return;
        videoOn = false;
        mediaContent.innerHTML = '';
        imgEl.src = r.image || 'https://placehold.co/800x600/ddd4c5/999?text=Review';
        imgEl.alt = r.name || '';
        imgEl.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;transition:opacity 0.4s;';
        mediaContent.appendChild(imgEl);
        overlay.style.display = '';
        playBtn.style.display = r.video_id ? 'flex' : 'none';
        captBadge.textContent = r.role || '';
        captText.textContent  = r.text ? r.text.substring(0, 80) + (r.text.length > 80 ? '\u2026' : '') : '';
        contentInner.style.opacity = '0';
        setTimeout(function() {
            quoteText.textContent  = r.text || '';
            authorName.textContent = r.name || '';
            authorRole.textContent = r.role || '';
            avatarEl.textContent   = getInitials(r.name);
            contentInner.style.opacity = '1';
        }, 210);
        buildDots();
    }
    window.tsPlayVideo = function() {
        var r = data[cur];
        if (!r || !r.video_id) return;
        clearAuto();
        mediaContent.innerHTML = '';
        var wrap = document.createElement('div');
        wrap.className = 'ts-iframe-wrap';
        var iframe = document.createElement('iframe');
        iframe.src = 'https://www.youtube.com/embed/' + r.video_id + '?autoplay=1&rel=0&modestbranding=1';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        wrap.appendChild(iframe);
        mediaContent.appendChild(wrap);
        overlay.style.display = 'none';
        playBtn.style.display = 'none';
        videoOn = true;
    };
    function goTo(idx) {
        if (videoOn) {
            mediaContent.innerHTML = '';
            mediaContent.appendChild(imgEl);
            overlay.style.display = '';
            videoOn = false;
        }
        cur = idx;
        render(cur);
        resetAuto();
    }
    window.tsNav = function(dir) { goTo((cur + dir + data.length) % data.length); };
    function clearAuto() { if (autoTimer) clearInterval(autoTimer); }
    function resetAuto() {
        clearAuto();
        autoTimer = setInterval(function() { if (!videoOn) window.tsNav(1); }, 6000);
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft')  window.tsNav(-1);
        if (e.key === 'ArrowRight') window.tsNav(1);
    });
    if (data.length > 0) { render(0); resetAuto(); }
})();
</script>
@endif

{{-- ============================================================
     SECTION 6: SCHEDULE A MEETING — bg: #f5f1eb (warm cream)
     ============================================================ --}}
<section class="sam-section" id="schedule-meeting">
    <svg class="sam-bg-svg" viewBox="0 0 1440 780" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M-80,200 Q200,80 480,220 Q760,360 1040,180 Q1200,100 1520,240" fill="none" stroke="#c8b89a" stroke-width="1.2" opacity="0.35"/>
        <path d="M-80,240 Q200,120 480,260 Q760,400 1040,220 Q1200,140 1520,280" fill="none" stroke="#c8b89a" stroke-width="1" opacity="0.28"/>
        <path d="M-80,420 Q300,320 560,460 Q820,580 1100,400 Q1280,300 1520,460" fill="none" stroke="#b8a480" stroke-width="1.2" opacity="0.3"/>
        <path d="M-80,600 Q360,500 640,640 Q900,760 1160,580 Q1340,480 1520,640" fill="none" stroke="#a89060" stroke-width="1" opacity="0.2"/>
        <path d="M580,0 Q720,60 860,20 Q960,-10 1020,60" fill="none" stroke="#f4a41c" stroke-width="1.5" opacity="0.15"/>
        <path d="M32,32 L32,72 M32,32 L72,32" stroke="#f4a41c" stroke-width="2.5" fill="none" opacity="0.5"/>
        <path d="M1408,748 L1408,708 M1408,748 L1368,748" stroke="#f4a41c" stroke-width="2" fill="none" opacity="0.3"/>
    </svg>

    <div class="sam-inner">
        {{-- LEFT: meeting section image --}}
        <div class="sam-image-col" data-aos="fade-right">
            @php
                $settings = $settings ?? \App\Models\Setting::first();
                $samImg = null;

                if (!empty($settings->meeting_section_image)) {
                    $rawPath = ltrim($settings->meeting_section_image, '/');
                    if (str_starts_with($rawPath, 'http')) {
                        $samImg = $rawPath;
                    } else {
                        $samImg = asset($rawPath);
                    }
                }

                if (!$samImg) {
                    $featuredProject = $projects->first() ?? null;
                    $samImg = $featuredProject
                        ? asset(ltrim(Str::replaceFirst('storage/', '', $featuredProject->featured_image), '/'))
                        : 'https://placehold.co/800x900/1a1a2e/f4a41c?text=Trikon+Holdings';
                }
            @endphp

            <div class="sam-image-frame">
                <img src="{{ $samImg }}" alt="Schedule a Meeting"
                     onerror="this.src='https://placehold.co/600x520/1a1a2e/f4a41c?text=Trikon+Holdings';">
                <div class="sam-image-tag">
                    <svg viewBox="0 0 24 24" fill="#0a1628"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                    <span>Book an Appointment</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: form --}}
        <div class="sam-form-col" data-aos="fade-left">
            <div class="sam-eyebrow">
                <div class="sam-eyebrow-line"></div>
                <span>Let's Connect</span>
            </div>
            <h2 class="sam-heading">Schedule a <em>Meeting</em></h2>
            <p class="sam-subtext">Fill in your details and our team will get back to you to confirm your appointment.</p>
            <form action="{{ route('contact.send') }}" method="POST" class="sam-form" id="samForm">
                @csrf
                <div class="sam-field">
                    <input type="text" name="name" required placeholder="Full Name *" class="sam-input">
                </div>
                <div class="sam-field">
                    <input type="tel" name="phone" required placeholder="Phone Number *" class="sam-input">
                </div>
                <div class="sam-field">
                    <input type="email" name="email" placeholder="Email Address" class="sam-input">
                </div>
                <div class="sam-field sam-select-wrap">
                    <select name="meeting_time" class="sam-input sam-select">
                        <option value="" disabled selected>Select a Time</option>
                        <option value="9:00 AM - 10:00 AM">9:00 AM – 10:00 AM</option>
                        <option value="10:00 AM - 11:00 AM">10:00 AM – 11:00 AM</option>
                        <option value="11:00 AM - 12:00 PM">11:00 AM – 12:00 PM</option>
                        <option value="12:00 PM - 1:00 PM">12:00 PM – 1:00 PM</option>
                        <option value="2:00 PM - 3:00 PM">2:00 PM – 3:00 PM</option>
                        <option value="3:00 PM - 4:00 PM">3:00 PM – 4:00 PM</option>
                        <option value="4:00 PM - 5:00 PM">4:00 PM – 5:00 PM</option>
                    </select>
                    <span class="sam-select-chevron">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </div>
                <button type="submit" class="sam-btn">
                    <span>Confirm Meeting</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 7: MAP — bg: #e8e4de (stone grey)
     ============================================================ --}}
<section class="map-section" id="project-locations">
    <svg class="map-arch-bg" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect x="30" y="120" width="34" height="580" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.12"/>
        <rect x="38" y="80" width="18" height="40" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.12"/>
        <rect x="72" y="200" width="28" height="500" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.1"/>
        <polygon points="72,200 86,175 100,200" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.1"/>
        <rect x="108" y="260" width="52" height="440" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.09"/>
        <rect x="1300" y="60" width="50" height="640" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.12"/>
        <line x1="1325" y1="40" x2="1325" y2="18" stroke="#0a1628" stroke-width="1.5" opacity="0.15"/>
        <circle cx="1325" cy="16" r="3" fill="#f4a41c" opacity="0.25"/>
        <rect x="1358" y="150" width="44" height="550" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.1"/>
        <polygon points="1358,150 1380,120 1402,150" fill="none" stroke="#0a1628" stroke-width="1" opacity="0.1"/>
        <path d="M24,24 L24,74 M24,24 L74,24" stroke="#f4a41c" stroke-width="2.5" fill="none" opacity="0.4"/>
        <path d="M1416,676 L1416,626 M1416,676 L1366,676" stroke="#f4a41c" stroke-width="2" fill="none" opacity="0.25"/>
        <line x1="170" y1="695" x2="440" y2="695" stroke="#f4a41c" stroke-width="2" opacity="0.18"/>
        <line x1="1000" y1="695" x2="1270" y2="695" stroke="#f4a41c" stroke-width="2" opacity="0.18"/>
    </svg>

    <div class="map-watermark" aria-hidden="true">PROJECTS</div>

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-6" style="position:relative;z-index:5;" data-aos="fade-up">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:10px;">
            <div style="width:38px;height:2px;background:#f4a41c;flex-shrink:0;"></div>
            <span style="font-size:10px;font-weight:700;letter-spacing:0.5em;text-transform:uppercase;color:#f4a41c;">Head Office</span>
        </div>
        <div style="display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
            <h2 style="font-family:'Cinzel',serif;font-size:clamp(1.6rem,3vw,2.6rem);font-weight:900;color:#0a1628;text-transform:uppercase;line-height:1.1;margin:0;">
                Find Us On <span style="color:#f4a41c;">The Map</span>
            </h2>
            <div style="display:flex;align-items:center;gap:10px;padding:10px 20px;background:#0a1628;border-left:3px solid #f4a41c;">
                <svg style="width:16px;height:16px;fill:#f4a41c;flex-shrink:0;" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                <span style="font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.85);">Rahman Trade Center, Bashundhara R/A, Dhaka</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-16">
        <div class="map-outer" data-aos="fade-up" data-aos-delay="100">
            <div class="map-frame-border" style="position:relative;">
                <span class="map-corner map-corner-tl"></span>
                <span class="map-corner map-corner-tr"></span>
                <span class="map-corner map-corner-bl"></span>
                <span class="map-corner map-corner-br"></span>
                <div class="map-embed-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1819962222226!2d90.4222225759289!3d23.81212648640261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c705aa134d71%3A0x1c8797d1479bcdb!2sTrikon%20Holdings%20Ltd.!5e0!3m2!1sen!2sbd!4v1777450989693!5m2!1sen!2sbd"
                        width="100%" height="100%"
                        style="border:0;display:block;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Trikon Holdings Project Locations">
                    </iframe>
                </div>
                <div class="map-filter-bar" id="mapFilterBar">
                    <div class="map-filter-item">
                        <select class="map-filter-select" id="filterLocation" onchange="applyMapFilter()" aria-label="Filter by location">
                            <option value="">All Locations</option>
                            @php
                                try {
                                    $allLocations = \App\Models\Project::select('location')->distinct()->whereNotNull('location')->get();
                                } catch (\Exception $e) {
                                    $allLocations = collect();
                                }
                            @endphp
                            @foreach($allLocations as $loc)
                                <option value="{{ $loc->location }}">{{ $loc->location }}</option>
                            @endforeach
                        </select>
                        <span class="map-filter-chevron">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="map-filter-item">
                        <select class="map-filter-select" id="filterStatus" onchange="applyMapFilter()" aria-label="Filter by project status">
                            <option value="">Project Status</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                        <span class="map-filter-chevron">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="map-filter-item">
                        <select class="map-filter-select" id="filterType" onchange="applyMapFilter()" aria-label="Filter by project type">
                            <option value="">Project Type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                            <option value="land">Land</option>
                        </select>
                        <span class="map-filter-chevron">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function applyMapFilter() {
    var location = document.getElementById('filterLocation').value;
    var iframeSrc;
    if (location) {
        iframeSrc = 'https://maps.google.com/maps?q=' + encodeURIComponent(location + ' Dhaka Bangladesh') + '&t=&z=13&ie=UTF8&iwloc=&output=embed';
    } else {
        iframeSrc = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1819962222226!2d90.4222225759289!3d23.81212648640261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c705aa134d71%3A0x1c8797d1479bcdb!2sTrikon%20Holdings%20Ltd.!5e0!3m2!1sen!2sbd!4v1777450989693!5m2!1sen!2sbd';
    }
    var iframe = document.querySelector('.map-embed-wrapper iframe');
    if (iframe) iframe.src = iframeSrc;
}
</script>

@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    new Swiper(".heroSwiper", {
        speed: 1500,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
    });
</script>
@endpush