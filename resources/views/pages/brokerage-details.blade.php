@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-28 pb-20">
        
        <!-- SINGLE LINE TITLE HEADER -->
        <div class="mb-10 border-b border-gray-100 pb-8">
            <nav class="text-[9px] font-bold uppercase tracking-[0.3em] text-gray-400 flex items-center gap-2 mb-4">
                <a href="/" class="hover:text-[#f4a41c] transition-colors">Home</a> 
                <i class="fa-solid fa-chevron-right text-[6px]"></i>
                <a href="/brokerage" class="hover:text-[#f4a41c] transition-colors">Brokerage</a>
            </nav>
            
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h1 class="serif text-2xl md:text-3xl font-black text-gray-900 leading-tight uppercase truncate flex-1 w-full" title="{{ $listing->title }}">
                    {{ $listing->title }}
                </h1>
                <div class="flex items-center gap-3 shrink-0 self-start md:self-center">
                    <span class="bg-black text-white text-[9px] px-4 py-1.5 font-bold uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                    <span class="bg-gray-100 text-gray-500 text-[9px] px-4 py-1.5 font-bold uppercase tracking-widest border border-gray-200">{{ $listing->category }}</span>
                </div>
            </div>
            
            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-2 mt-4">
                <i class="fa-solid fa-location-dot text-[#f4a41c]"></i> {{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- LEFT SIDE: Gallery & Info -->
            <div class="w-full lg:w-2/3">
                
                <!-- MOBILE PRICE DISPLAY (Visible only on mobile) -->
                <div class="lg:hidden mb-8 bg-gray-900 p-6 rounded-sm border-l-4 border-[#f4a41c] shadow-lg">
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Asking Price</span>
                    <p class="serif text-3xl font-black text-white">৳ {{ $listing->price }}</p>
                </div>

                <!-- GALLERY -->
                <div class="bg-gray-50 shadow-sm mb-10 group relative overflow-hidden rounded-sm border border-gray-100">
                    <div class="swiper propertySwiper h-[300px] md:h-[550px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    <div class="swiper-slide">
                                        @php
                                            // FIX: Bulletproof path logic for live server
                                            $cleanPath = ltrim($img, '/');
                                            $finalUrl = str_starts_with($cleanPath, 'storage/') 
                                                ? asset($cleanPath) 
                                                : asset('storage/' . $cleanPath);
                                        @endphp
                                        <img src="{{ $finalUrl }}" class="w-full h-full object-cover" alt="Property Image" onerror="this.src='https://placehold.co/800x600?text=Image+Not+Found'">
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide flex items-center justify-center text-gray-400 serif italic">No Images Uploaded</div>
                            @endif
                        </div>
                        <div class="swiper-button-next !text-white after:!text-xl"></div>
                        <div class="swiper-button-prev !text-white after:!text-xl"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- DYNAMIC PROPERTY SPECS -->
                <div class="mb-10">
                    <h3 class="serif text-sm font-black uppercase tracking-[0.3em] mb-6 border-l-4 border-[#f4a41c] pl-4">Property Specifications</h3>
                    
                    @if($listing->category === 'Flat')
                        <!-- FLAT SPECIFICATIONS -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Area</span><span class="text-sm font-black text-gray-900">{{ $listing->area_sqft ?? 'N/A' }} SFT</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Bedrooms</span><span class="text-sm font-black text-gray-900">{{ $listing->bedrooms ?? '0' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Bathrooms</span><span class="text-sm font-black text-gray-900">{{ $listing->bathrooms ?? '0' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Balcony</span><span class="text-sm font-black text-gray-900">{{ $listing->balcony ?? '0' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Floor</span><span class="text-sm font-black text-gray-900">{{ $listing->floor_no ?? 'N/A' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Property ID</span><span class="text-sm font-black text-gray-900">{{ $listing->property_id ?? 'N/A' }}</span></div>
                        </div>
                        <div class="flex flex-wrap gap-3 mt-6">
                            @foreach($listing->amenities ?? [] as $amenity)
                            <div class="bg-white px-6 py-2 border-2 border-gray-100 text-[10px] font-black uppercase tracking-widest text-gray-600 flex items-center gap-2"><i class="fa-solid fa-check text-[#f4a41c]"></i> {{ $amenity }}</div>
                            @endforeach
                        </div>
                    @else
                        <!-- LAND SPECIFICATIONS -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Block</span><span class="text-sm font-black text-gray-900">{{ $listing->block_name ?? 'N/A' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Plot Size</span><span class="text-sm font-black text-gray-900">{{ $listing->plot_size ?? 'N/A' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Serial</span><span class="text-sm font-black text-gray-900">{{ $listing->plot_serial ?? 'N/A' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Facing</span><span class="text-sm font-black text-gray-900">{{ $listing->facing ?? 'N/A' }}</span></div>
                            <div class="bg-gray-50 p-6 rounded-sm border border-gray-100"><span class="text-[9px] font-bold text-gray-400 uppercase block mb-1">Property ID</span><span class="text-sm font-black text-gray-900">{{ $listing->property_id ?? 'N/A' }}</span></div>
                            <div class="bg-[#f4a41c]/5 p-6 rounded-sm border border-[#f4a41c]/20"><span class="text-[9px] font-bold text-[#f4a41c] uppercase block mb-1">Price Status</span><span class="text-sm font-black text-[#f4a41c]">Negotiable</span></div>
                        </div>
                    @endif
                </div>

                <!-- DESCRIPTION -->
                <div class="border-t border-gray-100 pt-10">
                    <h3 class="serif text-xl font-bold mb-6 uppercase tracking-widest">Description</h3>
                    <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed listing-body">
                        {!! $listing->content !!}
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Sidebar (Price + Form) -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-28 space-y-6">
                    
                    <!-- PRICE SEGMENT (Desktop) -->
                    <div class="hidden lg:block bg-gray-900 p-10 shadow-2xl rounded-sm border-b-8 border-[#f4a41c]">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] block mb-3">Asking Price</span>
                        <div class="flex items-baseline gap-2">
                            <span class="serif text-4xl font-black text-[#f4a41c]">৳</span>
                            <span class="serif text-4xl font-black text-white">{{ $listing->price }}</span>
                        </div>
                        <div class="w-10 h-[1px] bg-gray-700 my-5"></div>
                        <p class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] italic">Last Updated: {{ $listing->updated_at->format('F d, Y') }}</p>
                    </div>

                    <!-- SCHEDULE TOUR / INQUIRY FORM -->
                    <div class="bg-white shadow-2xl border border-gray-100 rounded-sm overflow-hidden">
                        <div class="bg-[#f4a41c] px-10 py-6">
                            <h3 class="text-white text-[11px] font-black uppercase tracking-[0.4em]">Schedule a tour</h3>
                        </div>
                        <div class="p-10">
                            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="property" value="{{ $listing->title }}">
                                
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Your Full Name</label>
                                    <input type="text" name="name" required class="w-full bg-gray-50 border-b-2 border-gray-100 p-3 text-xs font-bold focus:outline-none focus:border-[#f4a41c] transition-all">
                                </div>
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Email Address</label>
                                    <input type="email" name="email" required class="w-full bg-gray-50 border-b-2 border-gray-100 p-3 text-xs font-bold focus:outline-none focus:border-[#f4a41c] transition-all">
                                </div>
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Phone Number</label>
                                    <input type="text" name="phone" required class="w-full bg-gray-50 border-b-2 border-gray-100 p-3 text-xs font-bold focus:outline-none focus:border-[#f4a41c] transition-all">
                                </div>
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Detailed Message</label>
                                    <textarea name="message" rows="3" class="w-full bg-gray-50 border-b-2 border-gray-100 p-3 text-xs font-bold focus:outline-none focus:border-[#f4a41c] resize-none"></textarea>
                                </div>
                                
                                <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-[10px] tracking-[0.4em] hover:bg-black transition-all shadow-xl rounded-sm">
                                    Submit Request
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- RELATED LISTINGS -->
                    <div class="bg-gray-50 p-10 border border-gray-100 rounded-sm">
                        <h4 class="serif text-[11px] font-black uppercase mb-10 border-b border-gray-200 pb-5 flex justify-between items-center">Similar Listings <span class="w-8 h-[2px] bg-[#f4a41c]"></span></h4>
                        <div class="space-y-8">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-5 group items-center">
                                <div class="w-20 h-16 bg-white overflow-hidden shrink-0 border border-gray-100 rounded-sm">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        $relUrl = $relImg ? (str_starts_with($relImg, 'storage/') ? asset($relImg) : asset('storage/'.$relImg)) : 'https://placehold.co/100x100';
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <div>
                                    <h5 class="text-[10px] font-black uppercase leading-tight group-hover:text-[#f4a41c] transition-colors line-clamp-2 tracking-tight">{{ $rel->title }}</h5>
                                    <p class="text-[#f4a41c] text-[12px] font-black mt-2 italic">৳ {{ $rel->price }}</p>
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
    .listing-body p { margin-bottom: 1.8rem; line-height: 2; font-size: 16px; color: #444; }
    .listing-body ul { list-style: square; margin-left: 1.5rem; margin-bottom: 1.8rem; color: #f4a41c; }
    .listing-body li { margin-bottom: 0.8rem; color: #555; }
    .swiper-pagination-bullet-active { background: #f4a41c !important; }
    .swiper-button-next:after, .swiper-button-prev:after { font-weight: 900; font-size: 24px !important; }
    @media (max-width: 768px) { .serif.truncate { white-space: normal; overflow: visible; text-overflow: clip; } }
</style>
@endsection

@push('scripts')
<script>
    new Swiper(".propertySwiper", {
        speed: 1200,
        loop: true,
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        pagination: { el: ".swiper-pagination", clickable: true },
        autoplay: { delay: 6000, disableOnInteraction: false },
        effect: "fade",
        fadeEffect: { crossFade: true }
    });
</script>
@endpush