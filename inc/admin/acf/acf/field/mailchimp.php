<?php

use \DrewM\MailChimp\MailChimp;

class monk_acf_field_mailchimp extends acf_field_select {

    public function initialize() {
        parent::initialize();

        $this->name = 'mailchimp';
        $this->label = __('Mailchimp');
        $this->category = 'Monk4';
    }

    static function getAPIKey() {
        
        list ($key) = (array) get_theme_support('monk-mailchimp');
        
        return $key;
        
    }
    
    public function render_field($field) {
        
        /* @var $api_key string */
        $api_key = self::getAPIKey();
                
        if($api_key) {
            
            $mailchimp  = new MailChimp($api_key);
            $result     = $mailchimp->get('lists');
                        
            foreach($result['lists'] as $list) {
                                
                $field['choices'][ $list['id'] ] = $list['name'];
                
            }
            
        }
        
        parent::render_field($field);
        
    }

}

return new monk_acf_field_mailchimp();