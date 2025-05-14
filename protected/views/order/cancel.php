<div class="flex flex-col justify-center items-center px-4 py-8 mx-auto bg-white">
    <div class="w-full max-w-7xl p-6 shadow-md rounded-lg border bg-gray-50  border-gray-200 space-y-6 text-center">

        <!-- Header -->
        <div class="flex justify-center">
            <i class="ph ph-warning text-4xl text-red-600"></i>
        </div>

        <!-- Message -->
        <h1 class="text-2xl font-bold text-red-700">Payment Canceled</h1>
        <p class="text-sm text-gray-600">
            Your checkout session was canceled or failed to complete.<br>
            No payment has been made at this time.
        </p>

        <!-- Suggestions -->
        <div class="text-sm text-gray-700 space-y-1">
            <p>Please check your internet connection or payment method and try again.</p>
            <p>You may return to your cart and attempt checkout once more.</p>
        </div>

        <!-- Actions -->
        <div class="flex justify-center gap-4 pt-4">
            <a href="<?php echo Yii::app()->createUrl('cart/myCart'); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-black text-white rounded hover:bg-gray-800 transition">
                <i class="ph ph-shopping-cart"></i>
                Back to Cart
            </a>
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 text-gray-800 rounded hover:bg-gray-100 transition">
                <i class="ph ph-house"></i>
                Home
            </a>
        </div>

        <!-- Footer -->
        <div class="pt-6 border-t text-xs text-gray-500">
            Need help? Contact <a href="mailto:amplify@gmail.com" class="underline">amplify@gmail.com</a>.
        </div>
    </div>
</div>
