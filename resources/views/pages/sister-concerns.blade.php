@extends('layouts.app')

@section('styles')
<style>
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.15); 
        text-transform: uppercase;
        letter-spacing: 0.1em;
        line-height: 1;
        pointer-events: none;
    }
    .hero-title { font-family: 'Cinzel', serif; line-height: 1.1; }
    .bg-number {
        font-family: 'Cinzel', serif;
        position: absolute;
        font-size: 15vw;
        font-weight: 900;
        color: rgba(0,0,0,0.03);
        z-index: 0;
        top: -50px;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen overflow-hidden">

    <!-- SECTION 1: HERO -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1449156001437-37e671782f13?q=80&w=2070" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6"></p>
            <div class="relative">
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">TRIKON</h2>
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10">
                    SISTER <span class="text-[#f4a41c]">CONCERNS</span>
                </h1>
            </div>
            <div class="mt-10 flex flex-col items-center">
                <div class="w-24 h-[2px] bg-[#f4a41c]"></div>
                <p class="text-white/70 italic text-[10px] md:text-xs font-bold uppercase tracking-[0.5em] mt-6"></p>
            </div>
        </div>
    </section>

    <!-- SECTION 2: LISTING -->
    <div class="max-w-7xl mx-auto px-6 py-32">
        @forelse($concerns as $index => $concern)
            <div class="relative mb-48 last:mb-0" data-aos="fade-up">
                <div class="bg-number {{ $index % 2 == 0 ? '-left-10' : '-right-10' }}">0{{ $index + 1 }}</div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">

                    <!-- Media Column (Using Logo from Admin) -->
                    <div class="lg:col-span-6 {{ $index % 2 != 0 ? 'lg:order-2' : '' }}">
                        <div class="bg-white p-12 md:p-20 rounded-[40px] border border-gray-100 shadow-2xl flex items-center justify-center aspect-video group hover:border-[#f4a41c]/30 transition-all duration-500">

                            @if($concern->logo)
                                @php
                                    $logo = $concern->logo;
                                    if (Str::startsWith($logo, ['http://', 'https://'])) {
                                        $logoUrl = $logo;
                                    } else {
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $logo), '/');
                                        $logoUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $logoUrl }}"
                                     class="max-w-full max-h-48 object-contain transform group-hover:scale-110 transition-transform duration-700"
                                     alt="{{ $concern->name }}"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x200?text=Logo+Not+Found';">
                            @else
                                <div class="text-gray-200 font-black uppercase text-xl italic tracking-tighter">TRIKON GROUP</div>
                            @endif
                        </div>
                    </div>

                    <!-- Text Column -->
                    <div class="lg:col-span-6 {{ $index % 2 != 0 ? 'lg:order-1' : '' }}">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-[2px] bg-[#f4a41c]"></div>
                            <h2 class="serif text-3xl md:text-5xl text-gray-900 font-black uppercase tracking-tight">{{ $concern->name }}</h2>
                        </div>
                        <div class="text-gray-500 leading-loose space-y-6 text-sm md:text-base mb-10 text-justify font-medium">
                            {!! $concern->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center py-20 text-gray-400">No content available.</p>
        @endforelse
    </div>

</div>
@endsection