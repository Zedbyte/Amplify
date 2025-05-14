<?php
/* @var $this OrderItemController */
/* @var $model OrderItem */

$this->breadcrumbs = ['Order Items' => ['index'], 'Manage'];

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $('#order-item-grid').yiiGridView('update', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>

<div class="max-w-7xl mx-auto px-6 py-10">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <i class="ph ph-gear-six text-2xl text-blue-600"></i>
            Manage Order Items
        </h1>

        <div class="flex space-x-5">
            <a href="<?php echo $this->createUrl('create'); ?>"
               class="px-4 py-2 text-sm bg-emerald-600 text-white rounded hover:bg-emerald-700 transition">
                <i class="ph ph-plus mr-1"></i> Create Order Item
            </a>
            <a href="<?php echo $this->createUrl('index'); ?>"
               class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition">
                <i class="ph ph-list mr-1"></i> List Order Items
            </a>
        </div>
    </div>

    <!-- Instructions -->
    <p class="text-sm text-gray-600 mb-4">
        You may optionally enter a comparison operator
        (<code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">&lt;</code>,
        <code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">&lt;=</code>,
        <code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">&gt;</code>,
        <code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">&gt;=</code>,
        <code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">&lt;&gt;</code>,
        or <code class="px-1 py-0.5 bg-gray-100 text-xs text-gray-700 rounded">=</code>) at the beginning of your search values.
    </p>

    <!-- Search Toggle -->
    <button class="search-button text-sm text-blue-600 hover:underline mb-4">
        <i class="ph ph-magnifying-glass mr-1"></i> Advanced Search
    </button>

    <div class="search-form mb-6 hidden">
        <div class="bg-gray-50 border border-gray-200 rounded p-4">
            <?php $this->renderPartial('_search', ['model' => $model]); ?>
        </div>
    </div>

    <!-- Grid View -->
    <?php $this->widget('zii.widgets.grid.CGridView', [
        'id' => 'order-item-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'itemsCssClass' => 'min-w-full divide-y divide-gray-200 border border-gray-200 rounded overflow-hidden text-sm text-center',
        'htmlOptions' => ['class' => 'overflow-x-auto'],
        'summaryCssClass' => 'text-sm text-gray-500 mb-2',
        'pagerCssClass' => 'mt-4',
        'columns' => [
            'id',
            'quantity',
            'price',
            'product_id',
            'order_id',
            [
                'name' => 'status',
                'value' => function ($data) {
                    $statuses = [0 => 'Pending', 1 => 'Processed', 2 => 'Shipped', 3 => 'Cancelled'];
                    return isset($statuses[$data->status]) ? $statuses[$data->status] : 'Unknown';
                },
                'filter' => [0 => 'Pending', 1 => 'Processed', 2 => 'Shipped', 3 => 'Cancelled'],
            ],
            [
                'class' => 'CButtonColumn',
                'template' => '{view} {update} {delete}',
                'htmlOptions' => ['class' => 'text-center whitespace-nowrap space-x-2'],
                'buttons' => [
                    'view' => [
                        'label' => '<i class="ph ph-eye"></i>',
                        'imageUrl' => false,
                        'encodeLabel' => false,
                        'options' => ['class' => 'text-gray-600'],
                    ],
                    'update' => [
                        'label' => '<i class="ph ph-pencil-simple"></i>',
                        'imageUrl' => false,
                        'encodeLabel' => false,
                        'options' => ['class' => 'text-blue-600'],
                    ],
                    'delete' => [
                        'label' => '<i class="ph ph-trash"></i>',
                        'imageUrl' => false,
                        'encodeLabel' => false,
                        'options' => ['class' => 'text-red-600'],
                    ]
                ],
            ],
        ],
    ]); ?>
</div>
