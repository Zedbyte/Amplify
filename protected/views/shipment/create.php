<?php
/* @var $this ShipmentController */
/* @var $model Shipment */

$this->breadcrumbs=array(
	'Shipments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Shipment', 'url'=>array('index')),
	array('label'=>'Manage Shipment', 'url'=>array('admin')),
);
?>

<h1>Create Shipment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>