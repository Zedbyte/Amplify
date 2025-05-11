<div class="flex flex-col justify-center items-center min-h-screen">
    <div class="flex flex-col bg-white p-6 shadow-md rounded-lg border border-gray-200">
        <!-- Header: Logo & Title -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <i class="ph ph-truck text-2xl text-black"></i>
                <h1 class="text-2xl font-bold">Dispatch Slip</h1>
            </div>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png"
            alt="Amplify's Logo"
            class="h-14 object-contain" />
        </div>

        <!-- Order Details -->
        <div class="space-y-3 text-sm text-gray-700">
            <p><span class="font-medium text-gray-900">Order #:</span> <?php echo $order->id; ?></p>
            <p><span class="font-medium text-gray-900">Shipment Date:</span> <?php echo $shipment->shipment_date; ?></p>
            <p><span class="font-medium text-gray-900">Ship To:</span> <?php echo $shipment->address . ', ' . $shipment->city . ', ' . $shipment->country; ?></p>
            
            <!-- Status Display -->
            <p class="flex items-center gap-2">
                <span class="font-medium text-gray-900">Status:</span> 
                <?php if ($shipment->status == 0): ?>
                    <span class="flex items-center gap-1 text-yellow-600">
                        <i class="ph ph-clock text-lg"></i> Pending
                    </span>
                <?php else: ?>
                    <span class="flex items-center gap-1 text-green-600">
                        <i class="ph ph-check-circle text-lg"></i> Shipped
                    </span>
                <?php endif; ?>
            </p>
        </div>

        <!-- CTA Button -->
        <div class="mt-6">
            <a href="<?php echo Yii::app()->createUrl('order/view', ['id' => $order->id]); ?>"
            class="inline-flex items-center gap-2 px-4 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
                <i class="ph ph-arrow-right"></i>
                View Order Details
            </a>
        </div>

        <!-- Footer Message -->
        <div class="mt-8 border-t pt-4 text-xs text-gray-500 text-center">
            Thank you for choosing our service. For assistance, contact amplify@gmail.com.
        </div>
    </div>
</div>