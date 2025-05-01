<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'View Product', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<div class="max-w-2xl mx-auto mt-10 bg-white border border-gray-200 shadow-sm rounded-2xl p-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Update Product</h1>

	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>