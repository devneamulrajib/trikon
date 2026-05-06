@extends('layouts.app')

@section('content')
<section class="bg-[#fafafa] min-h-screen pb-32">
    <!-- PREMIUM HERO HEADER - Modernized with deeper contrast and glass elements -->
    <div class="relative pt-48 pb-36 bg-[#0a0a0a] overflow-hidden">
        <!-- Decorative subtle grid overlay -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        <!-- Light flare effect -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#f4a41c] opacity-10 blur-[120px] rounded-full"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-block" data-aos="fade-down">
                <span class="text-[#f4a41c] text-[10px] font-black uppercase tracking-[1em] mb-4 block">Curated Real Estate</span>
                <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-[#f4a41c] to-transparent"></div>
            </div>
            
            <h1 class="serif text-5xl md:text-8xl text-white font-black uppercase tracking-tighter mt-8 mb-4" data-aos="zoom-in">
                Brokerage <span class="text-[#f4a41c]">Market</span>
            </h1>
            <p class="text-gray-500 uppercase text-[11px] tracking-[0.5em] font-bold" data-aos="fade-up" data-aos-delay="200">Exclusive Property Portfolio</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-16 relative z-20">
        <!-- EYE-CATCHY FILTER TABS - Refined Minimalist Design -->
        <div class="flex flex-wrap justify-center gap-3 mb-24" id="filter-tabs" data-aos="fade-up">
            <button onclick="filterList('all', this)" class="filter-btn active px-10 py-5 text-[11px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-xl transition-all duration-300 rounded-full border border-transparent hover:border-[#f4a41c]">
                View All
            </button>
            <button onclick="filterList('Land', this)" class="filter-btn px-10 py-5 text-[11px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-lg transition-all duration-300 rounded-full border border-gray-100 hover:border-[#f4a41c]">
                Land / Plots
            </button>
            <button onclick="filterList('Flat', this)" class="filter-btn px-10 py-5 text-[11px] font-black uppercase tracking-[0.3em] bg-white text-black shadow-lg transition-all duration-300 rounded-full border border-gray-100 hover:border-[#f4a41c]">
                Flats / Apartments
            </button>
        </div>

        <!-- LISTING GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="listing-container">
            @foreach($listings as $item)
            <div class="listing-card group bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden transition-all duration-700 hover:shadow-[0_40px_80px_rgba(0,0,0,0.1)] hover:-translate-y-4" data-category="{{ $item->category }}">
                <a href="{{ route('brokerage.show', $item->slug) }}" class="block">

                    <!-- Image Section - Improved Overlay -->
                    <div class="h-[420px] overflow-hidden relative">
                        @if($item->images && is_array($item->images) && count($item->images) > 0)
                            @php
                                $img = $item->images[0];
                                if (Str::startsWith($img, ['http://', 'https://'])) {
                                    $imgUrl = $img;
                                } else {
                                    $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                    $imgUrl = asset($cleanPath);
                                }
                            @endphp
                            <img src="{{ $imgUrl }}" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110" alt="{{ $item->title }}" onerror="this.onerror=null;this.src='https://placehold.co/600x800?text=Image+Not+Found';">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center serif italic text-gray-300 uppercase tracking-widest text-xs">
                                Photo Coming Soon
                            </div>
                        @endif
                        
                        <!-- Floating Glass Labels -->
                        <div class="absolute top-6 left-6 flex flex-col gap-2">
                            <span class="bg-[#f4a41c] text-white text-[9px] px-4 py-1.5 font-black uppercase tracking-widest shadow-2xl">
                                {{ $item->category }}
                            </span>
                            <span class="bg-black/80 backdrop-blur-md text-white text-[8px] px-4 py-1.5 font-bold uppercase tracking-widest border border-white/10">
                                {{ $item->status ?? 'FOR SALE' }}
                            </span>
                        </div>

                        <!-- Location Overlay - Modern Gradient -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            <p class="text-white text-[10px] font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                                <span class="w-5 h-5 bg-[#f4a41c] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-location-dot text-white text-[8px]"></i>
                                </span>
                                {{ $item->location ?? 'Bashundhara R/A, Dhaka' }}
                            </p>
                        </div>
                    </div>

                    <!-- Content Section - Enhanced Typography -->
                    <div class="p-10">
                        <h3 class="serif text-2xl font-black text-gray-900 leading-tight group-hover:text-[#f4a41c] transition-colors uppercase line-clamp-2 min-h-[60px]">
                            {{ $item->title }}
                        </h3>

                        <!-- Property Specific Icons - Standardized -->
                        <div class="flex items-center justify-between py-6 my-6 border-y border-gray-50">
                            @if($item->category === 'Flat')
                                <div class="flex flex-col items-center gap-1">
                                    <i class="fa-solid fa-bed text-gray-300 text-xs group-hover:text-[#f4a41c] transition-colors"></i>
                                    <span class="text-[8px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->bedrooms ?? '0' }} Beds</span>
                                </div>
                                <div class="w-[1px] h-4 bg-gray-100"></div>
                                <div class="flex flex-col items-center gap-1">
                                    <i class="fa-solid fa-bath text-gray-300 text-xs group-hover:text-[#f4a41c] transition-colors"></i>
                                    <span class="text-[8px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->bathrooms ?? '0' }} Baths</span>
                                </div>
                                <div class="w-[1px] h-4 bg-gray-100"></div>
                                <div class="flex flex-col items-center gap-1">
                                    <i class="fa-solid fa-maximize text-gray-300 text-xs group-hover:text-[#f4a41c] transition-colors"></i>
                                    <span class="text-[8px] font-black uppercase text-gray-400 tracking-tighter">{{ $item->area_sqft ?? '0' }} sq.ft</span>
                                </div>
                            @else
                                <div class="flex flex-col items-start">
                                    <span class="text-[8px] font-black uppercase text-[#f4a41c] tracking-widest mb-0.5">Plot Size</span>
                                    <span class="text-xs font-black text-gray-900">{{ $item->plot_size ?? 'N/A' }}</span>
                                </div>
                                <div class="flex flex-col items-end text-right">
                                    <span class="text-[8px] font-black uppercase text-[#f4a41c] tracking-widest mb-0.5">Block</span>
                                    <span class="text-xs font-black text-gray-900">{{ $item->block_name ?? 'N/A' }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Price & CTA -->
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Asking Price</span>
                                <p class="serif text-3xl font-black text-gray-900 tracking-tighter">৳ {{ $item->price }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-full border border-gray-100 flex items-center justify-center text-gray-300 group-hover:bg-[#f4a41c] group-hover:text-white group-hover:border-[#f4a41c] transition-all duration-500 shadow-sm">
                                <i class="fa-solid fa-arrow-right-long text-sm"></i>
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
/* Modern Tab Logic */
.filter-btn.active {
    background: #f4a41c !important;
    color: white !important;
    border-color: #f4a41c !important;
    box-shadow: 0 15px 30px -10px rgba(244, 164, 28, 0.4) !important;
    transform: scale(1.05);
}

.filter-btn:not(.active) {
    color: #888 !important;
    background: white !important;
}

.listing-card {
    border-radius: 4px;
    animation: premiumFadeIn 1.2s cubic-bezier(0.2, 1, 0.2, 1) forwards;
}

@keyframes premiumFadeIn {
    from { opacity: 0; transform: translateY(60px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .filter-btn {
        width: 100%;
        padding: 18px 0 !important;
        border-radius: 8px !important;
    }
}
</style>

<script>
function filterList(category, btn) {
    const cards = document.querySelectorAll('.listing-card');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(b => {
        b.classList.remove('active');
    });

    btn.classList.add('active');

    cards.forEach((card, index) => {
        const cardCategory = card.getAttribute('data-category');
        
        if (category === 'all' || cardCategory === category) {
            card.style.display = 'block';
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 40);
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection