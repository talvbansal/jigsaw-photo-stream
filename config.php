<?php

return [
    'production' => false,
    'baseUrl' => '',
    'siteTitle' => 'Jigsaw Photo Stream',
    'siteDescription' => 'A minimalistic photo stream.',

    'images' => [
        'thumbnail' => ['size' => 640],
        'large' => ['size' => 2048],
    ],

    'links' => [
        'twitter' => 'talv',
        'instagram' => 'iwantthewindowseat',
        'github' => 'talvbansal',
        'redbubble' => 'talvbansal',
    ],

    'analytics' => [
        'google' => '',
    ],

    'collections' => [
        'photos' => [
            'sort' => '-date'
        ]
    ],
];
