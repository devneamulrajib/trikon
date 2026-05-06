@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-10 pb-20">
        
        <!-- BREADCRUMBS & TITLE SECTION -->
        <div class="mb-12" data-aos="fade-down">
            <nav class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-400 flex items-center gap-2 mb-8">
                <a href="/" class="hover:text-[#f4a41c] transition-colors">Home</a> 
                <span class="opacity-30">/</span>
                <a href="/brokerage" class="hover:text-[#f4a41c] transition-colors">Brokerage</a>
            </nav>
            
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
                <div class="flex-1">
                    <h1 class="serif text-4xl md:text-6xl font-black text-gray-900 leading-[1.1] uppercase tracking-tighter mb-6">
                        {{ $listing->title }}
                    </h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                            <span class="w-2 h-2 bg-[#f4a41c] rounded-full animate-pulse"></span>
                            <p class="text-gray-900 text-[10px] font-black uppercase tracking-widest">
                                {{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID: <span class="text-gray-900 font-black">{{ $listing->property_id }}</span></span>
                    </div>
                </div>
                <div class="flex gap-3">
                    <span class="bg-black text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                    <span class="bg-[#f4a41c] text-white text-[9px] px-6 py-3 font-black uppercase tracking-widest shadow-xl shadow-orange-500/20">{{ $listing->category }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- LEFT SIDE: Gallery, Specs, Description & Map -->
            <div class="w-full lg:w-2/3">
                
                <!-- PREMIUM GALLERY -->
                <div class="bg-white p-2 mb-16 group relative overflow-hidden shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] rounded-sm" data-aos="zoom-in">
                    <div class="swiper propertySwiper h-[400px] md:h-[650px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    <div class="swiper-slide overflow-hidden">
                                        @php
                                            if (Str::startsWith($img, ['http://', 'https://'])) {
                                                $finalUrl = $img;
                                            } else {
                                                $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                                $finalUrl = asset($cleanPath);
                                            }
                                        @endphp
                                        <img src="{{ $finalUrl }}" class="w-full h-full object-cover transition-transform duration-[3s] group-hover:scale-110" alt="Property Image" onerror="this.src='https://placehold.co/1200x800?text=Image+Not+Found'">
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide flex items-center justify-center text-gray-300 serif italic bg-gray-50">No Images Available</div>
                            @endif
                        </div>
                        <!-- Modernized Navigation -->
                        <div class="swiper-button-next !w-12 !h-12 !bg-white/90 !backdrop-blur-md !rounded-full !text-black after:!text-sm hover:!bg-[#f4a41c] hover:!text-white transition-all shadow-xl"></div>
                        <div class="swiper-button-prev !w-12 !h-12 !bg-white/90 !backdrop-blur-md !rounded-full !text-black after:!text-sm hover:!bg-[#f4a41c] hover:!text-white transition-all shadow-xl"></div>
                        <div class="swiper-pagination !bottom-8"></div>
                    </div>
                </div>

                <!-- QUICK SPECIFICATIONS GRID - Modernized -->
                <div class="mb-20" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-10">
                        <h3 class="serif text-xl font-black uppercase tracking-[0.2em] text-gray-900">Key Specifications</h3>
                        <div class="h-[1px] flex-1 bg-gray-200"></div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        @if($listing->category === 'Flat')
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:border-[#f4a41c] transition-all">
                                <i class="fa-solid fa-maximize text-[#f4a41c] mb-4 text-xl opacity-50 group-hover:opacity-100"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Area</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->area_sqft ?? 'N/A' }} SFT</span>
                            </div>
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:border-[#f4a41c] transition-all">
                                <i class="fa-solid fa-bed text-[#f4a41c] mb-4 text-xl opacity-50 group-hover:opacity-100"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Bedrooms</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->bedrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:border-[#f4a41c] transition-all">
                                <i class="fa-solid fa-bath text-[#f4a41c] mb-4 text-xl opacity-50 group-hover:opacity-100"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Baths</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->bathrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:border-[#f4a41c] transition-all">
                                <i class="fa-solid fa-layer-group text-[#f4a41c] mb-4 text-xl opacity-50 group-hover:opacity-100"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Floor</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->floor_no ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:border-[#f4a41c] transition-all">
                                <i class="fa-solid fa-house-chimney text-[#f4a41c] mb-4 text-xl opacity-50 group-hover:opacity-100"></i>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</span>
                                <span class="text-sm font-black text-gray-900">{{ $listing->status ?? 'Available' }}</span>
                            </div>
                            <div class="bg-black p-8 rounded-xl shadow-2xl flex flex-col items-center text-center border border-[#f4a41c]/30">
                                <i class="fa-solid fa-fingerprint text-[#f4a41c] mb-4 text-xl"></i>
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-1">Property ID</span>
                                <span class="text-sm font-black text-white uppercase">{{ $listing->property_id }}</span>
                            </div>
                        @else
                            <!-- Plot Specific Layout -->
                            <div class="bg-white p-6 rounded-lg border border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Block</span>
                                <span class="text-base font-black text-gray-900 uppercase">{{ $listing->block_name ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-white p-6 rounded-lg border border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Size</span>
                                <span class="text-base font-black text-gray-900 uppercase">{{ $listing->plot_size ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-white p-6 rounded-lg border border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Facing</span>
                                <span class="text-base font-black text-gray-900 uppercase">{{ $listing->facing ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </div>

                    @if($listing->category === 'Flat' && $listing->amenities)
                    <div class="flex flex-wrap gap-2 mt-8">
                        @foreach($listing->amenities as $amenity)
                        <div class="bg-white px-5 py-2.5 rounded-full border border-gray-100 text-[10px] font-black uppercase tracking-widest text-gray-600 flex items-center gap-3 shadow-sm hover:border-[#f4a41c] hover:text-black transition-all cursor-default">
                            <span class="w-1 h-1 bg-[#f4a41c] rounded-full"></span> {{ $amenity }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- DESCRIPTION - FIXED SPACING -->
                <div class="bg-white p-10 md:p-14 rounded-sm shadow-sm border border-gray-100 mb-16" data-aos="fade-up">
                    <h3 class="serif text-3xl font-black mb-10 uppercase tracking-tight text-gray-900 flex items-center gap-4">
                        Description <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                    </h3>
                    <!-- Optimized content wrapper for spacing -->
                    <div class="listing-content-wrapper text-gray-600 leading-relaxed font-medium">
                        {!! $listing->content !!}
                    </div>
                </div>

                <!-- PROPERTY MAP -->
                @if($listing->map_link)
                <div class="mt-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <h3 class="serif text-xl font-black uppercase tracking-[0.2em] text-gray-900">Neighborhood <span class="text-[#f4a41c]">Context</span></h3>
                    </div>
                    <div class="w-full h-[450px] rounded-2xl overflow-hidden shadow-2xl border-8 border-white map-container grayscale hover:grayscale-0 transition-all duration-700">
                        {!! $listing->map_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE: Sidebar (Price + Form + Related) -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-32 space-y-10">
                    
                    <!-- MODERN PRICE CARD -->
                    <div class="bg-[#0a0a0a] p-12 shadow-2xl rounded-2xl border border-white/5 relative overflow-hidden" data-aos="fade-left">
                        <!-- Abstract glow -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#f4a41c] opacity-10 blur-[60px] rounded-full"></div>
                        
                        <span class="text-[10px] font-black text-[#f4a41c] uppercase tracking-[0.6em] block mb-4">Investment Required</span>
                        <div class="flex items-baseline gap-3">
                            <span class="serif text-5xl font-black text-white">৳ {{ $listing->price }}</span>
                        </div>
                        <div class="h-[1px] w-full bg-white/10 my-10"></div>
                        <div class="flex justify-between items-center">
                             <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Uploaded: {{ $listing->updated_at->format('d M, Y') }}</p>
                             <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- INQUIRY FORM - High End UI -->
                    <div class="bg-white p-10 shadow-2xl border border-gray-100 rounded-2xl" data-aos="fade-left" data-aos-delay="100">
                        <div class="mb-10">
                            <h3 class="text-gray-900 text-xs font-black uppercase tracking-[0.3em] mb-2">Inquiry Form</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Connect with our property experts</p>
                        </div>
                        
                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="hidden" name="property" value="{{ $listing->title }}">
                            
                            <div class="relative group">
                                <input type="text" name="name" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-gray-100 py-3 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                <label class="absolute left-0 top-3 text-[10px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-6 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-6">Legal Name</label>
                            </div>
                            <div class="relative group">
                                <input type="email" name="email" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-gray-100 py-3 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                <label class="absolute left-0 top-3 text-[10px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-6 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-6">Email Address</label>
                            </div>
                            <div class="relative group">
                                <input type="text" name="phone" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-gray-100 py-3 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                <label class="absolute left-0 top-3 text-[10px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-6 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-6">Direct Phone</label>
                            </div>
                            <div class="relative group">
                                <textarea name="message" rows="2" placeholder=" " class="peer w-full bg-transparent border-b-2 border-gray-100 py-3 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] resize-none transition-all"></textarea>
                                <label class="absolute left-0 top-3 text-[10px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Message</label>
                            </div>
                            
                            <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-[10px] tracking-[0.5em] hover:bg-black transition-all shadow-xl shadow-orange-500/10 rounded-full">
                                Request Details
                            </button>
                        </form>
                    </div>

                    <!-- SIMILAR OPTIONS - Modern Layout -->
                    <div class="pt-4" data-aos="fade-left" data-aos-delay="200">
                        <div class="flex items-center gap-4 mb-10">
                            <h4 class="serif text-xs font-black uppercase tracking-[0.4em] text-gray-900">Similar Options</h4>
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                        </div>
                        <div class="space-y-6">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-5 group items-center bg-white p-3 rounded-xl border border-transparent hover:border-gray-100 hover:shadow-xl transition-all">
                                <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0 shadow-sm">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        if($relImg) {
                                            $cleanRel = ltrim(Str::replaceFirst('storage/', '', $relImg), '/');
                                            $relUrl = asset($cleanRel);
                                        } else {
                                            $relUrl = 'https://placehold.co/200x200?text=Listing';
                                        }
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-[10px] font-black uppercase leading-tight text-gray-800 group-hover:text-[#f4a41c] transition-colors line-clamp-2 tracking-tight">{{ $rel->title }}</h5>
                                    <p class="text-[#f4a41c] text-[12px] font-black mt-2">৳ {{ $rel->price }}</p>
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

<style>
    /* FIX: Description Spacing & Readability */
    .listing-content-wrapper p { 
        margin-bottom: 1.5rem !important; /* Reduced from 2rem */
        line-height: 1.8 !important;   /* Reduced from 2.2 for tighter look */
        font-size: 16px; 
        color: #555;
    }
    .listing-content-wrapper h1, 
    .listing-content-wrapper h2, 
    .listing-content-wrapper h3 { 
        font-family: 'Cinzel', serif; 
        color: #111; 
        margin-top: 2rem;
        margin-bottom: 1rem; 
        text-transform: uppercase; 
        font-weight: 900; 
        letter-spacing: 1px;
    }
    .listing-content-wrapper ul { list-style: none; padding-left: 0; margin-bottom: 2rem; }
    .listing-content-wrapper li { margin-bottom: 0.75rem; position: relative; padding-left: 1.5rem; }
    .listing-content-wrapper li::before { content: "•"; position: absolute; left: 0; color: #f4a41c; font-weight: bold; }
    
    /* Map styling */
    .map-container iframe { width: 100% !important; height: 100% !important; border: 0 !important; }
    
    /* Swiper custom */
    .swiper-pagination-bullet-active { background: #f4a41c !important; transform: scale(1.4); }
    .propertySwiper { border-radius: 4px; }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".propertySwiper", {
            speed: 1500,
            loop: true,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            autoplay: { delay: 6000, disableOnInteraction: false },
            effect: "fade",
            fadeEffect: { crossFade: true },
        });
    });
</script>
@endpush