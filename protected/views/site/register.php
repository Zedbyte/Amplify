<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = ['Register'];
?>

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
    <!-- Left Side: Registration Form -->
    <div class="relative lg:col-span-5 flex items-center justify-center px-6 py-10 bg-white order-2 lg:order-1">
        
        <!-- Back Arrow -->
        <a href="<?php echo Yii::app()->createUrl('/'); ?>"
            class="absolute top-4 left-4 text-gray-700 hover:text-black transition-all duration-200 transform hover:-translate-x-1 hover:font-bold">
            <i class="ph ph-arrow-left text-2xl"></i>
        </a>

        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="mb-6 text-center">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/amplify_logo.png" alt="Amplify Logo" class="mx-auto h-14">
            </div>

            <h1 class="text-2xl font-bold text-black mb-2">Create Your Account</h1>
            <p class="text-gray-500 mb-6">Start your musical journey with Amplify</p>

            <?php $form = $this->beginWidget('CActiveForm', [
                'id' => 'register-form',
                'enableClientValidation' => true,
                'clientOptions' => ['validateOnSubmit' => true],
            ]); ?>

            <?php echo $form->errorSummary($model, null, null, [
                'class' => 'mb-4 p-4 border border-red-200 text-red-600 text-sm bg-red-50 rounded-lg'
            ]); ?>

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

            <div class="mb-4">
                <?php echo CHtml::submitButton('Register', [
                    'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
                ]); ?>
            </div>

            <p class="text-sm text-center text-gray-700">
                Already have an account?
                <a href="<?php echo Yii::app()->createUrl('/site/login'); ?>" class="text-blue-500 hover:underline">Sign in here</a>
            </p>

            <?php $this->endWidget(); ?>
        </div>
    </div>

    <!-- Right Side: Image Banner -->
    <div class="lg:col-span-7 h-52 lg:h-full order-1 lg:order-2">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register_banner.png"
            alt="Amplify Visual"
            class="w-full object-cover object-[center_30%] h-full" />
    </div>

</div>
