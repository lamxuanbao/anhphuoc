<?php
$permissions = config('permissions');
$data = [
    'translations' => [
        'en' => [
            'name' => 'Admin',
        ],
        'vi' => [
            'name' => 'Quản trị viên',
        ],
    ],
    'is_active' => 1,
    'permissions' => $permissions,
];
return $data;
