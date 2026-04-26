@extends('layouts.app')

@section('styles')
<style>
    /* Clean Hero Typography - No Overlays */
    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        text-shadow: 0px 4px 20px rgba(0,0,0,0.5);
    }

    /* Box Date Design Styling - Sizes reduced for a smaller look */
    .date-box-wrapper {
        position: relative;
        background-color: #1a1a1a; 
        padding-top: 45px; /* Reduced from 60px */
        padding-bottom: 25px; /* Reduced from 35px */
        transition: background-color 0.4s ease;
    }
    
    .card-date-outline {
        font-family: 'Cinzel', serif;
        font-size: 70px; /* Reduced from 100px */
        line-height: 1;
        font-weight: 900;
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.8);
        position: absolute;
        top: -35px; /* Adjusted position */
        left: 20px;
        z-index: 10;
        pointer-events: none;
    }
    
    .card-date-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 11px; /* Reduced from 13px */
        font-weight: 700;
        color: #fff;
        position: absolute;
        top: -8px;
        left: 100px; /* Adjusted position */
        z-index: 10;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* Interaction Styles */
    .blog-row-link {
        display: block;
        transition: all 0.5s ease;
    }
    .blog-row-link:hover .image-zoom {
        transform: scale(1.05);
    }
    .blog-row-link:hover .date-box-wrapper {
        background-color: #000;
    }
    .blog-row-link:hover .title-accent {
        color: #f4a41c;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- SECTION 1: STUNNING HERO -->
    <section class="relative h-[50vh] md:h-[60vh] w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069" 
                 class="w-full h-full object-cover" alt="Trikon Blog Heritage">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-6">
            <span class="text-[#f4a41c] text-xs font-black uppercase tracking-[0.6em] mb-4 block">Trikon Insights</span>
            <h1 class="hero-title text-white text-5xl md:text-8xl font-black uppercase tracking-tighter leading-none">
                THE <span class="text-[#f4a41c]">BLOG</span>
            </h1>
            <div class="w-24 h-[2px] bg-[#f4a41c] mx-auto mt-8 shadow-lg"></div>
        </div>
    </section>

    <!-- SECTION 2: CLICKABLE BLOG LISTING (AOS Removed, Spacing Tightened) -->
    <div class="max-w-7xl mx-auto px-6 py-20"> <!-- Reduced padding from py-40 -->
        <div class="space-y-24"> <!-- Reduced spacing from space-y-48 -->
            @foreach($blogs as $post)
            <div class="blog-entry">
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-row-link group">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        
                        <!-- LEFT SIDE: BOX DESIGN -->
                        <div class="lg:col-span-5"> <!-- Smaller col-span for more balance -->
                            <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-100">
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         class="w-full h-full object-cover image-zoom transition-transform duration-[1000ms]" 
                                         alt="{{ $post->title }}">
                                </div>
                                
                                <div class="date-box-wrapper px-8">
                                    <div class="card-date-outline">
                                        {{ $post->published_at ? $post->published_at->format('d') : '01' }}
                                    </div>
                                    <div class="card-date-text">
                                        {{ $post->published_at ? $post->published_at->format('M Y') : 'Insight' }}
                                    </div>
                                    <h3 class="text-white font-bold text-lg leading-tight uppercase tracking-tight title-accent">
                                        {{ $post->title }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: DESCRIPTION -->
                        <div class="lg:col-span-7">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-8 h-[1px] bg-[#f4a41c]"></div>
                                <span class="text-[#f4a41c] font-black text-[9px] uppercase tracking-[0.4em]">Expert Perspectives</span>
                            </div>

                            <div class="text-gray-500 leading-relaxed text-sm md:text-base mb-6 text-justify font-medium">
                                {!! Str::limit(strip_tags($post->content), 280) !!}
                            </div>

                            <div class="inline-flex items-center">
                                <span class="text-gray-900 font-black uppercase text-[10px] tracking-[0.4em] border-b border-[#f4a41c] pb-2 transition-all group-hover:text-[#f4a41c]">
                                    Read Article
                                </span>
                                <i class="fa-solid fa-arrow-right-long ml-4 text-[#f4a41c] transform group-hover:translate-x-2 transition-transform duration-300"></i>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- MODERN CONTACT FORM SECTION -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div class="pt-10">
                <h2 class="hero-title text-4xl font-black uppercase mb-16 text-gray-900 tracking-tighter">
                    <span class="text-[#f4a41c]">CONTACT</span> US
                </h2>
                <div class="space-y-12">
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-phone text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Hotline</p>
                            <p class="text-lg font-bold text-gray-800">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-location-dot text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">HQ Address</p>
                            <p class="text-gray-600 font-bold text-sm leading-relaxed max-w-sm uppercase">
                                {{ $settings->address ?? 'Bashundhara RD, Dhaka' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 md:p-16 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] rounded-[30px] border border-gray-50">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Phone Number</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="3" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-4 font-black uppercase text-[10px] tracking-[0.4em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10 rounded-full">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection