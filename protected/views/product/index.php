<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = ['Products'];

$this->menu = [
    ['label' => 'Create Product', 'url' => ['create']],
    ['label' => 'Manage Product', 'url' => ['admin']],
];
?>

<!-- Section: Shop by Category -->
<section class="px-6 py-12 mx-auto">
    <div class="flex justify-center mb-8">
        <h2 class="text-2xl md:text-4xl font-bold text-black">Shop by Category</h2>
    </div>

    <!-- Scrollable wrapper -->
    <div class="overflow-x-auto pb-2 scroll-wrapper">
        <div class="flex space-x-6">
            <?php $this->widget('application.widgets.ShopCategory', [
                'imageHeightClass' => 'h-[250px] md:h-[300px] lg:h-[350px]'
            ]); ?>
        </div>
    </div>
</section>

<!-- Section: Product Grid and Filter -->
<section class="px-6 pb-16 mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6  mx-auto">
        
        <!-- Filter Sidebar -->
        <?php $this->widget('application.widgets.FilterCard'); ?>

        <!-- Product Grid -->
        <div class="lg:col-span-9">
            <!-- Filters -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        
                <!-- Label -->
                <span class="font-semibold text-sm text-gray-800">Sort by</span>

                <!-- Filter Buttons -->
                <div class="flex gap-2">
                <?php
                    $sortOptions = ['Popular (MAINTENANCE)', 'Latest', 'Top Sales (MAINTENANCE)', 'Price'];
                    foreach ($sortOptions as $option): ?>
                        <?php if ($option === 'Price'): ?>
                            <div x-data="{ open: false }" class="relative">
                                <button type="button"
                                    @click="open = !open"
                                    class="font-semibold px-4 py-1 border text-sm border-black rounded-sm transition hover:bg-black hover:text-white focus:outline-none sort-btn flex items-center">
                                    Price
                                    <i class="ph ph-sliders-horizontal ml-2"></i>
                                </button>

                                <!-- Dropdown -->
                                <div 
                                    x-show="open" 
                                    @click.away="open = false" 
                                    x-transition 
                                    class="absolute left-0 mt-2 bg-white border border-gray-300 rounded-md shadow-lg z-50 w-48"
                                    x-cloak>
                                    <button type="button" data-sort="price_asc"
                                        class="sort-dropdown-option block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                        Lowest Prices First
                                    </button>
                                    <button type="button" data-sort="price_desc"
                                        class="sort-dropdown-option block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                        Highest Prices First
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <button class="font-semibold px-4 py-1 border text-sm border-black rounded-sm transition hover:bg-black hover:text-white focus:outline-none sort-btn"
                                data-sort="<?php echo strtolower(str_replace(' ', '_', $option)); ?>">
                                <?php echo $option; ?>
                            </button>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>

                <!-- Search Field -->
                <div class="relative w-full md:w-64">
                    <input type="text" name="q" id="searchInput"
                        class="w-full px-4 py-2 text-sm border border-black rounded-lg focus:outline-none"
                        placeholder="Search Instruments" />
                    <i class="ph ph-magnifying-glass absolute right-3 top-2.5 text-gray-500 pointer-events-none"></i>
                </div>
            </div>
            
            <!-- AJAX Filters -->
            <?php 
                Yii::app()->clientScript->registerScriptFile(
                    Yii::app()->request->baseUrl . '/js/product-filters.js',
                    CClientScript::POS_END
                );
            ?>

            <?php $this->widget('zii.widgets.CListView', [
                'id' => 'product-list',
                'dataProvider' => $dataProvider,
                'itemView' => '_view', // Only product card content
                'itemsCssClass' => 'grid grid-cols-2 md:grid-cols-3 gap-6',
                'template' => '{items}{pager}',
                'pagerCssClass' => 'mt-8',
            ]); ?>
        </div>
    </div>
</section>
