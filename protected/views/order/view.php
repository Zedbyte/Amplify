<?php
/* @var $this OrderController */
/* @var $order Order */
/* @var $shipment Shipment */
/* @var $payment Payment */
/* @var $products array */
/* @var $paymentIntent \Stripe\PaymentIntent|null */

$this->breadcrumbs = ['Orders' => ['index'], "Order #{$order->id}"];
?>

<div class="flex flex-col justify-center items-center bg-gray-50 px-4 py-8">
    <div class="w-full max-w-3xl bg-white p-6 shadow-md rounded-lg border border-gray-200 space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ph ph-receipt text-2xl text-indigo-600"></i>
                <h1 class="text-2xl font-bold">Order Slip</h1>
            </div>
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                <?php
                    echo match ($order->status) {
                        1 => 'bg-green-100 text-green-700',
                        2 => 'bg-blue-100 text-blue-700',
                        default => 'bg-yellow-100 text-yellow-700',
                    };
                ?>">
                <?php
                    echo match ($order->status) {
                        1 => 'Accepted',
                        2 => 'Shipped',
                        default => 'Pending',
                    };
                ?>
            </span>
        </div>

        <!-- Order Summary -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-semibold text-gray-900">Order ID:</span> 2025_AMP_OD_<?php echo $order->id; ?></p>
            <p><span class="font-semibold text-gray-900">Order Date:</span> <?php echo $order->order_date; ?></p>
            <p><span class="font-semibold text-gray-900">Reference ID:</span> <?php echo $order->reference_id ?? '—'; ?></p>
            <p><span class="font-semibold text-gray-900">Total Price:</span> ₱<?php echo number_format($order->total_price, 2); ?></p>
            <p><span class="font-semibold text-gray-900">Received:</span> <?php echo $order->is_received ? 'Yes' : 'No'; ?></p>
        </div>

        <!-- Shipment Info -->
        <div class="space-y-2 text-sm text-gray-700">
            <h2 class="text-base font-semibold text-black">Shipping Information</h2>
            <?php if ($shipment): ?>
                <p><span class="font-medium">Shipment ID: 2025_AMP_SP_</span><?php echo $shipment->id; ?></p>
                <p><span class="font-medium">Address:</span> <?php echo CHtml::encode($shipment->address); ?></p>
                <p><span class="font-medium">Shipment Date:</span> <?php echo $shipment->shipment_date ?? '—'; ?></p>
                <p>
                    <span class="font-medium">Status:</span>
                    <?php if ($shipment->status == 0): ?>
                        <span class="text-yellow-600 flex items-center gap-1"><i class="ph ph-clock"></i> Pending</span>
                    <?php else: ?>
                        <span class="text-green-600 flex items-center gap-1"><i class="ph ph-truck"></i> Shipped</span>
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <p class="text-gray-500 italic">No shipment assigned.</p>
            <?php endif; ?>
        </div>

        <!-- Payment Info -->
        <div class="space-y-2 text-sm text-gray-700">
            <h2 class="text-base font-semibold text-black">Payment Details</h2>
            <?php if ($payment): ?>
                <p><span class="font-medium">Payment ID:</span> 2025_AMP_PM_<?php echo $payment->id; ?></p>
                <p><span class="font-medium">Amount Paid:</span> ₱<?php echo number_format($payment->amount, 2); ?></p>
                <p><span class="font-medium">Method:</span> <?php echo CHtml::encode($payment->payment_method); ?></p>
                <p><span class="font-medium">Payment Date:</span> <?php echo $payment->payment_date; ?></p>
                <p><span class="font-medium">Reference Number:</span> <?php echo $paymentIntent->id ?? 'N/A'; ?></p>
            <?php else: ?>
                <p class="text-gray-500 italic">No payment record found.</p>
            <?php endif; ?>
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
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-2 font-semibold text-right">Total</td>
                        <td class="px-4 py-2 font-bold text-right text-emerald-600">
                            ₱<?php echo number_format($order->total_price, 2); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="pt-6 border-t text-xs text-gray-500 text-center">
            This is your official order slip. For inquiries, please contact amplify@gmail.com.
        </div>
    </div>
</div>
