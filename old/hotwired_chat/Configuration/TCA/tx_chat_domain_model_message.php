<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_message',
        'label' => 'text',
        'crdate' => 'crdate',
        'enablecolumns' => [
        ],
        'searchFields' => 'text',
        'iconfile' => 'EXT:chat/Resources/Public/Icons/tx_chat_domain_model_message.gif'
    ],
    'types' => [
        '1' => [
            'showitem' => 'text, username'
        ],
    ],
    'columns' => [
        'text' => [
            'label' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_message.text',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
            ]
        ],
        'username' => [
            'exclude' => false,
            'label' => 'LLL:EXT:chat/Resources/Private/Language/locallang_db.xlf:tx_chat_domain_model_message.username',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ]
        ],
        'crdate' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'room' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
