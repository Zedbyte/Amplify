<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = ['Register'];
?>

<div class="h-full w-full flex items-center justify-center bg-white px-4 my-10">
    <div class="w-6/12 max-w-6/12 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        <h1 class="text-2xl font-semibold text-black mb-4">Customer Registration</h1>
        <p class="text-gray-500 mb-6">Fill in the details below to create your account.</p>

        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'register-form',
            'enableClientValidation' => true,
            'clientOptions' => ['validateOnSubmit' => true],
        ]); ?>

        <?php echo $form->errorSummary($model, null, null, ['class' => 'mb-4 p-4 border border-red-200 text-red-600 text-sm bg-red-50 rounded-lg']); ?>

        <?php
        $fields = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'email' => 'Email Address',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
        ];
        foreach ($fields as $attr => $label):
        ?>
            <div class="mb-5">
                <?php echo $form->labelEx($model, $attr, ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
                <?php
                $isPassword = in_array($attr, ['password', 'confirm_password']);
                echo $isPassword
                    ? $form->passwordField($model, $attr, [
                        'class' => 'block w-full rounded-xl border border-gray-300 px-4 py-2 text-black placeholder-gray-400 focus:border-black focus:ring-black'
                    ])
                    : $form->textField($model, $attr, [
                        'class' => 'block w-full rounded-xl border border-gray-300 px-4 py-2 text-black placeholder-gray-400 focus:border-black focus:ring-black'
                    ]);
                ?>
                <?php echo $form->error($model, $attr, ['class' => 'text-red-600 text-sm mt-1']); ?>
            </div>
        <?php endforeach; ?>

        <div>
            <?php echo CHtml::submitButton('Register', [
                'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
            ]); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
