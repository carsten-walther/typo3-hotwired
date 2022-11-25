<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HotwiredTodos',
    'Todos',
    [
        \Walther\HotwiredTodos\Controller\TodolistController::class => 'index, list, show, new, create, edit, update, delete',
        \Walther\HotwiredTodos\Controller\TodoController::class => 'new, create, edit, update, delete',
    ], [
        \Walther\HotwiredTodos\Controller\TodolistController::class => 'create, update, delete',
        \Walther\HotwiredTodos\Controller\TodoController::class => 'create, update, delete',
    ]
);

\Walther\WebsocketService\Server\Connection\ConnectionComponentRegistry::addConnectionComponent(
    'hotwired_todos',
    'Todos',
    \Walther\HotwiredTodos\Server\Connection\Todos::class,
    [
        'port' => 8080,
        'path' => 'todo',
        'pusher' => \Walther\HotwiredTodos\Server\Pusher\Todos::class,
        'onEntry' => 'onEntry'
    ],
);

