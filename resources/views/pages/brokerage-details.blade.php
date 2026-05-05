@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-12 pb-20">
        
        <!-- BREADCRUMBS & TITLE -->
        <div class="mb-10 border-b border-gray-100 pb-8" data-aos="fade-down">
            <nav class="text-[9px] font-bold uppercase tracking-[0.3em] text-gray-400 flex items-center gap-2 mb-6">
                <a href="/" class="hover:text-[#f4a41c] transition-colors">Home</a> 
                <i class="fa-solid fa-chevron-right text-[6px]"></i>
                <a href="/brokerage" class="hover:text-[#f4a41c] transition-colors">Brokerage</a>
            </nav>
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex-1">
                    <h1 class="serif text-3xl md:text-5xl font-black text-gray-900 leading-tight uppercase mb-4">
                        {{ $listing->title }}
                    </h1>
                    <p class="text-[#f4a41c] text-[11px] font-black uppercase tracking-[0.4em] flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i> {{ $listing->location ?? 'Bashundhara R/A, Dhaka' }}
                    </p>
                </div>
                <div class="flex flex-col items-end gap-3 shrink-0">
                    <div class="flex gap-2">
                        <span class="bg-black text-white text-[9px] px-5 py-2 font-black uppercase tracking-widest">{{ $listing->status ?? 'FOR SALE' }}</span>
                        <span class="bg-[#f4a41c] text-white text-[9px] px-5 py-2 font-black uppercase tracking-widest shadow-lg">{{ $listing->category }}</span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Property ID: <span class="text-gray-900">{{ $listing->property_id }}</span></span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- LEFT SIDE: Gallery, Specs, Description & Map -->
            <div class="w-full lg:w-2/3">
                
                <!-- MOBILE PRICE DISPLAY -->
                <div class="lg:hidden mb-8 bg-gray-900 p-8 rounded-sm border-l-4 border-[#f4a41c] shadow-2xl">
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] block mb-2">Asking Price</span>
                    <p class="serif text-4xl font-black text-white">৳ {{ $listing->price }}</p>
                </div>

                <!-- SLIDISH GALLERY -->
                <div class="bg-gray-100 mb-12 group relative overflow-hidden rounded-sm shadow-2xl border border-gray-100" data-aos="zoom-in">
                    <div class="swiper propertySwiper h-[350px] md:h-[600px]">
                        <div class="swiper-wrapper">
                            @if($listing->images && is_array($listing->images))
                                @foreach($listing->images as $img)
                                    <div class="swiper-slide">
                                        @php
                                            // Handle absolute URLs or relative paths in public_html
                                            if (Str::startsWith($img, ['http://', 'https://'])) {
                                                $finalUrl = $img;
                                            } else {
                                                // Remove 'storage/' prefix to point directly to public_html root
                                                $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                                $finalUrl = asset($cleanPath);
                                            }
                                        @endphp
                                        <img src="{{ $finalUrl }}" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105" alt="Property Image" onerror="this.onerror=null;this.src='https://placehold.co/1200x800?text=Image+Not+Found'">
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide flex items-center justify-center text-gray-400 serif italic bg-white">No Images Uploaded</div>
                            @endif
                        </div>
                        <div class="swiper-button-next !w-14 !h-14 !bg-black/50 !backdrop-blur-md !rounded-full !text-white after:!text-lg hover:!bg-[#f4a41c] transition-all"></div>
                        <div class="swiper-button-prev !w-14 !h-14 !bg-black/50 !backdrop-blur-md !rounded-full !text-white after:!text-lg hover:!bg-[#f4a41c] transition-all"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- SPECIFICATIONS GRID -->
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

                    @if($listing->category === 'Flat' && $listing->amenities)
                    <div class="flex flex-wrap gap-3 mt-8">
                        @foreach($listing->amenities as $amenity)
                        <div class="bg-white px-6 py-2.5 border border-gray-100 text-[10px] font-black uppercase tracking-widest text-gray-600 flex items-center gap-3 shadow-sm hover:border-[#f4a41c] transition-colors cursor-default">
                            <div class="w-1.5 h-1.5 bg-[#f4a41c] rotate-45"></div> {{ $amenity }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- DESCRIPTION -->
                <div class="border-t border-gray-100 pt-16" data-aos="fade-up">
                    <h3 class="serif text-2xl font-black mb-8 uppercase tracking-widest text-gray-900">Description</h3>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed listing-body">
                        {!! $listing->content !!}
                    </div>
                </div>

                <!-- GOOGLE MAP SECTION -->
                @if($listing->map_link)
                <div class="mt-16 border-t border-gray-100 pt-16" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-[2px] w-12 bg-[#f4a41c]"></div>
                        <h3 class="serif text-xl font-black uppercase tracking-[0.3em] text-gray-900">Property <span class="text-[#f4a41c]">Map</span></h3>
                    </div>
                    <div class="w-full h-[450px] rounded-sm overflow-hidden shadow-2xl border-4 border-white ring-1 ring-gray-100 map-container">
                        {!! $listing->map_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE: Sidebar (Price + Form + Related) -->
            <div class="w-full lg:w-1/3">
                <div class="lg:sticky lg:top-32 space-y-8">
                    
                    <!-- PRICE SEGMENT -->
                    <div class="hidden lg:block bg-black p-12 shadow-2xl rounded-sm border-b-8 border-[#f4a41c] relative overflow-hidden" data-aos="fade-left">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#f4a41c] opacity-5 rounded-full -mr-16 -mt-16"></div>
                        <span class="text-[10px] font-black text-[#f4a41c] uppercase tracking-[0.5em] block mb-4">Asking Price</span>
                        <div class="flex items-baseline gap-3">
                            <span class="serif text-5xl font-black text-white">৳ {{ $listing->price }}</span>
                        </div>
                        <div class="w-12 h-1 bg-[#f4a41c] my-8"></div>
                        <p class="text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em]">Latest Listing • {{ $listing->updated_at->format('M d, Y') }}</p>
                    </div>

                    <!-- INQUIRY FORM -->
                    <div class="bg-white shadow-2xl border border-gray-100 rounded-sm overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                        <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                            <h3 class="text-gray-900 text-[10px] font-black uppercase tracking-[0.3em]">Schedule an Appointment</h3>
                        </div>
                        <div class="p-6">
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
                                    <textarea name="message" rows="2" placeholder=" " class="peer w-full bg-transparent border-b border-gray-200 py-2 text-sm font-bold text-gray-900 focus:outline-none focus:border-[#f4a41c] resize-none transition-all"></textarea>
                                    <label class="absolute left-0 top-2 text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all peer-focus:-top-4 peer-focus:text-[#f4a41c] peer-[:not(:placeholder-shown)]:-top-4">Message</label>
                                </div>
                                
                                <button type="submit" class="w-full bg-[#f4a41c] text-white py-4 font-black uppercase text-[10px] tracking-[0.4em] hover:bg-black transition-all shadow-xl hover:-translate-y-1 active:translate-y-0">
                                    Send Inquiry
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- RELATED OPTIONS -->
                    <div class="bg-gray-50 p-8 border border-gray-100 rounded-sm" data-aos="fade-left" data-aos-delay="200">
                        <h4 class="serif text-[10px] font-black uppercase mb-10 border-b border-gray-200 pb-5 flex justify-between items-center text-gray-900">Similar Options <span class="w-10 h-[2px] bg-[#f4a41c]"></span></h4>
                        <div class="space-y-8">
                            @foreach($related as $rel)
                            <a href="{{ route('brokerage.show', $rel->slug) }}" class="flex gap-5 group items-center">
                                <div class="w-24 h-20 bg-white overflow-hidden shrink-0 border border-gray-100 shadow-sm transition-transform group-hover:scale-95">
                                    @php
                                        $relImg = $rel->images[0] ?? null;
                                        if($relImg) {
                                            $cleanRel = ltrim(Str::replaceFirst('storage/', '', $relImg), '/');
                                            $relUrl = asset($cleanRel);
                                        } else {
                                            $relUrl = 'https://placehold.co/200x200';
                                        }
                                    @endphp
                                    <img src="{{ $relUrl }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/200x200?text=No+Img'">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-[10px] font-black uppercase leading-tight text-gray-900 group-hover:text-[#f4a41c] transition-colors line-clamp-2 tracking-tight">{{ $rel->title }}</h5>
                                    <p class="text-gray-500 text-[11px] font-bold mt-2 italic">৳ {{ $rel->price }}</p>
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
    .map-container iframe { width: 100% !important; height: 100% !important; border: 0 !important; filter: grayscale(1) contrast(1.2) opacity(0.8); transition: all 0.5s ease; }
    .map-container:hover iframe { filter: grayscale(0) opacity(1); }
    .listing-body p { margin-bottom: 2rem; line-height: 2.2; font-size: 17px; color: #4a4a4a; font-family: inherit; }
    .listing-body h1, .listing-body h2, .listing-body h3 { font-family: serif; color: #111; margin-bottom: 1.5rem; text-transform: uppercase; font-weight: 900; }
    .listing-body ul { list-style: none; padding-left: 1.5rem; margin-bottom: 2rem; }
    .listing-body li { margin-bottom: 1rem; position: relative; padding-left: 1.5rem; color: #555; }
    .listing-body li::before { content: ""; position: absolute; left: 0; top: 0.7rem; width: 8px; height: 8px; background: #f4a41c; transform: rotate(45deg); }
    input, textarea { color: #111 !important; }
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