<aside class="">
    <div class="bg-white p-4 border border-stone-300 rounded-xl shadow-sm space-y-6">

        <!-- Filters Header -->
        <div>
            <h3 class="text-lg font-bold text-black mb-2">Filters</h3>
            <hr class="border-t border-gray-300">
        </div>

        <div class="mt-6">
            <button id="resetFilterCard"
                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-black transition gap-2">
                <i class="ph ph-x-circle"></i>
                Reset Filters
            </button>
        </div>


        <!-- Category Tags -->
        <!-- <div>
            <div class="flex flex-wrap gap-2">
                <?php //foreach ($categories as $category): ?>
                    <span class="inline-block bg-stone-100 text-stone-800 px-3 py-1 text-sm rounded-full cursor-pointer hover:bg-stone-200 transition">
                        <?php //echo CHtml::encode($category->name); ?>
                    </span>
                <?php //endforeach; ?>
            </div>
            <hr class="border-t border-gray-300 mt-4">
        </div> -->

        <!-- Tag Cloud for Brands -->
        <div class="space-y-2">
            <h3 class="font-bold text-black text-md">Brands</h3>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($brands as $brand): ?>
                    <span 
                        class="inline-block bg-stone-100 text-stone-800 px-3 py-1 text-sm rounded-full cursor-pointer transition brand-tag hover:bg-stone-200"
                        data-brand-id="<?php echo $brand->id; ?>">
                        <?php echo CHtml::encode($brand->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
            <hr class="border-t border-gray-300 mt-4">
        </div>

        <!-- Price Dropdown (expanded by default) -->
        <div x-data="{ open: true, min: '', max: '' }" class="space-y-2" id="priceFilter">
            <button type="button" @click="open = !open"
                class="flex justify-between items-center w-full text-left font-bold text-black text-md">
                Price
                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-transition class="mt-4 space-y-3" x-cloak>
                <div class="flex justify-between items-center gap-2">
                    <input x-model="min" type="number" placeholder="Min ₱"
                        class="w-24 px-2 py-1 border rounded text-sm" id="minPriceInput" />
                    <span>—</span>
                    <input x-model="max" type="number" placeholder="Max ₱"
                        class="w-24 px-2 py-1 border rounded text-sm" id="maxPriceInput" />
                </div>
            </div>
            <hr class="border-t border-gray-300 mt-4">
        </div>



        <!-- Stock Filter -->
        <div>
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" id="inStockOnly" />
                In Stock Only
            </label>
        </div>

        <!-- Apply Filter Button -->
        <div>
            <button id="applyGlobalFilters"
                class="w-full bg-black text-white text-sm py-2 rounded-lg hover:bg-stone-800 transition">
                Apply Filter
            </button>
        </div>
    </div>
</aside>
