@extends('layouts.app')

@section('content')
<style>
    /* Modern Luxury Aesthetic - Refined Shanta Style */
    .contact-wrapper { 
        background: radial-gradient(circle at top right, #5a5451, #4a4441); /* Added depth with a soft gradient */
        min-height: 100vh;
        color: white;
        position: relative;
    }

    /* Decorative background element */
    .contact-wrapper::before {
        content: 'TRIKON';
        position: absolute;
        top: 20%;
        left: 5%;
        font-size: 15vw;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.03);
        pointer-events: none;
        z-index: 0;
        font-family: 'Cinzel', serif;
    }

    .input-group {
        position: relative;
        margin-bottom: 3rem;
    }

    .input-minimal {
        background: transparent !important;
        border: none !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        padding: 12px 0 !important;
        font-weight: 300;
        letter-spacing: 1px;
        font-size: 16px;
        border-radius: 0 !important;
        width: 100%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Modern Focus Effect */
    .input-minimal:focus {
        border-bottom-color: white !important;
        outline: none !important;
        padding-left: 10px !important;
    }

    .label-minimal {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: rgba(255, 255, 255, 0.4);
        font-weight: 700;
        margin-bottom: 8px;
        display: block;
        transition: all 0.3s ease;
    }

    .input-minimal:focus + .label-minimal {
        color: white;
    }

    .info-block {
        transition: all 0.5s ease;
        padding: 10px 0;
        border-left: 0px solid white;
    }
    
    .info-block:hover {
        padding-left: 20px;
        border-left: 2px solid rgba(255,255,255,0.5);
    }

    .info-label {
        color: rgba(255, 255, 255, 0.5);
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .info-text {
        color: #ffffff;
        font-size: 28px;
        font-weight: 200; /* Lighter weight for modern look */
        font-family: 'Cinzel', serif;
        letter-spacing: 1px;
    }

    .btn-submit-modern {
        display: inline-flex;
        align-items: center;
        gap: 20px;
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 4px;
        margin-top: 20px;
        transition: all 0.5s ease;
        background: none;
        border: none;
        cursor: pointer;
    }

    .btn-submit-modern .icon-circle {
        width: 45px;
        height: 45px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-submit-modern:hover .icon-circle {
        background: white;
        color: #4a4441;
        transform: rotate(-45deg);
    }
    
    .btn-submit-modern:hover {
        letter-spacing: 6px;
    }

    .address-box {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
</style>

<div class="contact-wrapper pt-56 pb-40 px-6 md:px-12 lg:px-24 overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        
        <!-- Header Section -->
        <div class="mb-32 text-center lg:text-left">
            <h4 class="text-white/40 uppercase tracking-[0.5em] text-[10px] font-bold mb-4" data-aos="fade-up">Get in Touch</h4>
            <h1 class="serif text-white text-5xl md:text-8xl font-black uppercase tracking-tighter leading-none" data-aos="fade-up" data-aos-delay="100">
                Connect <span class="text-white/20 italic font-light">&</span> Inquire
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-40 items-start">
            
            <!-- Left Column: Form Section -->
            <div data-aos="fade-right" data-aos-delay="200">
                @if(session('success'))
                    <div class="bg-white text-black p-6 mb-12 text-[10px] font-bold tracking-[0.3em] uppercase animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    
                    <div class="input-group">
                        <label class="label-minimal">Full Name</label>
                        <input type="text" name="name" required class="input-minimal">
                    </div>

                    <div class="input-group">
                        <label class="label-minimal">Phone Number</label>
                        <input type="tel" name="phone" required class="input-minimal">
                    </div>
                    
                    <div class="input-group">
                        <label class="label-minimal">Email Address</label>
                        <input type="email" name="email" required class="input-minimal">
                    </div>
                    
                    <div class="input-group">
                        <label class="label-minimal">Your Message</label>
                        <textarea name="message" rows="2" required class="input-minimal resize-none"></textarea>
                    </div>

                    <button type="submit" class="btn-submit-modern group">
                        <div class="icon-circle">
                            <i class="fa-solid fa-arrow-right text-[12px]"></i>
                        </div>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Right Column: Contact Details -->
            <div data-aos="fade-left" data-aos-delay="400" class="lg:sticky lg:top-60">
                
                <div class="space-y-12">
                    <div class="info-block">
                        <h3 class="info-label">Corporate Hotline</h3>
                        <p class="info-text">{{ $settings->hotline ?? '16634' }}</p>
                    </div>

                    <div class="info-block">
                        <h3 class="info-label">Sales Department</h3>
                        <p class="info-text">{{ $settings->sales_phone ?? '+88 01678 666444' }}</p>
                    </div>

                    <div class="info-block">
                        <h3 class="info-label">Official Email</h3>
                        <p class="info-text text-xl md:text-3xl break-all font-light">{{ $settings->email ?? 'info@trikonltd.com' }}</p>
                    </div>
                </div>

                @if($settings->address)
                <div class="address-box">
                    <h3 class="info-label mb-4">Global Headquarters</h3>
                    <p class="text-sm md:text-md font-light leading-relaxed text-white/60 tracking-widest uppercase">
                        {!! nl2br(e($settings->address)) !!}
                    </p>
                </div>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection