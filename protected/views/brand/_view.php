<?php
/* @var $this BrandController */
/* @var $data Brand */
?>

<div class="p-4 hover:bg-gray-50 transition view border-b border-gray-100">
    <div class="flex justify-between items-center">
        <!-- Left: ID and Brand Info -->
        <div>
            <!-- ID as link -->
            <a href="<?php echo Yii::app()->createUrl('brand/view', ['id' => $data->id]); ?>" 
               class="text-blue-600 hover:underline text-sm">
                #<?php echo CHtml::encode($data->id); ?>
            </a>

            <!-- Brand Name -->
            <div class="text-lg font-semibold text-gray-800">
                <?php echo CHtml::encode($data->name); ?>
            </div>

            <!-- Status & Dates -->
            <div class="text-sm text-gray-600 mt-1 space-x-2">
                <span>Status: 
                    <span class="font-medium <?php echo $data->status ? 'text-emerald-600' : 'text-red-600'; ?>">
                        <?php echo $data->status ? 'Active' : 'Inactive'; ?>
                    </span>
                </span>
                <span>| Created: <?php echo CHtml::encode($data->created_at); ?></span>
                <span>| Updated: <?php echo CHtml::encode($data->updated_at); ?></span>
            </div>
        </div>
    </div>
</div>
