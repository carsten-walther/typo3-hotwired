<?php
defined('TYPO3') || die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['hotwired'] = [
    'Walther\Hotwired\ViewHelpers',
];

$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][\Walther\Hotwired\Backend\ToolbarItems\ServerStatusToolbarItem::class] = \Walther\Hotwired\Backend\ToolbarItems\ServerStatusToolbarItem::class;