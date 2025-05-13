<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 px-4 py-8">
    <div class="w-full max-w-3xl bg-white p-6 shadow-md rounded-lg border border-gray-200 space-y-6">

        <!-- Header: Logo & Title -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ph ph-truck text-2xl text-black"></i>
                <h1 class="text-2xl font-bold">Dispatch Slip</h1>
            </div>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png"
                 alt="Amplify's Logo"
                 class="h-14 object-contain" />
        </div>

        <!-- Order Summary -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-semibold text-gray-900">Order ID.</span> 2025_AMP_OD_<?php echo $order->id; ?></p>
            <p><span class="font-semibold text-gray-900">Order Date:</span> <?php echo $order->order_date; ?></p>
            <p><span class="font-semibold text-gray-900">Shipment Date:</span> <?php echo $shipment->shipment_date; ?></p>
            <p><span class="font-semibold text-gray-900">Total Price:</span> ₱<?php echo number_format($order->total_price, 2); ?></p>
        </div>

        <!-- Shipment Info -->
        <div class="space-y-2 text-sm text-gray-700">
            <h2 class="text-base font-semibold text-black">Shipping Information</h2>
            <p><span class="font-medium">Address:</span> <?php echo $shipment->address; ?></p>

            <p>
                <span class="font-medium">Status:</span>
                <?php if ($shipment->status == 0): ?>
                    <span class="text-yellow-600 flex items-center gap-1"><i class="ph ph-clock"></i> Pending</span>
                <?php else: ?>
                    <span class="text-green-600 flex items-center gap-1"><i class="ph ph-check-circle"></i> Shipped</span>
                <?php endif; ?>
            </p>
        </div>

        <!-- Payment Info -->
        <div class="space-y-2 text-sm text-gray-700">
            <h2 class="text-base font-semibold text-black">Payment Details</h2>
            <p><span class="font-medium">Payment ID:</span> 2025_AMP_PM_<?php echo $payment->id ?? 'N/A'; ?></p>
            <p><span class="font-medium">Reference Number:</span> <?php echo $paymentIntent->id ?? 'N/A'; ?></p>
            <p><span class="font-medium">Amount Paid:</span> ₱<?php echo number_format($payment->amount ?? 0, 2); ?></p>
        </div>

        <!-- Product List -->
        <div class="space-y-2 text-sm text-gray-700">
            <h2 class="text-base font-semibold text-black">Items Ordered</h2>
            <table class="w-full text-sm text-left border border-gray-200 rounded overflow-hidden">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="px-4 py-2 border-b">Product</th>
                        <th class="px-4 py-2 border-b text-center">Qty</th>
                        <th class="px-4 py-2 border-b text-right">Price</th>
                        <th class="px-4 py-2 border-b text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo CHtml::encode($product['name']); ?></td>
                            <td class="px-4 py-2 text-center"><?php echo $product['quantity']; ?></td>
                            <td class="px-4 py-2 text-right">₱<?php echo number_format($product['price'], 2); ?></td>
                            <td class="px-4 py-2 text-right">₱<?php echo number_format($product['subtotal'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- CTA Button -->
        <div class="pt-4">
            <a href="<?php echo Yii::app()->createUrl('order/view', ['id' => $order->id]); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
                <i class="ph ph-arrow-right"></i>
                View Full Order
            </a>
        </div>

        <!-- Footer Message -->
        <div class="pt-6 border-t text-xs text-gray-500 text-center">
            Thank you for your order! For any questions, contact amplify@gmail.com.
        </div>
    </div>
</div>
