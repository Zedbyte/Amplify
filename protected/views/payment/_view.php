<?php
/* @var $this PaymentController */
/* @var $data Payment */
?>

<div class="p-4 hover:bg-gray-50 transition view border-b border-gray-100">
    <div class="flex justify-between items-center">
        <!-- Payment Info -->
        <div>
            <!-- Payment ID link -->
            <a href="<?php echo Yii::app()->createUrl('payment/view', ['id' => $data->id]); ?>"
               class="text-blue-600 hover:underline text-sm">
                #<?php echo CHtml::encode($data->id); ?>
            </a>

            <!-- Method + Amount -->
            <div class="text-lg font-semibold text-gray-800">
                <?php echo CHtml::encode($data->payment_method); ?>
                <span class="text-sm font-normal text-gray-500 ml-1">
                    (₱<?php echo CHtml::encode($data->amount); ?>)
                </span>
            </div>

            <!-- Date, Status, Customer -->
            <div class="text-sm text-gray-600 mt-1 space-x-2">
                <span>Date: <?php echo CHtml::encode($data->payment_date); ?></span>
                <span>| Status:
                    <span class="<?php
                        echo $data->status == 1 ? 'text-emerald-600' :
                             ($data->status == 0 ? 'text-yellow-600' : 'text-red-600');
                    ?>">
                        <?php
                            echo $data->status == 1 ? 'Paid' :
                                 ($data->status == 0 ? 'Pending' : 'Failed');
                        ?>
                    </span>
                </span>
                <span>| Customer ID: <?php echo CHtml::encode($data->customer_id); ?></span>
            </div>
        </div>
    </div>
</div>
