<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'Trikon Holdings Ltd' }}</title>
    
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Montserrat:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root { 
            --gold: #c5a059; 
            --gold-light: #e2c28d; 
            --dark-bg: #0a0a0a; 
            --trikon-orange: #f4a41c;
            --header-height: 90px;
        }
        body { font-family: 'Montserrat', sans-serif; background-color: var(--dark-bg); color: #fff; overflow-x: hidden; scroll-behavior: smooth; }
        .serif { font-family: 'Cinzel', serif; }
        
        /* NAVIGATION BAR */
        .glass-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--header-height);
            z-index: 1000;
            background: #000000; /* Initial Solid Black */
            display: flex;
            align-items: center;
            transition: all 0.5s ease-in-out;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* SCROLLED STATE: TRANSPARENT BACKGROUND */
        .glass-header.scrolled {
            background: transparent !important; /* Fully transparent on scroll */
            border-bottom: 1px solid transparent;
            backdrop-filter: blur(0px);
        }
        
        .nav-link { 
            font-size: 13.5px; 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            color: #ffffff; /* Initial white text */
            transition: 0.4s ease; 
            position: relative;
            padding-bottom: 4px;
        }

        /* CHANGE TEXT COLOR TO DARK ON SCROLL (To be visible on white/light sections) */
        .glass-header.scrolled .nav-link,
        .glass-header.scrolled .fa-chevron-down,
        .glass-header.scrolled .fa-bars-staggered,
        .glass-header.scrolled .logo-subtext {
            color: #000000 !important;
            text-shadow: 0px 0px 1px rgba(255,255,255,0.5); /* Subtle shadow for extra readability */
        }

        /* Adjust logo image visibility on scroll */
        .glass-header.scrolled img {
            filter: brightness(0); /* Makes a white/colored logo black when background is transparent/white */
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background: var(--trikon-orange);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .active-nav::after { width: 100%; }
        .nav-link:hover, .active-nav { color: var(--trikon-orange) !important; }

        .dropdown-link { font-size: 11.5px; font-weight: 600; letter-spacing: 1px; color: #fff; }
        main { padding-top: var(--header-height); }

        /* FLOATING SOCIAL BUTTONS */
        .floating-social-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 9999;
        }
        .social-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .social-btn:hover { transform: scale(1.15) translateY(-5px); }
        .btn-whatsapp { background-color: #25d366; }
        .btn-messenger { background-color: #0084ff; }
    </style>
    @yield('styles')
</head>
<body class="antialiased">

    <header class="glass-header">
        <nav class="w-full px-6 md:px-12 flex justify-between items-center">
            <!-- LOGO SECTION -->
            <a href="/" class="flex items-center">
                @php
                    $logoPath = $settings->logo ?? null;
                    $logoUrl = $logoPath ? asset('storage/' . $logoPath) : null;
                @endphp
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $settings->site_name ?? 'Logo' }}" class="h-14 md:h-16 w-auto object-contain transition-all duration-500">
                @else
                    <div class="flex flex-col leading-none">
                        <span class="serif text-[#f4a41c] font-black text-2xl md:text-3xl tracking-tighter uppercase">{{ $settings->site_name ?? 'TRIKON' }}</span>
                        <span class="logo-subtext text-[8px] text-white tracking-[0.4em] uppercase font-bold transition-colors">Holdings Ltd.</span>
                    </div>
                @endif
            </a>
            
            <!-- DESKTOP MENU -->
            <div class="hidden lg:flex space-x-8 items-center">
                <a href="/" class="nav-link {{ Request::is('/') ? 'active-nav' : '' }}">Home</a>
                
                <!-- About Us Dropdown -->
                <div class="relative group">
                    <a href="javascript:void(0)" class="nav-link flex items-center gap-1 {{ Request::is('about-us*') ? 'active-nav' : '' }}">About Us <i class="fa-solid fa-chevron-down text-[8px] ml-1"></i></a>
                    <div class="absolute left-0 mt-0 w-72 bg-[#f4a41c] hidden group-hover:block shadow-2xl z-50">
                        <a href="/about-us/stories" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] border-b border-white/10 transition-colors uppercase">Our stories</a>
                        <a href="/about-us/why-us" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] border-b border-white/10 transition-colors uppercase">Why Us</a>
                        <a href="/about-us/board-of-directors" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] border-b border-white/10 transition-colors uppercase">Board of Directors</a>
                        <a href="/about-us/management-team" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] border-b border-white/10 transition-colors uppercase">Management Team</a>
                        <a href="/about-us/sister-concerns" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] border-b border-white/10 transition-colors uppercase">Sister Concerns</a>
                        <a href="/about-us/csr" class="block dropdown-link px-6 py-4 hover:bg-[#e09418] transition-colors uppercase">CSR</a>
                    </div>
                </div>

                <a href="/projects/residential/all" class="nav-link {{ Request::is('projects*') ? 'active-nav' : '' }}">Projects</a>

                <a href="{{ route('brokerage') }}" class="nav-link {{ Request::is('brokerage*') ? 'active-nav' : '' }}">Brokerage</a>

                <!-- Services Dropdown -->
                <div class="relative group">
                    <a href="javascript:void(0)" class="nav-link flex items-center gap-1 {{ Request::is('services*') ? 'active-nav' : '' }}">Services <i class="fa-solid fa-chevron-down text-[8px] ml-1"></i></a>
                    <div class="absolute left-0 mt-0 w-64 bg-[#f4a41c] hidden group-hover:block shadow-2xl z-50">
                        @php $navServices = \App\Models\Service::all(); @endphp
                        @forelse($navServices as $service)
                            <a href="{{ route('services.show', $service->slug) }}" class="block px-6 py-4 dropdown-link text-white hover:bg-[#e09418] border-b border-white/10 last:border-0 transition-colors uppercase">{{ $service->name }}</a>
                        @empty
                            <a href="#" class="block px-6 py-4 dropdown-link text-white uppercase italic">No Services</a>
                        @endforelse
                    </div>
                </div>

                <a href="{{ route('news') }}" class="nav-link {{ Request::is('news-events*') ? 'active-nav' : '' }}">News</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ Request::is('blog*') ? 'active-nav' : '' }}">Blog</a>
                <a href="/career" class="nav-link {{ Request::is('career*') ? 'active-nav' : '' }}">Career</a>
                <a href="{{ route('contact') }}" class="nav-link {{ Request::is('contact') ? 'active-nav' : '' }}">Contact</a>
            </div>

            <button onclick="toggleMobileMenu()" class="lg:hidden text-white text-2xl transition-transform active:scale-90"><i class="fa-solid fa-bars-staggered"></i></button>
        </nav>
    </header>

    <!-- MOBILE OVERLAY MENU -->
    <div id="mobile-menu" class="fixed inset-0 bg-black z-[1100] translate-x-full lg:hidden p-12 flex flex-col items-center justify-center gap-6 shadow-2xl transition-transform duration-500 overflow-y-auto">
        <button onclick="toggleMobileMenu()" class="absolute top-10 right-10 text-white text-5xl hover:text-[#f4a41c]">&times;</button>
        <a href="/" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">HOME</a>
        <a href="/about-us/stories" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">ABOUT US</a>
        <a href="/projects/residential/all" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">PROJECTS</a>
        <a href="/brokerage" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">BROKERAGE</a>
        <a href="{{ route('news') }}" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">NEWS</a>
        <a href="{{ route('blog.index') }}" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">BLOG</a>
        <a href="/career" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">CAREER</a>
        <a href="{{ route('contact') }}" class="serif text-xl font-bold text-white hover:text-[#f4a41c]">CONTACT</a>
    </div>

    <!-- MAIN DYNAMIC CONTENT -->
    <main>@yield('content')</main>

    <!-- FLOATING CHAT BUTTONS -->
    <div class="floating-social-buttons">
        @if(isset($settings->whatsapp_number) && $settings->whatsapp_number)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="social-btn btn-whatsapp" title="Chat on WhatsApp">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        @endif
        @if(isset($settings->messenger_id) && $settings->messenger_id)
            <a href="https://m.me/{{ $settings->messenger_id }}" target="_blank" class="social-btn btn-messenger" title="Chat on Messenger">
                <i class="fa-brands fa-facebook-messenger"></i>
            </a>
        @endif
    </div>

    <!-- COMPACT FOOTER -->
    <footer class="bg-[#f4a41c] py-12 px-6 md:px-16 text-white border-t border-black/10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="flex flex-col items-center md:items-start">
                <img src="{{ $logoUrl ?? asset('logo.png') }}" class="h-14 mb-6 brightness-0" alt="Footer Logo">
                <p class="text-[10px] font-bold leading-relaxed uppercase tracking-tight max-w-[250px] text-center md:text-left text-white">
                    Contact us today to learn more about our services and property market possibilities.
                </p>
            </div>
            <div class="md:border-r border-black/30 pr-4">
                <h4 class="text-black font-black uppercase text-sm mb-6 tracking-widest">SERVICES</h4>
                <ul class="text-[11px] font-bold space-y-2 uppercase tracking-widest text-white">
                    <li><a href="#" class="hover:text-black transition-all">Investment</a></li>
                    <li><a href="#" class="hover:text-black transition-all">Joint Venture</a></li>
                    <li><a href="#" class="hover:text-black transition-all">Property Management</a></li>
                </ul>
            </div>
            <div class="md:border-r border-black/30 pr-4">
                <h4 class="text-black font-black uppercase text-sm mb-6 tracking-widest">USEFUL LINKS</h4>
                <ul class="text-[11px] font-bold space-y-2 uppercase tracking-widest text-white">
                    <li><a href="/about-us/stories" class="hover:text-black">Our Story</a></li>
                    <li><a href="/projects/residential/all" class="hover:text-black">Our Projects</a></li>
                    <li><a href="/about-us/why-us" class="hover:text-black">Why Us</a></li>
                    <li><a href="/terms-conditions" class="hover:text-black">Terms & Conditions</a></li>
                    <li><a href="/privacy-policy" class="hover:text-black">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-black font-black uppercase text-sm mb-6 tracking-widest">CONTACT US</h4>
                <div class="text-[10px] font-bold space-y-3 uppercase tracking-widest text-white leading-relaxed">
                    <p class="flex items-center gap-3"><i class="fa-solid fa-phone"></i> {{ $settings->contact_phone ?? '+8801633530231' }}</p>
                    <p class="flex items-center gap-3"><i class="fa-solid fa-envelope"></i> {{ $settings->contact_email ?? 'info@trikonholdings.com' }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- COPYRIGHT BAR -->
    <div class="bg-black py-4 px-6 text-center text-white text-[10px] font-bold uppercase tracking-[0.2em]">
        © {{ date('Y') }}. All rights reserved by Trikon. Developed by Trikon it
    </div>

    <!-- GLOBAL SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() { if (typeof AOS !== 'undefined') { AOS.init({ duration: 1200, once: true }); } });
        
        // SCROLL LOGIC: Initially black, changes to fully transparent when scrolled
        window.addEventListener('scroll', function() { 
            const header = document.querySelector('.glass-header'); 
            if (window.scrollY > 80) {
                header.classList.add('scrolled'); 
            } else {
                header.classList.remove('scrolled'); 
            }
        });

        function toggleMobileMenu() { document.getElementById('mobile-menu').classList.toggle('translate-x-full'); }
    </script>
    @stack('scripts')
</body>
</html>