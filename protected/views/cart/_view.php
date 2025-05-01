<?php
/* @var $this CartController */
/* @var $data Cart */
$product = $data->product;
?>

<div class="flex items-center border border-gray-200 rounded-xl p-4 gap-4">
    <!-- Checkbox -->
    <input type="checkbox" class="form-checkbox h-5 w-5 text-black">

    <!-- Product Image -->
    <div class="w-1/5">
        <img src="<?php echo Yii::app()->baseUrl . '/images/products/' . $product->image_path; ?>"
			alt="<?php echo CHtml::encode($product->name); ?>"
			class="w-full h-24 object-contain" />
    </div>

    <!-- Product Details -->
    <div class="flex-1">
        <!-- Name and Delete -->
        <div class="flex justify-between items-start">
            <h3 class="text-md font-bold text-black">
                <?php echo CHtml::encode($product->name); ?>
            </h3>
            <?php echo CHtml::beginForm(Yii::app()->createUrl('cart/delete', ['id' => $data->id]), 'post', [
				'style' => 'display:inline;',
				'onsubmit' => "return confirm('Are you sure you want to remove this item?');"
			]); ?>
				<button type="submit" class="text-red-500 hover:text-red-700">
					<i class="ph ph-trash text-xl"></i>
				</button>
			<?php echo CHtml::endForm(); ?>
        </div>

        <!-- Color and Stock -->
        <p class="text-sm text-gray-600">
            Color: Black · Stock: <?php echo $product->stock; ?>
        </p>

        <!-- Price and Quantity -->
        <div class="flex justify-between items-center mt-2">
            <p class="text-lg font-bold text-black">
                PHP <?php echo number_format($product->price, 2); ?>
            </p>

            <!-- Quantity -->
			<div 
				x-data="{
					qty: <?php echo (int) $data->quantity; ?>,
					max: <?php echo (int) $data->product->stock; ?>,
					updateQuantity() {
						fetch('<?php echo Yii::app()->createUrl("cart/updateQuantity"); ?>', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
								'X-Requested-With': 'XMLHttpRequest',
								<?php if (Yii::app()->request->enableCsrfValidation): ?>
									'X-CSRF-Token': '<?php echo Yii::app()->request->csrfToken; ?>',
								<?php endif; ?>
							},
							body: JSON.stringify({
								cart_id: <?php echo $data->id; ?>,
								product_id: <?php echo $data->product_id; ?>,
								quantity: this.qty
							})
						}).then(res => res.json())
						.then(data => {
							if (data.status !== 'success') {
								alert(data.message || 'Failed to update quantity');
							}
						});
					}
				}"
				class="flex items-center border border-gray-300 rounded-full px-3 py-1 w-28 justify-between"
			>
				<button type="button"
					@click="if (qty > 1) { qty--; updateQuantity(); }"
					class="text-xl font-bold text-gray-600 hover:text-black">-</button>

				<span class="text-base font-medium" x-text="qty"></span>

				<button type="button"
					@click="if (qty < max) { qty++; updateQuantity(); }"
					class="text-xl font-bold text-gray-600 hover:text-black">+</button>
			</div>
        </div>
    </div>
</div>
