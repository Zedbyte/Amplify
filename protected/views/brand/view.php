<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs = ['Brands' => ['index'], $model->name];
?>

<!-- Page Container -->
<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i class="ph ph-eye text-3xl text-indigo-600"></i>
            <h1 class="text-2xl font-bold text-gray-900">View Brand</h1>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <a href="<?php echo $this->createUrl('update', ['id' => $model->id]); ?>"
               class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center">
                <i class="ph ph-pencil-simple mr-1"></i> Edit
            </a>
            <?php echo CHtml::link('<i class="ph ph-trash mr-1"></i> Delete',
                '#',
                [
                    'class' => 'px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center',
                    'submit' => ['delete', 'id' => $model->id],
                    'confirm' => 'Are you sure you want to delete this brand?'
                ]); ?>
            <a href="<?php echo $this->createUrl('index'); ?>"
               class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-stone-900 transition flex items-center">
                <i class="ph ph-list mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="grid md:grid-cols-2 gap-6">
            <!-- ID -->
            <div>
                <div class="text-sm text-gray-500">ID</div>
                <div class="text-base font-medium text-gray-800"><?php echo CHtml::encode($model->id); ?></div>
            </div>

            <!-- Name -->
            <div>
                <div class="text-sm text-gray-500">Name</div>
                <div class="text-base font-medium text-gray-800"><?php echo CHtml::encode($model->name); ?></div>
            </div>

            <!-- Status -->
            <div>
                <div class="text-sm text-gray-500">Status</div>
                <div class="text-base font-medium <?php echo $model->status ? 'text-emerald-600' : 'text-red-600'; ?>">
                    <?php echo $model->status ? 'Active' : 'Inactive'; ?>
                </div>
            </div>

            <!-- Created At -->
            <div>
                <div class="text-sm text-gray-500">Created At</div>
                <div class="text-base font-medium text-gray-800"><?php echo CHtml::encode($model->created_at); ?></div>
            </div>

            <!-- Updated At -->
            <div>
                <div class="text-sm text-gray-500">Updated At</div>
                <div class="text-base font-medium text-gray-800"><?php echo CHtml::encode($model->updated_at); ?></div>
            </div>
        </div>
    </div>
</div>
