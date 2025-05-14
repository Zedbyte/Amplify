<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="p-4 hover:bg-gray-50 transition view">
    <div class="flex items-center justify-between">
        <!-- Left: ID and Name -->
        <div>
            <a href="<?php echo Yii::app()->createUrl('category/view', ['id' => $data->id]); ?>" class="text-blue-600 hover:underline">
				<?php echo CHtml::encode($data->id); ?>
			</a>
            <div class="text-lg font-semibold text-gray-800"><?php echo CHtml::encode($data->name); ?></div>
        </div>

        <!-- Right: Image Preview -->
        <?php if (!empty($data->image_path)): ?>
            <div>
                <img src="<?php echo Yii::app()->baseUrl . '/images/categories/' . CHtml::encode($data->image_path); ?>"
                     alt="<?php echo CHtml::encode($data->name); ?>"
                     class="w-16 h-16 object-cover rounded border border-gray-300" />
            </div>
        <?php endif; ?>
    </div>
</div>
