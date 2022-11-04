<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Hotwired :: Todos',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Carsten Walther',
    'author_email' => 'walther.carsten@web.de',
    'state' => 'alpha',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'classmap' => [
            'Classes',
        ],
        'psr-4' => [
            'Walther\\HotwiredTodos\\' => 'Classes',
        ],
    ],
];

