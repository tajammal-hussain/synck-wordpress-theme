<?php

return $iconbox = [
    'label' => "Icon Box",
    'sub_fields'=>[
        [
            'label' => 'Icon Box',
            'type' => 'repeater',
            'layout' => 'table',
            'sub_fields' => [
                [
                    'label' => 'Icon',
                    'name' => 'icon',
                    'type' => 'image',
                ],
                [
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                ],
                [
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'media_upload' => false,
                ],
            ],
        ],
    ],
];