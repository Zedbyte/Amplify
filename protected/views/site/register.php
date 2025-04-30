<?php
$form = $this->beginWidget('CActiveForm');
?>

<h1>Customer Registration</h1>

<?php echo $form->errorSummary($model); ?>

<p>
    <?php echo $form->labelEx($model, 'first_name'); ?>
    <?php echo $form->textField($model, 'first_name'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'last_name'); ?>
    <?php echo $form->textField($model, 'last_name'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'confirm_password'); ?>
    <?php echo $form->passwordField($model, 'confirm_password'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'address'); ?>
    <?php echo $form->textField($model, 'address'); ?>
</p>

<p>
    <?php echo $form->labelEx($model, 'phone_number'); ?>
    <?php echo $form->textField($model, 'phone_number'); ?>
</p>

<p>
    <?php echo CHtml::submitButton('Register'); ?>
</p>

<?php $this->endWidget(); ?>
