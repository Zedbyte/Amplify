<?php
/* @var $this ShipmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = ['Shipments'];
?>

<div class="flex justify-between items-center max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800">Shipments</h1>
    <div class="space-x-2">
        <a href="<?php echo $this->createUrl('create'); ?>" class="inline-flex items-center px-4 py-2 bg-black text-white text-sm font-medium rounded hover:bg-gray-800 transition">
            <i class="ph ph-plus-circle mr-1"></i> Create Shipment
        </a>
        <a href="<?php echo $this->createUrl('admin'); ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 transition">
            <i class="ph ph-gear mr-1"></i> Manage Shipments
        </a>
    </div>
</div>

<div class="space-y-4">
    <?php $this->widget('zii.widgets.CListView', [
        'dataProvider' => $dataProvider,
        'itemView' => '_view', // Uses your improved Tailwind-styled _view.php
        'template' => '{items}{pager}',
        'itemsCssClass' => 'space-y-4',
        'pagerCssClass' => 'mt-6 flex justify-center',
    ]); ?>
</div>
