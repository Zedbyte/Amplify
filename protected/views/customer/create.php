<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $user User */

$this->breadcrumbs = ['Customers' => ['index'], 'Create'];
?>

<!-- Page Container -->
<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i class="ph ph-plus-circle text-3xl text-emerald-600"></i>
            <h1 class="text-2xl font-bold text-gray-900">Create Customer</h1>
        </div>

        <!-- Admin Links -->
        <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role == 2): ?>
            <div class="flex gap-2">
                <a href="<?php echo $this->createUrl('index'); ?>"
                   class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                    <i class="ph ph-list mr-1"></i> List Customers
                </a>
                <a href="<?php echo $this->createUrl('admin'); ?>"
                   class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                    <i class="ph ph-gear-six mr-1"></i> Manage Customers
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form Section -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <?php $this->renderPartial('_form', ['model' => $model, 'user' => $user]); ?>
    </div>
</div>
