<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('script_tag')){
    function script_tag($resource, $type="text/javascript"){
        return "        <script src='" . base_url($resource) . "' type='" . $type . "'></script>\r\n";

    }
}

?>