@extends('layouts.app')

@section('styles')
<style>
    /* 1. Rangs Model Styling for Homepage Projects */
    .home-project-card {
        aspect-ratio: 3 / 4.2;
    }
    .serif-title { font-family: 'Cinzel', serif; }

    /* 2. Modern Services Styling - Zero Gap Edge-to-Edge */
    .service-container-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0; /* Removed Gaps */
    }
    
    @media (max-width: 768px) {
        .service-container-row {
            grid-template-columns: 1fr;
        }
    }

    .service-block {
        position: relative;
        height: 500px;
        overflow: hidden;
    }

    .service-block img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s ease;
    }

    .service-block:hover img {
        transform: scale(1.1);
    }

    /* Subtle overlay filter to match the 2nd screenshot */
    .service-block-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        transition: background 0.5s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 40px;
        z-index: 10;
    }

    .service-block:hover .service-block-overlay {
        background: rgba(244, 164, 28, 0.2); /* Subtle Orange Tint on hover */
    }
</style>
@endsection

@section('content')

<!-- SECTION 1: HERO SLIDER -->
<section class="relative h-screen w-full overflow-hidden bg-black">
    <div class="swiper heroSwiper h-full w-full">
        <div class="swiper-wrapper">
            @foreach($sliders ?? [] as $slide)
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-black/20 z-10"></div>
                <img src="{{ asset('storage/' . $slide->image) }}" class="w-full h-full object-cover" alt="Slider">
                
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-6">
                    <h2 class="serif text-white text-4xl md:text-6xl font-bold tracking-tight mb-4" data-aos="fade-up">
                        {{ $slide->title }}
                    </h2>
                    <p class="text-white text-lg font-medium max-w-2xl" data-aos="fade-up" data-aos-delay="200">
                        {{ $slide->subtitle ?? 'Excellence in Every Square Foot' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination !bottom-10"></div>
    </div>
</section>

<!-- SECTION 2: WELCOME SECTION -->
<section class="relative py-24 bg-black overflow-hidden border-b border-white/5">
    <div class="absolute right-0 top-0 h-full w-1/2 opacity-10 pointer-events-none">
        <svg viewBox="0 0 100 100" class="h-full w-full fill-white">
            <path d="M50 5 L95 95 L5 95 Z M50 25 L80 85 L20 85 Z" />
        </svg>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="max-w-2xl" data-aos="fade-right">
            <h4 class="text-white text-xl font-bold mb-2">Welcome to</h4>
            <h2 class="text-[#f4a41c] text-3xl md:text-4xl font-extrabold uppercase mb-8">Trikon Holdings Ltd</h2>
            
            <div class="space-y-6 text-white/90 text-sm leading-relaxed font-light">
                <p>We are delighted to extend a warm welcome to you as you explore the world of Trikon Holdings Limited - a name synonymous with excellence in property development.</p>
                <p>Our story is one of passion, commitment to quality, and a vision that reaches beyond the horizon. Trikon transforms luxury into a legacy.</p>
                <p>Thank you for choosing Trikon Holdings Limited. We look forward to sharing our vision and helping you discover perfection.</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: OUR PROJECTS (4-Column Rangs Model) -->
<section class="py-24 bg-[#f4a41c]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="serif-title text-white text-4xl md:text-6xl font-black uppercase tracking-widest">
                OUR <span class="text-gray-900">PROJECTS</span>
            </h2>
            <div class="w-16 h-1 bg-gray-900 mx-auto mt-4 mb-6"></div>
            <p class="text-gray-900 font-bold text-[10px] uppercase tracking-[0.3em] max-w-3xl mx-auto">
                Where excellence is redefined through top-tier property solutions.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($projects ?? [] as $project)
            <a href="{{ url('/project/' . $project->slug) }}" class="group relative block overflow-hidden shadow-2xl home-project-card bg-gray-800" data-aos="fade-up">
                <img src="{{ asset('storage/' . $project->featured_image) }}" 
                     class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-110" 
                     alt="{{ $project->title }}">
                
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 bg-black/50 backdrop-blur-[2px]">
                    <h3 class="text-white font-black text-2xl uppercase tracking-tighter mb-2">{{ $project->title }}</h3>
                    <div class="w-10 h-[1px] bg-[#f4a41c] mb-4"></div>
                    <p class="text-white/80 text-[10px] font-bold uppercase tracking-[0.3em]">
                        {{ $project->location ?? 'Bashundhara R/A' }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('projects.residential') }}" class="inline-block px-12 py-4 bg-gray-900 text-white font-black uppercase text-[10px] tracking-[0.5em] hover:bg-white hover:text-gray-900 transition-all shadow-xl">
                Explore All Projects
            </a>
        </div>
    </div>
</section>

<!-- SECTION 4: OUR SERVICES (Edge-to-Edge Grid - Matching 2nd Screenshot) -->
<section class="bg-white">
    <div class="text-center py-24" data-aos="fade-up">
        <h2 class="serif text-gray-900 text-4xl md:text-5xl font-black uppercase tracking-widest">
            Our <span class="text-[#f4a41c]">Services</span>
        </h2>
    </div>

    <!-- Container with NO GAPS and NO SIDE PADDING -->
    <div class="service-container-row">
        @php $services = \App\Models\Service::limit(3)->get(); @endphp
        @foreach($services as $service)
        <a href="{{ route('services.show', $service->slug) }}" class="service-block group">
            <img src="{{ asset('storage/' . $service->hero_image) }}" alt="{{ $service->name }}">
            
            <div class="service-block-overlay">
                <h3 class="serif text-2xl text-white font-bold uppercase tracking-[0.3em] group-hover:scale-110 transition-transform duration-500 drop-shadow-2xl">
                    {{ $service->name }}
                </h3>
                <!-- Animated line under title -->
                <div class="w-0 group-hover:w-16 h-[2px] bg-[#f4a41c] mt-6 transition-all duration-500"></div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<!-- SECTION 5: MODERNIZED WRITE US YOUR QUERY -->
<section class="py-32 bg-black border-t border-white/5 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-gray-500 text-xs font-bold uppercase tracking-[0.6em] mb-4">Inquiry</h2>
            <h3 class="serif text-white text-4xl md:text-5xl font-black uppercase tracking-widest">Write Us <span class="text-[#f4a41c]">Your Query</span></h3>
            <div class="w-16 h-[2px] bg-[#f4a41c] mx-auto mt-8"></div>
        </div>

        <form action="{{ route('contact.send') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
            @csrf
            <div class="relative group">
                <input type="text" name="name" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Full Name *</label>
            </div>
            <div class="relative group">
                <input type="email" name="email" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Email Address *</label>
            </div>
            <div class="relative group md:col-span-2">
                <input type="text" name="phone" required placeholder=" " class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300">
                <label class="absolute left-0 top-3 text-gray-400 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Phone Number *</label>
            </div>
            <div class="relative group md:col-span-2">
                <textarea name="message" required placeholder=" " rows="3" class="peer w-full bg-transparent border-b-2 border-white/10 py-3 text-white focus:outline-none focus:border-[#f4a41c] transition-all duration-300 resize-none"></textarea>
                <label class="absolute left-0 top-3 text-gray-500 text-xs font-bold uppercase tracking-widest transition-all duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:top-3 peer-focus:-top-6 peer-focus:text-[10px] peer-focus:text-[#f4a41c] pointer-events-none">Your Detailed Query *</label>
            </div>
            <div class="md:col-span-2 text-center mt-12">
                <button type="submit" class="inline-block px-20 py-5 bg-[#f4a41c] text-white font-black uppercase text-[10px] tracking-[0.4em] hover:bg-white hover:text-black transition-all shadow-2xl rounded-sm">Submit Inquiry</button>
            </div>
        </form>
    </div>
</section>

<!-- SECTION 6: GOOGLE MAP (FIXED FOR FULL WIDTH) -->
<section class="w-full h-[500px] grayscale contrast-125 border-t border-white/5">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1819962222226!2d90.4222225759289!3d23.81212648640261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c705aa134d71%3A0x1c8797d1479bcdb!2sTrikon%20Holdings%20Ltd.!5e0!3m2!1sen!2sbd!4v1777450989693!5m2!1sen!2sbd" 
        width="100%" 
        height="100%" 
        style="border:0; display:block;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

@endsection

@push('scripts')
<script>
    new Swiper(".heroSwiper", {
        speed: 1500,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
    });
</script>
@endpush