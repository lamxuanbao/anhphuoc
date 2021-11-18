<?php
return [
    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'users',
    ],
    'guards' => [
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'customers' => [
            'driver' => 'jwt',
            'provider' => 'customers',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \Kizi\Core\Models\Users::class
        ],
        'customers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Customers::class
        ]
    ]
];
