<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function cutom_date_time($str) {
    $hour = date('H', strtotime($str));
    $minutes = date('i', strtotime($str));
    $todate = toBangla($hour. ':' .$minutes) . ' , ' . toBanglaMonth(date("F", strtotime($str))) . ' ' . toBangla(date("d", strtotime($str))) . ' , ' . toBangla(date("Y", strtotime($str)));
    return $todate;
}

function cutom_date_time_header() {
    $hour = date('H');
    $hour_s = date('h');
    $minutes = date('i');
    $day = date('w');
    $month = date("F");
    $date = date("d");
    $year = date("Y");
    $bndate = todaytimes($hour).' '.toBangla($hour_s) . ':' . toBangla($minutes) . ' ; ' . toBanglaDay($day) . ' ; ' . toBanglaMonth($month) . ' ' . toBangla($date) . ' , ' . toBangla($year);
    //$bndate = toBangla($hour) . ':' . toBangla($minutes) . ' ; ' . toBanglaDay($day) . ' ; ' . toBanglaMonth($month) . ' ' . toBangla($date) . ' , ' . toBangla($year);
    return $bndate;
}

function toBangla($str) {
    $convert = array(
        '0' => '০',
        '1' => '১',
        '2' => '২',
        '3' => '৩',
        '4' => '৪',
        '5' => '৫',
        '6' => '৬',
        '7' => '৭',
        '8' => '৮',
        '9' => '৯',
        ':' => ':',
        '-' => '-'
    );
    $newStr = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = substr($str, $i, 1);
        if(ctype_space($char)){
            $newStr .= '&nbsp;';
        } elseif ($convert [$char] != NULL) {
            $newStr .= $convert [$char];
        } else {
            $newStr .= $char;
        }
    }

    return $newStr;
}

function toBanglaMonth($monthNo) {
    $month_array = array(
        'January' => 'জানুয়ারি',
        'February' => 'ফেব্রুয়ারি',
        'March' => 'মার্চ',
        'April' => 'এপ্রিল',
        'May' => 'মে',
        'June' => 'জুন',
        'July' => 'জুলাই',
        'August' => 'আগস্ট',
        'September' => 'সেপ্টেম্বর',
        'October' => 'অক্টোবর',
        'November' => 'নভেম্বর',
        'December' => 'ডিসেম্বর'
    );
    return $month_array[$monthNo];
}

function toBanglaDay($dayNo) {
    $days = array(
        '0' => 'রবিবার',
        '1' => 'সোমবার',
        '2' => 'মঙ্গলবার',
        '3' => 'বুধবার',
        '4' => 'বৃহস্পতিবার',
        '5' => 'শুক্রবার',
        '6' => 'শনিবার'
    );
    return $days [$dayNo];
}

function todaytimes($hrs) {
    if ($hrs >= 19) {
        $data = 'রাত';    // night
    } else if ($hrs >= 17) {
        $data = 'সন্ধ্যা';    // evening
    } else if ($hrs >= 15) {
        $data = 'বিকাল';    // afternoon
    } else if ($hrs >= 11) {
        $data = 'দুপুর';    // afternoon
    } else if ($hrs >= 7) {
        $data = 'সকাল';    // morning
    } else if ($hrs >= 5) {
        $data = 'ভোর';    // REALLY early
    } else {
        $data = 'রাত';    // night
    }
    return $data;
}

function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    $sentense = implode(" ", array_splice($words, 0, $word_limit)) . '...';
    return $sentense;
}
function limit_words_without_dot($string, $word_limit) {
    $words = explode(" ", $string);
    $sentense = implode(" ", array_splice($words, 0, $word_limit));
    return $sentense;
}
function url_format_fnc($web_url) {
    $replaced_url = str_replace(main_site_url(), base_url(), $web_url);
    return $replaced_url;
}
function to_web_url($web_url) {
    $replaced_url = str_replace(base_url(), main_site_url(), $web_url);
    return $replaced_url;
}
function media_image_resize($content_img,$width,$height) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = $width.'x'.$height.'x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}
function media_image_url_formating_600x315($content_img) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = '600x315x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}
function media_image_url_formating_160_90($content_img) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = '160x90x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}
function media_image_url_formating_304_171($content_img) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = '304x171x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}
function media_image_url_formating_416_234($content_img) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = '416x234x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}
function media_image_url_formating_50_50($content_img) {
    $exp_url = explode('/', $content_img);
    $exp_url[0] = 'http:';
    $exp_url[6] = '50x50x1';
    $imp_url=  implode('/', $exp_url);
    return $imp_url;
}

function make_single_content($con_array){
    $keys = array_keys($con_array['data']);
    $formated_array = $con_array['data'][$keys[0]];
    return $formated_array;
}

global $curl_coookie;
$curl_coookie = '';
if (is_array($_COOKIE)) {
    foreach ($_COOKIE as $key => $val)
        $curl_coookie .= $key . '=' . urlencode($val) . ';';
}
function curl_api_call($args = array()) {
    if (preg_match("/windows/i", $_SERVER['HTTP_USER_AGENT'])) {
        exit();
    }
    extract($args);
    $curl_options = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
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