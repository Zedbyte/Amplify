<?php
/* @var $this BrandController */
/* @var $model Brand */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'brand-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error Summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- Name -->
<div>
    <?php echo $form->labelEx($model, 'name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'name', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'name', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Status -->
<div>
    <?php echo $form->labelEx($model, 'status', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->dropDownList($model, 'status', [
        0 => 'Inactive',
        1 => 'Active',
    ], [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'status', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
