<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'order-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<?php
$fields = [
    'order_date' => 'text',
    'total_price' => 'text',
    'customer_id' => 'text',
    'payment_id' => 'text',
    'shipment_id' => 'text',
    'status' => 'text',
    'is_received' => 'boolean',
    'created_at' => 'text',
    'updated_at' => 'text',
];

foreach ($fields as $attribute => $type): ?>
    <div>
        <?php echo $form->labelEx($model, $attribute, ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>

        <?php if ($type === 'boolean'): ?>
            <?php echo $form->dropDownList($model, $attribute, [
                0 => 'No',
                1 => 'Yes'
            ], [
                'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
            ]); ?>

		<?php elseif ($attribute === 'status'): ?>
			<?php echo $form->dropDownList($model, 'status', [
				0 => 'Pending',
				1 => 'Accepted',
				2 => 'Shipped'
			], [
				'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
			]); ?>
		<?php else: ?>
			<?php echo $form->textField($model, $attribute, [
				'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
			]); ?>
		<?php endif; ?>

				<?php echo $form->error($model, $attribute, ['class' => 'text-red-600 text-sm mt-1']); ?>
			</div>
		<?php endforeach; ?>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
