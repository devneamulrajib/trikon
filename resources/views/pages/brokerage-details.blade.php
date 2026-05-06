@extends('layouts.app')

@push('styles')
<!-- Luxury Lightbox for Image Zooming -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    /* FIX: Description Spacing & Readability */
    .listing-content-wrapper p { 
        margin-bottom: 1.2rem !important; 
        line-height: 1.7 !important; 
        font-size: 16px; 
        color: #555;
    }
    .listing-content-wrapper h1, .listing-content-wrapper h2, .listing-content-wrapper h3 { 
        font-family: 'Cinzel', serif; color: #111; margin-top: 2rem; margin-bottom: 1rem; text-transform: uppercase; font-weight: 900; 
    }
    
    /* Elegant Breadcrumb style */
    .breadcrumb-text { font-[9px] font-black uppercase tracking-[0.4em] text-gray-400 flex items-center gap-2 mb-8; }
    
    /* Map styling */
    .map-container iframe { width: 100% !important; height: 100% !important; border: 0 !important; filter: grayscale(1) contrast(1.1); transition: 0.5s; }
    .map-container:hover iframe { filter: grayscale(0); }
</style>
@endpush

@section('content')
<div class="bg-[#fafafa] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-10 pb-20">
        
        <!-- HEADER SECTION -->
        <div class="mb-12" data-aos="fade-down">
            <nav class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-400 flex items-center gap-2 mb-8">
                <a href="/" class="hover:text-[#f4a41c]">Home</a> / <a href="/brokerage" class="hover:text-[#f4a41c]">Brokerage</a>
            </nav>
            
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
                <div class="flex-1">
                    <h1 class="serif text-4xl md:text-6xl font-black text-gray-900 leading-[1.1] uppercase tracking-tighter mb-6">{{ $listing->title }}</h1>
                    <div class="flex items-center gap-4">
                        <div class="bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 flex items-center gap-2">
                            <span class="w-2 h-2 bg-[#f4a41c] rounded-full animate-pulse"></span>
                            <p class="text-gray-900 text-[10px] font-black uppercase tracking-widest">{{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}</p>
                        </div>
                        <span class="text-[10px] font-bold text-gray-400">ID: <span class="text-gray-900 font-black">{{ $listing->property_id }}</span></span>
                    </div>
                </div>
                <div class="flex gap-3">
                    <span class="bg-black text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                    <span class="bg-[#f4a41c] text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest shadow-xl">{{ $listing->category }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- LEFT SIDE -->
            <div class="w-full lg:w-2/3">
                
                <!-- GALLERY WITH LIGHTBOX CLICK -->
                <div class="bg-white p-2 mb-12 group relative overflow-hidden shadow-2xl rounded-sm" data-aos="zoom-in">
                    <div class="swiper propertySwiper h-[400px] md:h-[650px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    @php
                                        $finalUrl = Str::startsWith($img, ['http://', 'https://']) ? $img : asset(ltrim(Str::replaceFirst('storage/', '', $img), '/'));
                                    @endphp
                                    <div class="swiper-slide">
                                        <!-- Clickable anchor for Fancybox -->
                                        <a href="{{ $finalUrl }}" data-fancybox="property-gallery" data-caption="{{ $listing->title }}">
                                            <img src="{{ $finalUrl }}" class="w-full h-full object-cover transition-transform duration-[3s] group-hover:scale-105 cursor-zoom-in">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next !w-12 !h-12 !bg-white/90 !backdrop-blur-md !rounded-full !text-black after:!text-sm hover:!bg-[#f4a41c] hover:!text-white transition-all shadow-xl"></div>
                        <div class="swiper-button-prev !w-12 !h-12 !bg-white/90 !backdrop-blur-md !rounded-full !text-black after:!text-sm hover:!bg-[#f4a41c] hover:!text-white transition-all shadow-xl"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- SPECIFICATIONS GRID - RESTORED PREVIOUS VERSION -->
                <div class="mb-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                        <h3 class="serif text-lg font-black uppercase tracking-[0.3em] text-gray-900">Quick Specifications</h3>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-1 shadow-sm border border-gray-100 overflow-hidden rounded-sm">
                        @if($listing->category === 'Flat')
                            <div class="bg-gray-50/50 p-8 flex flex-col items-center text-center border-r border-b border-gray-100">
                                <i class="fa-solid fa-maximize text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Area</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->area_sqft ?? 'N/A' }} SFT</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 flex flex-col items-center text-center border-r border-b border-gray-100">
                                <i class="fa-solid fa-bed text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Bedrooms</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->bedrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 flex flex-col items-center text-center border-b border-gray-100">
                                <i class="fa-solid fa-bath text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Bathrooms</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->bathrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 flex flex-col items-center text-center border-r border-gray-100">
                                <i class="fa-solid fa-layer-group text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Floor Level</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->floor_no ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 flex flex-col items-center text-center border-r border-gray-100">
                                <i class="fa-solid fa-house-chimney text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->status ?? 'Available' }}</span>
                            </div>
                            <div class="bg-[#f4a41c]/5 p-8 flex flex-col items-center text-center">
                                <i class="fa-solid fa-barcode text-[#f4a41c] mb-3 text-lg"></i>
                                <span class="text-[9px] font-black text-[#f4a41c] uppercase tracking-widest mb-1">Property ID</span>
                                <span class="text-sm font-black text-[#f4a41c]">{{ $listing->property_id }}</span>
                            </div>
                        @else
                            <div class="bg-gray-50/50 p-8 border-r border-b border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Block Name</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->block_name ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 border-r border-b border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Plot Size</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->plot_size ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 border-b border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Plot Serial</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->plot_serial ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 border-r border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Facing</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->facing ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-8 border-r border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Negotiable</span>
                                <span class="text-sm font-black text-gray-900">Yes</span>
                            </div>
                            <div class="bg-[#f4a41c]/5 p-8">
                                <span class="text-[9px] font-black text-[#f4a41c] uppercase block mb-1">Property ID</span>
                                <span class="text-sm font-black text-[#f4a41c]">{{ $listing->property_id }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION - COMPACT & MODERN -->
                <div class="bg-white p-10 md:p-14 rounded-sm shadow-sm border border-gray-100 mb-16" data-aos="fade-up">
                    <h3 class="serif text-3xl font-black mb-10 uppercase tracking-tight text-gray-900 flex items-center gap-4">
                        Description <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                    </h3>
                    <div class="listing-content-wrapper text-gray-600 font-medium">
                        {!! $listing->content !!}
                    </div>
                </div>

                @if($listing->map_link)
                <div class="mt-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <h3 class="serif text-xl font-black uppercase tracking-[0.3em] text-gray-900">Property <span class="text-[#f4a41c]">Location</span></h3>
                    </div>
                    <div class="w-full h-[450px] rounded-sm overflow-hidden shadow-2xl border-4 border-white map-container">
                        {!! $listing->map_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE SIDEBAR -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-32 space-y-10">
                    <div class="bg-[#0a0a0a] p-12 shadow-2xl rounded-2xl border border-white/5 relative overflow-hidden" data-aos="fade-left">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#f4a41c] opacity-10 blur-[60px] rounded-full"></div>
                        <span class="text-[10px] font-black text-[#f4a41c] uppercase tracking-[0.6em] block mb-4">Investment Required</span>
                        <p class="serif text-5xl font-black text-white">৳ {{ $listing->price }}</p>
                    </div>

                    <div class="bg-white p-10 shadow-2xl border border-gray-100 rounded-2xl" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="text-gray-900 text-xs font-black uppercase tracking-[0.3em] mb-10">Request a viewing</h3>
                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="hidden" name="property" value="{{ $listing->title }}">
                            <input type="text" name="name" required placeholder="FULL NAME" class="w-full bg-transparent border-b-2 border-gray-100 py-3 text-[10px] font-black tracking-widest focus:border-[#f4a41c] outline-none">
                            <input type="email" name="email" required placeholder="EMAIL ADDRESS" class="w-full bg-transparent border-b-2 border-gray-100 py-3 text-[10px] font-black tracking-widest focus:border-[#f4a41c] outline-none">
                            <input type="text" name="phone" required placeholder="PHONE NUMBER" class="w-full bg-transparent border-b-2 border-gray-100 py-3 text-[10px] font-black tracking-widest focus:border-[#f4a41c] outline-none">
                            <textarea name="message" rows="2" placeholder="YOUR MESSAGE" class="w-full bg-transparent border-b-2 border-gray-100 py-3 text-[10px] font-black tracking-widest focus:border-[#f4a41c] outline-none resize-none"></textarea>
                            <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-[10px] tracking-[0.5em] hover:bg-black transition-all shadow-xl rounded-full">Submit Request</button>
                        </form>
                    </div>

                    <!-- SIMILAR OPTIONS -->
                    <div class="pt-4" data-aos="fade-left" data-aos-delay="200">
                        <div class="flex items-center gap-4 mb-10">
                            <h4 class="serif text-xs font-black uppercase tracking-[0.4em] text-gray-900">Similar Options</h4>
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                        </div>
                        <div class="space-y-6">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-5 group items-center bg-white p-3 rounded-xl border border-transparent hover:border-gray-100 hover:shadow-xl transition-all">
                                <div class="w-20 h-20 rounded overflow-hidden shrink-0">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        $relUrl = $relImg ? asset(ltrim(Str::replaceFirst('storage/', '', $relImg), '/')) : 'https://placehold.co/200x200';
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-[10px] font-black uppercase leading-tight text-gray-800 group-hover:text-[#f4a41c]">{{ $rel->title }}</h5>
                                    <p class="text-[#f4a41c] text-[11px] font-black mt-1">৳ {{ $rel->price }}</p>
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
@endsection

@push('scripts')
<!-- Lightbox Script -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swiper
        new Swiper(".propertySwiper", {
            speed: 1500, loop: true,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            autoplay: { delay: 6000, disableOnInteraction: false },
            effect: "fade", fadeEffect: { crossFade: true },
        });

        // Initialize Lightbox
        Fancybox.bind("[data-fancybox]", {
            // Custom options for the lightbox
            compact: false,
            idle: false,
            dragToClose: true,
        });
    });
</script>
@endpush