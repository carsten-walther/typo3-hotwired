<?php
defined('TYPO3') || die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['hotwired'] = [
    'Walther\Hotwired\ViewHelpers',
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Walther\Hotwired\Task\ServerStartTask::class] = [
    'extension' => 'hotwired',
    'title' => 'Websocket Server start',
    'description' => 'This task starts PHP daemon which provides the Websockets server'
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Walther\Hotwired\Task\ServerStopTask::class] = [
    'extension' => 'hotwired',
    'title' => 'Websocket Server stop',
    'description' => 'This task kills PHP daemon which provides the Websockets server'
];