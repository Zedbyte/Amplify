<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="p-4 bg-white hover:bg-gray-50 transition border-b border-gray-100 rounded">
    <div class="flex items-center gap-6 text-sm text-gray-700">
        
        <!-- Icon -->
        <div class="text-gray-400">
            <i class="ph ph-user-circle text-2xl"></i>
        </div>

        <!-- ID -->
        <div class="w-24">
            <a href="<?php echo Yii::app()->createUrl('customer/view', ['id' => $data->id]); ?>"
               class="text-blue-600 hover:underline">
                #<?php echo CHtml::encode($data->id); ?>
            </a>
        </div>

        <!-- Name -->
        <div class="flex-1 font-medium text-gray-900">
            <?php
                if ($data->user) {
                    echo CHtml::encode($data->user->first_name . ' ' . $data->user->last_name);
                } else {
                    echo '<span class="text-gray-400 italic">No user linked</span>';
                }
            ?>
        </div>

        <!-- Address -->
        <div class="flex-1 text-gray-700">
            <i class="ph ph-map-pin-line mr-1 text-gray-400"></i>
            <?php echo CHtml::encode($data->address); ?>
        </div>

        <!-- Phone -->
        <div class="w-48 text-gray-700">
            <i class="ph ph-phone mr-1 text-gray-400"></i>
            <?php echo CHtml::encode($data->phone_number); ?>
        </div>
    </div>
</div>
