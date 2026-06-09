@extends('layouts.app')

@section('styles')
<style>
    /* 1. HEADER FIX */
    .glass-header {
        background: rgb(0, 0, 0) !important;
        transition: background 0.6s ease, backdrop-filter 0.6s ease !important;
    }
    .glass-header.scrolled-stories {
        background: rgba(0, 0, 0, 0.2) !important;
        backdrop-filter: blur(10px) !important;
    }

    /* 2. VIDEO STYLES */
    .video-container {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0;
    }
    .sound-toggle {
        position: absolute;
        bottom: 40px; right: 40px;
        z-index: 50;
        width: 50px; height: 50px;
        background: rgba(244, 164, 28, 0.6);
        border: none; border-radius: 50%;
        color: white; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease;
    }
    .sound-toggle:hover { transform: scale(1.1); background: #f4a41c; }

    /* 3. TYPOGRAPHY */
    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; }
    .gold-accent-line-center { width: 80px; height: 2px; background-color: #f4a41c; margin: 30px auto; }

    /* 4. HERITAGE SECTION — Architectural Blueprint Background */
    .heritage-bg {
        position: relative;
        overflow: hidden;
    }
    .heritage-bg .bg-art {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }

    /* 5. PROMISE SECTION — Delicate Geometric Background Art */
    .promise-section {
        position: relative;
        overflow: hidden;
        background: #fff;
    }
    .promise-section .promise-art {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    /* 6. PROMISE CARD STYLES */
    .promise-card {
        position: relative;
        z-index: 10;
        background: rgba(255,255,255,0.85);
        border: 1px solid rgba(244,164,28,0.12);
        border-radius: 20px;
        padding: 48px 32px 40px;
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        backdrop-filter: blur(4px);
    }
    .promise-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 32px 64px -12px rgba(244,164,28,0.18);
        border-color: rgba(244,164,28,0.4);
    }
    .promise-card .icon-ring {
        width: 88px; height: 88px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(244,164,28,0.08) 0%, rgba(244,164,28,0.18) 100%);
        border: 1.5px solid rgba(244,164,28,0.25);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 28px;
        transition: background 0.3s ease, border-color 0.3s ease;
    }
    .promise-card:hover .icon-ring {
        background: linear-gradient(135deg, rgba(244,164,28,0.16) 0%, rgba(244,164,28,0.32) 100%);
        border-color: rgba(244,164,28,0.55);
    }
    .promise-card .icon-ring img {
        width: 48px; height: 48px; object-fit: contain;
    }

    /* 7. CORE VALUES — Patterned Background */
    .values-section {
        position: relative;
        overflow: hidden;
    }
    .values-section .values-art {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }

    /* 8. LOGO SECTION ART */
    .logo-section {
        position: relative;
        overflow: hidden;
    }
    .logo-section .logo-art {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- SECTION 1: PURE VIDEO HERO -->
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


    <!-- SECTION 2: THE TRIKON HERITAGE — Architectural Blueprint Art -->
    <section class="py-32 bg-white heritage-bg">

        <!-- Background Art: Delicate architectural linework -->
        <div class="bg-art">
            <svg width="100%" height="100%" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.25"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hGrid)"/>

                <!-- Large faint triangle — brand symbol -->
                <polygon points="720,40 200,640 1240,640" fill="none" stroke="#f4a41c" stroke-width="0.8" opacity="0.08"/>
                <polygon points="720,120 280,610 1160,610" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.06"/>
                <polygon points="720,200 360,580 1080,580" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>

                <!-- Corner flourish lines — top left -->
                <line x1="0" y1="0" x2="200" y2="200" stroke="#f4a41c" stroke-width="0.5" opacity="0.12"/>
                <line x1="0" y1="40" x2="160" y2="200" stroke="#f4a41c" stroke-width="0.3" opacity="0.08"/>
                <line x1="40" y1="0" x2="200" y2="160" stroke="#f4a41c" stroke-width="0.3" opacity="0.08"/>

                <!-- Corner flourish lines — bottom right -->
                <line x1="1440" y1="700" x2="1240" y2="500" stroke="#f4a41c" stroke-width="0.5" opacity="0.12"/>
                <line x1="1440" y1="660" x2="1280" y2="500" stroke="#f4a41c" stroke-width="0.3" opacity="0.08"/>
                <line x1="1400" y1="700" x2="1240" y2="540" stroke="#f4a41c" stroke-width="0.3" opacity="0.08"/>

                <!-- Subtle dot constellation -->
                <circle cx="120" cy="350" r="2" fill="#f4a41c" opacity="0.15"/>
                <circle cx="180" cy="320" r="1.5" fill="#f4a41c" opacity="0.12"/>
                <circle cx="1320" cy="200" r="2" fill="#f4a41c" opacity="0.15"/>
                <circle cx="1380" cy="240" r="1.5" fill="#f4a41c" opacity="0.12"/>
                <line x1="120" y1="350" x2="180" y2="320" stroke="#f4a41c" stroke-width="0.4" opacity="0.1"/>
                <line x1="1320" y1="200" x2="1380" y2="240" stroke="#f4a41c" stroke-width="0.4" opacity="0.1"/>
            </svg>
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
    <section class="py-24 bg-gray-50 border-y border-gray-100 logo-section">

        <!-- Faint radial rings background art -->
        <div class="logo-art">
            <svg width="100%" height="100%" viewBox="0 0 1440 500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <circle cx="240" cy="250" r="160" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.07"/>
                <circle cx="240" cy="250" r="220" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <circle cx="240" cy="250" r="280" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <circle cx="1200" cy="250" r="180" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.06"/>
                <circle cx="1200" cy="250" r="260" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <!-- Subtle diagonal hatching -->
                <line x1="900" y1="0" x2="1440" y2="500" stroke="#f4a41c" stroke-width="0.3" opacity="0.06"/>
                <line x1="960" y1="0" x2="1440" y2="420" stroke="#f4a41c" stroke-width="0.3" opacity="0.05"/>
                <line x1="840" y1="0" x2="1440" y2="560" stroke="#f4a41c" stroke-width="0.2" opacity="0.04"/>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">
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


    <!-- SECTION 4: MISSION, VISION, OBJECTIVE — Geometric Mandala Background Art -->
    <section class="py-28 promise-section">

        <!-- Background Art: Overlapping geometric compass / mandala lines -->
        <div class="promise-art">
            <svg width="100%" height="100%" viewBox="0 0 1440 680" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <radialGradient id="fadeOut" cx="50%" cy="50%" r="50%">
                        <stop offset="0%" stop-color="#f4a41c" stop-opacity="0.07"/>
                        <stop offset="100%" stop-color="#f4a41c" stop-opacity="0"/>
                    </radialGradient>
                </defs>

                <!-- Central large radial bloom -->
                <circle cx="720" cy="340" r="420" fill="url(#fadeOut)"/>

                <!-- Concentric circles -->
                <circle cx="720" cy="340" r="100" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.1"/>
                <circle cx="720" cy="340" r="180" fill="none" stroke="#f4a41c" stroke-width="0.5" opacity="0.08"/>
                <circle cx="720" cy="340" r="260" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.07"/>
                <circle cx="720" cy="340" r="340" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <circle cx="720" cy="340" r="420" fill="none" stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>

                <!-- Radiating spoke lines -->
                <line x1="720" y1="340" x2="720" y2="0"    stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="340" x2="720" y2="680"   stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="340" x2="1440" y2="340"  stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="340" x2="0" y2="340"     stroke="#f4a41c" stroke-width="0.5" opacity="0.07"/>
                <line x1="720" y1="340" x2="1300" y2="0"    stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="340" x2="140" y2="680"   stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="340" x2="140" y2="0"     stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="340" x2="1300" y2="680"  stroke="#f4a41c" stroke-width="0.4" opacity="0.05"/>
                <line x1="720" y1="340" x2="1440" y2="100"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="340" x2="0" y2="580"     stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="340" x2="1440" y2="580"  stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>
                <line x1="720" y1="340" x2="0" y2="100"     stroke="#f4a41c" stroke-width="0.3" opacity="0.04"/>

                <!-- Decorative triangles echoing brand mark -->
                <polygon points="720,60 380,580 1060,580" fill="none" stroke="#f4a41c" stroke-width="0.6" opacity="0.06"/>
                <polygon points="720,100 420,560 1020,560" fill="none" stroke="#f4a41c" stroke-width="0.4" opacity="0.04"/>

                <!-- Small accent dots on circle intersections -->
                <circle cx="720" cy="240" r="3" fill="#f4a41c" opacity="0.1"/>
                <circle cx="720" cy="440" r="3" fill="#f4a41c" opacity="0.1"/>
                <circle cx="620" cy="340" r="3" fill="#f4a41c" opacity="0.1"/>
                <circle cx="820" cy="340" r="3" fill="#f4a41c" opacity="0.1"/>
                <circle cx="656" cy="276" r="2.5" fill="#f4a41c" opacity="0.08"/>
                <circle cx="784" cy="404" r="2.5" fill="#f4a41c" opacity="0.08"/>
                <circle cx="656" cy="404" r="2.5" fill="#f4a41c" opacity="0.08"/>
                <circle cx="784" cy="276" r="2.5" fill="#f4a41c" opacity="0.08"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <h2 class="serif-title text-3xl text-gray-900">OUR <span class="text-[#f4a41c]">PROMISE</span></h2>
                <div class="gold-accent-line-center"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- Mission -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="icon-ring">
                        <img src="{{ asset('images/icons/icons8-mission-48.png') }}" alt="Mission">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">MISSION</h3>
                    <p class="text-gray-500 text-xs leading-loose px-2 uppercase font-bold">Empowering individuals and businesses to achieve real estate goals by providing comprehensive solutions and expert guidance.</p>
                </div>

                <!-- Vision -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="icon-ring">
                        <img src="{{ asset('images/icons/icons8-vision-100.png') }}" alt="Vision">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">VISION</h3>
                    <p class="text-gray-500 text-xs leading-loose px-2 uppercase font-bold">Driven by excellence to become the industry's top-most prioritized company recognized for client satisfaction.</p>
                </div>

                <!-- Objective -->
                <div class="promise-card text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-ring">
                        <img src="{{ asset('images/icons/icons8-objective-64.png') }}" alt="Objective">
                    </div>
                    <h3 class="serif-title text-lg mb-4 text-[#f4a41c]">OBJECTIVE</h3>
                    <p class="text-gray-500 text-xs leading-loose px-2 uppercase font-bold">Connecting communities worldwide for a better society by offering affordable, unique housing projects.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- SECTION 5: CORE VALUES — Woven Lattice Background Art -->
    <section class="py-24 bg-gray-50 border-t border-gray-100 values-section">

        <!-- Background Art: Diagonal woven lattice -->
        <div class="values-art">
            <svg width="100%" height="100%" viewBox="0 0 1440 600" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="lattice" width="40" height="40" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                        <line x1="0" y1="0" x2="0" y2="40" stroke="#f4a41c" stroke-width="0.4" opacity="0.18"/>
                        <line x1="0" y1="0" x2="40" y2="0" stroke="#f4a41c" stroke-width="0.4" opacity="0.18"/>
                    </pattern>
                    <radialGradient id="valFade" cx="50%" cy="50%" r="60%">
                        <stop offset="0%" stop-color="white" stop-opacity="0"/>
                        <stop offset="100%" stop-color="white" stop-opacity="0.85"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#lattice)"/>
                <!-- Fade edges so content stays readable -->
                <rect width="100%" height="100%" fill="url(#valFade)"/>

                <!-- Large decorative T letter watermark -->
                <text x="50%" y="54%" text-anchor="middle" dominant-baseline="middle"
                      font-family="serif" font-weight="900" font-size="520"
                      fill="#f4a41c" opacity="0.025" letter-spacing="-20">T</text>
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h3 class="serif-title text-[#f4a41c] text-xl">CORE VALUES</h3>
                <div class="gold-accent-line-center"></div>
            </div>
            <div class="space-y-6 text-sm" data-aos="fade-up">
                @php
                    $values = [
                        'Integrity'        => 'We uphold the highest standards of honesty, transparency, and ethical conduct.',
                        'Excellence'       => 'We strive for excellence in everything we do, continuously innovating.',
                        'Client-Centricity'=> 'We prioritize the needs and interests of our clients above all else.',
                        'Professionalism'  => 'Demonstrating professionalism in communication, appearance, and conduct.',
                        'Collaboration'    => 'We believe in the power of working together with communities.',
                        'Accountability'   => 'We take responsibility for our actions and outcomes with high standards.',
                        'Respect'          => 'Showing respect and consideration for all individuals at all times.',
                        'Innovation'       => 'Embracing creativity to adapt to changing market dynamics.'
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