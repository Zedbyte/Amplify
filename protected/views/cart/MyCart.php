<?php
/* @var $dataProvider CActiveDataProvider|null */ 

$total = $subtotal + $deliveryFee;
?>

<h1 class="font-bold text-2xl px-6 pt-6">Your Cart</h1>

<?php echo CHtml::beginForm(['cart/checkout'], 'post', ['id' => 'checkout-form']); ?>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 px-6 py-8"
        x-data="{
            originalSubtotal: <?php echo $subtotal; ?>,
            subtotal: <?php echo $subtotal; ?>,
            deliveryFee: 0,

            get total() {
                return this.subtotal + this.deliveryFee;
            },

            updateSubtotal(newTotal, oldTotal) {
                this.originalSubtotal = this.originalSubtotal - oldTotal + newTotal;
                this.subtotal = this.originalSubtotal;
            },

            recalculateSelectedSubtotal() {
                const checkboxes = document.querySelectorAll('.select-item');
                const checked = document.querySelectorAll('.select-item:checked');
                
                // If none are selected, fallback to full subtotal
                if (checked.length === 0) {
                    this.subtotal = this.originalSubtotal;
                    return;
                }

                let total = 0;
                checked.forEach(cb => {
                    const price = parseFloat(cb.dataset.price);
                    const qty = parseInt(cb.dataset.qty);
                    total += price * qty;
                });

                this.subtotal = total;
            }
        }"
        @update-subtotal.window="updateSubtotal($event.detail.newTotal, $event.detail.oldTotal)"
        @change.window="
            if ($event.target.classList.contains('select-item')) {
                recalculateSelectedSubtotal();
            }
        "
        >
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
                <!-- <div class="flex justify-between text-sm text-gray-700">
                    <span>Delivery Fee</span>
                    <span x-text="'₱' + deliveryFee.toLocaleString(undefined, { minimumFractionDigits: 2 })"></span>
                </div> -->

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

<!-- Somewhere at the end of your cart view layout -->
<form id="delete-cart-form" method="post" style="display: none;">
  <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>">
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        const target = e.target.closest('.delete-cart-item');
        if (!target) return;

        e.preventDefault();

        if (!confirm('Are you sure you want to remove this item?')) {
            return; // user cancelled – do nothing
        }

        const form = document.getElementById('delete-cart-form');
        if (!form) {
            console.error('Delete form not found.');
            return;
        }

        form.action = `/index.php/cart/delete?id=${target.dataset.id}`;
        form.submit();
    });
});
</script>

