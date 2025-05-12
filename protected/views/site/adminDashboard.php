<div class="max-w-7xl mx-auto my-10">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Product -->
        <a href="<?php echo Yii::app()->createUrl('product/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-guitar text-xl mr-1"></i> Products
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Create, update and manage products listed in your store.</p>
        </a>

        <!-- Categories -->
        <a href="<?php echo Yii::app()->createUrl('category/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-folders text-xl mr-1"></i> Categories
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Add, edit or organize product categories.</p>
        </a>

        <!-- Brands -->
        <a href="<?php echo Yii::app()->createUrl('brand/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-seal-check text-xl mr-1"></i> Brands
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Manage brand listings associated with products.</p>
        </a>

        <!-- Orders -->
        <a href="<?php echo Yii::app()->createUrl('order/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-shopping-cart text-xl mr-1"></i> Orders
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">View and update customer orders and statuses.</p>
        </a>

        <!-- Order Items -->
        <a href="<?php echo Yii::app()->createUrl('orderItem/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-package text-xl mr-1"></i> Order Items
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Inspect and modify items included in orders.</p>
        </a>

        <!-- Payments -->
        <a href="<?php echo Yii::app()->createUrl('payment/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-credit-card text-xl mr-1"></i> Payments
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Monitor and edit payment records linked to orders.</p>
        </a>

        <!-- Shipments -->
        <a href="<?php echo Yii::app()->createUrl('shipment/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-truck text-xl mr-1"></i> Shipments
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Manage shipment details and logistics data.</p>
        </a>

        <!-- Customers -->
        <a href="<?php echo Yii::app()->createUrl('customer/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-user text-xl mr-1"></i> Customers
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Edit customer information and profiles.</p>
        </a>

        <!-- Users -->
        <a href="<?php echo Yii::app()->createUrl('user/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-users-three text-xl mr-1"></i> Users
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Manage all registered users and roles.</p>
        </a>

    </div>

</div>