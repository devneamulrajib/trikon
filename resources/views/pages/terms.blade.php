@extends('layouts.app')

@section('styles')
<style>
    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; }
    .hero-text-shadow { text-shadow: 0px 4px 30px rgba(0,0,0,0.5); }
    
    /* Content Styling for the RichEditor output */
    .policy-content {
        font-family: 'Montserrat', sans-serif;
        line-height: 2;
        color: #444;
    }
    .policy-content h1, .policy-content h2, .policy-content h3 {
        font-family: 'Cinzel', serif;
        color: #111;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .policy-content p { margin-bottom: 1.5rem; text-align: justify; }
    .policy-content ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1.5rem; }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- SECTION 1: COVER PHOTO -->
    <section class="relative h-[50vh] md:h-[60vh] flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0">
            <!-- Premium Corporate/Legal Background -->
            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070" class="w-full h-full object-cover opacity-60" alt="Terms and Conditions">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-white"></div>
        </div>
        
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <h1 class="serif-title text-4xl md:text-7xl text-white tracking-widest hero-text-shadow">
                Terms & <span class="text-[#f4a41c]">Conditions</span>
            </h1>
            <div class="w-20 h-1 bg-[#f4a41c] mx-auto mt-6"></div>
        </div>
    </section>

    <!-- SECTION 2: CONTENT AREA -->
    <section class="py-24 px-6 md:px-12 bg-white">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <div class="policy-content prose prose-xl max-w-none">
                @if($settings && $settings->terms_content)
                    {!! $settings->terms_content !!}
                @else
                    <p class="text-center text-gray-400 italic py-20">Terms and conditions are currently being updated by our legal team.</p>
                @endif
            </div>
        </div>
    </section>

</div>
@endsection