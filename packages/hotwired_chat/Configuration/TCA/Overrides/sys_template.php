<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'chat',
    'Configuration/TypoScript',
    'Chat'
);
