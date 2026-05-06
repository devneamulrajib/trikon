@extends('layouts.app')

@section('content')
<!-- CSS Loaded inside content to ensure proper isolation and overrides -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    /* FIX: Tighter Description Spacing */
    .listing-content-wrapper p { 
        margin-bottom: 0.8rem !important; 
        line-height: 1.5 !important; 
        font-size: 15px; 
        color: #444;
    }
    .listing-content-wrapper h1, .listing-content-wrapper h2, .listing-content-wrapper h3 { 
        font-family: 'Cinzel', serif; color: #111; margin-top: 1.2rem; margin-bottom: 0.8rem; text-transform: uppercase; font-weight: 900; 
    }

    /* MODERN NAVIGATION ARROWS */
    .swiper-button-next, .swiper-button-prev {
        background: rgba(255, 255, 255, 0.95) !important;
        width: 45px !important; height: 45px !important;
        border-radius: 50%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 16px !important; font-weight: 900; color: #111; }
    .swiper-button-next:hover, .swiper-button-prev:hover { background: #f4a41c !important; }
    .swiper-button-next:hover:after, .swiper-button-prev:hover:after { color: #fff; }

    /* MAP FIX */
    .map-frame-container { position: relative; width: 100%; height: 450px; background: #f9f9f9; overflow: hidden; }
    .map-frame-container iframe { position: absolute; top: 0; left: 0; width: 100% !important; height: 100% !important; border: 0 !important; }

    /* SPEC GRID STYLE (Matches Screenshot) */
    .spec-grid-box { 
        background-color: #fff; 
        padding: 2.5rem 2rem; 
        display: flex; 
        flex-direction: column; 
        align-items: flex-start; 
        text-align: left; 
        border: 0.5px solid #f0f0f0;
    }
    .spec-label { font-size: 9px; font-weight: 900; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .spec-value { font-size: 16px; font-weight: 800; color: #111827; line-height: 1.3; }
</style>

<div class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-10 pb-20">
        
        <!-- HEADER SECTION -->
        <div class="mb-12" data-aos="fade-down">
            <nav class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-400 flex items-center gap-2 mb-8">
                <a href="/" class="hover:text-[#f4a41c]">Home</a> / <a href="/brokerage" class="hover:text-[#f4a41c]">Brokerage</a>
            </nav>
            
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
                <div class="flex-1">
                    <h1 class="serif text-4xl md:text-6xl font-black text-gray-900 leading-tight uppercase tracking-tighter mb-4">{{ $listing->title }}</h1>
                    <div class="flex items-center gap-4">
                        <div class="bg-gray-50 px-4 py-2 rounded-full border border-gray-100 flex items-center gap-2">
                            <span class="w-2 h-2 bg-[#f4a41c] rounded-full"></span>
                            <p class="text-gray-900 text-[10px] font-black uppercase tracking-widest">{{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="bg-black text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                    <span class="bg-[#f4a41c] text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest shadow-xl">{{ $listing->category }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- LEFT SIDE -->
            <div class="w-full lg:w-2/3">
                
                <!-- GALLERY WITH ZOOM -->
                <div class="bg-gray-50 mb-16 relative overflow-hidden rounded-sm shadow-2xl border border-gray-100" data-aos="zoom-in">
                    <div class="swiper propertySwiper h-[400px] md:h-[650px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    @php
                                        $finalUrl = Str::startsWith($img, ['http://', 'https://']) ? $img : asset(ltrim(Str::replaceFirst('storage/', '', $img), '/'));
                                    @endphp
                                    <div class="swiper-slide">
                                        <a href="{{ $finalUrl }}" data-fancybox="property-gallery" class="w-full h-full block cursor-zoom-in">
                                            <img src="{{ $finalUrl }}" class="w-full h-full object-cover transition-transform duration-[2000ms] hover:scale-105" alt="Property Image">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- QUICK SPECIFICATIONS GRID (MATCHES SCREENSHOT) -->
                <div class="mb-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                        <h3 class="serif text-lg font-black uppercase tracking-[0.3em] text-gray-900">Quick Specifications</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-gray-100 overflow-hidden rounded-sm">
                        @if($listing->category === 'Flat')
                            <!-- Apartment Layout -->
                            <div class="spec-grid-box">
                                <span class="spec-label">Total Area</span>
                                <span class="spec-value">{{ $listing->area_sqft ?? 'N/A' }} SFT</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Bedrooms</span>
                                <span class="spec-value">{{ $listing->bedrooms ?? '0' }} Units</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Bathrooms</span>
                                <span class="spec-value">{{ $listing->bathrooms ?? '0' }} Units</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Floor Level</span>
                                <span class="spec-value">{{ $listing->floor_no ?? 'N/A' }}</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Status</span>
                                <span class="spec-value">{{ $listing->status ?? 'Available' }}</span>
                            </div>
                            <div class="spec-grid-box bg-[#f4a41c]/5">
                                <span class="spec-label !text-[#f4a41c]">Property ID</span>
                                <span class="spec-value !text-[#f4a41c] uppercase">{{ $listing->property_id }}</span>
                            </div>
                        @else
                            <!-- Plot Layout (Matches Provided Screenshot Exactly) -->
                            <div class="spec-grid-box">
                                <span class="spec-label">Block Name</span>
                                <span class="spec-value">{{ $listing->block_name ?? 'N/A' }}</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Plot Size</span>
                                <span class="spec-value">{{ $listing->plot_size ?? 'N/A' }}</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Plot Serial</span>
                                <span class="spec-value">{{ $listing->plot_serial ?? 'N/A' }}</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Facing</span>
                                <span class="spec-value">{{ $listing->facing ?? 'N/A' }}</span>
                            </div>
                            <div class="spec-grid-box">
                                <span class="spec-label">Negotiable</span>
                                <span class="spec-value">Yes</span>
                            </div>
                            <div class="spec-grid-box bg-[#fffbeb]">
                                <span class="spec-label !text-[#f4a41c]">Property ID</span>
                                <span class="spec-value !text-[#f4a41c] uppercase">{{ $listing->property_id }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="border-t border-gray-100 pt-16" data-aos="fade-up">
                    <h3 class="serif text-3xl font-black mb-8 uppercase tracking-widest text-gray-900">Description</h3>
                    <div class="listing-content-wrapper">
                        {!! $listing->content !!}
                    </div>
                </div>

                <!-- MAP SECTION - FIXED -->
                @if($listing->map_link)
                <div class="mt-20 border-t border-gray-100 pt-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                        <h3 class="serif text-xl font-black uppercase tracking-[0.3em] text-gray-900">Property <span class="text-[#f4a41c]">Map</span></h3>
                    </div>
                    <div class="map-frame-container shadow-2xl rounded-sm border-4 border-white ring-1 ring-gray-100">
                        {!! $listing->map_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE SIDEBAR -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-32 space-y-10">
                    <div class="bg-black p-12 shadow-2xl rounded-sm border-b-8 border-[#f4a41c] relative overflow-hidden">
                        <span class="text-[10px] font-black text-[#f4a41c] uppercase tracking-[0.5em] block mb-4">Asking Price</span>
                        <p class="serif text-5xl font-black text-white">৳ {{ $listing->price }}</p>
                    </div>

                    <div class="bg-white p-10 shadow-2xl border border-gray-100 rounded-sm">
                        <h3 class="text-gray-900 text-[10px] font-black uppercase tracking-[0.3em] mb-10">Schedule an Appointment</h3>
                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="hidden" name="property" value="{{ $listing->title }}">
                            <input type="text" name="name" required placeholder="FULL NAME" class="w-full border-b border-gray-200 py-3 text-xs font-bold focus:border-[#f4a41c] outline-none">
                            <input type="email" name="email" required placeholder="EMAIL ADDRESS" class="w-full border-b border-gray-200 py-3 text-xs font-bold focus:border-[#f4a41c] outline-none">
                            <input type="text" name="phone" required placeholder="PHONE NUMBER" class="w-full border-b border-gray-200 py-3 text-xs font-bold focus:border-[#f4a41c] outline-none">
                            <textarea name="message" rows="2" placeholder="MESSAGE" class="w-full border-b border-gray-200 py-3 text-xs font-bold focus:border-[#f4a41c] outline-none resize-none"></textarea>
                            <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-[10px] tracking-[0.4em] hover:bg-black transition-all">Send Inquiry</button>
                        </form>
                    </div>

                    <div class="bg-gray-50 p-8 border border-gray-100 rounded-sm">
                        <h4 class="serif text-[10px] font-black uppercase mb-10 pb-5 border-b border-gray-200 text-gray-900">Similar Options</h4>
                        <div class="space-y-8">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-5 group items-center">
                                <div class="w-20 h-20 bg-white overflow-hidden shrink-0 border border-gray-100 shadow-sm transition-transform group-hover:scale-95">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        $relUrl = $relImg ? asset(ltrim(Str::replaceFirst('storage/', '', $relImg), '/')) : 'https://placehold.co/200x200';
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-[10px] font-black uppercase leading-tight text-gray-900 group-hover:text-[#f4a41c] line-clamp-2">{{ $rel->title }}</h5>
                                    <p class="text-gray-400 text-[11px] font-bold mt-2 italic">৳ {{ $rel->price }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Slider Logic
        new Swiper(".propertySwiper", {
            speed: 1000, loop: true,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            autoplay: { delay: 6000, disableOnInteraction: false },
        });

        // Zoom Logic
        Fancybox.bind("[data-fancybox]", {
            infinite: true,
            dragToClose: true,
            Toolbar: { display: { left: ["infobar"], middle: [], right: ["close"] } }
        });
    });
</script>
@endsection