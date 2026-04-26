@extends('layouts.app')

@section('styles')
<style>
    .text-outline {
        -webkit-text-stroke: 1px rgba(197, 160, 89, 0.3);
        color: transparent;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(197, 160, 89, 0.1);
    }
    .gold-glow:hover {
        box-shadow: 0 0 30px rgba(197, 160, 89, 0.1);
        border-color: rgba(197, 160, 89, 0.5);
    }
    @keyframes zoom {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }
    .animate-zoom {
        animation: zoom 20s infinite alternate linear;
    }
</style>
@endsection

@section('content')
<div class="bg-[#050505] text-white overflow-hidden">

    <!-- SECTION 1: IMMERSIVE HERO (Updated with old cover image + new style) -->
    <div class="relative h-screen flex items-center justify-center">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Image of engineer/construction worker matching your old site -->
            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070" 
                 class="w-full h-full object-cover opacity-40 animate-zoom">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-[#050505]"></div>
        
        <div class="relative z-10 text-center px-6">
            <span class="text-gold text-[10px] uppercase tracking-[1em] mb-4 block" data-aos="fade-down">The Architectural Heritage</span>
            <h1 class="serif text-6xl md:text-9xl font-black uppercase leading-none mb-4" data-aos="zoom-in">
                <span class="block">The Trikon</span>
                <span class="text-outline block mt-2">Standard</span>
            </h1>
            <div class="mt-10 flex justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
                <div class="w-20 h-[1px] bg-gold self-center"></div>
                <p class="serif italic text-gold text-lg">Since 2012</p>
                <div class="w-20 h-[1px] bg-gold self-center"></div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: THE PHILOSOPHY (Image Removed, Clean Center Layout) -->
    <div class="max-w-4xl mx-auto px-6 py-32 text-center">
        <div data-aos="fade-up">
            <h2 class="serif text-4xl md:text-6xl uppercase tracking-widest mb-10 leading-tight">
                Beyond <br> <span class="text-gold">Real Estate.</span>
            </h2>
            <p class="text-gray-400 text-lg leading-loose tracking-wide font-light mb-12">
                Trikon Holdings isn't just a developer; we are curators of a lifestyle. Our philosophy is rooted in the belief that luxury should be felt, not just seen. Every project is an architectural symphony, blending modern technology with timeless aesthetics to create sanctuaries that reflect the prestige of those who call them home.
            </p>
            
            <div class="grid grid-cols-2 gap-10 border-t border-white/5 pt-12 max-w-2xl mx-auto">
                <div>
                    <span class="serif text-4xl text-gold block mb-2">12+</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Years of Excellence</span>
                </div>
                <div>
                    <span class="serif text-4xl text-gold block mb-2">500+</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Luxury Handovers</span>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: CORE PILLARS (Modern Glass Grid) -->
    <div class="bg-[#080808] py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h3 class="serif text-3xl uppercase tracking-[0.4em]">Our Core Pillars</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-white/5">
                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">01</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Strategic Location</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">We select land only in prime zones where convenience meets appreciation.</p>
                </div>

                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">02</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Design Purity</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">Collaborating with global consultants to ensure functional layouts and structural integrity.</p>
                </div>

                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">03</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Quality Control</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">Uncompromising use of the world's finest materials—setting new industry standards.</p>
                </div>

                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">04</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Time Commitment</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">Punctuality is our signature. We pride ourselves on delivering keys exactly when promised.</p>
                </div>

                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">05</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Post-Sales Care</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">Our relationship begins at handover. We provide comprehensive property management.</p>
                </div>

                <div class="p-12 glass-card gold-glow transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <span class="text-gold serif text-5xl opacity-20 group-hover:opacity-100 transition duration-500">06</span>
                    <h4 class="serif text-lg uppercase tracking-widest mt-8 mb-4">Urban Wellness</h4>
                    <p class="text-gray-500 text-xs leading-relaxed font-light">Integrating green spaces and smart home tech to promote health and sustainability.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4: THE MAGAZINE SECTION -->
    <div class="py-32 bg-black">
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative grid grid-cols-12 gap-10">
                <div class="col-span-12 md:col-span-5 self-center" data-aos="fade-right">
                    <h5 class="serif text-gold text-sm tracking-[0.5em] uppercase mb-6">The Firsts</h5>
                    <h2 class="serif text-5xl uppercase tracking-tighter leading-none mb-10">
                        Pioneering <br>
                        <span class="text-outline">Innovation</span>
                    </h2>
                    <p class="text-gray-500 text-sm italic font-light">
                        Trikon was the first in the region to introduce Unitized Double-Glazed System walls, providing 100% thermal and sound insulation.
                    </p>
                </div>

                <div class="col-span-12 md:col-span-7" data-aos="fade-left">
                    <div class="w-full h-[500px] relative overflow-hidden group border border-white/10">
                        <img src="https://images.unsplash.com/photo-1481253127861-534498168948?q=80&w=1973" 
                             class="w-full h-full object-cover grayscale opacity-60 group-hover:opacity-100 group-hover:scale-105 transition duration-1000">
                        <div class="absolute bottom-10 right-10 text-right bg-black/60 p-6 backdrop-blur-md">
                            <span class="serif text-gold text-6xl font-black block">01</span>
                            <span class="text-[9px] uppercase tracking-widest font-bold">Leading the Skyline</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection