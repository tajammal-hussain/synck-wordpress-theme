<?php

return $text_shortcode = [
    'label'=> 'Text With Shortcode',
    'sub_fields' => [
       [
        'label' => 'Shortcode',
        'name' => 'shortcode',
        'type' => 'text',
       ],
       [
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
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