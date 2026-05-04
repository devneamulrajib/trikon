@extends('layouts.app')

@section('styles')
<style>
    /* Style for the Large Outline Text behind the main title - Matches Board of Directors */
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
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

    <!-- SECTION 1: "BOARD OF DIRECTORS" STYLE HERO SECTION -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <!-- Background Image with Professional Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a?q=80&w=2070" class="w-full h-full object-cover opacity-50" alt="Management Background">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6"></p>
            
            <div class="relative">
                <!-- Large Outline Background Word: TRIKON (Matching Board Page) -->
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">
                    TRIKON
                </h2>
                
                <!-- Main Solid Title: Two-tone Style -->
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10">
                    MANAGEMENT <span class="text-[#f4a41c]">TEAM</span>
                </h1>
            </div>

            <div class="mt-10 flex flex-col items-center gap-4">
                <div class="w-24 h-[2px] bg-[#f4a41c]"></div>
                <p class="text-white/80 italic text-[10px] md:text-xs font-bold uppercase tracking-[0.5em]"></p>
            </div>
        </div>
    </section>

    <!-- SECTION 2: TEAM MEMBER GRID (Photos in Full Color) -->
    <section class="relative py-24 px-6 overflow-hidden bg-white">
        <!-- Subtle Logo Watermark -->
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.03] pointer-events-none select-none">
            <img src="{{ asset('logo.png') }}" class="w-[800px] grayscale" alt="Watermark">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-[#f4a41c] text-[10px] font-black uppercase tracking-[0.5em] mb-4">Leadership</h2>
                <h3 class="serif text-3xl font-bold text-gray-900 uppercase tracking-widest">Management <span class="text-[#f4a41c]">Team</span></h3>
                <div class="w-16 h-[1px] bg-[#f4a41c] mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-20">
                @foreach($members as $member)
                <div class="text-center group" data-aos="fade-up">
                    <div class="relative inline-block mb-6">
                        <div class="w-48 h-48 rounded-full border-2 border-gray-100 p-2 transition-all duration-500 group-hover:border-[#f4a41c]">
                            <div class="w-full h-full rounded-full overflow-hidden border-2 border-[#f4a41c] shadow-lg">
                                @php
                                    $img = $member->image;
                                    if (Str::startsWith($img, ['http://', 'https://'])) {
                                        $imgUrl = $img;
                                    } else {
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                        $imgUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x400?text=Member+Image';">
                            </div>
                        </div>
                    </div>
                    <h4 class="serif text-lg font-bold text-gray-900 uppercase tracking-tight">{{ $member->name }}</h4>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-2">{{ $member->designation }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 3: FULL-WIDTH TEAM PHOTO (Edge-to-Edge) -->
    <section class="w-full bg-white overflow-hidden leading-[0]">
        @if($gallery->count() > 0)
            @php
                $galleryImg = $gallery->first()->image;
                if (Str::startsWith($galleryImg, ['http://', 'https://'])) {
                    $galleryUrl = $galleryImg;
                } else {
                    $cleanGalleryPath = ltrim(Str::replaceFirst('storage/', '', $galleryImg), '/');
                    $galleryUrl = asset($cleanGalleryPath);
                }
            @endphp
            <img src="{{ $galleryUrl }}" 
                 class="w-full h-auto object-cover max-h-[90vh]" 
                 alt="Full Width Team Photo"
                 onerror="this.onerror=null;this.src='https://placehold.co/1920x800?text=Team+Gallery+Image';">
        @endif
    </section>

    <!-- SECTION 4: CONTACT US (Preserving Request Design) -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            
            <!-- LEFT COLUMN: Contact Details -->
            <div data-aos="fade-right" class="pt-10">
                <h2 class="text-4xl font-black uppercase mb-16 text-gray-900 tracking-tighter">
                    <span class="text-[#f4a41c]">CONTACT</span> US
                </h2>
                
                <div class="space-y-12">
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-phone text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Hotline</p>
                            <p class="text-lg font-bold text-gray-800 tracking-wide">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-envelope text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Email</p>
                            <p class="text-lg font-bold text-gray-800 tracking-wide">{{ $settings->contact_email ?? 'info@trikonltd.com' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-location-dot text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Address</p>
                            <p class="text-gray-600 font-bold text-sm leading-relaxed max-w-sm uppercase">
                                {{ $settings->address ?? 'Rahman Trade Center, Ka-1/B (Level 5), Jagannathpur, Bashundhara RD, Dhaka, Bangladesh' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-20">
                    <h4 class="text-[10px] font-black uppercase text-gray-900 mb-6 tracking-[0.4em]">Follow Us On</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#f4a41c] hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#f4a41c] hover:text-white transition-all"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#f4a41c] hover:text-white transition-all"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Message Form Card -->
            <div class="bg-white p-12 md:p-16 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Phone No.</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="4" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection