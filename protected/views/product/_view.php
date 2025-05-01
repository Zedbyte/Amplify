<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<section class="px-6 py-12 mx-auto">
    <div class="flex justify-center mb-8">
        <h2 class="text-2xl md:text-4xl font-bold text-black">Shop by Category</h2>
    </div>

    <!-- Scrollable wrapper -->
    <div class="overflow-x-auto pb-2 scroll-wrapper">
        <div class="flex space-x-6">
            <?php $this->widget('application.widgets.ShopCategory', [
                'imageHeightClass' => 'h-[250px] md:h-[300px] lg:h-[350px]'
            ]); ?>
        </div>
    </div>
</section>


<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6 max-w-11/12 mx-auto">
    <!-- Left Filter Panel Placeholder -->
    <?php $this->widget('application.widgets.FilterCard'); ?>

    <!-- Product Grid -->
    <div class="lg:col-span-9">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white  rounded-xl p-4 hover:shadow-md group hover:bg-black transition duration-500">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guitar.png"
                     alt="<?php echo CHtml::encode($data->name); ?>"
                     class="w-full h-40 object-contain mb-4 group-hover:scale-115 transition-transform duration-300" />

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
    </div>
</div>
