<!-- Category Grid -->
<?php foreach ($categories as $cat): ?>
    <div class="space-y-2 text-center">
        <div class="rounded-xl overflow-hidden bg-gray-100 group relative aspect-[3/4]  <?php echo $imageHeightClass; ?>">
            <img src="<?php echo Yii::app()->request->baseUrl . '/images/categories/' . $cat->image_path; ?>"
                alt="<?php echo CHtml::encode($cat->name); ?>"
                class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" />
        </div>
        <p class="text-md text-gray-800 font-medium"><?php echo CHtml::encode($cat->name); ?></p>
    </div>
<?php endforeach; ?>

