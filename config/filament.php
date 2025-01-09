<?php

return [
    'default_panel' => 'admin', // You can change this to the panel of your choice

    'panels' => [
        'admin' => [
            'path' => 'admin', // Path for the admin panel
            'middleware' => ['web'], // Adjust to your middleware
        ],
        
    ],

    'auth' => [
        'guard' => 'web',
    ],
];
