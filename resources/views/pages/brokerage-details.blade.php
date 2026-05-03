@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Main Container - REDUCED TOP PADDING FOR SLEEKER LANDING -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-14 pb-20">
        
        <!-- BREADCRUMBS & TITLE -->
        <div class="mb-8 border-b border-gray-100 pb-6" data-aos="fade-down">
            <nav class="text-[9px] font-bold uppercase tracking-[0.3em] text-gray-400 flex items-center gap-2 mb-4">
                <a href="/" class="hover:text-[#f4a41c] transition-colors">Home</a> 
                <i class="fa-solid fa-chevron-right text-[6px]"></i>
                <a href="/brokerage" class="hover:text-[#f4a41c] transition-colors">Brokerage</a>
            </nav>
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex-1">
                    <h1 class="serif text-2xl md:text-4xl font-black text-gray-900 leading-tight uppercase mb-2">
                        {{ $listing->title }}
                    </h1>
                    <p class="text-[#f4a41c] text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i> {{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}
                    </p>
                </div>
                <div class="flex flex-col items-end gap-2 shrink-0">
                    <div class="flex gap-2">
                        <span class="bg-black text-white text-[8px] px-4 py-1.5 font-black uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                        <span class="bg-[#f4a41c] text-white text-[8px] px-4 py-1.5 font-black uppercase tracking-widest shadow-lg">{{ $listing->category }}</span>
                    </div>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Property ID: <span class="text-gray-900">{{ $listing->property_id }}</span></span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- LEFT SIDE: Gallery, Specs, Description & Map -->
            <div class="w-full lg:w-2/3">
                
                <!-- MOBILE PRICE DISPLAY -->
                <div class="lg:hidden mb-8 bg-gray-900 p-8 rounded-sm border-l-4 border-[#f4a41c] shadow-2xl">
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] block mb-2">Asking Price</span>
                    <p class="serif text-4xl font-black text-white">৳ {{ $listing->price }}</p>
                </div>

                <!-- SLIDISH GALLERY -->
                <div class="bg-gray-100 mb-10 group relative overflow-hidden rounded-sm shadow-xl border border-gray-100" data-aos="zoom-in">
                    <div class="swiper propertySwiper h-[350px] md:h-[550px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    <div class="swiper-slide">
                                        @php
                                            $cleanPath = ltrim($img, '/');
                                            $finalUrl = str_starts_with($cleanPath, 'storage/') 
                                                ? asset($cleanPath) 
                                                : asset('storage/' . $cleanPath);
                                        @endphp
                                        <img src="{{ $finalUrl }}" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105" alt="Property Image" onerror="this.src='https://placehold.co/1200x800?text=Image+Not+Found'">
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide flex items-center justify-center text-gray-400 serif italic bg-white">No Images Uploaded</div>
                            @endif
                        </div>
                        <div class="swiper-button-next !w-12 !h-12 !bg-black/50 !backdrop-blur-md !rounded-full !text-white after:!text-sm hover:!bg-[#f4a41c] transition-all"></div>
                        <div class="swiper-button-prev !w-12 !h-12 !bg-black/50 !backdrop-blur-md !rounded-full !text-white after:!text-sm hover:!bg-[#f4a41c] transition-all"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- SPECIFICATIONS GRID -->
                <div class="mb-12">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-1 shadow-sm border border-gray-100 overflow-hidden rounded-sm">
                        @if($listing->category === 'Flat')
                            <div class="bg-gray-50/50 p-6 flex flex-col items-center text-center border-r border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Area</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->area_sqft ?? 'N/A' }} SFT</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 flex flex-col items-center text-center border-r border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Bedrooms</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->bedrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 flex flex-col items-center text-center border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Bathrooms</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->bathrooms ?? '0' }} Units</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 flex flex-col items-center text-center border-r border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Floor</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->floor_no ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 flex flex-col items-center text-center border-r border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Facing</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->facing ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-[#f4a41c]/5 p-6 flex flex-col items-center text-center">
                                <span class="text-[8px] font-black text-[#f4a41c] uppercase tracking-widest mb-1">Negotiable</span>
                                <span class="text-xs font-black text-[#f4a41c]">YES</span>
                            </div>
                        @else
                            <div class="bg-gray-50/50 p-6 border-r border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase block mb-1">Block</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->block_name ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 border-r border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase block mb-1">Size</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->plot_size ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50/50 p-6 border-b border-gray-100">
                                <span class="text-[8px] font-black text-gray-400 uppercase block mb-1">Facing</span>
                                <span class="text-xs font-black text-gray-900">{{ $listing->facing ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </div>

                    @if($listing->category === 'Flat' && $listing->amenities)
                    <div class="flex flex-wrap gap-2 mt-6">
                        @foreach($listing->amenities as $amenity)
                        <div class="bg-white px-5 py-2 border border-gray-100 text-[9px] font-black uppercase tracking-widest text-gray-600 flex items-center gap-3 shadow-sm">
                            <div class="w-1 h-1 bg-[#f4a41c] rotate-45"></div> {{ $amenity }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-16">
                    <h3 class="serif text-xl font-black mb-6 uppercase tracking-widest border-l-4 border-[#f4a41c] pl-4 text-gray-900">Description</h3>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed listing-body">
                        {!! $listing->content !!}
                    </div>
                </div>

                <!-- GOOGLE MAP SECTION - MOVED TO VERY BOTTOM -->
                @if($listing->map_link)
                <div class="mt-16" data-aos="fade-up">
                    <h3 class="serif text-xl font-black mb-6 uppercase tracking-widest border-l-4 border-[#f4a41c] pl-4 text-gray-900">Location <span class="text-[#f4a41c]">Map</span></h3>
                    <div class="w-full h-[400px] rounded-sm overflow-hidden shadow-2xl border-4 border-white ring-1 ring-gray-100 map-container">
                        {!! $listing->map_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE: Sidebar (Price + Form + Related) -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-28 space-y-6">
                    
                    <!-- PRICE CARD -->
                    <div class="bg-black p-8 shadow-2xl rounded-sm border-b-8 border-[#f4a41c] relative overflow-hidden" data-aos="fade-left">
                        <span class="text-[9px] font-black text-[#f4a41c] uppercase tracking-[0.5em] block mb-3">Asking Price</span>
                        <h2 class="serif text-4xl font-black text-white">৳ {{ $listing->price }}</h2>
                        <div class="w-10 h-[1px] bg-gray-700 my-6"></div>
                        <p class="text-[8px] font-bold text-gray-500 uppercase tracking-[0.2em]">Listing ID: {{ $listing->property_id }}</p>
                    </div>

                    <!-- INQUIRY FORM - COMPACT VERSION -->
                    <div class="bg-white shadow-2xl border border-gray-100 rounded-sm overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                        <div class="bg-gray-50 px-8 py-5 border-b border-gray-100 text-center">
                            <h3 class="text-gray-900 text-[10px] font-black uppercase tracking-[0.4em]">Schedule an Appointment</h3>
                        </div>
                        <div class="p-8">
                            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="property" value="{{ $listing->title }}">
                                
                                <div class="relative">
                                    <input type="text" name="name" required placeholder=" " class="peer w-full bg-transparent border-b border-gray-200 py-2 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                    <label class="absolute left-0 top-2 text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Full Name</label>
                                </div>
                                <div class="relative">
                                    <input type="email" name="email" required placeholder=" " class="peer w-full bg-transparent border-b border-gray-200 py-2 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                    <label class="absolute left-0 top-2 text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Email Address</label>
                                </div>
                                <div class="relative">
                                    <input type="text" name="phone" required placeholder=" " class="peer w-full bg-transparent border-b border-gray-200 py-2 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] transition-all">
                                    <label class="absolute left-0 top-2 text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Phone Number</label>
                                </div>
                                <div class="relative">
                                    <!-- FIXED TEXT COLOR IN TEXTAREA -->
                                    <textarea name="message" rows="2" placeholder=" " class="peer w-full bg-transparent border-b border-gray-200 py-2 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] resize-none transition-all"></textarea>
                                    <label class="absolute left-0 top-2 text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Message</label>
                                </div>
                                
                                <button type="submit" class="w-full bg-[#f4a41c] text-white py-4 font-black uppercase text-[10px] tracking-[0.4em] hover:bg-black transition-all shadow-lg">
                                    Send Inquiry
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- RELATED LISTINGS - FIXED TEXT COLOR -->
                    <div class="bg-gray-50 p-8 border border-gray-100 rounded-sm" data-aos="fade-left" data-aos-delay="200">
                        <h4 class="serif text-[10px] font-black uppercase mb-8 border-b border-gray-200 pb-4 flex justify-between items-center text-gray-900">Similar Options <span class="w-8 h-[2px] bg-[#f4a41c]"></span></h4>
                        <div class="space-y-6">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-4 group items-center">
                                <div class="w-20 h-16 bg-white overflow-hidden shrink-0 border border-gray-200 rounded-sm">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        $relUrl = $relImg ? (str_starts_with($relImg, 'storage/') ? asset($relImg) : asset('storage/'.$relImg)) : 'https://placehold.co/200x200';
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <!-- Forced dark color for Related Titles -->
                                    <h5 class="text-[9px] font-black uppercase leading-tight text-gray-900 group-hover:text-[#f4a41c] transition-colors line-clamp-2 tracking-tight">{{ $rel->title }}</h5>
                                    <!-- Forced visible color for Related Price -->
                                    <p class="text-gray-600 text-[10px] font-bold mt-1">৳ {{ $rel->price }}</p>
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
    /* Styling for the Map container specifically */
    .map-container iframe { width: 100% !important; height: 100% !important; border: 0 !important; filter: grayscale(1) contrast(1.2) opacity(0.8); transition: all 0.5s ease; }
    .map-container:hover iframe { filter: grayscale(0) opacity(1); }
    
    /* Elegant Content Styling */
    .listing-body p { margin-bottom: 2rem; line-height: 2; font-size: 16px; color: #333; }
    .listing-body h1, .listing-body h2, .listing-body h3 { font-family: serif; color: #111; margin-bottom: 1.5rem; text-transform: uppercase; font-weight: 900; }
    .listing-body ul { list-style: none; padding-left: 1.5rem; margin-bottom: 2rem; }
    .listing-body li { margin-bottom: 1rem; position: relative; padding-left: 1.5rem; color: #444; }
    .listing-body li::before { content: "→"; position: absolute; left: 0; color: #f4a41c; font-weight: bold; }
    
    /* Input visibility and text colors */
    input, textarea { color: #111 !important; }
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
        -webkit-text-fill-color: #111;
        transition: background-color 5000s ease-in-out 0s;
    }

    .swiper-pagination-bullet-active { background: #f4a41c !important; transform: scale(1.5); }
    .propertySwiper { border-radius: 2px; }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".propertySwiper", {
            speed: 1500,
            loop: true,
            parallax: true,
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            pagination: { el: ".swiper-pagination", clickable: true },
            autoplay: { delay: 5000, disableOnInteraction: false },
            effect: "creative",
            creativeEffect: {
                prev: { shadow: true, translate: [0, 0, -400] },
                next: { translate: ["100%", 0, 0] },
            },
        });
    });
</script>
@endpush