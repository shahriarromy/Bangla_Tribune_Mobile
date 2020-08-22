<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    function doCURLRequest($url, $vars = array(), $method = 'POST') {
        // if (preg_match("/\bVi\b/i", $_SERVER['HTTP_USER_AGENT'], 'Windows')){
        // exit();
        // }
        $curl_coookie = '';
        if (is_array($_COOKIE)) {
            foreach ($_COOKIE as $key => $val)
                $curl_coookie .= $key . '=' . urlencode($val) . ';';
        }
        $ch = curl_init();
        if ($curl_coookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $curl_coookie);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'm.banglatribune.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // times out after 1000 seconds
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if (strtoupper($method) == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        $data = json_decode(curl_exec($ch), TRUE);
        $ret = array();
        $ret['error'] = curl_error($ch);
        curl_close($ch);
        if (!$ret['error']) {
            return $data;
        }
        return $ret;
    }

}
?>	
