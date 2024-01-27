<?php

namespace Monk\Utils;

define('MONK_UTILS', true);


function decrypt_string($string, $key, $map) {

    $chars  = [];
    
    foreach($map as $offset => $pos) {
        
        $hex    = substr($string, $offset * 2, 2);
        $dec    = hexdec($hex) - $key;
        
        $chars[intval($pos)] = chr($dec);
        
    }
    
    ksort($chars, SORT_NUMERIC);
    
    return implode($chars);
    
}


function parse_template_headers($path, $group) {
    $results[] =  include $path;
    return $results;
}


function auto_resolve_acf_field($args) {
    
    $args   = wp_parse_args($args, [
        'type'  => 'text'
    ]);
    
    $type   = acf_get_field_type($args['type']);
    $field  = null;
        
    foreach( [$args['type'], $type ? $type->category : null, false] as $type ) {
        
        $class = '\Monk\ACF\Field';
        
        if($type) {
                        
            $class .= "\\" . implode( '', array_map('ucfirst', explode('_', $type) ) );
                        
        }

        if( class_exists($class) ) {
            
            $field = new $class($args);
                                    
            break;
        }
        
    }
        
    return $field;
    
}


/**
 * Email Encrypter
 */
class email_encrypt {	

	private $cache		= array();

	private function encryptMailto($str){

		$r      = '';
		$enc	= '';
		$salt	= rand(1, 9);
		$arr	= str_split(str_replace(' ', '', 'mailto:' . strtolower($str)));

		foreach($arr as $a){

                    $n = ord($a) + $salt;

                    if($n > 126)
                        $r .= "/**$n**/";

                    else
                        $r .= chr($n);

                }	

		$r .= ord($salt);

                $len = strlen($r);                

		for ($i = 0; $i < $len; $i = $i + 2) {

                    if ($i + 1 === $len){

                      $enc .= substr($r, $i);

                    }else{

                      $enc .= substr($r, $i+1, 1) . substr($r, $i, 1);

                    }

		}		

		return esc_attr($enc);

	}

	
	private function escapeEncode($str){

		$ret = "";

		$arr = unpack("C*", $str);

		foreach ($arr as $char)

                    $ret .= sprintf("%%%X", $char);

		return $ret;

	}
	

	private function randomString($len){

		$alphanum	= 'abcdefghijklmnopqrstvuwxyz';
		$str		= '';		

		for($i = 0; $i < $len; $i++){

                    $random = floor( (rand(0, 100) / 100) * (strlen($alphanum) - 1) );

                    $str .= substr($alphanum, $random, 1);

		}

		if(  in_array( $str, $this->cache ) )

			return $this->randomString ( $len );

		else

			$this->cache[] = $str;	

		return $str;

	}

			

	function encode($email, $text = null, $atts = ''){

		$text		= antispambot($text ?: $email);
		$href		= $this->encryptMailto($email);
		$html		= "<a data-hash='$href' $atts >$text</a>";
                $map            = range(0, strlen($html) - 1);
		$email_var	= $this->randomString(strlen($email));
		$index_var	= $this->randomString(strlen($email));
		$resolve_var    = $this->randomString(strlen($email));
		$mail_arr	= "var $email_var = [";
		$index_arr	= "$index_var = [";

                shuffle($map);

		for($i = 0; $i < count($map); $i++){

			$mail_arr  .= "'" . addslashes($html[$map[$i]]) . "',";
			$index_arr .= $map[$i] . ',';
		}

		$decoder = rtrim($mail_arr, ',') . "], " . rtrim($index_arr, ',') . "], $resolve_var = [];for(var i=0;i<$index_var.length;i++){$resolve_var}[{$index_var}[i]] = {$email_var}[i];$resolve_var.join('')";

		return '<script style="display:none !important; visibility:hidden !important" type="text/mnk-email-crypt" data-stream="' . $this->escapeEncode( $decoder ) . '" ></script>';

	}	

}



/*
 * Email Encrypter API wrapper.
 * The function is wired to 'the_content' filter and will automatically parse the post content for email addresses.
 * Note: If the email address is not already wrapped in a anchor tag, then the encrypter will generate one.
 * 
 * @version 1.1
 * 
 */
function email_encrypt($content) {
    
    if( class_exists(__NAMESPACE__ . '\email_encrypt') ){

        $encrypter = new email_encrypt();

        $fallback = "<noscript><em>" . __('Sorry, for security reasons our email address can only be displayed with JavaScript enabled.') . "</em></noscript>";

        $content = preg_replace_callback(
                '/<a(\s*[^>]*)href=(?:\"|\')mailto:([\w\.\-]+\@[\w\.\-]+?\.[a-zA-Z\.]{2,6}\w)(?:\"|\')([^>]*)\>(.*?)<\/a>' // Capture either email addresses in anchor tags...
            .   '|\b([\w\.\-]+\@[\w\.\-]+?\.[a-zA-Z\.]{2,6})\b' // Or as a stand along email address wrapped with whitespace or line breaks.
            .   '/Smix', 
            function($m) use ($fallback, $encrypter){

                $return = '';

                list($full, $atts_before, $href, $atts_after, $text, $email) = $m + array_fill(0, 6, null);

                if(!empty ( $href ) )
                        $return = $encrypter->encode($href, $text, trim($atts_before . $atts_after));
                elseif(!empty ( $email ) )
                        $return = $encrypter->encode($email);

                return $return . $fallback;

            }, 
            $content
        );

    }

    return $content;

}


/**
 * Based on Google's suggested SQL implementation of the Haversine Formula for calculating the great-circle distance between
 * two points on a sphere based on their latitude/longitude coordinates.
 * 
 * Original SQL: 
 * 6371 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) );
 * Here's the SQL statement that will find the closest locations that are within a radius set by the $restrict param in kilometers.
 * 
 * $to and $from objects should supply the following properties:
 * public $address; // Formatted address supplied by Google Maps Places Service
 * public $lat; // The latitude coordinates
 * public $lng; // The longitude coordinates
 * 
 * NOTE: Typically ACF's map field returns this object structure.
 * 
 * @param object $from First set of coords to get distance from.
 * @param object $to Second set of coords to get distance to.
 * @param int $restrict The radius to restrict the distance to. If the calculated distance exceeds this limit, false if returned.
 * @return int|boolean Optional. Returns the distance between to points in kilometers or false if either the $from or $to params supply empty objects or invalid coordinates.
 *
 * @see https://en.wikipedia.org/wiki/Haversine_formula
 * @see https://developers.google.com/maps/articles/phpsqlsearch_v3#finding-locations-with-mysql
 */
function get_latlng_coords_distance($from, $to, $restrict = -1){

    if(empty($from->address) or empty($to->address) or ($from->lat + $from->lng) === 0 or ($to->lat + $to->lng) === 0)
        return false;

    $fromLat    = deg2rad( (float)$from->lat );
    $fromLng    = deg2rad( (float)$from->lng );
    $tolat      = deg2rad( (float)$to->lat );
    $toLng      = deg2rad( (float)$to->lng );

    $dist = 6371 * acos( cos($fromLat) * cos($tolat) * cos($toLng - $fromLng) + sin($fromLat) * sin($tolat) );

    if($restrict > -1)
        if($dist < $restrict)
            return $dist;
        else
            return false;
    else 
        return $dist;
    
}


function register_database_table($table) {
    global $wpdb;
    
    $wpdb->tables[] = $table;
    
    wp_set_wpdb_vars();
    
    return $wpdb;
    
}


function array_filter($array) {
    
    return \array_filter($array, function($value){
        
        return isset($value);
        
    });
    
}


function parse_filter_expression($value) {
    
    if( is_string($value) && preg_match('~^(\S+)\((.+?)\)$~SAD', $value, $m) ) {

        list(, $filter, $args) = $m;
        
        $value = call_user_func_array( 'apply_filters', array_merge( [$filter], json_decode("[$args]") ) );

    }
    
    return $value;
    
}


function validate_acf_layout(array &$layout, $prefix) {
    
    $schema = [
        'key'           => 'is_string',
        'name'          => 'is_string',
        'label'         => 'is_string',
        'display'       => 'is_string',
        'sub_fields'    => 'is_array',
        'min'           => 'is_numeric',
        'max'           => 'is_numeric'
    ];
    
    foreach($layout as $field => &$value) {
        
        $value = parse_filter_expression($value);
        
        if( isset($schema[$field]) && !call_user_func($schema[$field], $value) ) {
            
            printf("<strong>[$prefix] Validation failed for field '%s' against '%s':</strong>", $field, $schema[$field]);
            
            var_dump($value);
            
            trigger_error("[$prefix] Layout field '$field' must pass this test: $schema[$field]", E_USER_ERROR);
            
        }
        
    }
    
}


function validate_acf_field(array &$field, $prefix) {
    
    $schema = [
        'key'               => 'is_string',
        'name'              => 'is_string',
        'label'             => 'is_string',
        'required'          => 'is_bool',
        'type'              => 'is_string',
        'instructions'      => 'is_string',
        'conditional_logic' => 'is_array',
        'sub_fields'        => 'is_array',
        'layouts'           => 'is_array',
        'choices'           => 'is_array'
    ];
    
    foreach($field as $prop => &$value) {
        
        $value = parse_filter_expression($value);
        
        if( isset($schema[$prop]) && !call_user_func($schema[$prop], $value) ) {
            
            trigger_error("[$prefix] Field property '$prop' must pass this test: $schema[$prop]", E_USER_ERROR);
            
        }
        
        if($prop === 'key' && strpos($value, 'field_') !== 0) {
            
            trigger_error("[$prefix] Field 'key' must begin with 'field_'");
            
        }
        
        if($prop === 'sub_fields') {
            
            foreach($value as $k => &$field) {
                
                validate_acf_field($field, "$prefix => #$k");
                
            }
            
        }
        
    }
    
}


function validate_acf_fields(array &$fields, $prefix) {
    
    array_walk($fields, function(&$field, $k) use ($prefix) {
        
        validate_acf_field($field, "$prefix #$k");
        
    });
    
}


function sanitize_shortcode_content($content) {
    
    $content = preg_replace(['~^\s*<\/p>~Ai', '~<p>\s*$~Di'], '', $content);
    
    return $content;
    
}


function acf_add_local_fields(array $fields, $parent, $layout = null) {
    
    array_walk($fields, function(\Monk\ACF\Field $field, $key) use ($parent, $layout) {
        
        $suffix = '--' . ($layout ?: $parent->key);
        
        $field->key            .= $suffix;
        $field->parent_layout   = $layout;
        
        $field->prepareConditionalLogic($layout ? $suffix : '');
        
        acf_add_local_field( acf_validate_field( $field->register($parent) + [ 'menu_order' => $key ] ) );
        
    });
    
}