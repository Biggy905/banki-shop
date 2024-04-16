<?php

return [
    [
        'verb' => ['get'],
        'pattern' => '/',
        'route' => 'index/list',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'photoalbum/<id>/item',
        'route' => 'index/item',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'about',
        'route' => 'about/index',
    ],
];
