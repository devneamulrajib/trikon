@extends('layouts.app')

@section('styles')
<style>
    /* 1. Project Cards */
    .home-project-card { aspect-ratio: 3 / 4.2; }
    .serif-title { font-family: 'Cinzel', serif; }

    /* 2. Services */
    .service-container-row { display: flex; flex-wrap: wrap; gap: 0; }
    .service-block { position: relative; height: 500px; overflow: hidden; flex: 1 0 33.333%; min-width: 33.333%; }
    @media (max-width: 1024px) { .service-block { flex: 1 0 50%; min-width: 50%; } }
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
        background: #f8f5f0;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    .ts-geo-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        width: 100%;
        height: 100%;
    }
    .ts-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 56px;
        position: relative;
        z-index: 2;
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
        font-weight: 900; color: #0a1628;
        text-transform: uppercase; line-height: 1.1; letter-spacing: -0.01em;
    }
    .ts-main-heading em { color: #f4a41c; font-style: normal; }
    .ts-counter-block { text-align: right; padding-bottom: 4px; }
    .ts-counter-num {
        font-family: 'Cinzel', serif;
        font-size: 54px; font-weight: 900; color: #0a1628; line-height: 1;
    }
    .ts-counter-label {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.4em; text-transform: uppercase; color: #aaa; margin-top: 5px;
    }
    .ts-card {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        position: relative; z-index: 2;
        box-shadow: 0 24px 64px rgba(10,22,40,0.12);
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
        background: #ffffff; padding: 48px 52px;
        display: flex; flex-direction: column; justify-content: space-between;
        border-top: 3px solid #f4a41c;
    }
    .ts-quote-icon {
        font-family: 'Cinzel', serif; font-size: 80px; line-height: 0.75;
        color: #f4a41c; opacity: 0.2; margin-bottom: 10px; display: block;
    }
    .ts-quote-text {
        color: #3d4a5c; font-size: 14.5px; line-height: 1.85;
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
        color: #0a1628; text-transform: uppercase; letter-spacing: 0.06em;
    }
    .ts-author-role {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.3em; text-transform: uppercase; color: #f4a41c; margin-top: 4px;
    }
    .ts-card-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 24px; border-top: 1px solid #ede8e0;
    }
    .ts-progress-dots { display: flex; gap: 7px; align-items: center; }
    .ts-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #d4cbbf; border: none; cursor: pointer;
        transition: all 0.3s ease; padding: 0;
    }
    .ts-dot.active { background: #f4a41c; width: 22px; border-radius: 4px; }
    .ts-navs { display: flex; gap: 10px; }
    .ts-nav-btn {
        width: 46px; height: 46px; border: 1.5px solid #d4cbbf;
        background: #fff; color: #0a1628; font-size: 20px;
        cursor: pointer; display: flex; align-items: center;
        justify-content: center; transition: all 0.25s ease;
    }
    .ts-nav-btn:hover { background: #0a1628; border-color: #0a1628; color: #f4a41c; }
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

<!-- SECTION 2: WELCOME -->
<section class="relative py-24 bg-black overflow-hidden border-b border-white/5">
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
            <img src="{{ $servUrl }}" alt="{{ $service->name }}"
                 onerror="this.onerror=null;this.src='https://placehold.co/800x600?text=Service+Image';">
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

    {{-- Artistic geometric SVG background --}}
    <svg class="ts-geo-bg" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
        {{-- Large open triangle top-right --}}
        <polygon points="1050,0 1440,0 1440,380" fill="none" stroke="#f4a41c" stroke-width="1.5" opacity="0.2"/>
        <polygon points="1140,0 1440,0 1440,280" fill="#f4a41c" opacity="0.05"/>
        {{-- Small filled triangle bottom-left --}}
        <polygon points="0,500 160,700 0,700" fill="none" stroke="#0a1628" stroke-width="1.5" opacity="0.08"/>
        <polygon points="0,580 90,700 0,700" fill="#0a1628" opacity="0.04"/>
        {{-- Gold dot grid top-left --}}
        @for($row = 0; $row < 4; $row++)
            @for($col = 0; $col < 5; $col++)
                <circle cx="{{ 48 + $col * 44 }}" cy="{{ 48 + $row * 44 }}" r="2" fill="#f4a41c" opacity="0.15"/>
            @endfor
        @endfor
        {{-- Architectural corner bracket top-left --}}
        <path d="M28,28 L28,80 M28,28 L80,28" stroke="#f4a41c" stroke-width="2.5" fill="none" opacity="0.45"/>
        {{-- Architectural corner bracket bottom-right --}}
        <path d="M1412,672 L1412,620 M1412,672 L1360,672" stroke="#0a1628" stroke-width="2" fill="none" opacity="0.12"/>
        {{-- Horizontal gold accent line bottom --}}
        <line x1="0" y1="694" x2="420" y2="694" stroke="#f4a41c" stroke-width="2.5" opacity="0.2"/>
        {{-- Concentric circles top-right --}}
        <circle cx="1380" cy="110" r="90"  fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.1"/>
        <circle cx="1380" cy="110" r="58"  fill="none" stroke="#f4a41c" stroke-width="1" opacity="0.07"/>
        <circle cx="1380" cy="110" r="26"  fill="#f4a41c" opacity="0.04"/>
        {{-- Diagonal gold lines mid-right --}}
        <line x1="1160" y1="400" x2="1440" y2="510" stroke="#f4a41c" stroke-width="1" opacity="0.09"/>
        <line x1="1160" y1="440" x2="1440" y2="550" stroke="#f4a41c" stroke-width="1" opacity="0.06"/>
        <line x1="1160" y1="480" x2="1440" y2="590" stroke="#f4a41c" stroke-width="1" opacity="0.04"/>
        {{-- Large T watermark --}}
        <text x="860" y="640" font-size="520" font-weight="900" fill="#0a1628" opacity="0.022" font-family="serif">T</text>
        {{-- Thin horizontal rule mid-section --}}
        <line x1="0" y1="350" x2="200" y2="350" stroke="#f4a41c" stroke-width="1" opacity="0.1"/>
    </svg>

    <div class="max-w-7xl mx-auto px-6" style="position:relative;z-index:2;">

        {{-- Header --}}
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

        {{-- Main testimonial card --}}
        <div class="ts-card" data-aos="fade-up" data-aos-delay="100">

            {{-- LEFT: Media --}}
            <div class="ts-media-side" id="tsMediaSide">
                <div id="tsMediaContent" style="position:absolute;inset:0;">
                    <img id="tsImg" src="" alt="Testimonial"
                         onerror="this.src='https://placehold.co/800x600/ddd4c5/999?text=Review';">
                </div>
                <div class="ts-media-overlay" id="tsMediaOverlay"></div>

                <button class="ts-play-btn" id="tsPlayBtn" onclick="tsPlayVideo()"
                        style="display:none;" aria-label="Play video">
                    <svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg>
                </button>

                <div class="ts-media-caption">
                    <div class="ts-caption-badge" id="tsCaptionBadge"></div>
                    <div class="ts-caption-text" id="tsCaptionText"></div>
                </div>
            </div>

            {{-- RIGHT: Content --}}
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
                        <button class="ts-nav-btn" onclick="tsNav(1)"  aria-label="Next">&#8594;</button>
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
        var wrap   = document.createElement('div');
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

    window.tsNav = function(dir) {
        goTo((cur + dir + data.length) % data.length);
    };

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

<!-- SECTION 6: INQUIRY FORM -->
<section class="py-32 bg-black border-t border-white/5 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-gray-500 text-xs font-bold uppercase tracking-[0.6em] mb-4">Inquiry</h2>
            <h3 class="serif text-white text-4xl md:text-5xl font-black uppercase tracking-widest">
                Write Us <span class="text-[#f4a41c]">Your Query</span>
            </h3>
            <div class="w-16 h-[2px] bg-[#f4a41c] mx-auto mt-8"></div>
        </div>
        <form action="{{ route('contact.send') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
            @csrf
            <div class="relative group">
                <input type="text" name="name" required placeholder=" "
                    class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Full Name *</label>
            </div>
            <div class="relative group">
                <input type="email" name="email" required placeholder=" "
                    class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Email Address *</label>
            </div>
            <div class="relative group md:col-span-2">
                <input type="text" name="phone" required placeholder=" "
                    class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-400 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Phone Number *</label>
            </div>
            <div class="relative group md:col-span-2">
                <textarea name="message" required placeholder=" " rows="3"
                    class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300 resize-none"></textarea>
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Your Detailed Query *</label>
            </div>
            <div class="md:col-span-2 text-center mt-12">
                <button type="submit" class="inline-block px-20 py-5 bg-[#f4a41c] text-white font-black uppercase text-[10px] tracking-[0.4em] hover:bg-white hover:text-black transition-all shadow-2xl rounded-sm">
                    Submit Inquiry
                </button>
            </div>
        </form>
    </div>
</section>

<!-- SECTION 7: GOOGLE MAP -->
<section class="w-full h-[500px] grayscale contrast-125 border-t border-white/5">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1819962222226!2d90.4222225759289!3d23.81212648640261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c705aa134d71%3A0x1c8797d1479bcdb!2sTrikon%20Holdings%20Ltd.!5e0!3m2!1sen!2sbd!4v1777450989693!5m2!1sen!2sbd"
        width="100%" height="100%"
        style="border:0;display:block;"
        allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

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