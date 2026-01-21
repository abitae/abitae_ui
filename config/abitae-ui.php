<?php

return [
    'component_prefix' => 'abitae-ui',
    'assets' => [
        'css' => '/vendor/abitae-ui/abitae-ui.css',
        'js' => '/vendor/abitae-ui/abitae-ui.js',
    ],
    'defaults' => [
        'button' => [
            'variant' => 'primary',
            'size' => 'md',
        ],
        'accordion' => [
            'multiple' => false,
        ],
        'autocomplete' => [
            'min_chars' => 2,
            'debounce' => 250,
        ],
    ],
];
