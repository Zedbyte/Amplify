$(function () {
    $('.sort-btn').on('click', function () {
        const sortVal = $(this).data('sort');

        // If it's the 'Price' group, ignore this handler — handled below
        if ($(this).find('.ph-sliders-horizontal').length) {
            return;
        }

        // Toggle logic
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $.fn.yiiListView.update('product-list', { data: {} });
        } else {
            $('.sort-btn, .sort-dropdown-option').removeClass('active');
            $(this).addClass('active');
            $.fn.yiiListView.update('product-list', { data: { sort: sortVal } });
        }
    });

    // Dropdown options for Price
    $('.sort-dropdown-option').on('click', function () {
        const sortVal = $(this).data('sort');

        $('.sort-btn, .sort-dropdown-option').removeClass('active');
        $(this).addClass('active');

        // Also activate the "Price" wrapper button
        $('.sort-btn:has(.ph-sliders-horizontal)').addClass('active');

        $.fn.yiiListView.update('product-list', {
            data: { sort: sortVal }
        });
    });
    

    $('.sort-dropdown-option').on('click', function () {
        const sortVal = $(this).data('sort');
        $.fn.yiiListView.update('product-list', {
            data: { sort: sortVal }
        });
    });

    $('#searchInput').on('keyup', function (e) {
        if (e.keyCode === 13) {
            const query = $(this).val();
            $.fn.yiiListView.update('product-list', {
                data: { q: query }
            });
        }
    });

    // 🆕 Category click handler
    $('.category-filter').on('click', function () {
        const categoryId = $(this).data('category-id');
        $.fn.yiiListView.update('product-list', {
            data: { category_id: categoryId }
        });
    });

    // Reset Filters button handler
    $('#resetFiltersBtn').on('click', function () {
        // Clear search input
        $('#searchInput').val('');
    
        // Clear any active sort buttons (if you have active class styles, handle that here)
        $('.sort-btn, .sort-dropdown-option').removeClass('active');
    
        // Optional: Reset other UI indicators (like selected category if you track it)
    
        // Trigger ListView update without any filters
        $.fn.yiiListView.update('product-list', {
            data: {
                q: '',         // clear search
                sort: '',      // clear sorting
                category_id: ''   // clear category
            }
        });
    });



    /**
     * 
     * FILTER CARD
     * 
     */

    // Brand Filter
    $('.brand-tag').on('click', function () {
        const brandId = $(this).data('brand-id');
    
        // Remove active styles and hover class from all
        $('.brand-tag')
            .removeClass('bg-black text-white')
            .addClass('bg-stone-100 text-stone-800 hover:bg-stone-200');
    
        // Apply active style to clicked one
        $(this)
            .removeClass('bg-stone-100 text-stone-800 hover:bg-stone-200')
            .addClass('bg-black text-white');
    
        $.fn.yiiListView.update('product-list', {
            data: { brand_id: brandId }
        });
    });
    
    // Reset Filter Card
    $('#resetFilterCard').on('click', function () {
        // Reset brand cloud styling
        $('.brand-tag')
            .removeClass('bg-black text-white')
            .addClass('bg-stone-100 text-stone-800 hover:bg-stone-200');

        $('#minPriceInput').val('');
        $('#maxPriceInput').val('');
        $('#inStockOnly').prop('checked', false);
    
        // Reset ListView (clear brand_id and other filters)
        $.fn.yiiListView.update('product-list', {
            data: {
                brand_id: '',
                min_price: '',
                max_price: '',
                in_stock: ''
            }
        });
    });


    // Global Filter Apply button
    $('#applyGlobalFilters').on('click', function () {
        const min = $('#minPriceInput').val();
        const max = $('#maxPriceInput').val();
        const inStock = $('#inStockOnly').is(':checked') ? 1 : 0;
    
        $.fn.yiiListView.update('product-list', {
            data: {
                min_price: min,
                max_price: max,
                in_stock: inStock
            }
        });
    });
    
});
