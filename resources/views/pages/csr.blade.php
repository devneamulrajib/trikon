@extends('layouts.app')

@section('styles')
<style>
    /* Styling for clear readability without using a dark overlay */
    .hero-text-shadow {
        text-shadow: 0px 4px 20px rgba(0,0,0,0.8);
    }
    
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #f4a41c; }

    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }
</style>
@endsection

@section('content')
<!-- Ensure Alpine.js is available -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="bg-[#0a0a0a] min-h-screen text-white" x-data="{ open: false, activeTitle: '', activeDesc: '', activeImg: '' }">
    
    <!-- SECTION 1: MODERN HERO SECTION (Clear Cover Photo, No Effects) -->
    <section class="relative h-[60vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden">
        <!-- BACKGROUND IMAGE: Crystal Clear, No Overlays -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2070" 
                 class="w-full h-full object-cover" 
                 alt="CSR Cover Photo">
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6 hero-text-shadow"></p>
            <div class="relative">
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10 leading-tight hero-text-shadow">
                    CORPORATE SOCIAL <br> <span class="text-[#f4a41c]">RESPONSIBILITY</span>
                </h1>
            </div>
            <div class="w-24 h-[2px] bg-[#f4a41c] mx-auto mt-8 shadow-lg"></div>
        </div>
    </section>

    <!-- SECTION 2: THE QUOTE SECTION (Right Under Cover Photo) -->
    <section class="py-20 bg-[#0d0d0d] border-b border-white/5">
        <div class="max-w-4xl mx-auto px-6 text-center" data-aos="fade-up">
            <h2 class="text-xl md:text-3xl font-light italic text-gray-300 leading-relaxed tracking-wide">
                "Empowering Communities Through <span class="text-[#f4a41c] font-medium not-italic">Healthcare</span>, 
                <span class="text-[#f4a41c] font-medium not-italic">Education</span> and Sustainable Change"
            </h2>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 md:px-12 py-24">
        
        <!-- SECTION 3: TOP MASONRY COLLAGE -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-auto md:h-[550px] mb-24" data-aos="fade-up">
            <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden border border-white/10 rounded-sm">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2070" class="w-full h-full object-cover transition duration-700 hover:scale-105">
            </div>
            <div class="overflow-hidden relative group border border-white/10 rounded-sm">
                <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1931" class="w-full h-full object-cover transition duration-700 hover:scale-105">
            </div>
            <div class="overflow-hidden relative group border border-white/10 rounded-sm">
                <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=2073" class="w-full h-full object-cover transition duration-700 hover:scale-105">
            </div>
            <div class="md:col-span-2 overflow-hidden relative group border border-white/10 rounded-sm">
                <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=2070" class="w-full h-full object-cover transition duration-700 hover:scale-105">
            </div>
        </div>

        <!-- SECTION 4: UPLOADED CSR PROJECTS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($csrs as $item)
                @php
                    $img = $item->image;
                    // Robust URL generation for public_html root:
                    if (Str::startsWith($img, ['http://', 'https://'])) {
                        $imgUrl = $img;
                    } else {
                        // Strip 'storage/' prefix so it looks in the public_html root
                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                        $imgUrl = asset($cleanPath);
                    }
                @endphp
                <div class="relative group cursor-pointer overflow-hidden bg-[#111]" 
                     data-aos="fade-up"
                     @click="activeTitle = '{{ e($item->title) }}'; activeDesc = '{{ e($item->description) }}'; activeImg = '{{ $imgUrl }}'; open = true">
                    
                    <div class="relative aspect-[3/4] overflow-hidden border border-white/5 group-hover:border-[#f4a41c]/50 transition-colors duration-500 shadow-2xl">
                        <img src="{{ $imgUrl }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                             onerror="this.onerror=null;this.src='https://placehold.co/600x800?text=CSR+Image+Not+Found';">
                        
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-12 h-12 rounded-full bg-[#f4a41c]/90 border-2 border-white flex items-center justify-center text-white text-2xl font-bold shadow-xl transform scale-0 group-hover:scale-100 transition duration-500">
                                +
                            </div>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 bg-black/80 backdrop-blur-md py-6 px-6 border-l-4 border-[#f4a41c]">
                            <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-white group-hover:text-[#f4a41c] transition duration-300">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 border border-dashed border-white/10">
                    <p class="text-gray-500 uppercase tracking-widest text-[10px] font-bold">No CSR initiatives documented yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- LUXURY POPUP MODAL -->
    <div x-show="open" 
         x-cloak
         class="fixed inset-0 z-[200] flex items-center justify-center p-4 md:p-10"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="absolute inset-0 bg-black/95 backdrop-blur-md" @click="open = false"></div>

        <div class="relative bg-[#0f0f0f] border border-white/10 w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col md:flex-row shadow-[0_20px_50px_rgba(0,0,0,0.8)] rounded-sm">
            <button @click="open = false" class="absolute top-5 right-5 z-50 text-white/30 hover:text-[#f4a41c] text-4xl transition">&times;</button>
            <div class="w-full md:w-3/5 h-64 md:h-auto bg-black overflow-hidden">
                <img :src="activeImg" class="w-full h-full object-cover">
            </div>
            <div class="w-full md:w-2/5 p-8 md:p-12 flex flex-col justify-center bg-[#0f0f0f]">
                <div class="w-12 h-[2px] bg-[#f4a41c] mb-6"></div>
                <h3 class="serif text-2xl md:text-3xl text-white uppercase tracking-widest mb-6 font-black" x-text="activeTitle"></h3>
                <div class="overflow-y-auto pr-4 custom-scrollbar max-h-[300px]">
                    <p class="text-gray-400 text-sm leading-relaxed tracking-wide font-medium italic" x-text="activeDesc"></p>
                </div>
                <button @click="open = false" class="mt-10 self-start border border-[#f4a41c]/50 px-8 py-3 text-[10px] uppercase tracking-[0.3em] text-[#f4a41c] font-black hover:bg-[#f4a41c] hover:text-black transition duration-500 rounded-sm">
                    Close Detail
                </button>
            </div>
        </div>
    </div>
</div>
@endsection