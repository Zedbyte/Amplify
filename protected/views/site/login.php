<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = ['Login'];
?>

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
    <!-- Left Side: Banner / Image -->
    <div class="lg:col-span-7 h-25">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/login_banner.png"
            alt="Band Promo"
            class="w-full h-52 sm:h-72 md:h-96 lg:h-screen object-cover object-[center_20%] lg:object-[center_30%]" />
    </div>


    <!-- Right Side: Login Form -->
    <div class="relative lg:col-span-5 flex items-center justify-center px-6 py-10 bg-white">
    
        <!-- Back Arrow: top-left -->
        <a href="<?php echo Yii::app()->createUrl('/'); ?>" 
        class="absolute top-4 left-4 text-gray-700 hover:text-black transition-all duration-200 transform hover:-translate-x-1 hover:font-bold">
            <i class="ph ph-arrow-left text-2xl"></i>
        </a>
        
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="mb-6 text-center">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png" alt="Amplify Logo" class="mx-auto h-14">
            </div>

            <h1 class="text-2xl font-bold text-black mb-2">Welcome Back</h1>
            <p class="text-gray-500 mb-6">Login and pick up where your music left off</p>

            <?php $form = $this->beginWidget('CActiveForm', [
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => ['validateOnSubmit' => true],
            ]); ?>

            <!-- Email -->
            <div class="mb-4">
                <?php echo $form->labelEx($model, 'username', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
                <?php echo $form->textField($model, 'username', [
                    'placeholder' => 'Enter username',
                    'class' => 'w-full rounded-lg border px-4 py-2 text-black border-gray-300 focus:ring-1 focus:ring-black focus:outline-none'
                ]); ?>
                <?php echo $form->error($model, 'username', ['class' => 'text-red-600 text-sm mt-1']); ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <?php echo $form->labelEx($model, 'password', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
                <?php echo $form->passwordField($model, 'password', [
                    'placeholder' => 'Enter password',
                    'class' => 'w-full rounded-lg border px-4 py-2 text-black border-gray-300 focus:ring-1 focus:ring-black focus:outline-none'
                ]); ?>
                <?php echo $form->error($model, 'password', ['class' => 'text-red-600 text-sm mt-1']); ?>
            </div>

            <!-- Remember me & forgot password -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <?php echo $form->checkBox($model, 'rememberMe', ['class' => 'rounded border-gray-300 text-black focus:ring-black']); ?>
                    <?php echo $form->label($model, 'rememberMe', ['class' => 'text-sm text-gray-700']); ?>
                </div>
                <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
            </div>

            <!-- Submit -->
            <div class="mb-4">
                <?php echo CHtml::submitButton("Let's Jam!", [
                    'class' => 'w-full bg-black text-white rounded-md py-2 text-sm font-semibold hover:bg-gray-900 transition'
                ]); ?>
            </div>

            <!-- Footer -->
            <p class="text-sm text-center text-gray-700">
                Don't have an account?
                <a href="<?php echo Yii::app()->createUrl('/site/register'); ?>" class="text-blue-500 hover:underline">Sign up now</a>
            </p>
            
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

