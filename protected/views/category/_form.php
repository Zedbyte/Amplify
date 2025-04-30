<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'category-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['enctype' => 'multipart/form-data'],
]); ?>

<!-- Category Name -->
<div class="mb-4">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', ['class' => 'form-input']); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<!-- Image Upload -->
<div class="mb-4">
    <?php echo $form->labelEx($model, 'imageFile'); ?>
    <?php echo $form->fileField($model, 'imageFile'); ?>
    <?php echo $form->error($model, 'imageFile'); ?>

    <?php if (!$model->isNewRecord && $model->image_path): ?>
        <div class="mt-2">
            <img src="<?php echo Yii::app()->baseUrl . '/images/categories/' . $model->image_path; ?>"
                 alt="<?php echo CHtml::encode($model->name); ?>"
                 class="h-32 rounded border" />
        </div>
    <?php endif; ?>
</div>

<!-- Submit -->
<div class="mt-6">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'bg-black text-white px-4 py-2 rounded']); ?>
</div>

<?php $this->endWidget(); ?>


</div><!-- form -->