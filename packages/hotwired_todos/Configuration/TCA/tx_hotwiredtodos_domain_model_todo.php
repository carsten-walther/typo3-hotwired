<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:hotwired_todos/Resources/Private/Language/locallang_db.xlf:tx_hotwiredtodos_domain_model_todo',
        'label' => 'text',
        'enablecolumns' => [
        ],
        'searchFields' => 'text',
        'iconfile' => 'EXT:hotwired_todos/Resources/Public/Icons/tx_hotwiredtodos_domain_model_todo.gif'
    ],
    'types' => [
        '1' => [
            'showitem' => 'text'
        ],
    ],
    'columns' => [
        'text' => [
            'label' => 'LLL:EXT:hotwired_todos/Resources/Private/Language/locallang_db.xlf:tx_hotwiredtodos_domain_model_todo.text',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
            ]
        ],
        'todolist' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
