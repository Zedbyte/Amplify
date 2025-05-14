<div class="max-w-7xl mx-auto my-10 mb-30">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

	<!-- KPI CARDS -->
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-15 mt-7">
		<!-- Total Orders -->
		<div class="bg-white border border-gray-200 rounded-lg shadow p-5">
			<div class="text-sm text-gray-500 mb-1 flex items-center gap-1">
				<i class="ph ph-shopping-cart-simple"></i> Total Orders
			</div>
			<div class="text-2xl font-bold text-gray-900"><?php echo $stats['totalOrders']; ?></div>
		</div>

		<!-- Revenue -->
		<div class="bg-white border border-gray-200 rounded-lg shadow p-5">
			<div class="text-sm text-gray-500 mb-1 flex items-center gap-1">
				<i class="ph ph-credit-card"></i> Total Revenue
			</div>
			<div class="text-2xl font-bold text-emerald-600">₱<?php echo number_format($stats['totalRevenue'], 2); ?></div>
		</div>

		<!-- Products -->
		<div class="bg-white border border-gray-200 rounded-lg shadow p-5">
			<div class="text-sm text-gray-500 mb-1 flex items-center gap-1">
				<i class="ph ph-guitar"></i> Products
			</div>
			<div class="text-2xl font-bold text-gray-900"><?php echo $stats['totalProducts']; ?></div>
		</div>

		<!-- Customers -->
		<div class="bg-white border border-gray-200 rounded-lg shadow p-5">
			<div class="text-sm text-gray-500 mb-1 flex items-center gap-1">
				<i class="ph ph-users-three"></i> Customers
			</div>
			<div class="text-2xl font-bold text-gray-900"><?php echo $stats['totalCustomers']; ?></div>
		</div>
	</div>


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
                <i class="ph ph-users-three text-xl mr-1"></i> Customers
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Edit customer information and profiles.</p>
        </a>

        <!-- Admins -->
        <a href="<?php echo Yii::app()->createUrl('user/admin'); ?>"
        class="bg-white shadow rounded-lg p-4 border hover:shadow-md transition hover:bg-black hover:text-white group">
            <h2 class="text-lg font-semibold text-black mb-2 group-hover:text-white">
                <i class="ph ph-user text-xl mr-1"></i> Admins
            </h2>
            <p class="text-sm text-gray-600 group-hover:text-white">Manage all registered admins.</p>
        </a>

    </div>

</div>