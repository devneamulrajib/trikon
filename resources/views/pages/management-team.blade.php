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
    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">

    <!-- SECTION 1: HERO -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a?q=80&w=2070" class="w-full h-full object-cover opacity-50" alt="Management Background">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>
        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <div class="relative">
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">
                    TRIKON
                </h2>
                <h1 class="hero-title text-white text-4xl md:text-7xl font-black uppercase relative z-10">
                    MANAGEMENT <span class="text-[#f4a41c]">TEAM</span>
                </h1>
            </div>
            <div class="mt-10 flex flex-col items-center gap-4">
                <div class="w-24 h-[2px] bg-[#f4a41c]"></div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: BOARD OF DIRECTORS -->
    <section class="py-24 px-6 md:px-20 max-w-7xl mx-auto">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-[#f4a41c] text-[10px] font-black uppercase tracking-[0.5em] mb-4">Leadership</h2>
            <h3 class="serif text-3xl font-bold text-gray-900 uppercase tracking-widest">Board of <span class="text-[#f4a41c]">Directors</span></h3>
            <div class="w-16 h-[1px] bg-[#f4a41c] mx-auto mt-6"></div>
        </div>

        @foreach($directors as $index => $director)
            <div class="flex flex-col {{ $index % 2 != 0 ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-12 md:gap-24 mb-32 last:mb-0">

                <!-- PORTRAIT -->
                <div class="w-full md:w-4/12 text-center" data-aos="zoom-in">
                    <div class="relative inline-block">
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full border-[10px] border-[#f4a41c]/20 p-2">
                            <div class="w-full h-full rounded-full border-4 border-[#f4a41c] overflow-hidden shadow-2xl">
                                @php
                                    $img = $director->image;
                                    if (Str::startsWith($img, ['http://', 'https://'])) {
                                        $imgUrl = $img;
                                    } else {
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                        $imgUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $director->name }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x400?text=Director+Image';">
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="serif text-2xl font-bold text-gray-900 uppercase">{{ $director->name }}</h3>
                        <p class="text-[#f4a41c] font-black uppercase text-xs tracking-widest mt-2">{{ $director->designation }}</p>
                    </div>
                </div>

                <!-- BIOGRAPHY -->
                <div class="w-full md:w-8/12" data-aos="fade-up">
                    <div class="text-gray-600 text-sm md:text-base leading-relaxed text-justify space-y-6 font-medium">
                        {!! nl2br(e($director->description)) !!}
                    </div>
                </div>

            </div>
        @endforeach
    </section>

    <!-- DIVIDER -->
    <div class="max-w-7xl mx-auto px-6 md:px-20">
        <div class="border-t border-gray-100"></div>
    </div>

    <!-- SECTION 3: MANAGEMENT TEAM GRID -->
    <section class="relative py-24 px-6 overflow-hidden bg-white">
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.03] pointer-events-none select-none">
            <img src="{{ asset('logo.png') }}" class="w-[800px] grayscale" alt="Watermark">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-[#f4a41c] text-[10px] font-black uppercase tracking-[0.5em] mb-4">Leadership</h2>
                <h3 class="serif text-3xl font-bold text-gray-900 uppercase tracking-widest">Management <span class="text-[#f4a41c]">Team</span></h3>
                <div class="w-16 h-[1px] bg-[#f4a41c] mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-20">
                @foreach($members as $member)
                <div class="text-center group" data-aos="fade-up">
                    <div class="relative inline-block mb-6">
                        <div class="w-48 h-48 rounded-full border-2 border-gray-100 p-2 transition-all duration-500 group-hover:border-[#f4a41c]">
                            <div class="w-full h-full rounded-full overflow-hidden border-2 border-[#f4a41c] shadow-lg">
                                @php
                                    $img = $member->image;
                                    if (Str::startsWith($img, ['http://', 'https://'])) {
                                        $imgUrl = $img;
                                    } else {
                                        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $img), '/');
                                        $imgUrl = asset($cleanPath);
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $member->name }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x400?text=Member+Image';">
                            </div>
                        </div>
                    </div>
                    <h4 class="serif text-lg font-bold text-gray-900 uppercase tracking-tight">{{ $member->name }}</h4>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-2">{{ $member->designation }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 4: FULL-WIDTH TEAM PHOTO -->
    <section class="w-full bg-white overflow-hidden leading-[0]">
        @if($gallery->count() > 0)
            @php
                $galleryImg = $gallery->first()->image;
                if (Str::startsWith($galleryImg, ['http://', 'https://'])) {
                    $galleryUrl = $galleryImg;
                } else {
                    $cleanGalleryPath = ltrim(Str::replaceFirst('storage/', '', $galleryImg), '/');
                    $galleryUrl = asset($cleanGalleryPath);
                }
            @endphp
            <img src="{{ $galleryUrl }}"
                 class="w-full h-auto object-cover max-h-[90vh]"
                 alt="Full Width Team Photo"
                 onerror="this.onerror=null;this.src='https://placehold.co/1920x800?text=Team+Gallery+Image';">
        @endif
    </section>

</div>
@endsection