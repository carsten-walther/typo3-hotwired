<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('Chat', 'Chat', [
    \Walther\Chat\Controller\TodolistController::class => 'index, list, show, new, create, edit, update, delete',
    \Walther\Chat\Controller\TodoController::class => 'new, create',
], [
    \Walther\Chat\Controller\TodolistController::class => 'create, update, delete',
    \Walther\Chat\Controller\TodoController::class => 'create',
]);
