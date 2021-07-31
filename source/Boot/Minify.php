<?php

use Source\Support\Minify;

$themes = [
    CONF_VIEW_WEB => [
        'cssVersion' => CONF_VIEW_WEB_VERSION_CSS,
        'jsVersion' => CONF_VIEW_WEB_VERSION_JS,
        'css' => [
            'shared::bootstrap.css',
            'theme::style.css'
        ],
        'js'  => [
            'shared::jquery.min.js',
            'shared::jquery-ui.min.js',
            'shared::jquery-mask.min.js',
            'shared::script.js',
            'theme::script.js'
        ]
    ],
    CONF_VIEW_APP => [
        'cssVersion' => CONF_VIEW_APP_VERSION_CSS,
        'jsVersion' => CONF_VIEW_APP_VERSION_JS,
        'css' => [
            'shared::bootstrap.css',
            'theme::auth.css',
            'theme::theme.css'
        ],
        'js'  => [
            'shared::jquery.min.js',
            'shared::jquery-ui.min.js',
            'shared::jquery-mask.min.js',
            'shared::dropdown.min.js',
            'shared::script.js',
            'theme::script.js'
        ]
    ],
    CONF_VIEW_ADMIN => [
        'cssVersion' => CONF_VIEW_ADMIN_VERSION_CSS,
        'jsVersion' => CONF_VIEW_ADMIN_VERSION_JS,
        'css' => [
            'shared::bootstrap.css',
            'theme::auth.css',
            'theme::theme.css'
        ],
        'js'  => [
            'shared::jquery.min.js',
            'shared::jquery-ui.min.js',
            'shared::jquery-mask.min.js',
            'shared::dropdown.min.js',
            'shared::script.js',
            'theme::script.js'
        ]
    ]
];

foreach ($themes as $theme => $params) {
    (new Minify($theme, $params['cssVersion'], $params['jsVersion']))
        ->css($params['css'])
        ->js($params['js']);
}

$themes = null;
