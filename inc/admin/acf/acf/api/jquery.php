<?php

namespace Monk\ACF\Field;

/*
 * jQuery
 */


class GoogleMap extends \Monk\ACF\Field {
    
    public $center_lat  = '-31.952780';
    public $center_lng  = '115.876930';
    public $zoom        = '17';
    public $type        = 'google_map';
    
}


class TimePicker extends \Monk\ACF\Field {
    
    public $display_format;
    public $return_format;
    public $type = 'time_picker';
    
}


class DatePicker extends TimePicker {
    
    public $first_day;
    public $type = 'date_picker';
    
    function setFirstDay($day) {
                
        $this->first_day = array_search(strtolower($day), ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']);
        
        return $this;
        
    }
    
}


class DateTimePicker extends DatePicker {
    
    public $type = 'date_time_picker';
    
}