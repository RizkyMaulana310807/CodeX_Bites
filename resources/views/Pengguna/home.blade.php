<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="min-h-screen flex flex-col bg-gradient-to-b from-orange-50 to-yellow-50">

        <!-- Hero Section -->
        <section id="home" class="py-20 md:py-32 px-6">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-orange-700 mb-6 leading-tight">
                        Authentic Dimsum Experience
                    </h1>
                    <p class="text-lg md:text-xl text-orange-600 mb-8 max-w-lg">
                        Premium dimsum made from the freshest ingredients, crafted with traditional techniques for exceptional flavor.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <button class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-8 rounded-full transition transform hover:scale-105">
                            Order Now
                        </button>
                        <button onclick="window.location.href = '/menus'" class="border-2 border-orange-600 text-orange-600 hover:bg-orange-50 font-semibold py-3 px-8 rounded-full transition transform hover:scale-105">
                            Our Menu
                        </button>
                                            </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <img src="images/Produk/image.png" alt="Dimsum Aditiva" 
                             class="w-full max-w-md rounded-3xl transform rotate-2 hover:rotate-0 transition duration-500">
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg hidden md:block">
                            <div class="flex items-center">
                                <div class="bg-orange-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Fresh Daily</p>
                                    <p class="text-sm text-gray-600">Made to order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-orange-100/50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-orange-700 mb-4">Why Choose Our Dimsum?</h2>
                    <div class="w-24 h-1 bg-orange-600 mx-auto mb-6"></div>
                    <p class="text-lg text-orange-600 max-w-3xl mx-auto">
                        We use only premium chicken, shrimp, and vegetables processed with strict hygiene standards for the best quality.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition text-center">
                        <div class="bg-orange-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-orange-700 mb-3">Authentic Taste</h3>
                        <p class="text-orange-600">Traditional recipes passed down for generations with authentic oriental flavors.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition text-center">
                        <div class="bg-orange-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-orange-700 mb-3">Premium Ingredients</h3>
                        <p class="text-orange-600">Only the freshest, highest quality ingredients with no artificial preservatives.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition text-center">
                        <div class="bg-orange-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-orange-700 mb-3">Handcrafted</h3>
                        <p class="text-orange-600">Each piece is carefully handmade by our expert dimsum chefs.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2">
                        <img src="images/Produk/image3.png" 
                             alt="Dimsum preparation" 
                             class="rounded-3xl shadow-xl w-full object-cover h-96">
                    </div>
                    <div class="md:w-1/2">
                        <h2 class="text-3xl md:text-4xl font-bold text-orange-700 mb-6">Our Specialties</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-orange-100 p-2 rounded-full mr-4 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-orange-700 mb-1">Signature Har Gao</h3>
                                    <p class="text-orange-600">Delicate shrimp dumplings with translucent wrappers, a customer favorite.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-orange-100 p-2 rounded-full mr-4 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-orange-700 mb-1">Siu Mai Perfection</h3>
                                    <p class="text-orange-600">Juicy pork and shrimp dumplings topped with orange fish roe.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-orange-100 p-2 rounded-full mr-4 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-orange-700 mb-1">Vegetarian Options</h3>
                                    <p class="text-orange-600">Delicious mushroom and vegetable dumplings for plant-based diets.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 bg-orange-100/50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-orange-700 mb-4">What Our Customers Say</h2>
                    <div class="w-24 h-1 bg-orange-600 mx-auto mb-6"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                ★★★★★
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"The best dimsum I've had outside of Hong Kong! The shrimp dumplings are perfectly textured with just the right amount of bounce."</p>
                        <div class="flex items-center">
                            <div class="bg-orange-100 w-12 h-12 rounded-full mr-4 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Customer" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Sarah L.</h4>
                                <p class="text-sm text-gray-500">Regular Customer</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                ★★★★★
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"I order for my office meetings every week. The quality is consistently excellent and everyone always asks where they're from."</p>
                        <div class="flex items-center">
                            <div class="bg-orange-100 w-12 h-12 rounded-full mr-4 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Michael T.</h4>
                                <p class="text-sm text-gray-500">Corporate Client</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                ★★★★★
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"As someone from Guangzhou, I'm very particular about dimsum. Aditiva's version brings me right back home - authentic and delicious!"</p>
                        <div class="flex items-center">
                            <div class="bg-orange-100 w-12 h-12 rounded-full mr-4 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Customer" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Wei C.</h4>
                                <p class="text-sm text-gray-500">Food Blogger</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Taste the Difference?</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Order now and experience authentic dimsum delivered to your door.</p>
                <button class="bg-white text-orange-600 hover:bg-gray-100 font-bold py-4 px-12 rounded-full transition transform hover:scale-105 shadow-lg">
                    Order Online
                </button>
            </div>
        </section>

    </div>
</x-layout>