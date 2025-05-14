<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $user User */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'customer-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error Summary -->
<?php echo $form->errorSummary([$model, $user], null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<!-- User Fields -->
<div>
    <h2 class="text-lg font-semibold text-gray-800 mb-4">User Account Info</h2>

    <!-- First Name -->
    <div class="mb-4">
        <?php echo $form->labelEx($user, 'first_name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($user, 'first_name', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($user, 'first_name', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <!-- Last Name -->
    <div class="mb-4">
        <?php echo $form->labelEx($user, 'last_name', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($user, 'last_name', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($user, 'last_name', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <!-- Username -->
    <div class="mb-4">
        <?php echo $form->labelEx($user, 'username', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($user, 'username', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($user, 'username', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <!-- Email -->
    <div class="mb-4">
        <?php echo $form->labelEx($user, 'email', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->emailField($user, 'email', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($user, 'email', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <!-- Password -->
    <div class="mb-4">
        <?php echo $form->labelEx($user, 'password', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->passwordField($user, 'password', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($user, 'password', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>
</div>

<!-- Customer Fields -->
<div>
    <!-- Address -->
    <div class="mb-4">
        <?php echo $form->labelEx($model, 'address', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'address', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($model, 'address', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <!-- Phone Number -->
    <div class="mb-4">
        <?php echo $form->labelEx($model, 'phone_number', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'phone_number', [
            'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2'
        ]); ?>
        <?php echo $form->error($model, 'phone_number', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>
</div>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
