<div class="flex bg-white shadow-sm rounded-xl border border-gray-200 mb-4 hover:shadow-md transition">
	<!-- Left Strip -->
	<div class="w-2 sm:w-6 bg-gradient-to-r from-black via-stone-950 to-stone-700 rounded-l-xl"></div>

    <!-- Header: Order ID and Status -->
    <div class="p-6 w-full">
		<div class="flex justify-between items-center mb-4">
			<h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
				<i class="ph ph-shopping-cart text-xl text-blue-500"></i>
				Order #
				<a href="<?php echo CHtml::normalizeUrl(['view', 'id' => $data->id]); ?>" class="text-blue-600 hover:underline">
					<?php echo CHtml::encode($data->id); ?>
				</a>
			</h3>
			<span class="inline-flex items-center gap-1 text-sm px-2 py-1 rounded-full 
				<?php echo $data->status == 1 ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'; ?>">
				<i class="ph <?php echo $data->status == 1 ? 'ph-check-circle' : 'ph-clock'; ?>"></i>
				<?php echo $data->status == 1 ? 'Accepted' : 'Pending'; ?>
			</span>
		</div>

		<!-- Metadata Section -->
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-700">
			<div class="flex items-center gap-2">
				<i class="ph ph-calendar text-gray-500"></i>
				<span class="font-medium text-gray-900">Order Date:</span> <?php echo CHtml::encode($data->order_date); ?>
			</div>
			<div class="flex items-center gap-2">
				<i class="ph ph-currency-circle-dollar text-gray-500"></i>
				<span class="font-medium text-gray-900">Total:</span> ₱<?php echo number_format($data->total_price, 2); ?>
			</div>
			<div class="flex items-center gap-2">
				<i class="ph ph-user text-gray-500"></i>
				<span class="font-medium text-gray-900">Customer ID:</span> <?php echo CHtml::encode($data->customer_id); ?>
			</div>
			<div class="flex items-center gap-2">
				<i class="ph ph-credit-card text-gray-500"></i>
				<span class="font-medium text-gray-900">Payment ID:</span> <?php echo CHtml::encode($data->payment_id ?? '—'); ?>
			</div>
			<div class="flex items-center gap-2">
				<i class="ph ph-truck text-gray-500"></i>
				<span class="font-medium text-gray-900">Shipment ID:</span> <?php echo CHtml::encode($data->shipment_id ?? '—'); ?>
			</div>
		</div>

		<?php if ($data->status == 0): ?>
			<div class="mt-4 flex justify-end">
				<a href="<?php echo Yii::app()->createUrl('order/createCheckoutSession', ['orderId' => $data->id]); ?>"
				class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition">
					<i class="ph ph-arrow-circle-right text-lg"></i>
					Proceed to Checkout
				</a>
			</div>
		<?php endif; ?>

	</div>

</div>
