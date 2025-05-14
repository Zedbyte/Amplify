<?php
/* @var $this OrderItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = ['Order Items'];
?>

<!-- Page Container -->
<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Order Items</h1>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <a href="<?php echo $this->createUrl('create'); ?>"
               class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                <i class="ph ph-plus-circle mr-1"></i> Create Order Item
            </a>
            <a href="<?php echo $this->createUrl('admin'); ?>"
               class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                <i class="ph ph-gear-six mr-1"></i> Manage Order Items
            </a>
        </div>
    </div>

    <!-- Order Item List -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <?php $this->widget('zii.widgets.CListView', [
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'ajaxUpdate' => false,
            'itemsCssClass' => 'divide-y divide-gray-100',
            'summaryCssClass' => 'p-4 text-sm text-gray-500',
            'pagerCssClass' => 'p-4',
            'htmlOptions' => ['class' => ''],
        ]); ?>
    </div>

</div>
