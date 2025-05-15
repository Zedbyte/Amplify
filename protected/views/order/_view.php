<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="relative flex bg-white shadow-sm rounded-xl border border-gray-200 mb-6 overflow-hidden hover:shadow-md transition">
    <!-- Diagonal Stripe with Vertical Status Label -->
    <div class="relative w-20 min-w-[5rem] bg-gradient-to-br from-black via-stone-900 to-stone-700">
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="transform -rotate-90 text-sm font-extrabold tracking-wider uppercase 
                <?php 
                    echo $data->status == 1 ? 'text-green-400' : 
                        ($data->status == 2 ? 'text-blue-400' : 'text-yellow-300'); 
                ?>">
                <?php 
                    echo $data->status == 1 ? 'Accepted' : 
                        ($data->status == 2 ? 'Shipped' : 'Pending'); 
                ?>
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6 flex-1 pl-4 relative">
        <!-- Top: Header + Total -->
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                <i class="ph ph-shopping-cart text-2xl text-blue-500"></i>
                Order #
                <a href="<?php echo CHtml::normalizeUrl(['view', 'id' => $data->id]); ?>" class="text-blue-600 hover:underline">
                    <?php echo CHtml::encode($data->id); ?>
                </a>
            </h3>
            <div class="text-right">
                <div class="text-xs uppercase text-gray-500">Total</div>
                <div class="text-2xl font-bold text-emerald-600">₱<?php echo number_format($data->total_price, 2); ?></div>
            </div>
        </div>

        <!-- Order Items Section -->
        <div class="mb-5">
            <div class="flex items-center gap-2 mb-2 text-gray-500 text-sm uppercase font-semibold">
                <i class="ph ph-list-bullets text-lg"></i>
                Order Items
            </div>
            <ul class="space-y-2 pl-4">
                <?php foreach ($data->orderItems as $item): ?>
                    <li class="flex justify-between items-center bg-gray-50 rounded px-3 py-2">
                        <span class="text-gray-800 font-medium"><?php echo CHtml::encode($item->product->name); ?></span>
                        <span class="text-sm text-gray-500">× <?php echo $item->quantity; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Metadata -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-base text-gray-700 ml-2">
            <div class="flex items-center gap-3">
                <i class="ph ph-calendar text-xl text-gray-500"></i>
                <div>
                    <div class="text-sm text-gray-500">Order Date</div>
                    <div class="font-medium text-gray-900"><?php echo CHtml::encode($data->order_date); ?></div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <i class="ph ph-credit-card text-xl text-gray-500"></i>
                <div>
                    <div class="text-sm text-gray-500">Payment ID</div>
                    <div class="font-medium text-gray-900"><?php echo CHtml::encode($data->payment_id ?? '—'); ?></div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <i class="ph ph-truck text-xl text-gray-500"></i>
                <div>
                    <div class="text-sm text-gray-500">Shipment ID</div>
                    <div class="font-medium text-gray-900"><?php echo CHtml::encode($data->shipment_id ?? '—'); ?></div>
                </div>
            </div>
        </div>

        <!-- Checkout CTA -->
        <?php if ($data->status == 0 && Yii::app()->user->role != 2): ?>
            <form action="<?php echo Yii::app()->createUrl('order/checkoutRedirect'); ?>" method="get" class="mt-6 flex justify-end">
                <input type="hidden" name="orderId" value="<?php echo $data->id; ?>">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2 text-base bg-black text-white rounded hover:bg-stone-900 transition">
                    <i class="ph ph-arrow-circle-right text-lg"></i>
                    Proceed to Checkout
                </button>
            </form>
            
        <?php elseif ($data->status == 1 && Yii::app()->user->role == 2): ?>
            <form action="<?php echo Yii::app()->createUrl('order/approveOrder'); ?>" method="get" class="mt-6 flex justify-end">
                <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2 text-base bg-black text-white rounded hover:bg-stone-900 transition">
                    <i class="ph ph-check-circle text-lg"></i>
                    Mark as Shipped
                </button>
            </form>
        <?php endif; ?> 
    </div>
</div>

