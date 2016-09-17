<?php

return [
    'cookie' => [
        'remember_me' => 'hash',
        'remember_me_expiry' => '+1 week',
        'encrypted_data' => true,
    ],
    'session' => [
        'user_data' => 'user',
        'encrypted_data' => false,
        'name' => 'CoreCaveSession', 
        'timeout' => 0, // 'timeout' => 30 >>> computed as 30 secs
        'use_db_handler' => true,
        'db_handler_options' => [
            'create_table' => false,
            'table' => null,
            'id_col' => null,
            'data_col' => null,
            'lifetime_col' => null,
            'time_col' => null,
            'connection_options' => null,
            'lock_mode' => null,
        ],
    ],
    'uploads' => [
        'compressed' => _path('storage.uploads.compressed'),
        'images' => _path('storage.uploads.images'),
    ],
    'social' => [
        'facebook' => [
            'app_id' => '628866373922560',
            'app_secret' => '5744a682604b22be38db75b5498e51a9',
            'default_graph_version' => 'v2.5',
        ],
        'google' => [
            'client_id' => '455053498627-vh4prtd0ap51thgeonfmg0vle2gfjvu9.apps.googleusercontent.com',
            'client_secret' => 'z2Hrjtv-WRoEBzHlMAuNFUUt',
            'scopes' => 'email'
        ]
    ]
];

