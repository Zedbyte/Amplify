<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error Summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- First Name -->
<div>
    <?php echo $form->labelEx($model, 'first_name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'first_name', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2',
        'maxlength' => 100,
    ]); ?>
    <?php echo $form->error($model, 'first_name', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Last Name -->
<div>
    <?php echo $form->labelEx($model, 'last_name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'last_name', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2',
        'maxlength' => 100,
    ]); ?>
    <?php echo $form->error($model, 'last_name', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Username -->
<div>
    <?php echo $form->labelEx($model, 'username', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->textField($model, 'username', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2',
        'maxlength' => 100,
    ]); ?>
    <?php echo $form->error($model, 'username', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Email -->
<div>
    <?php echo $form->labelEx($model, 'email', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->emailField($model, 'email', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2',
        'maxlength' => 100,
    ]); ?>
    <?php echo $form->error($model, 'email', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Password -->
<div>
    <?php echo $form->labelEx($model, 'password', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->passwordField($model, 'password', [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2',
        'maxlength' => 100,
    ]); ?>
    <?php echo $form->error($model, 'password', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Role (Hidden as Admin only) -->
<div>
    <?php echo $form->labelEx($model, 'role', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
    <?php echo $form->dropDownList($model, 'role', [2 => 'Admin'], [
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 cursor-not-allowed',
        'readonly' => true,
        'disabled' => true,
    ]); ?>
    <?php echo $form->error($model, 'role', ['class' => 'text-red-600 text-sm mt-1']); ?>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Admin' : 'Save Changes', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
