@extends('layouts.app')

@section('styles')
<style>
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.15); 
        text-transform: uppercase;
        letter-spacing: 0.1em;
        line-height: 1;
        pointer-events: none;
    }
    .hero-title { font-family: 'Cinzel', serif; line-height: 1.1; }
    .bg-number {
        font-family: 'Cinzel', serif;
        position: absolute;
        font-size: 15vw;
        font-weight: 900;
        color: rgba(0,0,0,0.03);
        z-index: 0;
        top: -50px;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen overflow-hidden">

    <!-- SECTION 1: HERO -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1449156001437-37e671782f13?q=80&w=2070" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6"></p>
            <div class="relative">
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">TRIKON</h2>
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10">
                    SISTER <span class="text-[#f4a41c]">CONCERNS</span>
                </h1>
            </div>
            <div class="mt-10 flex flex-col items-center">
                <div class="w-24 h-[2px] bg-[#f4a41c]"></div>
                <p class="text-white/70 italic text-[10px] md:text-xs font-bold uppercase tracking-[0.5em] mt-6"></p>
            </div>
        </div>
    </section>

    <!-- SECTION 2: LISTING -->
    <div class="max-w-7xl mx-auto px-6 py-32">
        @forelse($concerns as $index => $concern)
            <div class="relative mb-48 last:mb-0" data-aos="fade-up">
                <div class="bg-number {{ $index % 2 == 0 ? '-left-10' : '-right-10' }}">0{{ $index + 1 }}</div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">
                    
                    <!-- Media Column (Using Logo from Admin) -->
                    <div class="lg:col-span-6 {{ $index % 2 != 0 ? 'lg:order-2' : '' }}">
                        <div class="bg-white p-12 md:p-20 rounded-[40px] border border-gray-100 shadow-2xl flex items-center justify-center aspect-video group hover:border-[#f4a41c]/30 transition-all duration-500">
                            
                            @if($concern->logo)
                                @php
                                    $logo = $concern->logo;
                                    // 1. Handle absolute URLs (e.g. from a CDN or external source)
                                    if (Str::startsWith($logo, ['http://', 'https://'])) {
                                        $logoUrl = $logo;
                                    } 
                                    // 2. Robust URL generation for public_html root:
                                    else {
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $logo), '/');
                                        $logoUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $logoUrl }}" 
                                     class="max-w-full max-h-48 object-contain transform group-hover:scale-110 transition-transform duration-700" 
                                     alt="{{ $concern->name }}"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x200?text=Logo+Not+Found';">
                            @else
                                <div class="text-gray-200 font-black uppercase text-xl italic tracking-tighter">TRIKON GROUP</div>
                            @endif
                        </div>
                    </div>

                    <!-- Text Column -->
                    <div class="lg:col-span-6 {{ $index % 2 != 0 ? 'lg:order-1' : '' }}">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-[2px] bg-[#f4a41c]"></div>
                            <h2 class="serif text-3xl md:text-5xl text-gray-900 font-black uppercase tracking-tight">{{ $concern->name }}</h2>
                        </div>
                        <div class="text-gray-500 leading-loose space-y-6 text-sm md:text-base mb-10 text-justify font-medium">
                            {!! $concern->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center py-20 text-gray-400">No content available.</p>
        @endforelse
    </div>

    <!-- CONTACT FORM -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div data-aos="fade-right" class="pt-10">
                <h2 class="text-4xl font-black uppercase mb-16 text-gray-900 tracking-tighter">
                    <span class="text-[#f4a41c]">CONTACT</span> US
                </h2>
                <div class="space-y-12">
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-phone text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Hotline</p>
                            <p class="text-lg font-bold text-gray-800">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
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
            </div>

            <div class="bg-white p-12 md:p-16 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] rounded-3xl" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <!-- ADDED PHONE NUMBER FIELD BELOW -->
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Phone No.</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="3" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10 rounded-full">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection