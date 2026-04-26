@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <div class="max-w-6xl mx-auto px-6 py-32">
        
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h1 class="serif text-3xl md:text-5xl font-black text-gray-900 uppercase mb-4">{{ $job->title }}</h1>
            <div class="w-20 h-1 bg-[#f4a41c] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Left: Info & Requirements -->
            <div class="lg:col-span-8">
                <div class="mb-12 space-y-4 text-gray-800 font-bold uppercase text-xs tracking-widest">
                    <p>Employment Status: <span class="text-[#f4a41c]">{{ $job->type }}</span></p>
                    <p>Job Location: <span class="text-[#f4a41c]">{{ $job->location }}</span></p>
                    <p>Salary: <span class="text-[#f4a41c]">{{ $job->salary ?? 'Negotiable' }}</span></p>
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 leading-loose text-justify font-medium">
                    {!! $job->description !!}
                </div>
            </div>

            <!-- Right: Feature Image -->
            <div class="lg:col-span-4" data-aos="fade-left">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-8 border-gray-50">
                    <img src="{{ asset('storage/' . $job->image) }}" class="w-full h-auto">
                </div>
            </div>
        </div>

        <!-- Apply Form -->
        <section class="mt-32 pt-24 border-t border-gray-100">
            <div class="max-w-3xl mx-auto bg-[#fcfcfc] p-10 md:p-16 rounded-[40px] shadow-2xl border border-gray-50">
                <h2 class="serif text-3xl text-center mb-12 uppercase font-black">Apply <span class="text-[#f4a41c]">Now</span></h2>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-8 text-center font-bold">{{ session('success') }}</div>
                @endif

                <form action="{{ route('career.apply') }}" method="POST" class="space-y-10">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Position Applying For</label>
                        <input type="text" value="{{ $job->title }}" disabled class="w-full border-b border-gray-200 py-3 bg-transparent text-gray-400 font-medium outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Full Name</label>
                        <input type="text" name="full_name" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Phone Number</label>
                        <input type="text" name="phone" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Email Address</label>
                        <input type="email" name="email" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Resume / Cover Letter</label>
                        <textarea name="resume_text" rows="5" required class="w-full border-b border-gray-100 py-3 focus:border-[#f4a41c] outline-none transition-all text-gray-700 font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f4a41c] text-white py-5 font-black uppercase text-xs tracking-[0.4em] hover:bg-gray-900 transition-all rounded-full shadow-xl">Submit Application</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection