@extends('layouts.app')

@section('styles')
<style>
    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; }
    
    /* Card specific styling to match reference */
    .career-card {
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid #e5e7eb;
        background: #fff;
    }
    .career-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.1);
    }
    .career-card img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensuring it fills the area without being squished */
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- SECTION 1: HERO SECTION (Matches Reference) -->
    <section class="relative h-[40vh] md:h-[50vh] flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0">
            <!-- Modern Building Background -->
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 text-center" data-aos="fade-up">
            <h1 class="serif-title text-white text-5xl md:text-7xl tracking-widest">Career</h1>
            <div class="w-16 h-1 bg-[#f4a41c] mx-auto mt-6"></div>
        </div>
    </section>

    <!-- SECTION 2: JOB GRID (4-Columns as per reference) -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            @forelse($jobs as $job)
            <div class="career-card group flex flex-col h-full rounded-sm" data-aos="fade-up">
                <!-- Image Container (Perfectly Sized) -->
                <a href="{{ route('career.show', $job->slug) }}" class="block aspect-square overflow-hidden bg-gray-100 border-b border-gray-100">
                    <img src="{{ asset('storage/' . $job->image) }}" 
                         class="transition-transform duration-1000 group-hover:scale-110" 
                         alt="{{ $job->title }}">
                </a>

                <!-- Content Area -->
                <div class="p-6 flex-grow">
                    <a href="{{ route('career.show', $job->slug) }}">
                        <h3 class="serif-title text-base text-gray-900 group-hover:text-[#f4a41c] transition-colors leading-tight mb-8 h-12 overflow-hidden">
                            {{ $job->title }}
                        </h3>
                    </a>

                    <!-- Labels (Matching reference typography) -->
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-900 font-black text-[10px] uppercase tracking-widest mb-1">Job Status:</p>
                            <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest">{{ $job->type }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-900 font-black text-[10px] uppercase tracking-widest mb-1">Job Location:</p>
                            <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest">{{ $job->location }}</p>
                        </div>

                        <div>
                            <p class="text-gray-900 font-black text-[10px] uppercase tracking-widest mb-1">Job Salary:</p>
                            <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest">{{ $job->salary ?? 'Negotiable' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-100 rounded-2xl">
                <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No open positions currently available.</p>
            </div>
            @endforelse
        </div>
    </section>

</div>
@endsection