<?php

defined('BASEPATH') or exit('No direct script access allowed');
function currentTime()
{
    $time = date('Y-m-d H:i:s');
    return $time;
}

if(!function_exists('replaceSingleTag'))
{
    function replaceSingleTag($msg, $tag1)
    {
        return $str = str_replace('{0}',$tag1,$msg);
		
    }
}

if(!function_exists('str_replace_first'))
{
    function str_replace_first($search, $replace, $subject)
    {
        $search = '/'.preg_quote($search, '/').'/';
        return preg_replace($search, $replace, $subject, 1);
    }
}

if(!function_exists('random_generator'))
{
    function random_generator($s = 0, $e = 8){
        $now = substr( md5(time().uniqid()), $s, $e );
        return $now;
    }
}

if(!function_exists('filename_withoutext'))
{
    function filename_withoutext( $filename ){
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        return $withoutExt;
    }
}

if (!function_exists('get_image_src')) {
    function get_image_src($image_path) {
        // Check if the image_path is a full URL
        if (filter_var($image_path, FILTER_VALIDATE_URL)) {
            return $image_path; // It's a full URL
        } else {
            $assetUrl = config_item('islive') ? config_item('bucket_url') : config_item('assetsBasePath');
            return $assetUrl.$image_path; // It's a relative path, append with base_url
        }
    }
}

if (!function_exists('config_item')) {
    function config_item($item, $value=Null) {
        $ci = getInstance();
        if($item && $value) {
            return $ci->config->item($item);
        } else {
            return $ci->config->set_item($item, $value);
        }
    }
}

if (!function_exists('getInstance')) {
    function getInstance($item, $value=Null) {
        $ci =& get_instance();
        return $ci;
    }
}