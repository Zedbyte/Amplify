<?php
/* @var $dataProvider CActiveDataProvider|null */ ?>

<?php if ($dataProvider): ?>
	<?php $this->widget('zii.widgets.CListView', [
		'id' => 'cart-list',
		'dataProvider' => $dataProvider,
		'itemView' => '_view',
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
