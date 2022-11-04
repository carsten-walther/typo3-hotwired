<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:hotwired_todos/Resources/Private/Language/locallang_db.xlf:tx_hotwiredtodos_domain_model_todolist',
        'label' => 'name',
        'enablecolumns' => [
        ],
        'searchFields' => 'name',
        'iconfile' => 'EXT:hotwired_todos/Resources/Public/Icons/tx_hotwiredtodos_domain_model_todolist.gif'
    ],
    'types' => [
        '1' => [
            'showitem' => 'name, messages'
        ],
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:hotwired_todos/Resources/Private/Language/locallang_db.xlf:tx_hotwiredtodos_domain_model_todolist.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
                'default' => ''
            ],
        ],
        'todos' => [
            'label' => 'LLL:EXT:hotwired_todos/Resources/Private/Language/locallang_db.xlf:tx_hotwiredtodos_domain_model_todolist.messages',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hotwiredtodos_domain_model_todo',
                'foreign_field' => 'todolist',
                'maxitems' => 99999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                ],
            ],
        ],
    ],
];
