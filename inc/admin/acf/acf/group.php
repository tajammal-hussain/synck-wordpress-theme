<?php

namespace Monk\ACF;


class Group {
    
    public $key;
    public $title;
    public $style;
    public $fields = [];
    public $position;
    public $location = [];
    public $menu_order;
    public $hide_on_screen = [];
            
    function __construct($title = null, $register = true) {
        
        if( is_array($title) ) {
            
            $group  = $title;
            $title  = null;
            
            extract( \Monk\Utils\array_filter($group) );
            
            foreach($group as $p => $v) {
                
                $this->{strtolower($p)} = $v;
                
            }
            
        }
        
        if($title) {
            
            $this->title = $title;
            
        } else {
            
            $this->setStyle('seamless');
            
        }
        
        $register && add_action('init', [$this, 'register'], 99);
       
    }
    
    
    function register() {
        
        if( empty($this->key) ) {
                        
            $this->key = 'group_mnk_' . sanitize_title($this->title);
            
        }
        
        $field_group = \Monk\Utils\array_filter( get_object_vars($this) );
        
        \Monk\Utils\acf_add_local_fields(array_splice($field_group['fields'], 0), $this);
                
        remove_action('init', [$this, 'register'], 99);
        
        return acf_add_local_field_group($field_group);
        
    }
    
    
    function addField(Field $field) {
        
        foreach(func_get_args() as $field) {
            
            array_push($this->fields, $field);
            
        }
        
        return $this;
        
    }
    
    function addLocation($value = 'post', $param = 'post_type', $operator = '==', $new_group = true) {
        
        if( empty($this->title) ) {
            
            $this->title = $param . $operator . $value;
            
        }
        
        if( empty($this->location) ) {
            
            $new_group = true;
            
        }
        
        if($new_group) {
            
            $this->location[] = [];
            
        }
    
        array_push($this->location[count($this->location) - 1], [
            'param'     => $param,
            'operator'  => $operator,
            'value'     => $value,
        ]);
         
        return $this;
        
    }
    
    
    function addToFrontpage($new_group = true) {
            
        return $this->addLocation('front_page', 'page_type', '==', $new_group);
        
    }
    
    
    function addToOptions($page = 'acf-options', $new_group = true) {
        
        if( is_array($page) ) {
            
            $page = $page['menu_slug'];
            
        }
        
        return $this->addLocation($page, 'options_page', '==', $new_group);
        
    }
    
    
    function addToPostType($post_type, $new_group = true) {
        
        if($post_type instanceof \WP_Post_Type) {
            
            $post_type  = $post_type->name;
            
        }
        
        return $this->addLocation($post_type, 'post_type', '==', $new_group);
        
    }
    
    
    function addToTaxonomy($taxonomy = 'category', $new_group = true) {
        
        if($taxonomy instanceof \WP_Taxonomy) {
            
            $taxonomy = $taxonomy->name;
            
        }
        
        return $this->addLocation($taxonomy, 'taxonomy', '==', $new_group);
        
    }
    
    
    function addToPostWithTerm($term, $taxonomy = null, $new_group = true) {
        
        if($term instanceof \WP_Term) {
            
            $taxonomy   = $term->taxonomy;
            $term       = $term->slug;
            
        }
        
        if( empty($taxonomy) ) {
            
            $taxonomy   = 'category';
            
        }
        
        return $this->addLocation("$taxonomy:$term", 'post_taxonomy', '==', $new_group);
        
    }
    
    
    function addToUserRole($roles = [], $new_group = true) {
        
        if( empty($roles) ) {
            
            $roles = ['all']; 
            
        } 
        
        if($new_group) {
            
            $this->location[] = []; 
            
        } 
        
        foreach( (array)$roles as $role ) {
            
            $this->addLocation($role, 'user_role', '==', false); 
            
        } 
        
        return $this; 
        
    }
    

    /**
     * 
     * @param string $template the path to the template file relative to the theme directory e.g. 'templates/contact.php'
     * @return $this
     */
    function addToTemplate($path = 'default', $new_group = true) {
     
        
        return $this->addLocation($path, 'page_template', '==', $new_group);
        
    }
    
    
    /**
     * Add this group to a WP User form.
     * Accepted args: 'all' (default), 'edit', 'register'
     * 
     * @param string $form
     * @param boolean $new_group
     * @return $this
     */
    function addToUserForm($form = null, $new_group = true) {
        
        if( empty($form) ) {
            
            $form = 'all';
            
        }
        
        return $this->addLocation($form, 'user_form', '==', $new_group);
        
    }
    
    
    /**
     * Add this Field Group to attachment edit screens.
     * Accepted $attachment values: 'all' (default), 'image', 'video', 'text', 'application', 'audio'
     * or the specific file's mime-type
     * 
     * @param string $attachment
     * @param boolean $new_group
     * @return $this
     */
    function addToAttachment($attachment = null, $new_group = true) {
        
        if( empty($attachment) ) {
            
            $attachment = 'all';
            
        }

        return $this->addLocation($attachment, 'attachment', '==', $new_group);
                
    }
    
    
    function addToPost($post_id, $post_type = 'post', $new_group = true) {
        
        return $this->addLocation($post_id, $post_type, '==', $new_group);
        
    }
    
    
    function addToPage($page_id, $new_group = true) {
        
        return $this->addToPost($page_id, 'page', $new_group);
        
    }
    
    
    /**
     * 
     * Determines the metabox style. Built-in ACF choices are currently 'default' or 'seamless'.
     * If a boolean is passed, it toggles whether to enable/disable the 'seamless' appearance.
     * 
     * @param boolean $seamless
     * @return $this
     */
    function setStyle($style = true) {
        
        if( is_bool($style) ) {
            
            $style = $style ? 'seamless' : 'default';
            
        }
        
        $this->style = $style; 
        
        return $this;
        
    }
    
    
    /**
     * 
     * Determines the position on the edit screen. Defaults to 'normal'. Choices of 'acf_after_title', 'high' (alias of 'acf_after_title'), 'normal' or 'side'
     * 
     * @param string $position
     * @return $this
     */
    function setPosition($position = null) {
        
        if( $position === 'high' ) {
            
            $position = 'acf_after_title';
            
        }
        
        if( empty($position) ) {
            
            $position = 'normal';
            
        }
        
        $this->position = $position;
        
        return $this;
        
    }
    
    
    /**
     * 
     * An array of elements to hide on the screen. Note that the passed array will be merged with the existing elements.
     * 
     * Valid elements:
     * 'permalink'
     * 'the_content'
     * 'excerpt'
     * 'discussion'
     * 'comments'
     * 'revisions'
     * 'slug'
     * 'author'
     * 'format'
     * 'page_attributes'
     * 'featured_image'
     * 'categories'
     * 'tags'
     * 'send-trackbacks'
     * 
     * @param string|array $elements
     * @return $this
     */
    function hideOnScreen($elements) {
        
        $hide_on_screen = array_merge($this->hide_on_screen, (array)$elements);
        
        $this->hide_on_screen = array_unique($hide_on_screen);
        
        return $this;
        
    }
    
    
    /**
     * 
     * Pass an array or elements or a single sting to show on screen with everything else hidden.
     * Unlike hideOnScreen(), the passed elements will always override the value of the hide_on_screen property.
     * 
     * Valid elements:
     *  'permalink'
     *  'the_content'
     *  'excerpt'
     *  'discussion'
     *  'comments'
     *  'revisions'
     *  'slug'
     *  'author'
     *  'format'
     *  'page_attributes'
     *  'featured_image'
     *  'categories'
     *  'tags'
     *  'send-trackbacks'
     * 
     * @param type $elements
     * @return $this
     */
    function showOnScreen($elements) {
    
        $this->hide_on_screen = array_diff([
            'permalink',
            'the_content',
            'excerpt',
            'discussion',
            'comments',
            'revisions',
            'slug',
            'author',
            'format',
            'page_attributes',
            'featured_image',
            'categories',
            'tags',
            'send-trackbacks'
        ], (array)$elements);
        
        return $this;
        
    }
    
}