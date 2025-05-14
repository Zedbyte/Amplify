<?php
/* @var $this ShipmentController */
/* @var $model Shipment */

$this->breadcrumbs = ['Shipments' => ['index'], 'Shipment #' . $model->id];
?>

<!-- Page Container -->
<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i class="ph ph-eye text-3xl text-indigo-600"></i>
            <h1 class="text-2xl font-bold text-gray-900">View Shipment #<?php echo CHtml::encode($model->id); ?></h1>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <a href="<?php echo $this->createUrl('update', ['id' => $model->id]); ?>"
               class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center">
                <i class="ph ph-pencil-simple mr-1"></i> Edit
            </a>
            <?php echo CHtml::link('<i class="ph ph-trash mr-1"></i> Delete',
                '#',
                [
                    'class' => 'px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center',
                    'submit' => ['delete', 'id' => $model->id],
                    'confirm' => 'Are you sure you want to delete this shipment?'
                ]); ?>
            <a href="<?php echo $this->createUrl('index'); ?>"
               class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                <i class="ph ph-list mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="grid md:grid-cols-2 gap-6">
            <?php
            $attributes = [
                'ID' => $model->id,
                'Shipment Date' => $model->shipment_date,
                'Address' => $model->address,
                'City' => $model->city,
                'State' => $model->state,
                'Country' => $model->country,
                'Zip Code' => $model->zip_code,
                'Customer ID' => $model->customer_id,
                'Status' => $model->status ? '<span class="text-emerald-600">Active</span>' : '<span class="text-red-600">Inactive</span>',
                'Created At' => $model->created_at,
                'Updated At' => $model->updated_at,
            ];

            foreach ($attributes as $label => $value): ?>
                <div>
                    <div class="text-sm text-gray-500"><?php echo $label; ?></div>
                    <div class="text-base font-medium text-gray-800">
                        <?php echo is_string($value) && strip_tags($value) !== $value ? $value : CHtml::encode($value); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
