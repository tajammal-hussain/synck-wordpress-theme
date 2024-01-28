<?php

return $path = [
    'label' => 'Path Way',
    'sub_fields' => [
        [
            'label' => 'Content',
            'name' => 'content',
            'type' => 'wysiwyg',
            'media_upload' => false,
        ],
        [
            'label' => 'Path',
            'type' => 'repeater',
            'layout' => 'table',
            'sub_fields' => [
                [
                    'label' => 'Number',
                    'name' => 'number',
                    'type' => 'text',
                ],
                [
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                ],
                [
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'text',
                ],
            ],
        ],
    ],
];
