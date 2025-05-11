<?php
return [
    ['label' => 'Home', 'route' => '/site/index'],
    ['label' => 'Shop', 'route' => '/product/index'],
    ['label' => 'About', 'route' => '/site/page', 'params' => ['view' => 'about']],
    ['label' => 'My Orders', 'route' => '/order/index'],
    // Conditionally add admin link
    Yii::app()->user->isGuest || Yii::app()->user->role != 2 ? null : [
        'label' => 'Admin',
        'route' => '/site/adminDashboard'
    ],
];
