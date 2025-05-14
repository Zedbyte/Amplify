<?php
/* @var $this ShipmentController */
/* @var $data Shipment */
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4 flex flex-col gap-3 max-w-7xl mx-auto">
    <div class="flex justify-between items-center">
        <div class="text-lg font-semibold text-black">
            <i class="ph ph-truck mr-2 text-gray-500"></i>
            Shipment #<?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id], ['class' => 'text-blue-600 hover:underline']); ?>
        </div>
        <div class="text-sm text-gray-400">
            <i class="ph ph-calendar mr-1"></i>
            <?php echo CHtml::encode($data->shipment_date); ?>
        </div>
    </div>

    <div class="text-gray-700 text-sm flex items-start">
        <i class="ph ph-map-pin text-gray-500 mr-2 mt-0.5"></i>
        <div>
            <?php echo CHtml::encode($data->address); ?>
        </div>
    </div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>