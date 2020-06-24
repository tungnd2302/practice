<?php

return [
    'url' => [
        'prefix_admin' => 'admin'
    ],
    'template' => [
        'button' => [
            'role'   => ['edit','delete'],
            'unknow' => ['edit','delete','view'],
        ],
        'buttonType' => [
            'edit'   => [ 'class' => 'btn-success' , 'icon' => 'fa fa-pencil-alt', 'title' => 'Chỉnh sửa', 'action' => 'form' ],
            'delete' => [ 'class' => 'btn-primary', 'icon' => 'fa fa-trash' , 'title' => 'Xóa', 'action' => 'delete' ],
            'view'   => [ 'class' => 'btn-danger' , 'icon' => 'fa fa-eye'   , 'title' => 'Xem', 'action' => 'view' ],
            'unknow' => [ 'class' => 'btn-danger' , 'icon' => 'fa fa-eye'   , 'title' => 'Xem', 'action' => 'unknow' ],
        ],
        'buttonChangeStatus' => [
           '1'  => ['name' => 'Kích hoạt','class' => 'btn-success'],
           '0'  => ['name' => 'Chưa kích hoạt','class' => 'btn-primary'],
           '2'  => ['name' => 'Không xác định','class' => 'btn-danger'],
        ]
    ]
];
