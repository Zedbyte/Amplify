<?php
/* @var $this ShipmentController */
/* @var $model Shipment */
/* @var $form CActiveForm */
?>

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow my-10">
    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'shipment-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => ['class' => 'space-y-6'],
    ]); ?>

    <?php echo $form->errorSummary($model, null, null, [
        'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
    ]); ?>

    <div>
        <?php echo $form->labelEx($model, 'shipment_date', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'shipment_date', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'shipment_date', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'address', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'address', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'address', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'city', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'city', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'city', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'state', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'state', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'state', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'country', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'country', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'country', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'zip_code', ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>
        <?php echo $form->textField($model, 'zip_code', [
            'class' => 'w-full border border-gray-300 rounded-lg px-4 py-2 text-black focus:ring-1 focus:ring-black focus:outline-none'
        ]); ?>
        <?php echo $form->error($model, 'zip_code', ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Shipment' : 'Save Changes', [
            'class' => 'w-full bg-black text-white py-2 rounded-lg hover:bg-gray-900 font-semibold transition'
        ]); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
