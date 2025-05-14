<?php
/* @var $this OrderItemController */
/* @var $data OrderItem */
?>

<div class="p-4 hover:bg-gray-50 transition view border-b border-gray-100">
    <div class="flex justify-between items-center">
        <!-- Left: Order Item Info -->
        <div class="space-y-1">
            <a href="<?php echo Yii::app()->createUrl('orderItem/view', ['id' => $data->id]); ?>"
               class="text-blue-600 hover:underline text-sm font-medium">
                Order Item #<?php echo CHtml::encode($data->id); ?>
            </a>

            <div class="text-sm text-gray-700">
                <span class="font-semibold">Quantity:</span> <?php echo CHtml::encode($data->quantity); ?>
            </div>

            <div class="text-sm text-gray-700">
                <span class="font-semibold">Price:</span> $<?php echo CHtml::encode($data->price); ?>
            </div>

            <div class="text-sm text-gray-700">
                <span class="font-semibold">Product ID:</span> <?php echo CHtml::encode($data->product_id); ?>
            </div>

            <div class="text-sm text-gray-700">
                <span class="font-semibold">Order ID:</span> <?php echo CHtml::encode($data->order_id); ?>
            </div>

            <div class="text-sm text-gray-700">
                <span class="font-semibold">Status:</span>
                <?php
                    $statusText = [
                        0 => 'Pending',
                        1 => 'Accepted',
                        2 => 'Shipped',
                        3 => 'Cancelled',
                    ];
                    echo isset($statusText[$data->status]) ? $statusText[$data->status] : 'Unknown';
                ?>
            </div>

            <div class="text-xs text-gray-500">
                Created at: <?php echo CHtml::encode($data->created_at); ?>
            </div>
        </div>
    </div>
</div>
