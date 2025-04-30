<section class="px-6 py-12 mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-2xl md:text-4xl font-bold text-black">Shop by Category</h2>
            <p class="text-gray-500 text-md md:text-lg">Find your perfect sound in just a few clicks</p>
        </div>
        <a href="#" class="inline-flex items-center border border-black px-4 py-2 text-sm rounded-lg hover:bg-black hover:text-white transition">
            See All <i class="ph ph-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Category Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <?php foreach ($categories as $cat): ?>
            <div class="space-y-2 text-center">
                <div class="rounded-xl overflow-hidden aspect-[3/4] bg-gray-100 group relative">
                    <img src="<?php echo Yii::app()->request->baseUrl . '/images/categories/' . $cat->image_path; ?>"
                         alt="<?php echo CHtml::encode($cat->name); ?>"
                         class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" />
                </div>
                <p class="text-md text-gray-800 font-medium"><?php echo CHtml::encode($cat->name); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
