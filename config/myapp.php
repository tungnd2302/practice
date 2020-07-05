<?php

return [
    'url' => [
        'prefix_admin' => 'admin'
    ],
    'template' => [
        'button' => [
            'role'   => ['form','delete','detail'],
            'user'   => ['form','delete','detail'],
            'permission'   => ['form','delete'],
            'unknow' => ['form','delete'],
        ],
        'buttonType' => [
            'form'   => [ 'class' => 'btn-success' , 'icon' => 'fa fa-pencil-alt', 'title' => 'Chỉnh sửa'],
            'delete' => [ 'class' => 'btn-primary', 'icon'  => 'fa fa-trash' , 'title' => 'Xóa'],
            'detail'   => [ 'class' => ' btn-danger' , 'icon' => 'fa fa-eye'   , 'title' => 'Xem'],
            'cog'    => [ 'class' => ' btn-warning' , 'icon'=> 'fa fa-user-cog'   , 'title' => 'Cài đặt'],
            'adddetail' => [ 'class' => ' btn-default' , 'icon' => 'fa fa-plus'   , 'title' => 'Thêm'],
            'unknow' => [ 'class' => ' btn-danger' , 'icon' => 'fa fa-eye'   , 'title' => 'Xem'],
        ],
        'buttonChangeStatus' => [
           '1'  => ['name' => 'Kích hoạt','class' => 'btn-success'],
           '0'  => ['name' => 'Chưa kích hoạt','class' => 'btn-primary'],
           '2'  => ['name' => 'Không xác định','class' => 'btn-danger'],
        ],
        'searchField' => [
            'all'      => 'Tìm kiếm tất cả',
            'name'     => 'Tìm kiếm theo tên',
            'id'       => 'Tìm kiếm theo ID',
            'content'  => 'Tìm kiếm theo nội dung',
            'question' => 'Tìm kiếm theo câu hỏi',
            'username' => 'Tìm kiếm theo người dùng',
            'role'     => 'Tìm kiếm theo chức vụ',
            'fullname'     => 'Tìm kiếm theo họ tên',
            // 'role'     => 'Tìm kiếm theo tên',
        ],
        'search' => [
            'role'   => ['all','id','name'],
            'user'   => ['all','fullname','id','username'],
            'permission'   => ['all','id','name'],
            'questionsuite'   => ['all','id','name'],
            'unknow' => ['id','name','role'],
        ]
    ],
    'unknow' => [
        'role' => [
            '-1' => 'Không xác định'
        ]
    ],
    'scope' => [
        'user' => 'Quản lý người dùng',
        'role' => 'Quản lý chức vụ',
        'permission' => 'Quản lý phân quyền',
        'post' => 'Quản lý bài viết',
        'questionSuite' => 'Quản lý bộ đề',
        'account' => 'Quản lý tài khoản người dùng',
        'system' => 'Quản lý hệ thống'
    ],
    'actionType' => [
        'view' => 'view',
        'add' => 'add',
        'form' => 'form',
        'delete' => 'delete',
    ],
    'level' => [
        'easy' => 'Dễ',
        'normal' => 'Thường',
        'hard' => 'Khó',
    ]
];
