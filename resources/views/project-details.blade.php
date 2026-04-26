@extends('layouts.app')

@section('content')
<div class="pt-24 bg-[#0a0a0a] text-white">
    <!-- HERO / COVER PHOTO (Uses Main Featured Photo) -->
    <div class="relative h-[70vh]">
        <img src="{{ asset('storage/' . ($project->featured_image ?? $project->image)) }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-center px-4">
            <h1 class="serif text-5xl md:text-7xl uppercase tracking-[0.2em]">{{ $project->name }}</h1>
        </div>
    </div>

    <!-- QUICK STATS (Top Bar) -->
    <div class="bg-[#0f0f0f] border-b border-white/5 py-10 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-5 text-center divide-x divide-white/10 uppercase text-[10px] tracking-widest">
            <div class="px-2"><p class="text-gray-500 mb-2">Location</p><p class="text-lg serif">{{ $project->location }}</p></div>
            <div class="px-2"><p class="text-gray-500 mb-2">Size</p><p class="text-lg serif">{{ $project->size }}</p></div>
            <div class="px-2"><p class="text-gray-500 mb-2">Beds</p><p class="text-lg serif">{{ $project->beds_baths }}</p></div>
            <div class="px-2"><p class="text-gray-500 mb-2">Completion</p><p class="text-lg serif">{{ $project->launch_date }}</p></div>
            <div class="px-2"><p class="text-gray-500 mb-2">Status</p><p class="text-lg serif text-gold">{{ $project->category }}</p></div>
        </div>
    </div>

    <!-- NAV GRID (5 Boxes with Golden Hover) -->
    <section class="max-w-7xl mx-auto py-16 px-6 grid grid-cols-2 md:grid-cols-5 gap-4">
        <a href="#at-a-glance" class="group bg-[#111] border border-white/5 p-12 flex flex-col items-center hover:bg-[#C5A059] transition duration-500">
            <i class="fa-solid fa-list-check text-3xl mb-4 group-hover:text-black transition duration-500"></i>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase group-hover:text-black transition duration-500">At a Glance</span>
        </a>
        <a href="#features" class="group bg-[#111] border border-white/5 p-12 flex flex-col items-center hover:bg-[#C5A059] transition duration-500">
            <i class="fa-solid fa-leaf text-3xl mb-4 group-hover:text-black transition duration-500"></i>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase group-hover:text-black transition duration-500">Features</span>
        </a>
        <a href="#experience" class="group bg-[#111] border border-white/5 p-12 flex flex-col items-center hover:bg-[#C5A059] transition duration-500">
            <i class="fa-solid fa-vr-cardboard text-3xl mb-4 group-hover:text-black transition duration-500"></i>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase group-hover:text-black transition duration-500">Experience</span>
        </a>
        <a href="#map" class="group bg-[#111] border border-white/5 p-12 flex flex-col items-center hover:bg-[#C5A059] transition duration-500">
            <i class="fa-solid fa-map-location-dot text-3xl mb-4 group-hover:text-black transition duration-500"></i>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase group-hover:text-black transition duration-500">Maps</span>
        </a>
        <a href="{{ asset('storage/' . $project->brochure_pdf) }}" download class="group bg-[#111] border border-white/5 p-12 flex flex-col items-center hover:bg-[#C5A059] transition duration-500">
            <i class="fa-solid fa-file-pdf text-3xl mb-4 group-hover:text-black transition duration-500"></i>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase group-hover:text-black transition duration-500">Brochure</span>
        </a>
    </section>

    <!-- AT A GLANCE (Uses Body Photo / Thumbnail) -->
    <section id="at-a-glance" class="max-w-7xl mx-auto py-24 px-6 grid md:grid-cols-2 gap-20 items-center scroll-mt-32">
        <div class="relative">
            <div class="absolute -top-4 -left-4 w-32 h-32 border-t border-l border-gold"></div>
            <img src="{{ asset('storage/' . $project->image) }}" class="rounded shadow-2xl relative z-10 w-full">
            <div class="absolute -bottom-4 -right-4 w-32 h-32 border-b border-r border-gold"></div>
        </div>
        <div>
            <h2 class="serif text-4xl mb-12 gold-gradient uppercase tracking-widest">At a Glance</h2>
            <div class="space-y-6 text-sm">
                <div class="flex justify-between border-b border-white/5 pb-3"><span>Address</span> <span class="text-gray-400 text-right max-w-[250px]">{{ $project->address }}</span></div>
                <div class="flex justify-between border-b border-white/5 pb-3"><span>Land Area</span> <span class="text-gray-400">{{ $project->land_area }}</span></div>
                <div class="flex justify-between border-b border-white/5 pb-3"><span>No. of Floors</span> <span class="text-gray-400">{{ $project->floors }}</span></div>
                <div class="flex justify-between border-b border-white/5 pb-3"><span>Apartment Size</span> <span class="text-gray-400">{{ $project->size }}</span></div>
                <div class="flex justify-between border-b border-white/5 pb-3"><span>Bed / Bath</span> <span class="text-gray-400">{{ $project->beds_baths }}</span></div>
                <div class="flex justify-between border-b border-white/5 pb-3"><span>Collection</span> <span class="text-gold font-bold uppercase">{{ $project->collection }}</span></div>
            </div>

            @if($project->category == 'Ongoing')
            <button onclick="toggleModal()" class="w-full mt-12 gold-button py-6 tracking-[0.4em] uppercase text-xs">
                Construction Status
            </button>
            @endif
        </div>
    </section>

    <!-- FEATURES & AMENITIES -->
    <section id="features" class="max-w-7xl mx-auto py-24 px-6 border-t border-white/5 scroll-mt-32">
        <div class="grid md:grid-cols-2 gap-20 items-start">
            <div>
                <h2 class="serif text-4xl mb-8 gold-gradient uppercase tracking-widest">Features & Amenities</h2>
                <div class="text-gray-400 leading-relaxed space-y-4 prose prose-invert max-w-none">
                    {!! $project->features !!} 
                </div>
            </div>
            <div class="mt-10 md:mt-0">
                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-auto rounded shadow-xl border border-white/5">
            </div>
        </div>
    </section>

    <!-- EXPERIENCE / GALLERY -->
    <section id="experience" class="py-24 bg-[#080808] scroll-mt-32">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="serif text-4xl mb-12 text-center gold-gradient uppercase tracking-widest">Experience</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if($project->gallery)
                    @foreach($project->gallery as $gal_img)
                    <div class="overflow-hidden group">
                        <img src="{{ asset('storage/' . $gal_img) }}" class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                    </div>
                    @endforeach
                @else
                    <div class="col-span-3 text-center text-gray-600 py-10">No Gallery Images Found</div>
                @endif
            </div>
        </div>
    </section>

    <!-- MAP -->
    <section id="map" class="h-[500px] w-full grayscale contrast-125 mt-20 scroll-mt-32">
        <iframe src="{{ $project->map_link }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>

    <!-- BOOK A FREE CONSULTATION -->
    <section class="py-24 bg-black border-t border-white/5">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="serif text-4xl mb-4 gold-gradient uppercase tracking-widest">Book A Free Consultation</h2>
            <p class="text-gray-500 mb-10 tracking-[0.3em] uppercase text-[10px]">Expert guidance for your dream home</p>
            <form action="#" class="grid grid-cols-1 gap-8">
                <input type="text" placeholder="YOUR NAME" class="bg-transparent border-b border-white/20 py-4 focus:outline-none focus:border-gold uppercase text-[10px] tracking-widest">
                <input type="email" placeholder="EMAIL ADDRESS" class="bg-transparent border-b border-white/20 py-4 focus:outline-none focus:border-gold uppercase text-[10px] tracking-widest">
                <button type="submit" class="mt-8 gold-button py-6 tracking-[0.4em] uppercase text-xs">Request a Call Back</button>
            </form>
        </div>
    </section>

    <!-- YOU MAY ALSO LIKE (Uses Body Photo / Thumbnail) -->
    <section class="py-24 bg-[#0a0a0a] border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="serif text-3xl mb-16 text-center uppercase tracking-[0.3em]">You May Also Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @php
                    $related = \App\Models\Project::where('id', '!=', $project->id)->inRandomOrder()->take(3)->get();
                @endphp
                @foreach($related as $rel)
                <a href="{{ url('/project/' . $rel->slug) }}" class="group block text-center">
                    <div class="relative overflow-hidden aspect-[4/5] mb-8">
                        <img src="{{ asset('storage/' . $rel->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition duration-500"></div>
                    </div>
                    <h3 class="serif text-2xl mb-2">{{ $rel->name }}</h3>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">{{ $rel->location }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- CONSTRUCTION MODAL -->
<div id="statusModal" class="fixed inset-0 bg-black/95 z-[100] hidden items-center justify-center p-6">
    <div class="bg-[#0a0a0a] w-full max-w-4xl border border-white/10 rounded-xl overflow-hidden shadow-2xl">
        <div class="p-10 border-b border-white/5 flex justify-between items-center">
            <h2 class="serif text-3xl gold-gradient uppercase">{{ $project->name }} <span class="text-white font-light">Status</span></h2>
            <button onclick="toggleModal()" class="text-4xl text-gray-500 hover:text-gold">&times;</button>
        </div>
        <div class="p-10 max-h-[60vh] overflow-y-auto">
            <table class="w-full text-left text-xs uppercase tracking-widest">
                <thead>
                    <tr class="text-gray-500 border-b border-white/5">
                        <th class="pb-4">Task Description</th>
                        <th class="pb-4">Progress Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @if($project->construction_updates)
                        @foreach($project->construction_updates as $item)
                        <tr>
                            <td class="py-6">{{ $item['task'] }}</td>
                            <td class="py-6">
                                <div class="flex items-center gap-4">
                                    <div class="flex-grow h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-gold" style="width: {{ $item['progress'] }}%"></div>
                                    </div>
                                    <span class="text-gold">{{ $item['progress'] }}%</span>
                                </div>
                                <span class="text-[9px] text-gray-500 mt-1 block italic">{{ $item['remarks'] ?? '' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
</script>

<style>
    /* Fixed the scroll position so it doesn't get hidden under the header */
    .scroll-mt-32 {
        scroll-margin-top: 8rem;
    }
    .gold-button {
        background: transparent;
        border: 1px solid #C5A059;
        color: #C5A059;
        transition: all 0.4s ease;
    }
    .gold-button:hover {
        background: #C5A059;
        color: #000;
    }
</style>
@endsection