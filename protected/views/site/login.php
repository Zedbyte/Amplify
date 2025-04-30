<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = ['Login'];
?>

<div class="h-full w-full flex items-center justify-center bg-white px-4">
    <div class="w-6/12 max-w-6/12 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        <h1 class="text-2xl font-semibold text-black mb-4">Login</h1>
        <p class="text-gray-500 mb-6">Enter your credentials to access your account.</p>

        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => ['validateOnSubmit' => true],
        ]); ?>

        <div class="mb-5">
            <?php echo $form->labelEx($model, 'username', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
            <?php echo $form->textField($model, 'username', [
                'class' => 'block w-full rounded-xl border border-gray-300 px-4 py-2 text-black placeholder-gray-400 focus:border-black focus:ring-black'
            ]); ?>
            <?php echo $form->error($model, 'username', ['class' => 'text-red-600 text-sm mt-1']); ?>
        </div>

        <div class="mb-5">
            <?php echo $form->labelEx($model, 'password', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
            <?php echo $form->passwordField($model, 'password', [
                'class' => 'block w-full rounded-xl border border-gray-300 px-4 py-2 text-black placeholder-gray-400 focus:border-black focus:ring-black'
            ]); ?>
            <?php echo $form->error($model, 'password', ['class' => 'text-red-600 text-sm mt-1']); ?>

            <p class="text-xs text-gray-400 mt-2">
                Hint: You may login with <kbd class="bg-gray-100 px-1 rounded text-black">demo</kbd>/<kbd class="bg-gray-100 px-1 rounded text-black">demo</kbd> or <kbd class="bg-gray-100 px-1 rounded text-black">admin</kbd>/<kbd class="bg-gray-100 px-1 rounded text-black">admin</kbd>.
            </p>
        </div>

        <div class="mb-6 flex items-center space-x-2">
            <?php echo $form->checkBox($model, 'rememberMe', ['class' => 'rounded border-gray-300 text-black focus:ring-black']); ?>
            <?php echo $form->label($model, 'rememberMe', ['class' => 'text-sm text-gray-700']); ?>
            <?php echo $form->error($model, 'rememberMe', ['class' => 'text-red-600 text-sm']); ?>
        </div>

        <div>
            <?php echo CHtml::submitButton('Login', [
                'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
            ]); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
