<?php
return 
   $banner =  [
            'label' => 'Banner',
            'type' => 'repeater',
            'instructions' => 'Add and rearrange content blocks for the page.',
            'collapsed' => 'field_5e9a524f3c76d_label',
            'min' => 0,
            'layout' => 'block',
            'sub_fields' => [
                [
                    'label' => 'Image',
                    'name' => 'slides',
                    'type' => 'image',
                    'preview_size' => 'full-width',
                ],
                [
                    'label' => 'Content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter the content for this content block.',
                
                ],
            ],
    ];