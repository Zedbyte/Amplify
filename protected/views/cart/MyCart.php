<?php
/* @var $dataProvider CActiveDataProvider|null */ 

$total = $subtotal + $deliveryFee;
?>

<h1 class="font-bold text-2xl px-6 pt-6">Your Cart</h1>

<?php echo CHtml::beginForm(['cart/checkout'], 'post', ['id' => 'checkout-form']); ?>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 px-6 py-8"
        x-data="{
            subtotal: <?php echo $subtotal; ?>,
            deliveryFee: 700,
            get total() {
                return this.subtotal + this.deliveryFee;
            },
            updateSubtotal(newTotal, oldTotal) {
                this.subtotal = this.subtotal - oldTotal + newTotal;
            }
        }"
        @update-subtotal.window="updateSubtotal($event.detail.newTotal, $event.detail.oldTotal)">
        <!-- Cart Items (60%) -->
        <div class="lg:col-span-7 space-y-4">
            <?php if ($dataProvider): ?>
                <?php $this->widget('zii.widgets.CListView', [
                    'id' => 'cart-list',
                    'dataProvider' => $dataProvider,
                    'itemView' => '_view',
                    'template' => '{items}',
                ]); ?>
            <?php elseif ($guestCart): ?>
                <?php foreach ($guestCart as $product): ?>
                    <?php
                        $mockCart = new Cart();
                        $mockCart->product = $product;
                        $mockCart->product_id = $product->id;
                        $mockCart->quantity = $quantities[$product->id] ?? 1;
                    ?>
                    <?php $this->renderPartial('_view', ['data' => $mockCart]); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500">Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <!-- Order Summary (40%) -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-xl p-6 shadow border border-gray-200 space-y-4">
                <h2 class="text-lg font-bold text-black">Order Summary</h2>

                <!-- Subtotal -->
                <div class="flex justify-between text-sm text-gray-700">
                    <span>Subtotal</span>
                    <span x-text="'₱' + subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 })"></span>
                </div>

                <!-- Delivery Fee -->
                <div class="flex justify-between text-sm text-gray-700">
                    <span>Delivery Fee</span>
                    <span x-text="'₱' + deliveryFee.toLocaleString(undefined, { minimumFractionDigits: 2 })"></span>
                </div>

                <!-- Voucher (optional placeholder remains the same) -->
                <div>
                    <!-- Add Voucher UI -->
                </div>

                <hr class="border-t border-gray-300 my-2" />

                <!-- Total -->
                <div class="flex justify-between text-base font-semibold text-black">
                    <span>Total</span>
                    <span x-text="'₱' + total.toLocaleString(undefined, { minimumFractionDigits: 2 })"></span>
                </div>

                <?php //echo CHtml::beginForm(['cart/checkout'], 'post'); ?>
                    <?php
                        echo CHtml::htmlButton(
                            '<span>Go to Checkout</span><i class="ph ph-arrow-right ml-2"></i>',
                            [
                                'type' => 'submit',
                                'class' => 'w-full bg-black text-white py-3 rounded-full hover:bg-gray-900 transition font-semibold flex justify-center items-center gap-2',
                                'encode' => false // This is important to allow raw HTML inside
                            ]
                        );
                    ?>
            </div>
        </div>
    </div>
<?php echo CHtml::endForm(); ?>
