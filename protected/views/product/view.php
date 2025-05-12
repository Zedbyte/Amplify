<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = ['Products' => ['index'], $model->name];

$imageUrl = Yii::app()->baseUrl . '/images/products/' . $model->image_path;
?>

<!-- Back Link -->
<div class="px-6 pt-6">
    <a href="<?php echo $this->createUrl('index'); ?>" class="text-sm text-gray-500 hover:text-black flex items-center mb-6">
        <i class="ph ph-arrow-left mr-2"></i> Back to Products
    </a>
</div>

<!-- Product View Section -->
<section class="px-6 pb-16 grid grid-cols-1 lg:grid-cols-2 gap-8  mx-auto">

    <!-- Left: Product Image -->
	<div class="relative overflow-hidden border border-gray-200 rounded-xl w-full h-[600px] group">
		<div class="zoom-container relative w-full h-full overflow-hidden">
			<img src="<?php echo CHtml::encode($imageUrl); ?>"
				id="zoom-image"
				alt="<?php echo CHtml::encode($model->name); ?>"
				class="object-contain w-full h-full transition duration-300" />
		</div>
	</div>


    <!-- Right: Product Info -->
    <div class="w-full h-[600px] relative flex flex-col justify-between">
        <div class="space-y-4">

            <!-- Product Name -->
            <h1 class="text-2xl md:text-3xl font-bold text-black">
                <?php echo CHtml::encode($model->name); ?>
            </h1>

            <!-- Rating -->
            <div class="flex items-center space-x-2">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="ph-fill ph-star<?php echo $i <= 4 ? ' text-yellow-400' : ' text-gray-300'; ?>"></i>
                <?php endfor; ?>
                <span class="text-sm text-gray-600">4.5/5</span>
            </div>

            <!-- Stock -->
            <div class="text-sm font-bold text-gray-600">
                <?php echo $model->stock; ?> available
            </div>

            <!-- Price -->
            <div class="text-2xl font-bold text-black">
                PHP <?php echo number_format($model->price, 2); ?>
            </div>

            <!-- Description -->
            <div class="text-gray-600 text-sm line-clamp-5 prose max-w-none">
                <?php echo $model->description; ?>
            </div>
        </div>

        <!-- Bottom Controls -->
        <div class="absolute bottom-0 left-0 right-0 flex items-center space-x-4 mt-6 pt-6 bg-white">
            <!-- Quantity -->
            <div 
                x-data="{ 
                    qty: 1, 
                    max: <?php echo (int) $model->stock; ?> 
                }" 
                class="flex items-center space-x-4 w-full"
            >
                <!-- Quantity Control -->
                <div class="flex items-center border border-gray-300 rounded-full px-3 py-1 w-32 justify-between">
                    <button 
                        @click="qty = Math.max(1, qty - 1)" 
                        class="text-xl font-bold text-gray-600 hover:text-red-500 cursor-pointer"
                        aria-label="Decrease quantity">-</button>
                    
                    <input 
                        type="number"
                        min="1"
                        :max="max"
                        x-model.number="qty"
                        @input="if (!qty || qty < 1) qty = 1; if (qty > max) qty = max"
                        class="remove-spinners w-10 text-center border-none focus:outline-none text-sm font-medium"
                    >
                    
                    <button 
                        @click="qty = qty < max ? qty + 1 : qty" 
                        class="text-xl font-bold text-gray-600 hover:text-green-500 cursor-pointer"
                        aria-label="Increase quantity">+</button>
                </div>

                <!-- Add to Cart Form -->
                <form method="post" action="<?php echo Yii::app()->createUrl('cart/add'); ?>" class="flex w-full items-center gap-4">
                    <?php echo CHtml::hiddenField('product_id', $model->id); ?>
                    <input type="hidden" name="quantity" :value="qty">
                    
                    <?php if ($model->stock > 0): ?>
                        <button type="submit" 
                            class="flex-1 bg-black text-white py-3 rounded-full hover:bg-gray-900 transition text-sm font-semibold">
                            Add to Cart
                        </button>
                    <?php else: ?>
                        <button type="button" disabled
                            class="flex-1 bg-gray-300 text-gray-500 py-3 rounded-full text-sm font-semibold cursor-not-allowed">
                            Out of Stock
                        </button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

	<!-- Zoom Effect -->
	<?php
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->baseUrl . '/js/product-zoom.js',
			CClientScript::POS_END
		);
	?>
</section>




<!-- Tabs -->
<section x-data="{ tab: 'details' }" class="px-6 mx-auto">
    <!-- Tabs -->
    <div class="border-b border-gray-200 flex space-x-10 mb-6">
        <button 
            @click="tab = 'details'"
            :class="tab === 'details' ? 'border-black text-black border-b-2' : 'text-gray-500'"
            class="tab-btn text-sm font-semibold py-3 cursor-pointer hover:text-black">
            Product Details
        </button>
        <button 
            @click="tab = 'reviews'"
            :class="tab === 'reviews' ? 'border-black text-black border-b-2' : 'text-gray-500'"
            class="tab-btn text-sm font-semibold py-3 cursor-pointer hover:text-black">
            Ratings & Reviews
        </button>
    </div>

    <!-- Panels -->
    <div x-show="tab === 'details'" class="tab-panel">
        <h3 class="text-lg font-semibold text-black mb-2">Product Details</h3>
        <p class="text-sm text-gray-700 leading-relaxed mb-4">
            <?php echo $model->description; ?>
        </p>
    </div>

    <div x-show="tab === 'reviews'" x-cloak class="tab-panel">
        <h3 class="text-lg font-semibold text-black mb-2">Customer Ratings & Reviews</h3>
        <p class="text-sm text-gray-500">No reviews yet.</p>
    </div>
</section>





<?php
/* @var $this ProductController */
/* @var $model Product */

// $this->breadcrumbs=array(
// 	'Products'=>array('index'),
// 	$model->name,
// );

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<!-- <h1>View Product #<?php //echo $model->id; ?></h1> -->

<?php //$this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
	// 	'id',
	// 	'SKU',
	// 	'name',
	// 	'description',
	// 	'price',
	// 	'stock',
	// 	'category_id',
	// 	'brand_id',
	// 	'status',
	// 	'image_path',
	// 	'created_at',
	// 	'updated_at',
	// ),
//)); ?>


