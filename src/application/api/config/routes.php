<?php

return [
    [
        'verb' => ['post'],
        'pattern' => 'photoalbum/create',
        'route' => 'photoalbum/create',
    ],
    [
        'verb' => ['patch'],
        'pattern' => 'photoalbum/<slug>/update',
        'route' => 'photoalbum/update',
    ],
    [
        'verb' => ['delete'],
        'pattern' => 'photoalbum/<slug>/delete',
        'route' => 'photoalbum/delete',
    ],
    [
        'verb' => ['post'],
        'pattern' => 'files/<slug>/upload',
        'route' => 'image-file/upload',
    ],
];
