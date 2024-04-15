<?php

namespace site\assets;

use yii\web\AssetBundle;

final class MainAssets extends AssetBundle
{
    public $sourcePath = '@resoursesMain/main';

    public $css = [
        'css/main.css',
    ];

    public $js = [
        'js/main.js',
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];

    public $publishOptions = [
        'only' => [
            '*',
        ],
        'except' => [
            'html/',
        ]
    ];
}
