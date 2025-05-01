<?php
/* @var $dataProvider CActiveDataProvider|null */ ?>

<h1 class="font-bold text-2xl px-6 pt-6">Your Cart</h1>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 px-6 py-8">
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
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <?php foreach ($guestCart as $product): ?>
                    <div class="bg-white rounded-xl p-4">
                        <img src="<?php echo Yii::app()->baseUrl . '/images/products/' . $product->image_path; ?>"
                             class="w-full h-40 object-contain mb-4" alt="<?php echo CHtml::encode($product->name); ?>">
                        <h3 class="text-md font-semibold"><?php echo CHtml::encode($product->name); ?></h3>
                        <p class="text-sm text-gray-500">Qty: <?php echo $quantities[$product->id]; ?></p>
                        <p class="text-lg font-semibold">₱<?php echo number_format($product->price, 2); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Order Summary (40%) -->
    <div class="lg:col-span-5">
        <div class="bg-white rounded-xl p-6 shadow border border-gray-200 space-y-4">
            <h2 class="text-lg font-bold text-black">Order Summary</h2>

            <div class="flex justify-between text-sm text-gray-700">
                <span>Subtotal</span>
                <span>₱47,960.00</span>
            </div>

            <div class="flex justify-between text-sm text-gray-700">
                <span>Delivery Fee</span>
                <span>₱700.00</span>
            </div>

            <!-- Voucher -->
            <div>
                <button class="text-sm text-blue-600 hover:underline font-medium">
                    + Add Voucher
                </button>
                <!-- You could open a modal or dropdown here -->
            </div>

            <hr class="border-t border-gray-300 my-2" />

            <div class="flex justify-between text-base font-semibold text-black">
                <span>Total</span>
                <span>₱48,660.00</span>
            </div>

            <button class="w-full bg-black text-white py-3 rounded-full hover:bg-gray-900 transition font-semibold flex justify-center items-center gap-2">
                Go to Checkout
                <i class="ph ph-arrow-right"></i>
            </button>
        </div>
    </div>
</div>

