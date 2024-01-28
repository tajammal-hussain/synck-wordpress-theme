<?php

return $iconslider = [
    'label' => "Icon Slider",
    'sub_fields'=>[
        [
            'label' => 'Icon Box',
            'type' => 'repeater',
            'layout' => 'row',
            'sub_fields' => [
                [
                    'label' => 'Icon',
                    'name' => 'icon',
                    'type' => 'image',
                ],
            ],
        ],
    ],
];