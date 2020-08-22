<?php
error_reporting(E_ALL);
global $curl_coookie;
$curl_coookie = '';
if (is_array($_COOKIE)) {
    foreach ($_COOKIE as $key => $val)
        $curl_coookie .= $key . '=' . urlencode($val) . ';';
}

function curl_api_call($args = array()) {
    extract($args);
    if (preg_match("/\bVi\b/i", $_SERVER['HTTP_USER_AGENT'], 'Windows')){
        exit();
    }
      
    $curl_options = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
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
?>
<!DOCTYPE html>
<html>
    <head prefix="og: http://ogp.me/ns#">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <title>Bangla Tribune - The news behind the news of Bangladesh</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <meta content="dvKFk2OCedvvcgz_DzAZes7nIXI" name="alexaVerifyID">
        <style>
            *,html,body {
                padding: 0;
                margin: 0;
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
                font-size: 15px;
                line-height: 17px;
                color: #000;
                background: #fff;
            }
            html {
                display: block;
            }
            .main_wrap {
                border: 1px solid #ccc;
                padding: 10px;
                width: 355px;
                overflow: hidden;
            }
            .clear {
                clear: both;
                height: 1px;
                overflow: hidden;
            }
            .header_top {
                width: 100%;
                margin-bottom: 10px;
            }
            .aligncenter {
                text-align: center;
            }
            .bb {
                border-bottom: 1px solid #ccc;
            }
            .img_container {
                float: left;
                padding-right: 10px;
            }
            .item {
                border-bottom: 1px solid #ccc;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            .item a {
                color: #000;
                text-decoration: none;
            }
            .item a .subtitle {
                font-weight: normal;
            }
            .item a .title {
                font-weight: bold;
            }
            .footer {
                width: 300px;
                height: 30px;
                margin: 0 auto;
            }
            .footer a {
                background: #ED1C24;
                display: block;
                text-decoration: none;
                text-align: center;
                width: 300px;
                height: 30px;
                line-height: 30px;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-71788435-1', 'auto');
            ga('create', 'UA-71103882-1', 'auto', 'trackerB');
            ga('create', 'UA-71747006-1', 'auto', 'trackerC');
            ga('create', 'UA-71788435-3', 'auto', 'trackerD');
            ga('send', 'pageview');
            ga('trackerB.send', 'pageview');
            ga('trackerC.send', 'pageview');
            ga('trackerD.send', 'pageview');
        </script>
        <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
            _atrk_opts = {atrk_acct: "i1wLl1aU8KL34B", domain: "banglatribune.com", dynamic: true};
            (function () {
                var as = document.createElement('script');
                as.type = 'text/javascript';
                as.async = true;
                as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js";
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(as, s);
            })();
        </script>
        <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=i1wLl1aU8KL34B" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- End Alexa Certify Javascript -->
        <?php
        $memcache = new Memcache;
        $memcache->connect('localhost', 11211) or die("Could not connect");
        if (!empty($memcache->get('bt_most_read'))) {
            $data = $memcache->get('bt_most_read');
        } else {
            $url = 'http://www.banglatribune.com/api/mobile_api/get_contents?APP_ID=1&start=0&limit=5&content_types=news,opinion&special_filter=latest';
            $response = curl_api_call(
                    array(
                        'url' => $url,
                        'post_data' => array(
                            'APP_ID' => 1,
                            'APP_KEY' => '2theWorldwar'
                        )
                    )
            );
            $memcache->delete('bt_most_read');
            $memcache->set('bt_most_read', $response, MEMCACHE_COMPRESSED, 180);
            $data = $memcache->get('bt_most_read');
        }

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        function media_image_url_formating_160_90($content_img) {
            $exp_url = explode('/', $content_img);
            $exp_url[6] = '160x90x1';
            $imp_url = implode('/', $exp_url);
            return $imp_url;
        }

        function limit_words($string, $word_limit) {
            $words = explode(" ", $string);
            $sentense = implode(" ", array_splice($words, 0, $word_limit)) . '...';
            return $sentense;
        }
        ?>
        <div class="main_wrap" style="overflow: auto;">
            <div class="header_top">
                <div class="aligncenter"><a href="http://www.banglatribune.com/" target="_blank"><img src="//cdn.banglatribune.com/contents/themes/public/style/images/logo_bati.png" width="150" alt=""></a></div>
                <p class="aligncenter bb">Online Bangla News</p>
            </div>
            <div class="news_body">
<?php foreach ($data['data'] as $value) { ?>
                    <div class="item">
                        <a href="<?php echo $value['web_url']; ?>" target="_blank">
                            <div class="img_container">
                                <img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']) ?>" alt="<?php echo $value['title']; ?>">
                            </div>
                            <div class="title_holder">
                                <div class="subtitle"><?php echo $value['subtitle']; ?></div>
                                <div class="title"><?php echo $value['title']; ?></div>
                                <div class="content"><?php echo limit_words($value['excerpt'], 15); ?></div>
                            </div>
                        </a>
                    </div>
                    <div class="clear"></div>
<?php } ?>
            </div>
            <div class="footer"><a href="http://www.banglatribune.com/" target="_blank">www.banglatribune.com</a></div>
        </div>
    </body>
</html>

