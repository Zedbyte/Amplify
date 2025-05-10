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
});
