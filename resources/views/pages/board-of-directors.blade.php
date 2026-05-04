@extends('layouts.app')

@section('styles')
<style>
    /* Modernized Outline Text - Made Bolder and more Visible */
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
        /* Increased stroke from 1px to 2px and increased opacity */
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.15); 
        text-transform: uppercase;
        letter-spacing: 0.1em;
        line-height: 1;
        pointer-events: none;
    }

    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- SECTION 1: REDESIGNED MODERN HERO SECTION -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <!-- Background Image with Professional Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069" class="w-full h-full object-cover opacity-50" alt="Corporate Office">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6"></p>
            
            <div class="relative">
                <!-- Large Outline Background Word (Made Bolder) -->
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">
                    TRIKON
                </h2>
                
                <!-- Main Solid Title - High Contrast & Bolder -->
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10">
                    BOARD OF <span class="text-[#f4a41c]">DIRECTORS</span>
                </h1>
            </div>

            <div class="mt-10 flex flex-col items-center gap-4">
                <div class="w-24 h-[2px] bg-[#f4a41c]"></div>
                <p class="text-white/80 italic text-[10px] md:text-xs font-bold uppercase tracking-[0.5em]"></p>
            </div>
        </div>
    </section>

    <!-- SECTION 2: DIRECTORS LIST -->
    <section class="py-24 px-6 md:px-20 max-w-7xl mx-auto">
        @foreach($directors as $index => $director)
            <div class="flex flex-col {{ $index % 2 != 0 ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-12 md:gap-24 mb-32 last:mb-0">
                
                <!-- PORTRAIT COLUMN -->
                <div class="w-full md:w-4/12 text-center" data-aos="zoom-in">
                    <div class="relative inline-block">
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full border-[10px] border-[#f4a41c]/20 p-2">
                            <div class="w-full h-full rounded-full border-4 border-[#f4a41c] overflow-hidden shadow-2xl">
                                @php
                                    $img = $director->image;
                                    // Handle absolute URLs or relative paths in public_html
                                    if (Str::startsWith($img, ['http://', 'https://'])) {
                                        $imgUrl = $img;
                                    } else {
                                        // Remove 'storage/' prefix if it exists to point directly to public_html root
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                        $imgUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}" 
                                     alt="{{ $director->name }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x400?text=Director+Image';">
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="serif text-2xl font-bold text-gray-900 uppercase">{{ $director->name }}</h3>
                        <p class="text-[#f4a41c] font-black uppercase text-xs tracking-widest mt-2">{{ $director->designation }}</p>
                    </div>
                </div>

                <!-- BIOGRAPHY COLUMN -->
                <div class="w-full md:w-8/12" data-aos="fade-up">
                    <div class="text-gray-600 text-sm md:text-base leading-relaxed text-justify space-y-6 font-medium">
                        {!! nl2br(e($director->description)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- SECTION 3: CONTACT FORM -->
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20">
            <!-- Contact Details -->
            <div data-aos="fade-right">
                <h2 class="text-3xl font-black uppercase mb-12 text-gray-900 tracking-tighter"><span class="text-[#f4a41c]">CONTACT</span> US</h2>
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <i class="fa-solid fa-phone text-[#f4a41c] mt-1"></i>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Hotline</p>
                            <p class="text-lg font-bold text-gray-700">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <i class="fa-solid fa-envelope text-[#f4a41c] mt-1"></i>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Email</p>
                            <p class="text-lg font-bold text-gray-700">{{ $settings->contact_email ?? 'info@trikonltd.com' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <i class="fa-solid fa-location-dot text-[#f4a41c] mt-1"></i>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Address</p>
                            <p class="text-gray-600 font-medium max-w-sm uppercase leading-relaxed text-xs">
                                {{ $settings->address ?? 'Rahman Trade Center, Ka-1/B, Bashundhara RD, Dhaka' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white p-10 shadow-2xl rounded-2xl" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-200 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Phone No.</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-200 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-200 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Message</label>
                        <textarea name="message" rows="4" required class="w-full border-b border-gray-200 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-4 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/20">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection