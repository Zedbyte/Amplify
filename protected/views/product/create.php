<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = ['Products' => ['index'], 'Create'];

$this->menu = [
    ['label' => 'List Product', 'url' => ['index']],
    ['label' => 'Manage Product', 'url' => ['admin']],
];
?>

<div class="max-w-2xl mx-auto mt-10 bg-white border border-gray-200 shadow-sm rounded-2xl p-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Create Product</h1>

    <?php $this->renderPartial('_form', ['model' => $model]); ?>
</div>