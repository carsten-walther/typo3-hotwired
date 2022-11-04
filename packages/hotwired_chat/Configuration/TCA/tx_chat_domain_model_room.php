<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_room',
        'label' => 'name',
        'crdate' => 'crdate',
        'enablecolumns' => [
        ],
        'searchFields' => 'name',
        'iconfile' => 'EXT:chat/Resources/Public/Icons/tx_chat_domain_model_room.gif'
    ],
    'types' => [
        '1' => [
            'showitem' => 'name, messages'
        ],
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_room.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
                'default' => ''
            ],
        ],
        'messages' => [
            'label' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_room.messages',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chat_domain_model_message',
                'foreign_field' => 'room',
                'maxitems' => 99999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                ],
            ],
        ],
    ],
];
