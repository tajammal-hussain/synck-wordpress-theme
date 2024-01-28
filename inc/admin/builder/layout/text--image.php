<?php

return $image_with_text = [
    'label' => 'Text - Image',
    'layout' => 'table',
    'sub_fields' => [
       [
        'label' => 'Content',
        'type' => 'wysiwyg',
       ],
       [
        'label' => 'Image',
        'type' => 'image',
        'name' => 'img'
       ],
       [
        'label' => 'Horizontal Layout',
        'type' => 'radio',
        'name' => 'img',
        'default_value'=> 'row',
        'layout' => 'horizontal',
        'choices' => [
            'row'        => 'Normal',
            'row-reverse' =>  'Reversed',
        ],

    ],
],
];