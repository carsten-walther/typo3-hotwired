<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('HotwiredTodos', 'Todos', [
    \Walther\HotwiredTodos\Controller\TodolistController::class => 'index, list, show, new, create, edit, update, delete',
    \Walther\HotwiredTodos\Controller\TodoController::class => 'new, create, edit, update, delete',
], [
    \Walther\HotwiredTodos\Controller\TodolistController::class => 'create, update, delete',
    \Walther\HotwiredTodos\Controller\TodoController::class => 'create, update, delete',
]);
