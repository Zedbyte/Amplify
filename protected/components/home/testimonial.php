<section class="relative py-16 mx-auto overflow-hidden">
    <h2 class="text-4xl font-bold text-black mb-6">
        What customers say about <br> amplify?
    </h2>

    <!-- Left fade -->
    <div class="pointer-events-none absolute top-40 left-0 w-12 h-full z-10"
        style="background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,0.95) 30%, rgba(255,255,255,0.7) 60%, rgba(255,255,255,0) 100%);">
    </div>

    <!-- Right fade -->
    <div class="pointer-events-none absolute top-40 right-0 w-12 h-full z-10"
        style="background: linear-gradient(to left, rgba(255,255,255,1) 0%, rgba(255,255,255,0.8) 30%, rgba(255,255,255,0.5) 60%, rgba(255,255,255,0) 100%);">
    </div>

    <!-- Scrollable container -->
    <div class="overflow-hidden group">
        <div class="flex space-x-6 animate-scroll-x w-full">
        <?php 
        
        $testimonials = [
            [
                'name' => 'John Doe',
                'role' => 'Youtuber',
                'text' => "Amplify is a music lover's paradise! From hard-to-find vinyl records to the latest chart-toppers, their collection is unmatched. Their website is so easy to navigate, and I always find exactly what I'm looking for. Highly recommended!",
                'rating' => '4.5',
                'image' => 'https://images.pexels.com/photos/31833615/pexels-photo-31833615/free-photo-of-black-and-white-portrait-of-guitarist-in-australia.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'name' => 'Jane Doe',
                'role' => 'Youtuber',
                'text' => "As a musician, I'm always on the lookout for high-quality gear. Amplify has it all—guitars, keyboards, and even some unique items you won't 
                find elsewhere. Plus, their customer service team goes above and beyond. They've earned my loyalty!",
                'rating' => '4.2',
                'image' => 'https://images.pexels.com/photos/243989/pexels-photo-243989.jpeg',
            ],
            [
                'name' => 'Michael V.',
                'role' => 'Songwriter',
                'text' => "What makes Amplify stand out for me is their commitment to music culture. 
                The curated playlists and blog posts on their site keep me inspired. Shopping here feels like connecting with a passionate community. Love it!",
                'rating' => '4.2',
                'image' => 'https://images.pexels.com/photos/5650947/pexels-photo-5650947.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'name' => 'Triple H',
                'role' => 'Ghost Guitarist',
                'text' => "Fast shipping, competitive prices, and an incredible selection—Amplify has redefined online music 
                shopping for me. Whether it's instruments, accessories, or music itself, they're my go-to store. Truly a 5-star experience!",
                'rating' => '4.2',
                'image' => 'https://images.pexels.com/photos/8043762/pexels-photo-8043762.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ]
        ];
        
        $loopTestimonials = array_merge($testimonials, $testimonials);

            foreach ($loopTestimonials as $t): ?>
                <div class="relative bg-black text-white flex-shrink-0 w-4/12 md:w-5/12 rounded-2xl p-6 flex flex-col justify-between">
                    <!-- Text -->
                    <p class="text-sm leading-relaxed mb-4 pr-2 overflow-y-auto max-h-40">
                        <?php echo $t['text']; ?>
                    </p>

                    <!-- Footer -->
                    <div class="relative bottom-4 flex justify-between items-end mt-10">
                        <div class="flex items-center space-x-3">
                            <i class="ph ph-quotes text-2xl"></i>
                            <img src="<?php echo $t['image']; ?>"
                                 alt="<?php echo CHtml::encode($t['name']); ?>"
                                 class="h-12 w-12 object-cover rounded-full border border-stone-700" />
                            <div>
                                <p class="font-semibold"><?php echo $t['name']; ?></p>
                                <p class="text-sm text-gray-400"><?php echo $t['role']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="ph ph-star text-white text-sm"></i>
                            <span class="text-sm"><?php echo $t['rating']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
