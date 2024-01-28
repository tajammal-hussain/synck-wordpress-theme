<?php
return  $coulmns = [
    'label'   => 'Columns',
    'sub_fields'=>[
        'sub_fields'=> [
            'label' => 'Layout',
            'type' => 'group',
            'layout' => 'table',
            'instructions' => 'Note: columns will always stack into one on mobile.',
            'sub_fields' => [
               [
                    'label' => 'Tablet',
                    'name' => 'sm',
                    'type' => 'number',
                    'default_value'=> 1,
               ],
                [
                    'label' => 'Laptop',
                    'name' => 'md',
                    'type' => 'number',
                    'default_value'  =>  2,
                ],
                [
                    'label' => 'Desktop',
                    'name' => 'lg',
                    'type' => 'number',
                    'default_value'  =>  3,
                ],
            ],
            
        ],
        [
            'label' => 'Columns',
            'type' => 'repeater',
            'layout' => 'block',
            'sub_fields' => [
                [
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'media_upload' => true,
                ],
            ],
        ],
    ],
    
];

