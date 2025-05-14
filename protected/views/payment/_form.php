<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'payment-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error Summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- Payment Date -->
<div>
    <?php echo $form->labelEx($model, 'payment_date', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'payment_date', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'payment_date', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Payment Method -->
<div>
    <?php echo $form->labelEx($model, 'payment_method', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'payment_method', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none',
        'maxlength' => 100
    ]); ?>
    <?php echo $form->error($model, 'payment_method', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Amount -->
<div>
    <?php echo $form->labelEx($model, 'amount', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'amount', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none',
        'maxlength' => 10
    ]); ?>
    <?php echo $form->error($model, 'amount', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Customer ID -->
<div>
    <?php echo $form->labelEx($model, 'customer_id', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'customer_id', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'customer_id', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Status -->
<div>
    <?php echo $form->labelEx($model, 'status', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->dropDownList($model, 'status', [
        0 => 'Pending',
        1 => 'Paid',
        2 => 'Failed'
    ], [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'status', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Created At -->
<div>
    <?php echo $form->labelEx($model, 'created_at', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'created_at', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'created_at', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Updated At -->
<div>
    <?php echo $form->labelEx($model, 'updated_at', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'updated_at', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'updated_at', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
