@extends('layouts.app')

@section('styles')
<style>
    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; }
    
    /* Stronger text shadow for readability since the dark overlay is removed */
    .hero-text-shadow { 
        text-shadow: 0px 4px 40px rgba(0,0,0,0.8), 0px 2px 10px rgba(0,0,0,0.6); 
    }
    
    .service-body-content {
        font-family: 'Montserrat', sans-serif;
        line-height: 2;
        color: #444;
    }
    .service-body-content h2, .service-body-content h3 {
        font-family: 'Cinzel', serif;
        color: #111;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        font-weight: 800;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- 1. CLEAN COVER PHOTO (Hero Section - No Overlay) -->
    <section class="relative h-[60vh] md:h-[70vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <!-- Set opacity to 100 and removed the gradient overlay div -->
            <img src="{{ asset('storage/' . $service->hero_image) }}" class="w-full h-full object-cover opacity-100" alt="{{ $service->name }}">
        </div>
        
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <h1 class="serif-title text-5xl md:text-8xl text-white tracking-widest hero-text-shadow">
                {{ $service->name }}
            </h1>
            <div class="w-24 h-1 bg-[#f4a41c] mx-auto mt-6 shadow-xl"></div>
        </div>
    </section>

    <!-- 2. INTRO SECTION (Short Description + Side Video) -->
    <section class="py-24 px-6 md:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Short Description -->
                <div data-aos="fade-right">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-[2px] bg-[#f4a41c]"></div>
                        <span class="text-[#f4a41c] font-black uppercase tracking-[0.4em] text-[10px]">Overview</span>
                    </div>
                    <div class="text-gray-600 text-lg md:text-xl leading-[2] font-medium text-justify italic">
                        {!! $service->description !!}
                    </div>
                </div>

                <!-- Right: YouTube Video -->
                <div data-aos="fade-left">
                    @if($service->video_url)
                    <div class="relative aspect-video rounded-3xl overflow-hidden shadow-2xl bg-black border-8 border-gray-50">
                        @php
                            $videoId = \Illuminate\Support\Str::afterLast($service->video_url, '/');
                            if(str_contains($videoId, 'watch?v=')) $videoId = \Illuminate\Support\Str::afterLast($videoId, '=');
                        @endphp
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 3. MAIN BODY DETAILS AREA -->
    <section class="pb-32 px-6 md:px-12 bg-white">
        <div class="max-w-5xl mx-auto" data-aos="fade-up">
            <div class="w-20 h-1 bg-gray-100 mb-16 mx-auto"></div>
            
            <div class="service-body-content prose prose-xl max-w-none">
                @if($service->main_content)
                    {!! $service->main_content !!}
                @else
                    <p class="text-center text-gray-400 italic">Information is currently being updated.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- 4. CONTACT SECTION -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div data-aos="fade-right" class="pt-10">
                <h2 class="serif-title text-4xl font-black uppercase mb-16 text-gray-900 tracking-tighter">
                    <span class="text-[#f4a41c]">CONTACT</span> US
                </h2>
                <div class="space-y-12 text-gray-800">
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-phone text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">Hotline</p>
                            <p class="text-lg font-bold">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5">
                        <i class="fa-solid fa-location-dot text-[#f4a41c] text-lg mt-1"></i>
                        <div>
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">HQ Address</p>
                            <p class="text-gray-600 font-bold text-sm leading-relaxed max-w-sm uppercase">{{ $settings->address ?? 'Rahman Trade Center, Dhaka, Bangladesh' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 md:p-16 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] rounded-[40px] border border-gray-50" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Phone No.</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="3" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none bg-transparent"></textarea>
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