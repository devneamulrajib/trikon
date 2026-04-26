<section class="bg-white py-24 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-20">
        <!-- Left Side: Contact Information -->
        <div data-aos="fade-right">
            <h2 class="text-[#f4a41c] font-bold text-3xl mb-12 uppercase tracking-[0.2em]">CONTACT <span class="text-gray-900">US</span></h2>
            
            <div class="space-y-8 text-gray-600 font-medium text-sm">
                <div class="flex items-center">
                    <i class="fa-solid fa-phone w-10 text-[#f4a41c] text-xl"></i>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-1">Hotline</p>
                        <p class="text-gray-900">{{ $settings->contact_phone ?? '+8809647600600' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <i class="fa-brands fa-whatsapp w-10 text-[#f4a41c] text-2xl"></i>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-1">WhatsApp</p>
                        <p class="text-gray-900">{{ $settings->whatsapp ?? '+8801740050032' }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <i class="fa-solid fa-envelope w-10 text-[#f4a41c] text-xl"></i>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-1">Email Address</p>
                        <p class="text-gray-900">{{ $settings->contact_email ?? 'info@trikonltd.com' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <i class="fa-solid fa-location-dot w-10 text-[#f4a41c] text-xl mt-1"></i>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-1">Location</p>
                        <p class="text-gray-900 leading-relaxed max-w-xs">{{ $settings->address ?? 'Rahman Trade Center, Bashundhara RD, Dhaka' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <h3 class="text-gray-900 font-bold uppercase tracking-[0.3em] text-[10px] mb-6">FOLLOW US ON</h3>
                <div class="flex space-x-6 text-xl">
                    <a href="#" class="text-gray-400 hover:text-[#f4a41c] transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-[#f4a41c] transition-colors"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-[#f4a41c] transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="text-gray-400 hover:text-[#f4a41c] transition-colors"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Right Side: Contact Form -->
        <div data-aos="fade-left">
            <form action="#" method="POST" class="space-y-8 bg-gray-50 p-10 rounded-2xl">
                @csrf
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="relative">
                        <input type="text" name="name" placeholder="Your Name" required
                               class="w-full bg-transparent border-b border-gray-300 py-3 focus:border-[#f4a41c] outline-none transition-colors text-sm">
                    </div>
                    <div class="relative">
                        <input type="text" name="phone" placeholder="Phone No." required
                               class="w-full bg-transparent border-b border-gray-300 py-3 focus:border-[#f4a41c] outline-none transition-colors text-sm">
                    </div>
                </div>
                
                <div class="relative">
                    <input type="email" name="email" placeholder="Your Email" required
                           class="w-full bg-transparent border-b border-gray-300 py-3 focus:border-[#f4a41c] outline-none transition-colors text-sm">
                </div>
                
                <div class="relative">
                    <textarea name="message" rows="4" placeholder="Message" required
                              class="w-full bg-transparent border-b border-gray-300 py-3 focus:border-[#f4a41c] outline-none transition-colors text-sm resize-none"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="bg-[#f4a41c] text-white px-12 py-4 rounded-full uppercase font-bold tracking-widest text-[11px] hover:bg-black transition-all duration-500 shadow-xl shadow-orange-500/20">
                        Send message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>