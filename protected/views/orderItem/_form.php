<?php
/* @var $this OrderItemController */
/* @var $model OrderItem */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'order-item-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error Summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- Quantity -->
<div>
    <?php echo $form->labelEx($model, 'quantity', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'quantity', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'quantity', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Price -->
<div>
    <?php echo $form->labelEx($model, 'price', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'price', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none',
        'maxlength' => 10
    ]); ?>
    <?php echo $form->error($model, 'price', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Product ID -->
<div>
    <?php echo $form->labelEx($model, 'product_id', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'product_id', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'product_id', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Order ID -->
<div>
    <?php echo $form->labelEx($model, 'order_id', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'order_id', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'order_id', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Status -->
<div>
    <?php echo $form->labelEx($model, 'status', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->dropDownList($model, 'status', [
        0 => 'Pending',
        1 => 'Processed',
        2 => 'Shipped',
        3 => 'Cancelled',
    ], [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'status', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Created At -->
<div>
    <?php echo $form->labelEx($model, 'created_at', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'created_at', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none',
        'placeholder' => 'YYYY-MM-DD HH:MM:SS'
    ]); ?>
    <?php echo $form->error($model, 'created_at', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Updated At -->
<div>
    <?php echo $form->labelEx($model, 'updated_at', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'updated_at', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none',
        'placeholder' => 'YYYY-MM-DD HH:MM:SS'
    ]); ?>
    <?php echo $form->error($model, 'updated_at', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Order Item' : 'Save Changes', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
