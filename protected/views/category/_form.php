<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'category-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'space-y-6'],
]); ?>

<!-- Error summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- Category Name -->
<div>
    <?php echo $form->labelEx($model, 'name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'name', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
    ]); ?>
    <?php echo $form->error($model, 'name', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Image Upload -->
<div>
    <?php echo $form->labelEx($model, 'imageFile', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->fileField($model, 'imageFile', [
        'class' => 'w-full text-sm text-gray-700 border border-gray-300 rounded-xl px-4 py-2 file:bg-gray-100 file:border-0 file:px-4 file:py-2 file:rounded file:cursor-pointer'
    ]); ?>
    <?php echo $form->error($model, 'imageFile', ['class' => 'text-red-600 text-sm mt-1']); ?>

    <?php if (!$model->isNewRecord && $model->image_path): ?>
        <div class="mt-4">
            <img src="<?php echo Yii::app()->baseUrl . '/images/categories/' . $model->image_path; ?>"
                 alt="<?php echo CHtml::encode($model->name); ?>"
                 class="h-32 rounded border border-gray-300 object-cover" />
        </div>
    <?php endif; ?>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
