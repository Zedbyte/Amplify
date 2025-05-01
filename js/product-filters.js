$(function () {
    $('.sort-btn').on('click', function () {
        const sortVal = $(this).data('sort');
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
});
