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

