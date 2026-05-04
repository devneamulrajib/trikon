@extends('layouts.app')

@section('styles')
<style>
    /* 1. HEADER FIX: Overriding app.blade.php behavior for this page specifically */
    .glass-header {
        background: rgb(0, 0, 0) !important; /* Starts solid black */
        transition: background 0.6s ease, backdrop-filter 0.6s ease !important;
    }
    .glass-header.scrolled-stories {
        background: rgba(0, 0, 0, 0.2) !important; /* Becomes transparent on scroll */
        backdrop-filter: blur(10px) !important;
    }

    /* 2. VIDEO & TYPOGRAPHY STYLES */
    .video-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }
    
    .sound-toggle {
        position: absolute;
        bottom: 40px;
        right: 40px;
        z-index: 50;
        width: 50px;
        height: 50px;
        background: rgba(244, 164, 28, 0.6);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .sound-toggle:hover { transform: scale(1.1); background: #f4a41c; }

    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; }
    .gold-accent-line-center { width: 80px; height: 2px; background-color: #f4a41c; margin: 30px auto; }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- SECTION 1: PURE VIDEO HERO (Edge to Edge) -->
    <section class="relative h-screen w-full overflow-hidden bg-black">
        <div class="video-container">
            <video id="heroVideo" autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ asset('story.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <button onclick="toggleSound()" class="sound-toggle" id="muteBtn">
                <i class="fa-solid fa-volume-xmark" id="muteIcon"></i>
            </button>
        </div>
    </section>

    <!-- SECTION 2: THE TRIKON HERITAGE -->
    <section class="py-32 bg-white relative overflow-hidden">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none select-none flex items-center justify-center">
            <h2 class="serif text-[20vw] font-black text-black leading-none">TRIKON</h2>
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="serif-title text-4xl md:text-5xl text-gray-900 mb-2" data-aos="fade-up">
                THE TRIKON <span class="text-[#f4a41c]">HERITAGE</span>
            </h2>
            <div class="gold-accent-line-center" data-aos="fade-up" data-aos-delay="100"></div>
            
            <div class="text-gray-600 text-lg md:text-xl leading-[2.2] space-y-10 font-light" data-aos="fade-up" data-aos-delay="200">
                <p class="italic">"Architecture is a visual art, and the buildings speak for themselves."</p>
                <p>Ready to experience the difference that Trikon Holdings can make in your real estate journey? Our story is one of passion, commitment to quality, and a vision that reaches beyond the horizon. For years, we have been dedicated to transforming prime pieces of land into architectural masterpieces.</p>
                <p>As a valued member of our community, you will find information that will spark your imagination and show you the world that exceeds your expectations. Trikon Holdings doesn't just build homes; we craft legacies where life unfolds in its most beautiful form.</p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: LOGO STORY -->
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <div class="lg:col-span-5 flex justify-center" data-aos="fade-right">
                @php
                    $logoPath = $settings->logo ?? null;
                    if($logoPath) {
                        $cleanLogo = ltrim(Str::replaceFirst('storage/', '', $logoPath), '/');
                        $logoUrl = asset($cleanLogo);
                    } else {
                        $logoUrl = null;
                    }
                @endphp

                @if($logoUrl)
                    <img src="{{ $logoUrl }}" class="w-64 md:w-80 h-auto grayscale opacity-60" alt="Logo Story" onerror="this.style.display='none'; document.getElementById('text-logo-story-fallback').style.display='block'">
                    <div id="text-logo-story-fallback" style="display:none;" class="serif text-gray-200 font-black text-7xl uppercase select-none opacity-20">TRIKON</div>
                @else
                    <div class="serif text-gray-200 font-black text-7xl uppercase select-none opacity-20">TRIKON</div>
                @endif
            </div>
            <div class="lg:col-span-7" data-aos="fade-left">
                <h2 class="serif-title text-3xl text-gray-900 mb-2">LOGO <span class="text-[#f4a41c]">STORY</span></h2>
                <div class="w-16 h-1 bg-[#f4a41c] my-6"></div>
                <div class="text-gray-500 text-sm leading-loose space-y-6 font-medium text-justify uppercase tracking-wider">
                    <p>The founders sought a symbol that would encapsulate the essence of their brand—a symbol that would convey their commitment to innovation, excellence, and integrity. After much deliberation, they turned to the timeless symbolism of the triangle.</p>
                    <p>Each of its three pillars represents a core philosophy: luxury, sustainability, and community. The logo features a harmonious blend of yellow and golden tones, symbolizing optimism, creativity, and luxury.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: MISSION, VISION, OBJECTIVE -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="serif-title text-3xl text-gray-900">OUR <span class="text-[#f4a41c]">PROMISE</span></h2>
                <div class="gold-accent-line-center"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Mission -->
                <div class="text-center group" data-aos="fade-up">
                    <div class="w-20 h-20 mx-auto mb-8 flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/1055/1055644.png" class="w-full h-full object-contain" alt="Mission" style="filter: invert(66%) sepia(85%) saturate(395%) hue-rotate(1deg) brightness(103%) contrast(92%);">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">MISSION</h3>
                    <p class="text-gray-500 text-xs leading-loose px-4 uppercase font-bold">Empowering individuals and businesses to achieve real estate goals by providing comprehensive solutions and expert guidance.</p>
                </div>

                <!-- Vision -->
                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto mb-8 flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2829/2829906.png" class="w-full h-full object-contain" alt="Vision" style="filter: invert(66%) sepia(85%) saturate(395%) hue-rotate(1deg) brightness(103%) contrast(92%);">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">VISION</h3>
                    <p class="text-gray-500 text-xs leading-loose px-4 uppercase font-bold">Driven by excellence to become the industry's top-most prioritized company recognized for client satisfaction.</p>
                </div>

                <!-- Objective -->
                <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-20 h-20 mx-auto mb-8 flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/1141/1141971.png" class="w-full h-full object-contain" alt="Objective" style="filter: invert(66%) sepia(85%) saturate(395%) hue-rotate(1deg) brightness(103%) contrast(92%);">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">OBJECTIVE</h3>
                    <p class="text-gray-500 text-xs leading-loose px-4 uppercase font-bold">Connecting communities worldwide for a better society by offering affordable, unique housing projects.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: CORE VALUES LIST -->
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="serif-title text-[#f4a41c] text-xl">CORE VALUES</h3>
            </div>
            <div class="space-y-6 text-sm" data-aos="fade-up">
                @php
                    $values = [
                        'Integrity' => 'We uphold the highest standards of honesty, transparency, and ethical conduct.',
                        'Excellence' => 'We strive for excellence in everything we do, continuously innovating.',
                        'Client-Centricity' => 'We prioritize the needs and interests of our clients above all else.',
                        'Professionalism' => 'Demonstrating professionalism in communication, appearance, and conduct.',
                        'Collaboration' => 'We believe in the power of working together with communities.',
                        'Accountability' => 'We take responsibility for our actions and outcomes with high standards.',
                        'Respect' => 'Showing respect and consideration for all individuals at all times.',
                        'Innovation' => 'Embracing creativity to adapt to changing market dynamics.'
                    ];
                @endphp
                @foreach($values as $title => $desc)
                <div class="flex gap-4 items-start">
                    <span class="text-[#f4a41c] mt-1">•</span>
                    <p class="text-gray-600 leading-relaxed uppercase"><strong class="text-gray-900 font-black tracking-widest text-xs">{{ $title }}:</strong> {{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 6: CONTACT FORM -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div data-aos="fade-right" class="pt-10">
                <h2 class="serif-title text-3xl text-gray-900 mb-16"><span class="text-[#f4a41c]">CONTACT</span> US</h2>
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
                            <p class="text-gray-600 font-bold text-sm leading-relaxed max-w-sm uppercase">{{ $settings->address ?? 'Rahman Trade Center, Ka-1/B, Bashundhara RD, Dhaka' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl" data-aos="fade-left">
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
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10 rounded-full">Send Message</button>
                </form>
            </div>
        </div>
    </section>

</div>

<script>
    // Header Color Change Logic
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.glass-header');
        if (header) {
            if (window.scrollY > 150) {
                header.classList.add('scrolled-stories');
            } else {
                header.classList.remove('scrolled-stories');
            }
        }
    });

    function toggleSound() {
        const video = document.getElementById('heroVideo');
        const icon = document.getElementById('muteIcon');
        if (video.muted) {
            video.muted = false;
            icon.classList.remove('fa-volume-xmark');
            icon.classList.add('fa-volume-high');
        } else {
            video.muted = true;
            icon.classList.remove('fa-volume-high');
            icon.classList.add('fa-volume-xmark');
        }
    }
</script>
@endsection