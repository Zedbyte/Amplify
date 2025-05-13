<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orders',
);

$this->menu = [];

if (!Yii::app()->user->isGuest && Yii::app()->user->role == 2) {
    $this->menu = [
        ['label' => 'Create Order', 'url' => ['create']],
        ['label' => 'Manage Order', 'url' => ['admin']],
    ];
}

$filter = $_GET['filter'] ?? 'pending';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <i class="ph ph-files text-blue-600"></i>
            Orders
        </h1>

		<div class="flex gap-2">
            <a href="<?php echo Yii::app()->createUrl('order/index', ['filter' => 'pending']); ?>"
                class="px-4 py-2 text-sm rounded <?php echo $filter === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700'; ?>">
                Pending Only
            </a>
            <a href="<?php echo Yii::app()->createUrl('order/index', ['filter' => 'accepted']); ?>"
                class="px-4 py-2 text-sm rounded <?php echo $filter === 'accepted' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'; ?>">
                Accepted Only
            </a>
            <a href="<?php echo Yii::app()->createUrl('order/index', ['filter' => 'shipped']); ?>"
                class="px-4 py-2 text-sm rounded <?php echo $filter === 'shipped' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'; ?>">
                Shipped Only
            </a>
            <a href="<?php echo Yii::app()->createUrl('order/index', ['filter' => 'all']); ?>"
                class="px-4 py-2 text-sm rounded <?php echo $filter === 'all' ? 'bg-black text-white' : 'bg-gray-100 text-gray-700'; ?>">
                Show All
            </a>
        </div>

        <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role == 2): ?>
            <div class="flex gap-2">
                <a href="<?php echo Yii::app()->createUrl('order/create'); ?>" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Create Order
                </a>
                <a href="<?php echo Yii::app()->createUrl('order/admin'); ?>" class="px-4 py-2 text-sm bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    Manage Orders
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'itemsCssClass' => 'space-y-4', // spacing between items
        'summaryCssClass' => 'text-sm text-gray-500 mb-4',
        'pagerCssClass' => 'mt-6',
        'pager' => array(
            'header' => '',
            'selectedPageCssClass' => 'font-semibold text-blue-600',
        ),
    ));
    ?>
</div>
