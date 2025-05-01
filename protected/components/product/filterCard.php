<aside class="lg:col-span-3 hidden lg:block">
    <div class="bg-white p-4 border border-stone-300 rounded-xl shadow-sm space-y-6">

        <!-- Filters Header -->
        <div>
            <h3 class="text-lg font-bold text-black mb-2">Filters</h3>
            <hr class="border-t border-gray-300">
        </div>

        <!-- Category Tags -->
        <div>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($categories as $category): ?>
                    <span class="inline-block bg-stone-100 text-stone-800 px-3 py-1 text-sm rounded-full cursor-pointer hover:bg-stone-200 transition">
                        <?php echo CHtml::encode($category->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
            <hr class="border-t border-gray-300 mt-4">
        </div>

        <!-- Price Dropdown (expanded by default) -->
        <div x-data="{ open: true }">
            <button type="button" @click="open = !open" class="flex justify-between items-center w-full text-left font-bold text-black text-md">
                Price
                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" class="mt-4 space-y-4">
                <!-- Replace below with actual range slider if available -->
                <div class="flex items-center justify-between text-sm text-stone-700">
                    <span>₱5,000</span>
                    <span>₱50,000</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full"></div>
            </div>
            <hr class="border-t border-gray-300 mt-4">
        </div>

        <!-- Apply Filter Button -->
        <div>
            <button class="w-full bg-black text-white text-sm py-2 rounded-lg hover:bg-stone-800 transition">Apply Filter</button>
        </div>
    </div>
</aside>
