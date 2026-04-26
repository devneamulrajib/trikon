@extends('layouts.app')

@section('styles')
<style>
    /* 1. Custom Styles for Bangla Text Readability */
    .blog-content-body {
        font-family: 'Hind Siliguri', 'Montserrat', sans-serif;
        color: #1a1a1a;
        line-height: 1.8;
        font-size: 1.25rem; /* Matches common editor sizes */
        text-align: left; /* Ensures content starts from the left */
    }

    /* 2. Style resets to match Admin Panel Editor exactly */
    .blog-content-body h1, .blog-content-body h2, .blog-content-body h3 {
        font-weight: 800;
        color: #000;
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.3;
        text-align: left;
    }
    
    .blog-content-body p {
        margin-bottom: 1.5rem;
    }

    .blog-content-body strong {
        font-weight: 700;
        color: #000;
    }

    .blog-content-body ul, .blog-content-body ol {
        margin-left: 1.5rem;
        margin-bottom: 1.5rem;
        list-style-type: disc;
    }

    /* 3. Handling full-width image */
    .full-hero {
        height: 100vh;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- SECTION 1: FULL SIZE COVER PHOTO (No Gap, First thing user sees) -->
    <section class="full-hero relative overflow-hidden bg-black">
        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
             class="w-full h-full object-cover" 
             alt="{{ $blog->title }}">
    </section>

    <!-- SECTION 2: BLOG CONTENT (Matching Admin Panel Layout) -->
    <article class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            
            <!-- Blog Title (Left Aligned) -->
            <div class="mb-12" data-aos="fade-up">
                <span class="text-[#f4a41c] font-black text-[11px] uppercase tracking-[0.4em] mb-4 block">Trikon Heritage Insights</span>
                <h1 class="serif text-4xl md:text-6xl font-black text-gray-900 leading-tight">
                    {{ $blog->title }}
                </h1>
                <div class="flex items-center gap-4 mt-6 text-gray-400 text-xs font-bold uppercase tracking-widest">
                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</span>
                    <span>•</span>
                    <span>Trikon Editorial</span>
                </div>
            </div>

            <!-- MAIN BODY: The exact content from Admin Panel -->
            <div class="blog-content-body prose prose-xl max-w-none prose-neutral" data-aos="fade-up">
                @if($blog->content)
                    {!! $blog->content !!}
                @else
                    <p class="text-gray-400 italic">Content is loading...</p>
                @endif
            </div>

            <!-- Share and Bottom Divider -->
            <div class="mt-20 pt-10 border-t border-gray-100 flex items-center justify-between">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Share this Story</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#f4a41c] hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#f4a41c] hover:text-white transition-all"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </article>

    <!-- SECTION 3: CONTACT FORM (Standard footer integration) -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div data-aos="fade-right">
                <h2 class="serif text-4xl font-black uppercase mb-16 text-gray-900 tracking-tighter">
                    <span class="text-[#f4a41c]">CONTACT</span> US
                </h2>
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
                            <p class="text-[9px] uppercase font-bold text-gray-400 tracking-[0.3em] mb-1">HQ Address</p>
                            <p class="text-gray-600 font-bold text-sm leading-relaxed max-w-sm uppercase">
                                {{ $settings->address ?? 'Bashundhara RD, Dhaka, Bangladesh' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 shadow-2xl rounded-3xl border border-gray-50" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div class="relative">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div class="relative">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div class="relative">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="3" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10 rounded-full">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection