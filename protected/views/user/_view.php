<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="p-4 bg-white hover:bg-gray-50 transition border-b border-gray-100 rounded">
    <div class="flex items-center gap-6 text-sm text-gray-700">

        <!-- Icon -->
        <div class="text-gray-400">
            <i class="ph ph-shield-star text-2xl"></i>
        </div>

        <!-- ID -->
        <div class="w-20">
            <a href="<?php echo Yii::app()->createUrl('user/view', ['id' => $data->id]); ?>"
               class="text-blue-600 hover:underline font-medium">
                #<?php echo CHtml::encode($data->id); ?>
            </a>
        </div>

        <!-- Name -->
        <div class="flex-1 font-semibold text-gray-900">
            <?php echo CHtml::encode($data->first_name . ' ' . $data->last_name); ?>
        </div>

        <!-- Username -->
        <div class="w-48">
            <i class="ph ph-user-circle text-gray-400 mr-1"></i>
            <?php echo CHtml::encode($data->username); ?>
        </div>

        <!-- Email -->
        <div class="w-60 text-gray-700 truncate">
            <i class="ph ph-envelope-simple text-gray-400 mr-1"></i>
            <?php echo CHtml::encode($data->email); ?>
        </div>

        <!-- Role -->
        <div class="w-24 text-center">
            <span class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                Admin
            </span>
        </div>
    </div>
</div>
