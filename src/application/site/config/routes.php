<?php

return [
    [
        'verb' => ['get'],
        'pattern' => '/',
        'route' => 'index/list',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'photoalbum/<slug>/item',
        'route' => 'index/item',
    ],
];
