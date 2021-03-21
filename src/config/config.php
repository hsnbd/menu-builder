<?php

return [
    'view_path' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'menu-builder',
    'template' => [
        'master_page' => 'root-view::admin-lte.main',
        'content_placeholer' => 'content',
        'css_placeholder' => 'css',
        'js_placeholder' => 'js',
    ],
    'route' => [
        'prefix' => 'menu-builder',
        'name_prefix' => 'menu-builder.',
        'middleware' => ['web']
    ],
    'menu-disk' => [
        'driver' => 'local',
        'root' => base_path('menu-backup'),
        'permissions' => [
            'file' => [
                'public' => 0664,
                'private' => 0600,
            ],
            'dir' => [
                'public' => 0775,
                'private' => 0700,
            ],
        ],
    ]
];
