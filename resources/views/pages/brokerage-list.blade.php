@extends('layouts.app')

@section('content')
<section class="bg-gray-50 min-h-screen pb-32">
    <!-- PREMIUM HERO HEADER - Adjusted padding for fixed header -->
    <div class="relative pt-40 pb-28 md:pt-48 md:pb-32 bg-black overflow-hidden border-b-4 border-[#f4a41c]">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h4 class="text-[#f4a41c] text-xs font-black uppercase tracking-[0.8em] mb-6" data-aos="fade-down">Premium Property Portfolio</h4>
            <h1 class="serif text-4xl md:text-8xl text-white font-black uppercase tracking-tighter" data-aos="zoom-in">
                Brokerage <span class="text-[#f4a41c]">Market</span>
            </h1>
            <div class="w-32 h-1.5 bg-[#f4a41c] mx-auto mt-10"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-12 relative z-20">
        <!-- EYE-CATCHY FILTER TABS - Enhanced visibility -->
        <div class="flex flex-wrap justify-center gap-4 mb-24" id="filter-tabs">
            <button onclick="filterList('all', this)" class="filter-btn active px-14 py-5 text-[12px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-2xl border-2 border-white hover:border-[#f4a41c] transition-all duration-300 rounded-sm">
                View All
            </button>
            <button onclick="filterList('Land', this)" class="filter-btn px-14 py-5 text-[12px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-2xl border-2 border-gray-200 hover:border-[#f4a41c] transition-all duration-300 rounded-sm">
                Land / Plots
            </button>
            <button onclick="filterList('Flat', this)" class="filter-btn px-14 py-5 text-[12px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-2xl border-2 border-gray-200 hover:border-[#f4a41c] transition-all duration-300 rounded-sm">
                Flats / Apartments
            </button>
        </div>

        <!-- LISTING GRID - MAXIMIZED CARD SIZE -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12" id="listing-container">
            @foreach($listings as $item)
            <div class="listing-card group bg-white shadow-2xl overflow-hidden border border-gray-100 transition-all duration-500 hover:-translate-y-4" data-category="{{ $item->category }}">
                <a href="{{ route('brokerage.show', $item->slug) }}" class="block">

                    <!-- Image Section -->
                    <div class="h-[380px] overflow-hidden relative">
                        @if($item->images && is_array($item->images) && count($item->images) > 0)
                            @php
                                $img = $item->images[0];
                                // 1. Handle absolute URLs (e.g. from a CDN or external source)
                                if (Str::startsWith($img, ['http://', 'https://'])) {
                                    $imgUrl = $img;
                                } 
                                // 2. Robust URL generation for public_html root:
                                // We strip 'storage/' if it exists and use asset() to point to public_html
                                else {
                                    $cleanPath = ltrim(Str::after($img, 'storage/'), '/');
                                    // If 'storage/' wasn't in the path, ltrim/after might return empty or same string
                                    // so we double check the variable
                                    if(empty($cleanPath)) { $cleanPath = ltrim($img, '/'); }
                                    
                                    $imgUrl = asset($cleanPath);
                                }
                            @endphp
                            <img src="{{ $imgUrl }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $item->title }}" onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=Image+Not+Found';">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center serif italic text-gray-400">
                                No Image Available
                            </div>
                        @endif
                        
                        <!-- Badges -->
                        <div class="absolute top-8 left-8 flex flex-col gap-3">
                            <span class="bg-[#f4a41c] text-white text-[10px] px-5 py-2 font-black uppercase tracking-widest shadow-xl">
                                {{ $item->category }}
                            </span>
                            <span class="bg-black text-white text-[9px] px-5 py-2 font-bold uppercase tracking-widest border border-white/10">
                                {{ $item->status ?? 'FOR SALE' }}
                            </span>
                        </div>

                        <!-- Location Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/90 via-black/40 to-transparent">
                            <p class="text-white text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-[#f4a41c]"></i> {{ $item->location ?? 'Bashundhara R/A, Dhaka' }}
                            </p>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-12">
                        <!-- Title clearly displayed -->
                        <h3 class="serif text-2xl font-black text-gray-900 leading-tight group-hover:text-[#f4a41c] transition-colors uppercase line-clamp-2 min-h-[64px]">
                            {{ $item->title }}
                        </h3>

                        <!-- Property Specific Icons -->
                        <div class="flex items-center justify-between py-8 my-8 border-y border-gray-100">
                            @if($item->category === 'Flat')
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-bed text-[#f4a41c] text-sm mb-2"></i>
                                    <span class="text-[9px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->bedrooms ?? '0' }} Bedrooms</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-bath text-[#f4a41c] text-sm mb-2"></i>
                                    <span class="text-[9px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->bathrooms ?? '0' }} Baths</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-maximize text-[#f4a41c] text-sm mb-2"></i>
                                    <span class="text-[9px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->area_sqft ?? '0' }} sq.ft</span>
                                </div>
                            @else
                                <div class="flex flex-col items-start">
                                    <span class="text-[9px] font-black uppercase text-[#f4a41c] tracking-widest mb-1">Plot Size</span>
                                    <span class="text-sm font-black text-gray-900">{{ $item->plot_size ?? 'N/A' }}</span>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-[9px] font-black uppercase text-[#f4a41c] tracking-widest mb-1">Block Name</span>
                                    <span class="text-sm font-black text-gray-900">{{ $item->block_name ?? 'N/A' }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Price & CTA -->
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest block mb-1">Asking Price</span>
                                <p class="serif text-3xl font-black text-gray-900">৳ {{ $item->price }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-full border-2 border-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-[#f4a41c] group-hover:text-white group-hover:border-[#f4a41c] transition-all duration-500 shadow-lg">
                                <i class="fa-solid fa-chevron-right text-lg"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Enhanced Filter Button Logic */
.filter-btn.active {
    background: #f4a41c !important;
    color: white !important;
    border-color: #f4a41c !important;
    box-shadow: 0 25px 50px -12px rgba(244, 164, 28, 0.5) !important;
    transform: scale(1.05);
}

.filter-btn:not(.active) {
    color: #111 !important;
    background: white !important;
    border-color: #eee !important;
}

/* Smooth Fade and Lift Animation */
.listing-card {
    animation: premiumFadeIn 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes premiumFadeIn {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Fix for mobile headers */
@media (max-width: 768px) {
    .filter-btn {
        width: 100%;
        padding: 15px 0 !important;
    }
}
</style>

<script>
function filterList(category, btn) {
    const cards = document.querySelectorAll('.listing-card');
    const buttons = document.querySelectorAll('.filter-btn');

    // Reset all buttons to inactive state
    buttons.forEach(b => {
        b.classList.remove('active');
        b.style.borderColor = "#eee";
    });

    // Set clicked button to active
    btn.classList.add('active');
    btn.style.borderColor = "#f4a41c";

    // Filtering logic with stagger animation
    cards.forEach((card, index) => {
        const cardCategory = card.getAttribute('data-category');
        
        if (category === 'all' || cardCategory === category) {
            card.style.display = 'block';
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection