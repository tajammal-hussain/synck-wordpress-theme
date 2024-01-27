<?php

defined('ABSPATH') || die;

if( !class_exists('acf_field') ) return;

class monk_acf_field_layouts extends acf_field_flexible_content {
    
    function initialize() {
        
        parent::initialize();
        
        $this->name     = 'layouts';
        $this->label    = __('Layouts');
        $this->defaults = [ 
            'button_label'  => __('Add Layout')
        ] + $this->defaults;
                
    }
    
    
    function load_value($value, $post_id, $field) {
        
        $rows = parent::load_value($value, $post_id, $field);
                
        if( is_array($rows) ) {
            
            $rows = array_map(function($r){
                        
                $r['template'] = $r['acf_fc_layout'];

                return $r;
            
            }, $rows);
            
        }
                
        return $rows;
        
    }
    
    
    function input_admin_footer() {
        
        ?>
        
        <script type="text/javascript" >

        (function($){ 
            
            var Field = acf.getFieldType('flexible_content').extend({

                type    : '<?= $this->name ?>'

            });

            acf.registerFieldType( Field );

        })(jQuery);

        </script>

        <?php
        
    }
    
    
}

return new monk_acf_field_layouts();