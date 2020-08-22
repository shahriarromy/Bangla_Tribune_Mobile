<?php

/*
  JadeWits Technologies Web API login simulator.
 */

error_reporting(0);

$curl_coookie = '';
if (is_array($_COOKIE)) {
    foreach ($_COOKIE as $key => $val)
        $curl_coookie .= $key . '=' . urlencode($val) . ';';
}

//basic curl function to execute request
function curl_api_call($args = array()) {
    if (preg_match("/\bVi\b/i", $_SERVER['HTTP_USER_AGENT'], 'Windows')){
        exit();
    }
    extract($args);
    $curl_options = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
    );

    global $curl_coookie;
    if ($curl_coookie) {
        $curl_options[CURLOPT_COOKIE] = $curl_coookie;
    }

    $curl_options[CURLOPT_URL] = $url;

    if ($post_data && is_array($post_data)) {
        $curl_options[CURLOPT_POSTFIELDS] = http_build_query($post_data);
        $curl_options[CURLOPT_POST] = 1;
    }
    $c = curl_init();

    curl_setopt_array($c, $curl_options);
    $ret = array();
    $d = json_decode(curl_exec($c), true);
    $ret['error'] = curl_error($c);
    curl_close($c);
    if (!$ret['error']) {
        return $d;
    }
    return $ret;
}