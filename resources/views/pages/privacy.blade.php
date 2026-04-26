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
            <!-- Premium Security/Privacy Background -->
            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070" class="w-full h-full object-cover opacity-50" alt="Privacy Policy">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-white"></div>
        </div>
        
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <h1 class="serif-title text-4xl md:text-7xl text-white tracking-widest hero-text-shadow">
                Privacy <span class="text-[#f4a41c]">Policy</span>
            </h1>
            <div class="w-20 h-1 bg-[#f4a41c] mx-auto mt-6"></div>
        </div>
    </section>

    <!-- SECTION 2: CONTENT AREA -->
    <section class="py-24 px-6 md:px-12 bg-white">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <div class="policy-content prose prose-xl max-w-none">
                @if($settings && $settings->privacy_content)
                    {!! $settings->privacy_content !!}
                @else
                    <p class="text-center text-gray-400 italic py-20">Our privacy statement is currently being updated to ensure your maximum protection.</p>
                @endif
            </div>
        </div>
    </section>

</div>
@endsection