@extends('layouts.app')

@section('styles')
<style>
    [x-cloak] { display: none !important; }
    
    /* Styling for clear readability on top of the newspaper background */
    .hero-text-shadow {
        text-shadow: 0px 4px 25px rgba(0,0,0,0.9);
    }

    /* "Why Us" Style Typography */
    .outline-text {
        font-family: 'Cinzel', serif;
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.4); 
        text-transform: uppercase;
        letter-spacing: 0.1em;
        line-height: 1;
        pointer-events: none;
    }
    .hero-title {
        font-family: 'Cinzel', serif;
        line-height: 1.1;
        text-shadow: 0px 4px 30px rgba(0,0,0,0.5);
    }

    /* Custom Scrollbar for Modal */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #f4a41c; border-radius: 10px; }

    .serif-title { font-family: 'Cinzel', serif; font-weight: 900; text-transform: uppercase; }
</style>
@endsection

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="bg-white min-h-screen overflow-hidden" 
     x-data="{ 
        open: false, 
        active: { title: '', desc: '', img: '', date: '' },
        launch(data) {
            this.active = data;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.open = false;
            document.body.style.overflow = 'auto';
        }
     }">
    
    <!-- SECTION 1: MODERN HERO SECTION (Requested Newspaper Photo) -->
    <section class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070" 
                 class="w-full h-full object-cover" 
                 alt="News & Events Cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-6" data-aos="zoom-in">
            <p class="text-[#f4a41c] text-[10px] md:text-xs font-black uppercase tracking-[0.6em] mb-6 hero-text-shadow"></p>
            <div class="relative">
                <h2 class="outline-text text-8xl md:text-[14rem] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 select-none">TRIKON</h2>
                <h1 class="hero-title text-white text-4xl md:text-8xl font-black uppercase relative z-10 leading-tight">
                    NEWS <span class="text-[#f4a41c]">&</span> EVENTS
                </h1>
            </div>
            <div class="mt-12 flex flex-col items-center">
                <div class="w-24 h-[2px] bg-[#f4a41c] shadow-lg"></div>
                <p class="text-white italic text-[11px] md:text-sm font-medium uppercase tracking-[0.4em] mt-8 hero-text-shadow">
                    
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION 2: ALTERNATING NEWS CONTENT (Gap added with pt-32) -->
    <section class="pt-24 md:pt-32 pb-20">
        @forelse($news as $index => $item)
            <div class="grid grid-cols-1 md:grid-cols-2 items-stretch border-b border-gray-100 min-h-[550px] mb-12 last:mb-0">
                
                <!-- IMAGE SIDE -->
                <div class="relative overflow-hidden group {{ $index % 2 != 0 ? 'md:order-2' : '' }}">
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-110" 
                         alt="{{ $item->title }}">
                    
                    <div @click="launch({ 
                            title: {{ json_encode($item->title) }}, 
                            desc: {{ json_encode($item->description) }}, 
                            img: '{{ asset('storage/' . $item->image) }}',
                            date: '{{ $item->published_at->format('M d, Y') }}'
                         })" 
                         class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-all cursor-pointer flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-[#f4a41c] text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-500 flex items-center justify-center">
                            <i class="fa-solid fa-plus text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- TEXT SIDE -->
                <div class="flex items-center p-12 md:p-24 {{ $index % 2 != 0 ? 'md:order-1' : '' }}">
                    <div data-aos="{{ $index % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                        <p class="text-[#f4a41c] font-black text-[10px] uppercase tracking-[0.4em] mb-6">
                            {{ $item->published_at->format('M d, Y') }}
                        </p>
                        <h2 class="serif-title text-2xl md:text-4xl text-gray-900 mb-8 leading-tight tracking-tight uppercase cursor-pointer hover:text-[#f4a41c] transition-colors"
                            @click="launch({ 
                                title: {{ json_encode($item->title) }}, 
                                desc: {{ json_encode($item->description) }}, 
                                img: '{{ asset('storage/' . $item->image) }}',
                                date: '{{ $item->published_at->format('M d, Y') }}'
                             })">
                            {{ $item->title }}
                        </h2>
                        <div class="text-gray-500 leading-loose text-sm md:text-base mb-10 text-justify line-clamp-4">
                            {!! strip_tags($item->description) !!}
                        </div>
                        <button @click="launch({ 
                                title: {{ json_encode($item->title) }}, 
                                desc: {{ json_encode($item->description) }}, 
                                img: '{{ asset('storage/' . $item->image) }}',
                                date: '{{ $item->published_at->format('M d, Y') }}'
                             })" 
                             class="text-gray-900 font-black uppercase text-[10px] tracking-[0.4em] border-b-2 border-[#f4a41c] pb-2 hover:text-[#f4a41c] transition-all">
                            Read More
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="text-center py-40">
                <p class="text-gray-400 uppercase tracking-widest font-black">No recent events found.</p>
            </div>
        @endforelse
    </section>

    <!-- SECTION 3: CONTACT FORM -->
    <section class="py-24 bg-[#fcfcfc] border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-start">
            <div data-aos="fade-right" class="pt-10">
                <h2 class="serif-title text-3xl text-gray-900 mb-16 tracking-tighter">
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
                                {{ $settings->address ?? 'Dhaka, Bangladesh' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-12 md:p-16 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] rounded-3xl border border-gray-50" data-aos="fade-left">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Your Email</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Message</label>
                        <textarea name="message" rows="3" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none bg-transparent"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.3em] hover:bg-gray-900 transition-all shadow-xl shadow-orange-500/10 rounded-full">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- POPUP MODAL -->
    <div x-show="open" 
         x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 md:p-8"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="close()"></div>

        <div class="relative bg-white w-full max-w-5xl rounded-[40px] overflow-hidden flex flex-col max-h-[90vh] shadow-2xl">
            <button @click="close()" class="absolute top-6 right-8 z-[110] text-gray-400 hover:text-[#f4a41c] text-5xl font-thin">&times;</button>
            <div class="overflow-y-auto custom-scrollbar flex-1 bg-white">
                <div class="w-full bg-gray-50 flex justify-center border-b border-gray-100">
                    <img :src="active.img" class="w-full h-auto max-h-[60vh] object-cover">
                </div>
                <div class="p-12 md:p-20">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-[#f4a41c] text-[10px] uppercase tracking-widest font-black" x-text="active.date"></span>
                        <div class="w-10 h-[1px] bg-gray-200"></div>
                        <span class="text-gray-400 text-[9px] uppercase font-bold tracking-widest">Official Post</span>
                    </div>
                    <h2 class="serif-title text-3xl md:text-5xl text-gray-900 tracking-tight leading-tight mb-12 uppercase" x-text="active.title"></h2>
                    <div class="text-gray-600 text-lg leading-loose font-medium text-justify">
                        <p class="whitespace-pre-line uppercase" x-text="active.desc"></p>
                    </div>
                    <div class="mt-20 pt-10 border-t border-gray-100 text-center">
                        <button @click="close()" class="mx-auto bg-gray-900 text-white px-12 py-4 text-[10px] uppercase font-black tracking-[0.4em] hover:bg-[#f4a41c] transition rounded-full shadow-xl">Close Story</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection