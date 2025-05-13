<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $orderItems OrderItem[] */

$this->breadcrumbs = ['Orders' => ['index'], "Order #{$model->id}"];
?>

<div class="max-w-3xl mx-auto px-6 py-10 bg-white border border-gray-200 rounded-xl shadow mt-15">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i class="ph ph-receipt text-2xl text-blue-600"></i>
                Order Slip — <span class="text-gray-700">Order #<?php echo $model->id; ?></span>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                <?php echo date('F j, Y, g:i A', strtotime($model->order_date)); ?>
            </p>
        </div>
        <div class="text-right">
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                <?php
                echo match ($model->status) {
                    1 => 'bg-green-100 text-green-700',
                    2 => 'bg-blue-100 text-blue-700',
                    default => 'bg-yellow-100 text-yellow-700',
                };
                ?>">
                <?php
                echo match ($model->status) {
                    1 => 'Accepted',
                    2 => 'Shipped',
                    default => 'Pending',
                };
                ?>
            </span>
        </div>
    </div>

    <!-- Order Info -->
    <div class="grid grid-cols-2 gap-6 text-sm text-gray-700 mb-6">
        <div>
            <div class="font-medium text-gray-900">Customer ID</div>
            <div>#<?php echo $model->customer_id; ?></div>
        </div>
        <div>
            <div class="font-medium text-gray-900">Payment</div>
            <div><?php echo $model->payment_id ?? '—'; ?></div>
        </div>
        <div>
			<div class="font-medium text-gray-900">Shipment</div>
			<div>
				<?php 
					if ($model->shipment === null) {
						echo '—';
					} else {
						echo $model->shipment->id . ' — ';
						echo $model->shipment->status == 1 ? 'In Transit' : 'Pending';
					}
				?>
			</div>
		</div>
        <div>
            <div class="font-medium text-gray-900">Received?</div>
            <div><?php echo $model->is_received ? 'Yes' : 'No'; ?></div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Order Items</h2>
        <table class="w-full border border-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">Product</th>
                    <th class="px-4 py-2 border-b text-center">Qty</th>
                    <th class="px-4 py-2 border-b text-right">Unit Price</th>
                    <th class="px-4 py-2 border-b text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $grandTotal = 0; ?>
                <?php foreach ($orderItems as $item): ?>
                    <?php
                        $subtotal = $item->price * $item->quantity;
                        $grandTotal += $subtotal;
                    ?>
                    <tr>
                        <td class="px-4 py-2 border-b"><?php echo CHtml::encode($item->product->name); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo $item->quantity; ?></td>
                        <td class="px-4 py-2 border-b text-right">₱<?php echo number_format($item->price, 2); ?></td>
                        <td class="px-4 py-2 border-b text-right">₱<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-4 py-2 font-semibold text-right">Total</td>
                    <td class="px-4 py-2 font-bold text-right text-emerald-600">₱<?php echo number_format($grandTotal, 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Footer -->
    <div class="text-center text-xs text-gray-400">
        Thank you for shopping with us. This serves as your digital order slip.
    </div>
</div>
