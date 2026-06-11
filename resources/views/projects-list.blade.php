@extends('layouts.app')

@section('styles')
<style>
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.5); 
        text-transform: uppercase;
        letter-spacing: 0.1em;
        line-height: 1;
        pointer-events: none;
    }
    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        text-shadow: 0px 4px 30px rgba(0,0,0,0.9);
    }
    .hero-text-shadow {
        text-shadow: 0px 2px 10px rgba(0,0,0,0.9);
    }

    .filter-tab {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        font-weight: 900;
        letter-spacing: 5px;
        color: #999;
        padding: 15px 40px;
        transition: all 0.4s ease;
        position: relative;
        text-transform: uppercase;
    }
    .filter-tab:hover { color: #000; }
    
    .filter-tab.active-tab { color: #f4a41c; }
    .filter-tab.active-tab::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #f4a41c;
    }

    .project-aspect { aspect-ratio: 3 / 4.2; }

    /* ── Hover overlay fix ── */
    .project-card-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;   /* pin content to bottom */
        padding: 2rem;
        opacity: 0;
        transition: opacity 0.5s ease;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.25) 60%, transparent 100%);
        backdrop-filter: blur(1px);
        -webkit-backdrop-filter: blur(1px);
        text-align: center;
    }
    .group:hover .project-card-overlay {
        opacity: 1;
    }

    .project-card-title {
        color: #fff;
        font-weight: 900;
        font-size: 1.25rem;          /* 20px */
        text-transform: uppercase;
        letter-spacing: -0.02em;
        line-height: 1.2;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.6);
    }

    .project-card-divider {
        width: 2.5rem;               /* 40px */
        height: 1px;
        background: #f4a41c;
        margin: 0 auto 0.75rem;
    }

    .project-card-location {
        color: rgba(255,255,255,0.85);
        font-size: 0.625rem;         /* 10px */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        line-height: 1.4;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- HERO VIDEO SECTION -->
    <section class="relative h-[65vh] md:h-[80vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ asset('project.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <div class="relative">
                <h1 class="hero-title text-white text-5xl md:text-8xl font-black uppercase relative z-10">
                    OUR <span class="text-[#f4a41c]">PROJECTS</span>
                </h1>
            </div>
            <div class="mt-12 flex flex-col items-center">
                <div class="w-24 h-[2px] bg-[#f4a41c] shadow-2xl"></div>
            </div>
        </div>
    </section>

    <!-- NAVIGATION TABS -->
    <div class="bg-white border-b border-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-6 md:gap-12">
                <a href="/projects/residential/all"       class="filter-tab {{ $currentStatus == 'all'       ? 'active-tab' : '' }}">All</a>
                <a href="/projects/residential/ongoing"   class="filter-tab {{ $currentStatus == 'ongoing'   ? 'active-tab' : '' }}">Ongoing</a>
                <a href="/projects/residential/upcoming"  class="filter-tab {{ $currentStatus == 'upcoming'  ? 'active-tab' : '' }}">Upcoming</a>
                <a href="/projects/residential/completed" class="filter-tab {{ $currentStatus == 'completed' ? 'active-tab' : '' }}">Completed</a>
            </div>
        </div>
    </div>

    <!-- PROJECT GRID -->
    <div class="max-w-[1600px] mx-auto px-6 md:px-12 py-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($projects as $project)
                @php
                    $gridImg = $project->featured_image;
                    $gridUrl = asset(ltrim(Str::replaceFirst('storage/', '', $gridImg), '/'));
                    $location = $project->location ?? 'Bashundhara R/A';
                @endphp

                <a href="/project/{{ $project->slug }}"
                   class="group relative block overflow-hidden bg-gray-100 project-aspect shadow-2xl"
                   data-aos="fade-up">

                    {{-- Project image --}}
                    <img src="{{ $gridUrl }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                         onerror="this.onerror=null;this.src='https://placehold.co/600x800?text=Project+Image';">

                    {{-- Hover overlay — always shows BOTH title AND location --}}
                    <div class="project-card-overlay">
                        <h3 class="project-card-title">{{ $project->title }}</h3>
                        <div class="project-card-divider"></div>
                        <p class="project-card-location">{{ $location }}</p>
                    </div>

                </a>
            @empty
                <div class="col-span-full py-40 text-center border-2 border-dashed border-gray-100 rounded-[50px]">
                    <p class="text-gray-400 font-black uppercase tracking-widest text-xs">No projects listed yet.</p>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-32 text-center">
            @if($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}"
                   class="inline-block px-12 py-5 bg-gray-900 text-white hover:bg-[#f4a41c] transition-all text-[11px] font-black uppercase tracking-[0.5em] rounded-sm shadow-xl">
                    Next Projects
                </a>
            @endif
        </div>
    </div>

</div>
@endsection