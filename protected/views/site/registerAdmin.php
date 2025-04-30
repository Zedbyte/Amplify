<?php
$form = $this->beginWidget('CActiveForm');
?>

<h1>Admin Registration</h1>

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
    <?php echo CHtml::submitButton('Register Admin'); ?>
</p>

<?php $this->endWidget(); ?>
