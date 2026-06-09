@extends('layouts.app')

@section('styles')
<style>
    /* ── HEADER ── */
    .glass-header {
        background: rgb(0,0,0) !important;
        transition: background 0.6s ease, backdrop-filter 0.6s ease !important;
    }
    .glass-header.scrolled-stories {
        background: rgba(0,0,0,0.2) !important;
        backdrop-filter: blur(10px) !important;
    }

    /* ── SHARED TYPOGRAPHY ── */
    .serif-title {
        font-family: 'Cinzel', serif;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .gold-line-center {
        width: 72px; height: 2px;
        background: linear-gradient(90deg, transparent, #f4a41c, transparent);
        margin: 24px auto 0;
    }
    .gold-line-left {
        width: 56px; height: 2px;
        background: linear-gradient(90deg, #f4a41c, transparent);
        margin: 18px 0 0;
    }
    .section-eyebrow {
        font-family: 'Cinzel', serif;
        font-size: 0.65rem;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: #f4a41c;
        display: block;
        margin-bottom: 12px;
    }

    /* ── VIDEO HERO ── */
    .hero-section {
        position: relative;
        width: 100%;
        height: 100vh;
        min-height: 500px;
        overflow: hidden;
        background: #000;
    }
    .hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        object-fit: cover;
        z-index: 1;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom,
            rgba(0,0,0,0.35) 0%,
            rgba(0,0,0,0.1) 50%,
            rgba(0,0,0,0.55) 100%);
        z-index: 2;
    }
    .hero-content {
        position: absolute;
        inset: 0;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 24px;
    }
    .hero-title {
        font-family: 'Cinzel', serif;
        font-weight: 900;
        font-size: clamp(2.2rem, 6vw, 5rem);
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        line-height: 1.15;
        text-shadow: 0 4px 32px rgba(0,0,0,0.5);
    }
    .hero-subtitle {
        font-size: clamp(0.85rem, 1.5vw, 1.05rem);
        color: rgba(255,255,255,0.75);
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-top: 20px;
        font-weight: 400;
    }
    .hero-divider {
        width: 60px; height: 2px;
        background: #f4a41c;
        margin: 24px auto;
    }
    .sound-toggle {
        position: absolute;
        bottom: 36px; right: 36px;
        z-index: 10;
        width: 52px; height: 52px;
        background: rgba(244,164,28,0.55);
        border: 1.5px solid rgba(244,164,28,0.7);
        border-radius: 50%;
        color: white; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(6px);
    }
    .sound-toggle:hover { transform: scale(1.1); background: #f4a41c; }
    .scroll-hint {
        position: absolute;
        bottom: 44px; left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex; flex-direction: column; align-items: center; gap: 6px;
        color: rgba(255,255,255,0.5);
        font-size: 0.6rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        animation: bounce 2.2s infinite;
    }
    .scroll-hint svg { opacity: 0.5; }
    @keyframes bounce {
        0%,100% { transform: translateX(-50%) translateY(0); }
        50%      { transform: translateX(-50%) translateY(8px); }
    }

    /* ── HERITAGE SECTION ── */
    .heritage-section {
        position: relative;
        overflow: hidden;
        background: #fff;
        padding: 96px 0;
    }
    .heritage-section .art-layer {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0;
    }
    .heritage-section .body-text {
        font-size: 1.1rem;
        line-height: 2;
        color: #4b5563;
        font-weight: 300;
    }
    .heritage-section .pull-quote {
        font-family: 'Cinzel', serif;
        font-size: clamp(1rem, 1.8vw, 1.25rem);
        font-style: italic;
        color: #9ca3af;
        letter-spacing: 0.05em;
        border-left: 3px solid #f4a41c;
        padding-left: 24px;
        text-align: left;
        margin: 40px auto;
        max-width: 680px;
    }

    /* ── LOGO STORY ── */
    .logo-section {
        position: relative;
        overflow: hidden;
        background: #fafafa;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
        padding: 96px 0;
    }
    .logo-section .art-layer {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0;
    }
    .logo-section .body-text {
        font-size: 1rem;
        line-height: 1.95;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    /* ── PROMISE SECTION ── */
    .promise-section {
        position: relative;
        overflow: hidden;
        background: #fff;
        padding: 96px 0;
    }
    .promise-section .art-layer {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0;
    }
    .promise-card {
        position: relative; z-index: 10;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(244,164,28,0.15);
        border-radius: 20px;
        padding: 48px 32px 44px;
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        backdrop-filter: blur(4px);
    }
    .promise-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 40px 70px -16px rgba(244,164,28,0.2);
        border-color: rgba(244,164,28,0.45);
    }
    .icon-ring {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(244,164,28,0.07), rgba(244,164,28,0.18));
        border: 1.5px solid rgba(244,164,28,0.28);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 28px;
        transition: all 0.3s ease;
    }
    .promise-card:hover .icon-ring {
        background: linear-gradient(135deg, rgba(244,164,28,0.18), rgba(244,164,28,0.35));
        border-color: rgba(244,164,28,0.6);
    }
    .icon-ring img { width: 48px; height: 48px; object-fit: contain; }
    .promise-card .card-text {
        font-size: 0.9rem;
        line-height: 1.85;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.04em;
    }

    /* ── CORE VALUES ── */
    .values-section {
        position: relative;
        overflow: hidden;
        background: #fafafa;
        border-top: 1px solid #f0f0f0;
        padding: 96px 0;
    }
    .values-section .art-layer {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0;
    }
    .value-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        padding: 18px 0;
        border-bottom: 1px solid rgba(244,164,28,0.08);
        transition: background 0.2s;
    }
    .value-row:last-child { border-bottom: none; }
    .value-bullet {
        flex-shrink: 0;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: rgba(244,164,28,0.1);
        border: 1px solid rgba(244,164,28,0.3);
        display: flex; align-items: center; justify-content: center;
        margin-top: 2px;
        font-size: 0.7rem;
        color: #f4a41c;
        font-weight: 900;
    }
    .value-title {
        font-family: 'Cinzel', serif;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #111827;
    }
    .value-desc {
        font-size: 0.95rem;
        line-height: 1.75;
        color: #6b7280;
        margin-top: 4px;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- ═══════════════════════════════════════════
         SECTION 1 · VIDEO HERO
    ═══════════════════════════════════════════ -->
    <section class="hero-section">
        <video id="heroVideo" class="hero-video" autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('story.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <span class="section-eyebrow" style="color:rgba(244,164,28,0.85); margin-bottom:0;">Our Journey</span>
            <div class="hero-divider"></div>
            <h1 class="hero-title">The <span style="color:#f4a41c;">Trikon</span> Story</h1>
            <p class="hero-subtitle">Passion · Purpose · Legacy</p>
        </div>

        <button onclick="toggleSound()" class="sound-toggle" id="muteBtn" title="Toggle sound">
            <i class="fa-solid fa-volume-xmark" id="muteIcon"></i>
        </button>

        <div class="scroll-hint">
            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="14" height="18" rx="7" stroke="white" stroke-width="1.5"/>
                <rect x="7" y="5" width="2" height="5" rx="1" fill="white"/>
            </svg>
            <span>Scroll</span>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
         SECTION 2 · THE TRIKON HERITAGE
    ═══════════════════════════════════════════ -->
    <section class="heritage-section">

        <!-- Background Art: Grid + nested triangles + constellation -->
        <div class="art-layer">
            <svg width="100%" height="100%" viewBox="0 0 1440 720" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hGrid" width="64" height="64" patternUnits="userSpaceOnUse">
                        <path d="M 64 0 L 0 0 0 64" fill="none" stroke="#f4a41c" stroke-width="0.35" opacity="0.2"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hGrid)"/>
                <!-- Brand triangles -->
                <polygon points="720,30 160,660 1280,660" fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.07"/>
                <polygon points="720,110 260,630 1180,630" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.05"/>
                <polygon points="720,190 360,600 1080,600" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.04"/>
                <!-- Decorative corner arcs -->
                <path d="M0,0 Q180,0 180,180" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.1"/>
                <path d="M0,0 Q130,0 130,130" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.07"/>
                <path d="M1440,720 Q1260,720 1260,540" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.1"/>
                <path d="M1440,720 Q1310,720 1310,590" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.07"/>
                <!-- Constellation dots -->
                <circle cx="100" cy="360" r="2.5" fill="#f4a41c" opacity="0.18"/>
                <circle cx="164" cy="310" r="1.8" fill="#f4a41c" opacity="0.14"/>
                <circle cx="60"  cy="430" r="1.5" fill="#f4a41c" opacity="0.12"/>
                <line x1="100" y1="360" x2="164" y2="310" stroke="#f4a41c" stroke-width="0.5" opacity="0.12"/>
                <line x1="100" y1="360" x2="60"  y2="430" stroke="#f4a41c" stroke-width="0.5" opacity="0.10"/>
                <circle cx="1340" cy="200" r="2.5" fill="#f4a41c" opacity="0.18"/>
                <circle cx="1390" cy="260" r="1.8" fill="#f4a41c" opacity="0.14"/>
                <circle cx="1300" cy="150" r="1.5" fill="#f4a41c" opacity="0.12"/>
                <line x1="1340" y1="200" x2="1390" y2="260" stroke="#f4a41c" stroke-width="0.5" opacity="0.12"/>
                <line x1="1340" y1="200" x2="1300" y2="150" stroke="#f4a41c" stroke-width="0.5" opacity="0.10"/>
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <span class="section-eyebrow" data-aos="fade-up">Est. Our Foundation</span>
            <h2 class="serif-title text-4xl md:text-5xl text-gray-900" data-aos="fade-up">
                THE TRIKON <span class="text-[#f4a41c]">HERITAGE</span>
            </h2>
            <div class="gold-line-center" data-aos="fade-up" data-aos-delay="80"></div>

            <div class="mt-12 space-y-8" data-aos="fade-up" data-aos-delay="160">
                <blockquote class="pull-quote">
                    "Architecture is a visual art, and the buildings speak for themselves."
                </blockquote>
                <p class="body-text">
                    Ready to experience the difference that Trikon Holdings can make in your real estate journey? Our story is one of passion, commitment to quality, and a vision that reaches beyond the horizon. For years, we have been dedicated to transforming prime pieces of land into architectural masterpieces.
                </p>
                <p class="body-text">
                    As a valued member of our community, you will find information that will spark your imagination and show you the world that exceeds your expectations. Trikon Holdings doesn't just build homes — we craft legacies where life unfolds in its most beautiful form.
                </p>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
         SECTION 3 · LOGO STORY
    ═══════════════════════════════════════════ -->
    <section class="logo-section">

        <!-- Background Art: Concentric rings + hatching -->
        <div class="art-layer">
            <svg width="100%" height="100%" viewBox="0 0 1440 520" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <circle cx="220" cy="260" r="150" fill="none" stroke="#f4a41c" stroke-width="0.7" opacity="0.08"/>
                <circle cx="220" cy="260" r="220" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.06"/>
                <circle cx="220" cy="260" r="290" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <circle cx="1220" cy="260" r="170" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.07"/>
                <circle cx="1220" cy="260" r="260" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <!-- Diagonal lines top-right -->
                <line x1="880" y1="0"   x2="1440" y2="520" stroke="#f4a41c" stroke-width="0.35" opacity="0.07"/>
                <line x1="960" y1="0"   x2="1440" y2="430" stroke="#f4a41c" stroke-width="0.25" opacity="0.05"/>
                <line x1="820" y1="0"   x2="1440" y2="580" stroke="#f4a41c" stroke-width="0.2"  opacity="0.04"/>
                <!-- Small diamond accent mid -->
                <polygon points="720,100 740,130 720,160 700,130" fill="none" stroke="#f4a41c" stroke-width="0.7" opacity="0.12"/>
                <polygon points="720,110 734,130 720,150 706,130" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.08"/>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <div class="lg:col-span-5 flex justify-center" data-aos="fade-right">
                    @php
                        $logoPath = $settings->logo ?? null;
                        if($logoPath) {
                            $cleanLogo = ltrim(Str::replaceFirst('storage/', '', $logoPath), '/');
                            $logoUrl = asset($cleanLogo);
                        } else {
                            $logoUrl = null;
                        }
                    @endphp
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" class="w-64 md:w-80 h-auto grayscale opacity-60" alt="Trikon Logo" onerror="this.style.display='none'; document.getElementById('fallback-logo').style.display='block'">
                        <div id="fallback-logo" style="display:none;" class="serif text-gray-200 font-black text-7xl uppercase select-none">TRIKON</div>
                    @else
                        <div class="serif text-gray-200 font-black text-7xl uppercase select-none">TRIKON</div>
                    @endif
                </div>

                <div class="lg:col-span-7" data-aos="fade-left">
                    <span class="section-eyebrow">Identity & Symbol</span>
                    <h2 class="serif-title text-3xl text-gray-900">LOGO <span class="text-[#f4a41c]">STORY</span></h2>
                    <div class="gold-line-left"></div>
                    <div class="mt-8 space-y-6 body-text" style="font-size:1rem; text-transform:uppercase; letter-spacing:0.06em;">
                        <p>The founders sought a symbol that would encapsulate the essence of their brand — conveying their commitment to innovation, excellence, and integrity. After much deliberation, they turned to the timeless symbolism of the triangle.</p>
                        <p>Each of its three pillars represents a core philosophy: luxury, sustainability, and community. The logo features a harmonious blend of yellow and golden tones, symbolizing optimism, creativity, and prosperity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
         SECTION 4 · MISSION · VISION · OBJECTIVE
    ═══════════════════════════════════════════ -->
    <section class="promise-section">

        <!-- Background Art: Compass mandala -->
        <div class="art-layer">
            <svg width="100%" height="100%" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <radialGradient id="promiseGlow" cx="50%" cy="50%" r="50%">
                        <stop offset="0%"   stop-color="#f4a41c" stop-opacity="0.08"/>
                        <stop offset="100%" stop-color="#f4a41c" stop-opacity="0"/>
                    </radialGradient>
                </defs>
                <circle cx="720" cy="350" r="440" fill="url(#promiseGlow)"/>
                <!-- Concentric rings -->
                <circle cx="720" cy="350" r="90"  fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.1"/>
                <circle cx="720" cy="350" r="170" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.09"/>
                <circle cx="720" cy="350" r="260" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.07"/>
                <circle cx="720" cy="350" r="355" fill="none" stroke="#f4a41c" stroke-width="0.35" opacity="0.05"/>
                <circle cx="720" cy="350" r="440" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <!-- Radial spokes — 16 directions -->
                <line x1="720" y1="350" x2="720"  y2="0"    stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="350" x2="720"  y2="700"  stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="350" x2="0"    y2="350"  stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="350" x2="1440" y2="350"  stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="350" x2="1330" y2="40"   stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="350" x2="110"  y2="660"  stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="350" x2="110"  y2="40"   stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="350" x2="1330" y2="660"  stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="350" x2="1440" y2="130"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="350" x2="0"    y2="570"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="350" x2="1440" y2="570"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="350" x2="0"    y2="130"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <!-- Brand triangle overlay -->
                <polygon points="720,70 370,600 1070,600" fill="none" stroke="#f4a41c" stroke-width="0.7" opacity="0.07"/>
                <polygon points="720,120 420,575 1020,575" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <!-- Compass tick marks -->
                <line x1="720" y1="260" x2="720" y2="272" stroke="#f4a41c" stroke-width="1.2" opacity="0.18"/>
                <line x1="720" y1="428" x2="720" y2="440" stroke="#f4a41c" stroke-width="1.2" opacity="0.18"/>
                <line x1="630" y1="350" x2="618" y2="350" stroke="#f4a41c" stroke-width="1.2" opacity="0.18"/>
                <line x1="810" y1="350" x2="822" y2="350" stroke="#f4a41c" stroke-width="1.2" opacity="0.18"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <span class="section-eyebrow" data-aos="fade-up">What drives us</span>
                <h2 class="serif-title text-4xl text-gray-900" data-aos="fade-up">
                    OUR <span class="text-[#f4a41c]">PROMISE</span>
                </h2>
                <div class="gold-line-center" data-aos="fade-up" data-aos-delay="80"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- Mission -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="icon-ring">
                        <img src="data:image/jpeg;base64,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" alt="Mission">
                    </div>
                    <h3 class="serif-title text-base mb-5 text-[#f4a41c]">MISSION</h3>
                    <p class="card-text">Empowering individuals and businesses to achieve real estate goals by providing comprehensive solutions and expert guidance.</p>
                </div>

                <!-- Vision -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="120">
                    <div class="icon-ring">
                        <img src="data:image/jpeg;base64,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" alt="Vision">
                    </div>
                    <h3 class="serif-title text-base mb-5 text-[#f4a41c]">VISION</h3>
                    <p class="card-text">Driven by excellence to become the industry's top-most prioritized company recognized for client satisfaction.</p>
                </div>

                <!-- Objective -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="240">
                    <div class="icon-ring">
                        <img src="data:image/jpeg;base64,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" alt="Objective">
                    </div>
                    <h3 class="serif-title text-base mb-5 text-[#f4a41c]">OBJECTIVE</h3>
                    <p class="card-text">Connecting communities worldwide for a better society by offering affordable, unique housing projects.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
         SECTION 5 · CORE VALUES
    ═══════════════════════════════════════════ -->
    <section class="values-section">

        <!-- Background Art: Woven lattice + large T watermark -->
        <div class="art-layer">
            <svg width="100%" height="100%" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="lattice" width="44" height="44" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                        <line x1="0" y1="0" x2="0"  y2="44" stroke="#f4a41c" stroke-width="0.45" opacity="0.2"/>
                        <line x1="0" y1="0" x2="44" y2="0"  stroke="#f4a41c" stroke-width="0.45" opacity="0.2"/>
                    </pattern>
                    <radialGradient id="vFade" cx="50%" cy="50%" r="55%">
                        <stop offset="0%"   stop-color="#fafafa" stop-opacity="0"/>
                        <stop offset="100%" stop-color="#fafafa" stop-opacity="0.88"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#lattice)"/>
                <rect width="100%" height="100%" fill="url(#vFade)"/>
                <!-- Large TRIKON watermark -->
                <text x="50%" y="52%" text-anchor="middle" dominant-baseline="middle"
                      font-family="serif" font-weight="900" font-size="380"
                      fill="#f4a41c" opacity="0.028" letter-spacing="30">TRIKON</text>
            </svg>
        </div>

        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <span class="section-eyebrow" data-aos="fade-up">Our DNA</span>
                <h2 class="serif-title text-4xl text-gray-900" data-aos="fade-up">
                    CORE <span class="text-[#f4a41c]">VALUES</span>
                </h2>
                <div class="gold-line-center" data-aos="fade-up" data-aos-delay="80"></div>
            </div>

            <div data-aos="fade-up" data-aos-delay="120">
                @php
                    $values = [
                        'Integrity'         => 'We uphold the highest standards of honesty, transparency, and ethical conduct.',
                        'Excellence'        => 'We strive for excellence in everything we do, continuously innovating and raising the bar.',
                        'Client-Centricity' => 'We prioritize the needs and interests of our clients above all else, ensuring their satisfaction.',
                        'Professionalism'   => 'Demonstrating professionalism in every interaction — communication, appearance, and conduct.',
                        'Collaboration'     => 'We believe in the power of working together, building strong partnerships with communities.',
                        'Accountability'    => 'We take full responsibility for our actions and outcomes, maintaining the highest standards.',
                        'Respect'           => 'Showing respect and genuine consideration for all individuals we work with at all times.',
                        'Innovation'        => 'Embracing creativity and fresh thinking to adapt and thrive in changing market dynamics.'
                    ];
                @endphp
                @foreach($values as $title => $desc)
                <div class="value-row">
                    <div class="value-bullet">✦</div>
                    <div>
                        <div class="value-title">{{ $title }}</div>
                        <div class="value-desc">{{ $desc }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</div>

<script>
    /* ── Scroll-based header transparency ── */
    window.addEventListener('scroll', function () {
        const header = document.querySelector('.glass-header');
        if (header) {
            header.classList.toggle('scrolled-stories', window.scrollY > 150);
        }
    });

    /* ── Sound toggle ── */
    function toggleSound() {
        const video = document.getElementById('heroVideo');
        const icon  = document.getElementById('muteIcon');
        if (video.muted) {
            video.muted = false;
            icon.classList.replace('fa-volume-xmark', 'fa-volume-high');
        } else {
            video.muted = true;
            icon.classList.replace('fa-volume-high', 'fa-volume-xmark');
        }
    }

    /* ── Ensure video plays on mobile (needs user gesture fallback) ── */
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('heroVideo');
        if (video) {
            video.play().catch(function () {
                // Autoplay blocked — silently ignore; muted loop will retry on interaction
            });
        }
    });
</script>
@endsection