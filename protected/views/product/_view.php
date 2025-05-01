<?php
/* @var $this ProductController */
/* @var $data Product */

// Build image path
$imageUrl = $data->image_path
    ? Yii::app()->baseUrl . '/images/products/' . $data->image_path
    : Yii::app()->baseUrl . '/images/placeholder.png'; // fallback image if needed
?>

<div class="bg-white rounded-xl p-4 hover:shadow-md group hover:bg-black transition duration-500">
    <div class="overflow-hidden">
        <img src="<?php echo CHtml::encode($imageUrl); ?>"
            alt="<?php echo CHtml::encode($data->name); ?>"
            class="w-full h-64 object-contain mb-4 group-hover:scale-110 transition-transform duration-300 rotate-45" />
    </div>

    <div>
        <h3 class="text-md font-semibold text-gray-800 group-hover:text-white">
            <?php echo CHtml::encode($data->name); ?>
        </h3>

        <p class="text-sm text-gray-500 mb-1 group-hover:text-white">
            <?php echo CHtml::encode($data->category ? $data->category->name : 'Uncategorized'); ?>
        </p>

        <p class="text-lg font-semibold text-black group-hover:text-green-200">
            ₱<?php echo number_format($data->price, 2); ?>
        </p>
    </div>
</div>
