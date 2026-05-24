@extends('layouts.app')

@section('styles')
<style>
    /* 1. Rangs Model Styling for Homepage Projects */
    .home-project-card {
        aspect-ratio: 3 / 4.2;
    }
    .serif-title { font-family: 'Cinzel', serif; }

    /* 2. Modern Services Styling - Zero Gap Edge-to-Edge */
    .service-container-row {
        display: flex;
        flex-wrap: wrap; 
        gap: 0;
    }

    .service-block {
        position: relative;
        height: 500px;
        overflow: hidden;
        flex: 1 0 33.333%; 
        min-width: 33.333%;
    }

    @media (max-width: 1024px) {
        .service-block {
            flex: 1 0 50%;
            min-width: 50%;
        }
    }

    @media (max-width: 640px) {
        .service-block {
            flex: 1 0 100%;
            min-width: 100%;
        }
    }

    .service-block img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s ease;
    }

    .service-block:hover img {
        transform: scale(1.1);
    }

    .service-block-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4); 
        transition: background 0.5s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 40px;
        z-index: 10;
    }

    .service-block:hover .service-block-overlay {
        background: rgba(244, 164, 28, 0.3); 
    }

    /* VIDEO CONTAINER STYLING */
    .video-aspect-box {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        height: 0;
        overflow: hidden;
        background: #111;
        border: 1px solid rgba(244, 164, 28, 0.2);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6);
    }
    .video-aspect-box iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* =========================================
       STUNNING CUSTOMER REVIEWS SECTION - NEW
       ========================================= */

    /* --- LEFT PANEL: Hero Text --- */
    .reviews-section {
        display: flex;
        min-height: 100vh;
        background: #050505;
        overflow: hidden;
        position: relative;
    }

    .reviews-left-panel {
        width: 38%;
        min-width: 340px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 60px;
        position: relative;
        z-index: 10;
        background: #050505;
        border-right: 1px solid rgba(244,164,28,0.12);
    }

    .reviews-left-panel::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: radial-gradient(ellipse at bottom left, rgba(244,164,28,0.07) 0%, transparent 70%);
        pointer-events: none;
    }

    .reviews-eyebrow {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }

    .reviews-eyebrow-line {
        width: 40px;
        height: 2px;
        background: #f4a41c;
    }

    .reviews-eyebrow span {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: #f4a41c;
    }

    .reviews-main-heading {
        font-family: 'Cinzel', serif;
        font-size: clamp(2.8rem, 5vw, 5rem);
        font-weight: 900;
        line-height: 1.0;
        color: #ffffff;
        margin-bottom: 32px;
        letter-spacing: -0.02em;
    }

    .reviews-main-heading em {
        font-style: normal;
        color: #f4a41c;
        display: block;
    }

    .reviews-subtext {
        font-size: 13px;
        color: rgba(255,255,255,0.45);
        line-height: 1.8;
        max-width: 280px;
        font-weight: 300;
        margin-bottom: 48px;
    }

    .reviews-counter {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }

    .reviews-counter-num {
        font-family: 'Cinzel', serif;
        font-size: 4rem;
        font-weight: 900;
        color: #f4a41c;
        line-height: 1;
    }

    .reviews-counter-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.3);
    }

    .reviews-stars {
        display: flex;
        gap: 4px;
        margin-top: 16px;
        margin-bottom: 40px;
    }

    .reviews-stars svg {
        width: 18px;
        height: 18px;
        fill: #f4a41c;
    }

    .reviews-scroll-hint {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.2);
        margin-top: auto;
    }

    .reviews-scroll-hint-arrow {
        width: 32px;
        height: 1px;
        background: rgba(255,255,255,0.15);
        position: relative;
    }

    /* --- RIGHT PANEL: Image Grid --- */
    .reviews-right-panel {
        flex: 1;
        position: relative;
        overflow: hidden;
        background: #080808;
    }

    .reviews-grid-wrapper {
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 20px;
        scrollbar-width: none;
        -ms-overflow-style: none;
        cursor: grab;
        user-select: none;
    }

    .reviews-grid-wrapper::-webkit-scrollbar {
        display: none;
    }

    .reviews-grid-wrapper.is-dragging {
        cursor: grabbing;
    }

    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 6px;
    }

    @media (max-width: 1200px) {
        .reviews-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .review-thumb {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        cursor: pointer;
        background: #111;
    }

    .review-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), filter 0.5s ease;
        filter: grayscale(30%) brightness(0.85);
    }

    .review-thumb:hover img {
        transform: scale(1.08);
        filter: grayscale(0%) brightness(1);
    }

    .review-thumb-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 16px;
    }

    .review-thumb:hover .review-thumb-overlay {
        opacity: 1;
    }

    .review-thumb-name {
        font-size: 11px;
        font-weight: 700;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        line-height: 1.2;
    }

    .review-thumb-role {
        font-size: 9px;
        color: #f4a41c;
        font-weight: 600;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 3px;
    }

    .review-thumb-icon {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 28px;
        height: 28px;
        background: rgba(244,164,28,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.7);
        transition: all 0.3s ease;
    }

    .review-thumb:hover .review-thumb-icon {
        opacity: 1;
        transform: scale(1);
    }

    .review-thumb-icon svg {
        width: 12px;
        height: 12px;
        fill: #000;
    }

    /* Video badge */
    .review-thumb-video-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
        background: rgba(0,0,0,0.7);
        border: 1px solid rgba(244,164,28,0.5);
        padding: 3px 8px;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.2em;
        color: #f4a41c;
        text-transform: uppercase;
    }

    .review-thumb-video-badge svg {
        width: 8px;
        height: 8px;
        fill: #f4a41c;
    }

    /* Top fade gradient on grid */
    .reviews-right-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(to bottom, #080808, transparent);
        z-index: 5;
        pointer-events: none;
    }

    .reviews-right-panel::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to top, #080808, transparent);
        z-index: 5;
        pointer-events: none;
    }

    /* Decorative number */
    .reviews-deco-num {
        position: absolute;
        bottom: 40px;
        left: 60px;
        font-family: 'Cinzel', serif;
        font-size: 160px;
        font-weight: 900;
        color: rgba(255,255,255,0.02);
        line-height: 1;
        pointer-events: none;
        z-index: 1;
    }

    /* --- FULLSCREEN MODAL --- */
    .review-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.97);
        z-index: 9999;
        display: flex;
        align-items: stretch;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s ease;
    }

    .review-modal-backdrop.is-open {
        opacity: 1;
        pointer-events: all;
    }

    /* Modal Left: Full Image/Video */
    .review-modal-media {
        width: 55%;
        position: relative;
        background: #000;
        overflow: hidden;
        flex-shrink: 0;
    }

    .review-modal-media img,
    .review-modal-media video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .review-modal-media iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .review-modal-media-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, transparent 60%, rgba(0,0,0,0.3) 100%);
        pointer-events: none;
    }

    /* Modal Right: Content */
    .review-modal-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 60px;
        background: #0a0a0a;
        border-left: 1px solid rgba(244,164,28,0.1);
        overflow-y: auto;
        position: relative;
    }

    .review-modal-content::before {
        content: '"';
        position: absolute;
        top: 40px;
        left: 40px;
        font-size: 200px;
        line-height: 1;
        color: rgba(244,164,28,0.04);
        font-family: 'Cinzel', serif;
        pointer-events: none;
    }

    .review-modal-eyebrow {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 36px;
    }

    .review-modal-eyebrow-line {
        width: 30px;
        height: 2px;
        background: #f4a41c;
    }

    .review-modal-eyebrow span {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: #f4a41c;
    }

    .review-modal-quote {
        font-size: clamp(1.1rem, 2vw, 1.5rem);
        color: rgba(255,255,255,0.9);
        font-weight: 300;
        line-height: 1.75;
        font-style: italic;
        margin-bottom: 48px;
        position: relative;
        z-index: 1;
    }

    .review-modal-author {
        border-left: 3px solid #f4a41c;
        padding-left: 24px;
        margin-bottom: 48px;
    }

    .review-modal-author-name {
        font-size: 20px;
        font-weight: 800;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-family: 'Cinzel', serif;
    }

    .review-modal-author-role {
        font-size: 10px;
        color: #f4a41c;
        font-weight: 600;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-top: 6px;
    }

    .review-modal-stars {
        display: flex;
        gap: 6px;
        margin-bottom: 40px;
    }

    .review-modal-stars svg {
        width: 20px;
        height: 20px;
        fill: #f4a41c;
    }

    /* Modal navigation */
    .review-modal-nav {
        display: flex;
        gap: 12px;
        margin-top: auto;
        padding-top: 40px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .review-modal-nav-btn {
        width: 48px;
        height: 48px;
        border: 1px solid rgba(255,255,255,0.1);
        background: transparent;
        color: rgba(255,255,255,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 18px;
    }

    .review-modal-nav-btn:hover {
        border-color: #f4a41c;
        color: #f4a41c;
        background: rgba(244,164,28,0.05);
    }

    .review-modal-close {
        position: absolute;
        top: 24px;
        right: 24px;
        width: 44px;
        height: 44px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.5);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .review-modal-close:hover {
        background: rgba(244,164,28,0.1);
        border-color: #f4a41c;
        color: #f4a41c;
    }

    .review-modal-counter {
        position: absolute;
        bottom: 24px;
        left: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3em;
        color: rgba(255,255,255,0.2);
        z-index: 10;
    }

    /* Transition for modal content swap */
    .review-modal-content-inner {
        transition: opacity 0.3s ease;
    }

    .review-modal-content-inner.fading {
        opacity: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 900px) {
        .reviews-section {
            flex-direction: column;
            min-height: auto;
        }

        .reviews-left-panel {
            width: 100%;
            min-width: unset;
            padding: 60px 30px 40px;
            border-right: none;
            border-bottom: 1px solid rgba(244,164,28,0.12);
        }

        .reviews-right-panel {
            height: 80vw;
            min-height: 400px;
        }

        .reviews-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .review-modal-backdrop {
            flex-direction: column;
        }

        .review-modal-media {
            width: 100%;
            height: 45vh;
        }

        .review-modal-content {
            padding: 40px 30px;
        }

        .reviews-main-heading {
            font-size: 2.2rem;
        }
    }
</style>
@endsection

@section('content')

<!-- SECTION 1: HERO SLIDER -->
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
                <img src="{{ $slideUrl }}" class="w-full h-full object-cover" alt="Slider" onerror="this.onerror=null;this.src='https://placehold.co/1920x1080?text=Slider+Image';">
                
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

<!-- SECTION 2: WELCOME SECTION (WITH FUNCTIONAL VIDEO) -->
<section class="relative py-24 bg-black overflow-hidden border-b border-white/5">

    <div class="absolute right-0 top-0 h-full w-1/3 opacity-5 pointer-events-none">
        <svg viewBox="0 0 100 100" class="h-full w-full fill-white">
            <path d="M50 5 L95 95 L5 95 Z" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT CONTENT -->
            <div data-aos="fade-right">

                <h4 class="text-white text-xl font-bold mb-2">
                    Welcome to
                </h4>

                <h2 class="text-[#f4a41c] text-3xl md:text-4xl font-extrabold uppercase mb-8">
                    Trikon Holdings
                </h2>

                <div class="space-y-6 text-white/90 text-sm leading-relaxed font-light">

                    <p>
                        Discover a new standard in real estate with Trikon Holdings, a trusted name in Bangladesh's real estate sector, specializing in property development, luxury residential apartments, commercial spaces, and land projects.
                    </p>

                    <p>
                        We are dedicated to delivering developments that combine quality construction, modern design, and long-term investment value.
                    </p>

                    <p>
                        Whether you are seeking your dream home, a functional office space, or a secure investment opportunity, Trikon Holdings offers reliable solutions tailored to your needs.
                    </p>

                    <p>
                        Experience premium living, exceptional opportunities, and smart investments with Trikon.
                    </p>

                </div>

            </div>

            <!-- RIGHT VIDEO -->
            <div data-aos="fade-left">

                <div class="relative w-full overflow-hidden bg-black shadow-2xl border border-[#f4a41c]/20"
                     style="padding-bottom:56.25%;">

                    @php

                        $settings = \App\Models\Setting::first();

                        $videoUrl = trim($settings->welcome_video_url ?? '');

                        $videoId = null;

                        if ($videoUrl) {

                            // youtu.be/xxxxx
                            if (preg_match('/youtu\.be\/([^\?\/]+)/', $videoUrl, $matches)) {
                                $videoId = $matches[1];
                            }

                            // youtube.com/watch?v=xxxxx
                            elseif (preg_match('/v=([^\&]+)/', $videoUrl, $matches)) {
                                $videoId = $matches[1];
                            }

                            // youtube.com/embed/xxxxx
                            elseif (preg_match('/embed\/([^\?\/]+)/', $videoUrl, $matches)) {
                                $videoId = $matches[1];
                            }
                        }

                    @endphp

                    @if($videoId)

                        <iframe
                            class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1"
                            title="Welcome Video"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>

                    @else

                        <div class="absolute inset-0 flex items-center justify-center bg-gray-900">

                            <div class="text-center">

                                <p class="text-white/50 uppercase tracking-[0.3em] text-xs mb-3">
                                    Video Not Found
                                </p>

                                <p class="text-white/30 text-[11px]">
                                    Please add a valid YouTube URL from admin panel
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SECTION 3: OUR PROJECTS -->
<section class="py-24 bg-[#f4a41c]">
    <div class="max-w-7xl mx-auto px-6">
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

<!-- SECTION 4: OUR SERVICES -->
<section class="bg-white relative overflow-hidden">
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.03] pointer-events-none select-none">
        <img src="{{ asset('logo.png') }}" class="w-[800px] grayscale" alt="Watermark">
    </div>

    <div class="text-center py-24 relative z-10" data-aos="fade-up">
        <h2 class="serif text-gray-900 text-4xl md:text-5xl font-black uppercase tracking-widest">
            Our <span class="text-[#f4a41c]">Services</span>
        </h2>
    </div>

    <div class="service-container-row relative z-10">
        @php $services = \App\Models\Service::all(); @endphp
        @foreach($services as $service)
        <a href="{{ route('services.show', $service->slug) }}" class="service-block group">
            @php
                $servImg = $service->hero_image;
                $servUrl = asset(ltrim(Str::replaceFirst('storage/', '', $servImg), '/'));
            @endphp
            <img src="{{ $servUrl }}" alt="{{ $service->name }}" onerror="this.onerror=null;this.src='https://placehold.co/800x600?text=Service+Image';">
            <div class="service-block-overlay">
                <h3 class="serif text-2xl text-white font-bold uppercase tracking-[0.3em] group-hover:scale-110 transition-transform duration-500 drop-shadow-2xl px-4">
                    {{ $service->name }}
                </h3>
                <div class="w-0 group-hover:w-16 h-[2px] bg-[#f4a41c] mt-6 transition-all duration-500"></div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<!-- SECTION 5: CUSTOMER REVIEWS -->
@php 
    $testimonialsData = \App\Models\Testimonial::where('is_active', true)
        ->get()
        ->map(function($t) {
            $vId = '';
            if ($t->video_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $t->video_url, $m)) {
                $vId = $m[1];
            }
            $imagePath = $t->image;
            if ($imagePath) {
                $imageUrl = asset('storage/' . ltrim($imagePath, '/'));
            } else {
                $imageUrl = 'https://placehold.co/800x520/111/333?text=Review';
            }
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
<section class="py-24 bg-white" id="testimonials-section">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section header --}}
        <div class="mb-14" data-aos="fade-up">
            <p class="text-xs font-bold uppercase tracking-[0.5em] text-gray-400 mb-3">Testimonial</p>
            <h2 class="text-gray-900 text-4xl md:text-5xl font-black uppercase leading-tight tracking-tight">
                What Customers<br>
                <span class="text-[#0a2240]">Say About Us</span>
            </h2>
        </div>

        {{-- Testimonial layout --}}
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center" data-aos="fade-up" data-aos-delay="100">

            {{-- LEFT: Media panel --}}
            <div class="w-full lg:w-[55%] flex-shrink-0">
                <div class="relative overflow-hidden bg-gray-900" style="aspect-ratio:16/10;">

                    {{-- Video or Image --}}
                    <div id="tsMediaWrap" class="absolute inset-0">
                        {{-- Filled by JS --}}
                    </div>

                    {{-- Overlay gradient --}}
                    <div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.05) 55%);"></div>

                    {{-- Play button (hidden when video playing) --}}
                    <button id="tsPlayBtn"
                        onclick="tsPlayVideo()"
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white/95 rounded-full flex items-center justify-center z-20 hover:scale-110 transition-transform duration-300 shadow-xl"
                        aria-label="Play video">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#0a2240" style="margin-left:4px"><path d="M5 3l14 9-14 9V3z"/></svg>
                    </button>

                    {{-- Caption bar --}}
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10 flex items-end justify-between">
                        <div>
                            <p id="tsCaptionText" class="text-white font-bold uppercase text-sm leading-snug tracking-wide max-w-xs"></p>
                            <p id="tsCaptionRole" class="text-white/60 text-[10px] font-semibold uppercase tracking-[0.25em] mt-1"></p>
                        </div>
                        <div class="text-white/50 text-[9px] font-black uppercase tracking-[0.3em] border border-white/20 px-2 py-1">
                            TRIKON HOLDINGS
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Text panel --}}
            <div class="flex-1 min-w-0">
                <h3 id="tsTitle" class="text-[#0a2240] text-xl font-extrabold leading-snug mb-4"></h3>
                <p id="tsBody" class="text-gray-500 text-sm leading-relaxed mb-6"></p>
                <p id="tsName" class="text-gray-900 font-bold text-sm"></p>
                <p id="tsRole" class="text-gray-400 text-xs mt-1"></p>

                {{-- Progress dots --}}
                <div id="tsDots" class="flex gap-2 mt-6 mb-8"></div>

                {{-- Navigation arrows --}}
                <div class="flex gap-3 mt-2">
                    <button onclick="tsNavigate(-1)"
                        class="w-11 h-11 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-[#0a2240] hover:text-white hover:border-[#0a2240] transition-all duration-200 text-lg font-bold"
                        aria-label="Previous">&#8592;</button>
                    <button onclick="tsNavigate(1)"
                        class="w-11 h-11 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-[#0a2240] hover:text-white hover:border-[#0a2240] transition-all duration-200 text-lg font-bold"
                        aria-label="Next">&#8594;</button>
                </div>
            </div>

        </div>

    </div>
</section>

<script>
(function() {
    const reviews = @json($testimonialsData);
    let current = 0;
    let videoActive = false;

    const mediaWrap  = document.getElementById('tsMediaWrap');
    const playBtn    = document.getElementById('tsPlayBtn');
    const captText   = document.getElementById('tsCaptionText');
    const captRole   = document.getElementById('tsCaptionRole');
    const titleEl    = document.getElementById('tsTitle');
    const bodyEl     = document.getElementById('tsBody');
    const nameEl     = document.getElementById('tsName');
    const roleEl     = document.getElementById('tsRole');
    const dotsEl     = document.getElementById('tsDots');

    function buildDots() {
        dotsEl.innerHTML = '';
        reviews.forEach(function(_, i) {
            const d = document.createElement('button');
            d.style.cssText = 'width:8px;height:8px;border-radius:50%;border:none;cursor:pointer;transition:all 0.3s;background:' + (i === current ? '#0a2240' : '#d1d5db');
            d.onclick = function() { goTo(i); };
            dotsEl.appendChild(d);
        });
    }

    function render(idx) {
        const r = reviews[idx];
        videoActive = false;

        // Image or video thumbnail
        mediaWrap.innerHTML = '';
        const img = document.createElement('img');
        img.src = r.image || 'https://placehold.co/800x520/111/333?text=Review';
        img.alt = r.name;
        img.style.cssText = 'width:100%;height:100%;object-fit:cover;position:absolute;inset:0;transition:opacity 0.4s;';
        img.onerror = function() { this.src='https://placehold.co/800x520/111/333?text=Review'; };
        mediaWrap.appendChild(img);

        // Show/hide play button
        playBtn.style.display = r.video_id ? 'flex' : 'none';

        // Caption
        captText.textContent = r.text ? r.text.substring(0, 80) + (r.text.length > 80 ? '...' : '') : '';
        captRole.textContent  = r.role || '';

        // Right panel
        titleEl.textContent = 'Cherished Moments from Our Homeowner';
        bodyEl.textContent  = r.text || '';
        nameEl.textContent  = r.name || '';
        roleEl.textContent  = r.role || '';

        buildDots();
    }

    window.tsPlayVideo = function() {
        const r = reviews[current];
        if (!r.video_id) return;
        mediaWrap.innerHTML = '';
        const iframe = document.createElement('iframe');
        iframe.src = 'https://www.youtube.com/embed/' + r.video_id + '?autoplay=1&rel=0&modestbranding=1';
        iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:none;';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        mediaWrap.appendChild(iframe);
        playBtn.style.display = 'none';
        videoActive = true;
    };

    function goTo(idx) {
        // Stop any playing video
        if (videoActive) {
            const r = reviews[current];
            const img = document.createElement('img');
            img.src = r.image || 'https://placehold.co/800x520/111/333?text=Review';
            img.alt = r.name;
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;position:absolute;inset:0;';
            mediaWrap.innerHTML = '';
            mediaWrap.appendChild(img);
        }
        current = idx;
        render(current);
    }

    window.tsNavigate = function(dir) {
        goTo((current + dir + reviews.length) % reviews.length);
    };

    // Keyboard
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft')  window.tsNavigate(-1);
        if (e.key === 'ArrowRight') window.tsNavigate(1);
    });

    // Init
    if (reviews.length > 0) render(0);
})();
</script>
@endif

<!-- SECTION 6: INQUIRY FORM 2 -->
<section class="py-32 bg-black border-t border-white/5 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-gray-500 text-xs font-bold uppercase tracking-[0.6em] mb-4">Inquiry</h2>
            <h3 class="serif text-white text-4xl md:text-5xl font-black uppercase tracking-widest">Write Us <span class="text-[#f4a41c]">Your Query</span></h3>
            <div class="w-16 h-[2px] bg-[#f4a41c] mx-auto mt-8"></div>
        </div>

        <form action="{{ route('contact.send') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
            @csrf
            <div class="relative group">
                <input type="text" name="name" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Full Name *</label>
            </div>
            <div class="relative group">
                <input type="email" name="email" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Email Address *</label>
            </div>
            <div class="relative group md:col-span-2">
                <input type="text" name="phone" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-400 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Phone Number *</label>
            </div>
            <div class="relative group md:col-span-2">
                <textarea name="message" required placeholder=" " rows="3" class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300 resize-none"></textarea>
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Your Detailed Query *</label>
            </div>
            <div class="md:col-span-2 text-center mt-12">
                <button type="submit" class="inline-block px-20 py-5 bg-[#f4a41c] text-white font-black uppercase text-[10px] tracking-[0.4em] hover:bg-white hover:text-black transition-all shadow-2xl rounded-sm">Submit Inquiry</button>
            </div>
        </form>
    </div>
</section>

<!-- SECTION 7: GOOGLE MAP -->
<section class="w-full h-[500px] grayscale contrast-125 border-t border-white/5">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1819962222226!2d90.4222225759289!3d23.81212648640261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c705aa134d71%3A0x1c8797d1479bcdb!2sTrikon%20Holdings%20Ltd.!5e0!3m2!1sen!2sbd!4v1777450989693!5m2!1sen!2sbd" 
        width="100%" 
        height="100%" 
        style="border:0; display:block;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    // Hero Swiper
    new Swiper(".heroSwiper", {
        speed: 1500,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
    });

    // =============================================
    // CUSTOMER REVIEWS SECTION JAVASCRIPT
    // =============================================

    // Testimonials data from PHP
    const reviewsData = @json($testimonialsData ?? []);
    let currentReviewIndex = 0;

    // --- Draggable Grid ---
    (function() {
        const wrapper = document.getElementById('reviewsGridWrapper');
        if (!wrapper) return;

        let isDragging = false;
        let startY, scrollTop;
        let hasDragged = false;
        let dragThreshold = 6;

        wrapper.addEventListener('mousedown', function(e) {
            isDragging = true;
            hasDragged = false;
            startY = e.pageY - wrapper.offsetTop;
            scrollTop = wrapper.scrollTop;
            wrapper.classList.add('is-dragging');
        });

        wrapper.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
            const y = e.pageY - wrapper.offsetTop;
            const walk = y - startY;
            if (Math.abs(walk) > dragThreshold) hasDragged = true;
            wrapper.scrollTop = scrollTop - walk;
        });

        wrapper.addEventListener('mouseup', function() {
            isDragging = false;
            wrapper.classList.remove('is-dragging');
        });

        wrapper.addEventListener('mouseleave', function() {
            isDragging = false;
            wrapper.classList.remove('is-dragging');
        });

        // Block click events on children if dragging happened
        wrapper.addEventListener('click', function(e) {
            if (hasDragged) {
                e.stopPropagation();
                e.preventDefault();
            }
        }, true);
    })();

    // --- Modal Logic ---
    function openReviewModal(index) {
        currentReviewIndex = index;
        renderModal(index);
        document.getElementById('reviewModal').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.remove('is-open');
        document.body.style.overflow = '';
        // Clear iframe to stop video
        const mediaEl = document.getElementById('reviewModalMedia');
        const iframe = mediaEl.querySelector('iframe');
        if (iframe) iframe.src = '';
    }

    function navigateModal(dir) {
        const total = reviewsData.length;
        currentReviewIndex = (currentReviewIndex + dir + total) % total;
        
        const inner = document.getElementById('reviewModalContentInner');
        inner.classList.add('fading');
        
        setTimeout(function() {
            renderModal(currentReviewIndex);
            inner.classList.remove('fading');
        }, 200);
    }

    function renderModal(index) {
        const data = reviewsData[index];
        if (!data) return;

        const total = reviewsData.length;
        const counterEl = document.getElementById('reviewModalCounter');
        const quoteEl = document.getElementById('reviewModalQuote');
        const nameEl = document.getElementById('reviewModalName');
        const roleEl = document.getElementById('reviewModalRole');
        const mediaEl = document.getElementById('reviewModalMedia');

        // Update counter
        counterEl.textContent = String(index + 1).padStart(2, '0') + ' / ' + String(total).padStart(2, '0');

        // Update text
        quoteEl.textContent = data.text || '';
        nameEl.textContent = data.name || '';
        roleEl.textContent = data.role || '';

        // Update media (keep overlay and counter in place)
        // Remove old media content
        const oldMedia = mediaEl.querySelector('.review-modal-media-content');
        if (oldMedia) oldMedia.remove();

        const mediaContent = document.createElement('div');
        mediaContent.className = 'review-modal-media-content';
        mediaContent.style.cssText = 'position:absolute;inset:0;';

        if (data.video_id) {
            // Show YouTube iframe
            const iframe = document.createElement('iframe');
            iframe.src = 'https://www.youtube.com/embed/' + data.video_id + '?autoplay=1&rel=0&modestbranding=1';
            iframe.style.cssText = 'width:100%;height:100%;border:none;';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            mediaContent.appendChild(iframe);
        } else {
            // Show full image
            const img = document.createElement('img');
            img.src = data.image || '';
            img.alt = data.name || '';
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            img.onerror = function() { this.src = 'https://placehold.co/800x1000/111/333?text=Review'; };
            mediaContent.appendChild(img);
        }

        // Insert before the overlay
        const overlay = mediaEl.querySelector('.review-modal-media-overlay');
        mediaEl.insertBefore(mediaContent, overlay);
    }

    function handleModalBackdropClick(e) {
        if (e.target === document.getElementById('reviewModal')) {
            closeReviewModal();
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('reviewModal');
        if (!modal || !modal.classList.contains('is-open')) return;

        if (e.key === 'Escape') closeReviewModal();
        if (e.key === 'ArrowLeft') navigateModal(-1);
        if (e.key === 'ArrowRight') navigateModal(1);
    });
</script>
@endpush