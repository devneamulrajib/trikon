@extends('layouts.app')

@section('content')
@php 
    // This pulls the data you just saved in the admin panel
    $brokerage = \App\Models\Brokerage::first(); 
@endphp

<!-- Hero Section -->
<section class="relative h-[65vh] w-full overflow-hidden bg-black">
    @if($brokerage && $brokerage->hero_image)
        <img src="{{ asset('storage/' . $brokerage->hero_image) }}" class="w-full h-full object-cover opacity-50" alt="Brokerage Banner">
    @else
        <!-- Fallback if no image is uploaded -->
        <div class="w-full h-full bg-neutral-900"></div>
    @endif
    
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
        <h1 class="serif text-white text-4xl md:text-7xl font-black uppercase tracking-widest" data-aos="fade-up">
            {{ $brokerage->title ?? 'Brokerage' }}
        </h1>
        <div class="w-20 h-1 bg-[#f4a41c] my-6" data-aos="zoom-in"></div>
        <p class="text-white text-sm md:text-lg font-medium uppercase tracking-[0.4em]" data-aos="fade-up" data-aos-delay="200">
            {{ $brokerage->subtitle ?? 'Excellence in Real Estate' }}
        </p>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        @if($brokerage && $brokerage->content)
            <div class="prose prose-lg max-w-none brokerage-content text-gray-800">
                {!! $brokerage->content !!}
            </div>
        @else
            <div class="text-center py-20">
                <p class="serif text-gray-400 italic text-xl">Our brokerage service details are being updated. Please check back soon.</p>
                <a href="/contact" class="inline-block mt-8 px-8 py-3 bg-[#f4a41c] text-white font-bold uppercase tracking-widest">Inquire Now</a>
            </div>
        @endif
    </div>
</section>

<style>
    /* Styling for the content coming from the Rich Editor */
    .brokerage-content h2, .brokerage-content h3 { 
        font-family: 'Cinzel', serif; 
        font-weight: 700; 
        text-transform: uppercase; 
        color: #111; 
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .brokerage-content p { 
        margin-bottom: 1.5rem; 
        line-height: 1.8; 
        font-size: 17px;
    }
    .brokerage-content ul { list-style: disc; margin-left: 1.5rem; margin-bottom: 1.5rem; }
</style>
@endsection