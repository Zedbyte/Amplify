<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['class' => 'space-y-6'],
]); ?>

<!-- Error summary -->
<?php echo $form->errorSummary($model, null, null, [
    'class' => 'p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg'
]); ?>

<?php
$fields = [
    'SKU' => 'text',
	'name' => 'text',
    'description' => 'text',
    'price' => 'text',
    'stock' => 'text',
    'category_id' => 'dropdown',
    'brand_id' => 'dropdown',
    'status' => 'text',
];

foreach ($fields as $attribute => $type): ?>
    <div>
        <?php echo $form->labelEx($model, $attribute, ['class' => 'block text-sm font-medium text-gray-700 mb-1']); ?>

        <?php if ($attribute === 'category_id'): ?>
            <?php
                $categories = CHtml::listData(
                    Category::model()->findAllByAttributes(['status' => 1]),
                    'id',
                    'name'
                );
                echo $form->dropDownList($model, 'category_id', $categories, [
                    'empty' => 'Select Category',
                    'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
                ]);
            ?>

        <?php elseif ($attribute === 'brand_id'): ?>
            <?php
                $brands = CHtml::listData(
                    Brand::model()->findAllByAttributes(['status' => 1]),
                    'id',
                    'name'
                );
                echo $form->dropDownList($model, 'brand_id', $brands, [
                    'empty' => 'Select Brand',
                    'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 bg-white text-black focus:ring-1 focus:ring-black focus:outline-none'
                ]);
            ?>

        <?php else: ?>
            <?php echo $form->textField($model, $attribute, [
                'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:outline-none'
            ]); ?>
        <?php endif; ?>

        <?php echo $form->error($model, $attribute, ['class' => 'text-red-600 text-sm mt-1']); ?>
    </div>
<?php endforeach; ?>

<!-- Submit Button -->
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', [
        'class' => 'w-full bg-black text-white rounded-xl py-2 text-sm font-semibold hover:bg-gray-900 transition'
    ]); ?>
</div>

<?php $this->endWidget(); ?>
