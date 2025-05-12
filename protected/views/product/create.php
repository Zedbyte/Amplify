<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = ['Products' => ['index'], 'Create'];

// $this->menu = [
//     ['label' => 'List Product', 'url' => ['index']],
//     ['label' => 'Manage Product', 'url' => ['admin']],
// ];
?>

<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-3">
            <i class="ph ph-plus-square text-3xl text-emerald-600"></i>
            <h1 class="text-2xl font-bold text-gray-900">Create Product</h1>
        </div>

        <!-- Action Buttons (Admin only) -->
        <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role == 2): ?>
            <div class="flex gap-2">
                <a href="<?php echo $this->createUrl('index'); ?>"
                   class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                    <i class="ph ph-list mr-1"></i> List Products
                </a>
                <a href="<?php echo $this->createUrl('admin'); ?>"
                   class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                    <i class="ph ph-gear-six mr-1"></i> Manage Products
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-8">
        <?php $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>
