<?php
/* @var $this CartController */
/* @var $data Cart */
$product = isset($data->product) ? $data->product : Product::model()->findByPk($data->product_id);
$qty = isset($data->quantity) ? $data->quantity : ($quantities[$product->id] ?? 1);
?>

<div class="flex items-center border border-gray-200 rounded-xl p-4 gap-4 mb-5">
    <input type="checkbox" name="selectedCartItems[]" value="<?php echo $data->id; ?>" class="form-checkbox h-5 w-5 text-black">

    <!-- Product Image -->
    <div class="w-1/5">
        <img src="<?php echo Yii::app()->baseUrl . '/images/products/' . $product->image_path; ?>"
             alt="<?php echo CHtml::encode($product->name); ?>"
             class="w-full h-24 object-contain" />
    </div>

    <!-- Product Details -->
    <div class="flex-1">
        <div class="flex justify-between items-start">
            <h3 class="text-md font-bold text-black"><?php echo CHtml::encode($product->name); ?></h3>

            <a href="#" 
                class="text-red-500 hover:text-red-700 delete-cart-item" 
                data-id="<?php echo $data->id; ?>">
                <i class="ph ph-trash text-xl"></i>
            </a>
        </div>

        <p class="text-sm text-gray-600">Color: Black · Stock: <?php echo $product->stock; ?></p>

        <div class="flex justify-between items-center mt-2">
            <p class="text-lg font-bold text-black">PHP <?php echo number_format($product->price, 2); ?></p>

            <!-- Quantity -->
            <div
                x-data="{
                    qty: <?php echo (int) $qty; ?>,
                    price: <?php echo (float) $product->price; ?>,
                    max: <?php echo (int) $product->stock; ?>,
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
                                cart_id: <?php echo Yii::app()->user->isGuest ? 'null' : $data->id; ?>,
                                product_id: <?php echo $data->product_id; ?>,
                                quantity: this.qty
                            })
                        }).then(res => res.json())
                          .then(data => {
                              if (data.status !== 'success') {
                                  alert(data.message || 'Failed to update quantity');
                              }
                          });
                    },
                    changeQty(delta) {
                        const oldTotal = this.qty * this.price;
                        this.qty = Math.max(1, Math.min(this.qty + delta, this.max));
                        const newTotal = this.qty * this.price;

                        this.updateQuantity();

                        $dispatch('update-subtotal', {
                            oldTotal: oldTotal,
                            newTotal: newTotal
                        });
                    }
                }"
                class="flex items-center border border-gray-300 rounded-full px-3 py-1 w-28 justify-between"
            >
                <button type="button"
                        @click="changeQty(-1)"
                        class="text-xl font-bold text-gray-600 hover:text-black">-</button>

                <span class="text-base font-medium" x-text="qty"></span>

                <button type="button"
                        @click="changeQty(1)"
                        class="text-xl font-bold text-gray-600 hover:text-black">+</button>
            </div>
        </div>
    </div>
</div>
