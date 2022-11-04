<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'hotwired_todos',
    'Configuration/TypoScript',
    'Hotwired :: Todos'
);
