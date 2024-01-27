<?php
// exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if( class_exists('acf_field') ) :

class monk_acf_field_icons extends acf_field_select {
    
    
    /*
    *  __construct
    *
    *  This function will setup the field type data
    *
    *  @type	function
    *  @date	5/03/2014
    *  @since	5.0.0
    *
    *  @param	n/a
    *  @return	n/a
    */

    function initialize() {
        global $monk_default_manifest;
        
        parent::initialize();

        $this->name = 'icon';

        $this->label = __('Icon');

        $this->category = 'Monk3';
        
        $this->l10n = array_merge($this->l10n, []);

        $this->defaults = array_merge($this->defaults, [
            'icons_path'    => $monk_default_manifest,
            'ui'            => 1,
            'placeholder'   => __('-- Select an icon --')
        ]);
       
    }

        /*
     *  render_field_settings()
     *
     *  Create extra settings for your field. These are visible when editing a field
     *
     *  @type	action
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	$field (array) the $field being edited
     *  @return	n/a
     */

    function render_field_settings($field) {

        /*
         *  acf_render_field_setting
         *
         *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
         *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
         *
         *  More than one setting can be added by copy/paste the above code.
         *  Please note that you must also have a matching $defaults value for the field name (font_size)
         */

        acf_render_field_setting($field, array(
            'label'         => __("Icons Path"),
            'instructions'  => __("Either the path to the SVG Icons' folder or the filename to the SCSS/CSS file containing the icon classnames. The path should be relative to the theme's directory."),
            'type'          => 'text',
            'name'          => 'icons_path'
        ));
        
    }

    /*
     *  render_field()
     *
     *  Create the HTML interface for your field
     *
     *  @param	$field (array) the $field being rendered
     *
     *  @type	action
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	$field (array) the $field being edited
     *  @return	n/a
     */

    function render_field($field) {
        
        $choices    = [ '' => $field['placeholder'] ];
        $path       = MNK_THEME_ROOT . "/{$field['icons_path']}";
                
        if( isset($field['icons_path']) ) {
            
            
            if( preg_match('-\.json$-', $path) ) {
                
                $manifest = get_manifest($path);
                
                foreach($manifest->getAssets('svg') as $svg) {
                                    
                    $choices[ $svg['filename'] ] = "<img width='20' height='20' style='width:20px;height:20px;object-fit:contain' class='mnk-acf-icon-select-img' src='{$svg['src']}' > {$svg['filename']}";
                
                }
                
            } else {
                
                $file = file_get_contents($path);

                if( preg_match_all('~\.(.*?icon\-.+?)(?:\s|\{|:)~', $file, $m) ) {

                    list($icons) = array_slice($m, 1);

                    foreach((array)$icons as $icon) {

                        $value  = esc_attr($icon);
                        $label  = explode('-', $icon);

                        $choices[$icon] = ucfirst( end($label) );

                    }

                }
                
            }
            
            
        } else {
            
            printf( "<strong>%s</strong>", __("Undefined icons path.") );
            
        }
                                
//        if( is_dir($path) ) {
//
//            foreach( glob($path . '{/**,}/*.svg', GLOB_BRACE) as $icon ) {

//            }  
//            
//        } elseif ( is_readable($path) ) {
//                        
//
//        }
        
        $field['choices'] = $choices;
        
        parent::render_field($field);
        
    }


    /*
     *  input_form_data()
     *
     *  This function is called once on the 'input' page between the head and footer
     *  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
     *  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
     *  seen on comments / user edit forms on the front end. This function will always be called, and includes
     *  $args that related to the current screen such as $args['post_id']
     *
     *  @type	function
     *  @date	6/03/2014
     *  @since	5.0.0
     *
     *  @param	$args (array)
     *  @return	n/a
     */

    /*

      function input_form_data( $args ) {



      }

     */


    /*
     *  input_admin_footer()
     *
     *  This action is called in the admin_footer action on the edit screen where your field is created.
     *  Use this action to add CSS and JavaScript to assist your render_field() action.
     *
     *  @type	action (admin_footer)
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	n/a
     *  @return	n/a
     */


    function input_admin_footer() {

        ?>

        <style>

            .mnk-acf-icon-select-img {
                margin-right: 5px;
                vertical-align: middle;
                position: relative;
                top: -2px;
            }

        </style>

        <script>
            
        (function($){

            var Select  = acf.getFieldType('select'),
                Field   = Select.extend({
                    type    : '<?= $this->name ?>'
                });

            acf.registerFieldType( Field );

        })(jQuery);
            
        </script>

        <?php

    }


    /*
     *  field_group_admin_enqueue_scripts()
     *
     *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
     *  Use this action to add CSS + JavaScript to assist your render_field_options() action.
     *
     *  @type	action (admin_enqueue_scripts)
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	n/a
     *  @return	n/a
     */

    /*

      function field_group_admin_enqueue_scripts() {

      }

     */


    /*
     *  field_group_admin_head()
     *
     *  This action is called in the admin_head action on the edit screen where your field is edited.
     *  Use this action to add CSS and JavaScript to assist your render_field_options() action.
     *
     *  @type	action (admin_head)
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	n/a
     *  @return	n/a
     */

    /*

      function field_group_admin_head() {

      }

     */


    /*
     *  load_value()
     *
     *  This filter is applied to the $value after it is loaded from the db
     *
     *  @type	filter
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	$value (mixed) the value found in the database
     *  @param	$post_id (mixed) the $post_id from which the value was loaded
     *  @param	$field (array) the field array holding all the field options
     *  @return	$value
     */

    /*

      function load_value( $value, $post_id, $field ) {

      return $value;

      }

     */


    /*
     *  update_value()
     *
     *  This filter is applied to the $value before it is saved in the db
     *
     *  @type	filter
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	$value (mixed) the value found in the database
     *  @param	$post_id (mixed) the $post_id from which the value was loaded
     *  @param	$field (array) the field array holding all the field options
     *  @return	$value
     */

    /*

      function update_value( $value, $post_id, $field ) {

      return $value;

      }

     */


    /*
     *  format_value()
     *
     *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
     *
     *  @type	filter
     *  @since	3.6
     *  @date	23/01/13
     *
     *  @param	$value (mixed) the value which was loaded from the database
     *  @param	$post_id (mixed) the $post_id from which the value was loaded
     *  @param	$field (array) the field array holding all the field options
     *
     *  @return	$value (mixed) the modified value
     */

    function format_value( $value, $post_id, $field ) {

        // bail early if no value
        if( empty($value) ) {

            return $value;

        }
        
        if( preg_match('-\.json$-', $field['icons_path']) ) {
            
            $value  = icon($value);
            
        } else {
            
            $value  = "<i class='$value' ></i>";
            
        }

        // return
        return $value;
        
    }



    /*
     *  validate_value()
     *
     *  This filter is used to perform validation on the value prior to saving.
     *  All values are validated regardless of the field's required setting. This allows you to validate and return
     *  messages to the user if the value is not correct
     *
     *  @type	filter
     *  @date	11/02/2014
     *  @since	5.0.0
     *
     *  @param	$valid (boolean) validation status based on the value and the field's required setting
     *  @param	$value (mixed) the $_POST value
     *  @param	$field (array) the field array holding all the field options
     *  @param	$input (string) the corresponding input name for $_POST value
     *  @return	$valid
     */

    /*

      function validate_value( $valid, $value, $field, $input ){

      // Basic usage
      if( $value < $field['custom_minimum_setting'] )
      {
      $valid = false;
      }


      // Advanced usage
      if( $value < $field['custom_minimum_setting'] )
      {
      $valid = __('The value is too little!','TEXTDOMAIN'),
      }


      // return
      return $valid;

      }

     */


    /*
     *  delete_value()
     *
     *  This action is fired after a value has been deleted from the db.
     *  Please note that saving a blank value is treated as an update, not a delete
     *
     *  @type	action
     *  @date	6/03/2014
     *  @since	5.0.0
     *
     *  @param	$post_id (mixed) the $post_id from which the value was deleted
     *  @param	$key (string) the $meta_key which the value was deleted
     *  @return	n/a
     */

    /*

      function delete_value( $post_id, $key ) {



      }

     */


    /*
     *  load_field()
     *
     *  This filter is applied to the $field after it is loaded from the database
     *
     *  @type	filter
     *  @date	23/01/2013
     *  @since	3.6.0	
     *
     *  @param	$field (array) the field array holding all the field options
     *  @return	$field
     */

/*
    function load_field( $field ) {
        
        $field['type'] = 'select';

        return $field;

    }
*/



    /*
     *  update_field()
     *
     *  This filter is applied to the $field before it is saved to the database
     *
     *  @type	filter
     *  @date	23/01/2013
     *  @since	3.6.0
     *
     *  @param	$field (array) the field array holding all the field options
     *  @return	$field
     */

    /*

      function update_field( $field ) {

      return $field;

      }

     */


    /*
     *  delete_field()
     *
     *  This action is fired after a field is deleted from the database
     *
     *  @type	action
     *  @date	11/02/2014
     *  @since	5.0.0
     *
     *  @param	$field (array) the field array holding all the field options
     *  @return	n/a
     */

    /*

      function delete_field( $field ) {



      }

     */
}

// initialize
new monk_acf_field_icons();

endif;