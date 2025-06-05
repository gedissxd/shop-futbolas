<footer class="dark:bg-zinc-800 border-t dark:border-zinc-700 border-zinc-200 bg-zinc-100">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
            <!-- Logo Section -->
            <div class="lg:col-span-1 flex justify-center lg:justify-start">
               <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-50">
            </div>

            <!-- Learn More Section -->
            <div class="lg:col-span-1">
                <h3 class="font-semibold text-lg mb-4">Learn More</h3>
                <ul class="space-y-3 text-sm text-zinc-400">
                    <li><a href="{{ route('about-us') }}" class="hover:text-yellow-500 dark:hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="hover:text-yellow-500 dark:hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('contact-us') }}" class="hover:text-yellow-500 dark:hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Us Section -->
            <div class="lg:col-span-1">
                <h3 class="font-semibold text-lg mb-4">Contact Us</h3>
                <div class="space-y-3 text-sm text-zinc-400">
                    <div>
                        <p class="text-white">Director:</p>
                        <p>+370 612 34567</p>
                    </div>
                </div>
            </div>

            <!-- Social Section -->
            <div class="lg:col-span-1">
                <h3 class="font-semibold text-lg mb-4">Social</h3>
                <div class="flex gap-4">
                    <!-- Facebook -->
                    <a href="#" class="text-zinc-400 hover:text-yellow-500 dark:hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="text-zinc-400 hover:text-yellow-500 dark:hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                
                    <!-- YouTube -->
                    <a href="#" class="text-zinc-400 hover:text-yellow-500 dark:hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer> 