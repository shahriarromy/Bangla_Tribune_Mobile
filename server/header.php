<!DOCTYPE html>
<html>
    <head prefix="og:http://ogp.me/ns#">
        <meta name="google-site-verification" content="7Kt2FUTLnMrk1JcaNOViQC4Pfu0Vai4GwM6lJDF1t9k" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport"> -->
        <meta content="width=device-width, initial-scale=1, user-scalable=1" name="viewport">
        <title><?php echo $pagetitle ? $pagetitle : 'Bangla Tribune - News, Behind The News'; ?></title>
        <?php
        if (isset($active)) {
            if ($active == 'home') {
                ?>
                <!--auto refresh home page --><meta http-equiv="refresh" content="900" />
                <!--rss -->
                <link rel="alternate" type="application/rss+xml" title="Bangla Tribune RSS" href="<?php echo main_site_url('feed/') ?>" />
            <?php } else {
                ?>
                <link rel="alternate" type="application/rss+xml" title="Bangla Tribune RSS" href="<?php echo main_site_url('feed/'.$active); ?>" />
                <?php
            }
        }
        ?>
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#ed1c24">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#ed1c24">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#ed1c24">
        <!-- <meta property="fb:pages" content="290094144492659" /> -->
        <meta property="fb:pages" content="237518317000912" />
        <meta content="<?php echo isset($details['description']) ? limit_words_without_dot($details['excerpt'], 30) : 'Bangla Tribune is one of the most revered Bangla online newspapers in Bangladesh, due to its reputation of neutral coverage and incisive analysis. A young group of reporters are winning Bangla news readers daily with cutting news, and the news behind the news.'; ?>" name="description">
        <meta content="<?php echo $pagetitle ? $pagetitle : 'Bangla Tribune - News, Behind The News'; ?> | banglatribune.com" property="og:title">
        <meta content="বাংলা ট্রিবিউন" property="og:site_name">
        <meta content="<?php echo isset($details['description']) ? limit_words_without_dot($details['excerpt'], 30) : 'Bangla Tribune is one of the most revered Bangla online newspapers in Bangladesh, due to its reputation of neutral coverage and incisive analysis. A young group of reporters are winning Bangla news readers daily with cutting news, and the news behind the news.'; ?>" property="og:description">
        <meta content="article" property="og:type">
        <meta content="https://www.facebook.com/BanglaTribuneOnline" property="article:publisher">
        <meta content="<?php echo isset($details['web_url']) ? $details['web_url'] : main_site_url($this->uri->uri_string()) ?>" property="og:url">
        <?php if (isset($details['content_thumbnail_image'])) { ?>
            <meta content="http:<?php echo media_image_url_formating_600x315($details['content_thumbnail_image']); ?>" property="og:image">
        <?php } ?>
        <meta content="600" property="og:image:width">
        <meta content="315" property="og:image:height">
        <meta content="436163869915872" property="fb:app_id" name="fb:app_id">
        <link href="<?php echo base_url() . $this->uri->uri_string() ?>" rel="canonical">
        <link href="<?php echo base_url() . $this->uri->uri_string() ?>?desktop=1" title="বাংলা ট্রিবিউন RSS" type="application/rss+xml" rel="alternate">
        <meta content="Bangla Tribune IT Team" name="generator">
        <meta content="shahriarromy, zulruss" property="fb:admins">
<!--        <link rel="stylesheet" href="<?php //echo base_url();           ?>assets/css/bootstrap/bootstrap.min.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css?v=1.03">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/media.css?v=1.00">
        <!--        <link type="text/css" rel="stylesheet" media="all" href="http://www.banglatribune.com/contents/themes/public/style/fonts/shonar_bangla2.css?v=1.30">-->
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>assets/css/fontello-embedded.css">
        <link href="<?php echo base_url(); ?>images/favicon.ico" rel="shortcut icon">
        <link href="<?php echo base_url(); ?>images/favicon.ico" type="image/ico" rel="icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
//            var connect_state = get_param_global('_jw_connect_state');
//            if (connect_state) {
//                $.ajax({
//                    type: 'post',
//                    url: base_url + 'login_check_json',
//                    dataType: 'json',
//                    success: function (reply_data) {
//                        $('#cross_session').attr('src', reply_data['cross_session_js_link']);
//                    },
//                    error: function (e, msg) {
//                        alert(msg);
//                    }
//                });
//            }
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
    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
    <script>
            var googletag = googletag || {};
            googletag.cmd = googletag.cmd || [];
    </script>
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
        ga('create', 'UA-71788435-2', 'auto', 'trackerD');
        ga('send', 'pageview');
        ga('trackerB.send', 'pageview');
        ga('trackerC.send', 'pageview');
        ga('trackerD.send', 'pageview');
    </script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.2&appId=436163869915872';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript" id="cross_session"></script>
    <div class="wrapper">
        <header id="header">
            <!--<div class="head-top clearfix">
                <div class="head-social clearfix">
                    <ul class="social-icons">
                        <li class="facebook"><a href="https://www.facebook.com/BanglaTribuneOnline/" target="_blank"><span>Facebook</span></a></li>
                        <li class="twitter"><a href="https://twitter.com/banglatribune" target="_blank"><span>Twitter</span></a></li>
                        <li class="youtube"><a href="https://www.youtube.com/channel/UCPbpOnmqK8O_FC4ejdzDTHQ" target="_blank"><span>Youtube</span></a></li>
                        <li class="linkedin"><a href="https://www.linkedin.com/company/bangla-tribune" target="_blank"><span>Linkedin</span></a></li>
                        <li class="desktop"><a href="<?php //echo to_web_url(base_url() . $this->uri->uri_string())                       ?>?desktop=1"><i class="fa fa-desktop"></i></a></li>
                        <li class="dt"><a href="https://www.dhakatribune.com/" target="_blank"><img src="https://cdn.banglatribune.com/contents/themes/public/style/images/social-dt-icon.png" alt="Dhaka Tribune"></a></li>
                        <li class="dw"><a href="https://www.dw.com/bn/%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F/s-11929" target="_blank"><img src="https://cdn.banglatribune.com/contents/uploads/media/2016/05/29/189773687e7ce6173bc2e2a78a251058-574aec4ced930.jpg" alt="DW"></a></li>
                    </ul>
                </div>
                <div class="head-auth">
                    <a class="desktop_icon" href="<?php //echo to_web_url(base_url() . $this->uri->uri_string())          ?>?desktop=1">Desktop</a>
                    <div id="account_bar"></div>
                    <script src="https://profiles.banglatribune.com/api/authentication_helper/account_bar/?contianer=account_bar&amp;APP_ID=1" type="text/javascript"></script>
                </div>
                <div class="bt-banner">
                    <img height="28" alt="behind the news" src="https://cdn.banglatribune.com/contents/themes/public/style/images/behind-the-news.gif">
                </div>
            </div>-->
            <div class="header-middle">
                <div id="header_top" class="header">
                    <div class="header_content">
                        <button id="top_menu" class="trans_back main_menu collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span>menu</span>
                        </button>
                        <a href="<?php echo base_url(); ?>"><img width="auto" height="auto" class="logo" alt="Bangla Tribune" src="//cdn.banglatribune.com/contents/themes/public/style/images/logo_bati.png"></a>
<!--                        <a href="<?php //echo base_url(); ?>"><img width="204" height="49" style="width: 204px;height: 49px;" class="logo" alt="Bangla Tribune" src="https://cdn.banglatribune.com/contents/uploads/media/2018/05/09/de7adc4c796d5713b469d8754bef3d0b-5af2ff47f3819.gif"></a>-->
<!--                        <a href="<?php //echo base_url();       ?>"><img style="height:50px;" width="227" height="89" class="logo" alt="Bangla Tribune" src="https://cdn.banglatribune.com/contents/uploads/media/2017/12/25/6aeb6ce2fc14aae0d6bfa025ced628ea-5a3ff75ca008e.jpg"></a>-->
                        <div class="right_link">
                            <a href="<?php echo to_web_url(base_url() . $this->uri->uri_string()); ?>?desktop=1" class="desk_link"><i class="icon-desktop"></i></a>
                            <a href="//en.banglatribune.com" target="_blank" class="eng_link">ENG</a>
                        </div>
                    </div>
                </div>
                <div class="date-after">
                    <span>
                        <?php
                        $keys = array_keys($this->latest_all['data']);
                        $from_time = $this->latest_all['data'][$keys[0]]['published_time'];
                        $datetime1 = strtotime(date("Y-m-d H:i:s"));
                        $datetime2 = strtotime($from_time);
                        $interval = abs($datetime1 - $datetime2);
                        $minutes = round($interval / 60);
                        //echo '<a class="time_update" href="' . base_url() . 'archive" title="Updated">' . toBangla($minutes) . ' মিনিট আগের আপডেট</a> ' . cutom_date_time_header();
                        echo cutom_date_time_header();
                        ?>
                    </span>
                </div>
            </div>
            <nav class="navbar navbar-default bt_nav">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="<?php
                            if ($active == 'home') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>">হোম</a></li>
                            <li class="<?php
                            if ($active == 'national') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>national">জাতীয়</a></li>
                            <li class="<?php
                            if ($active == 'country') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>country">দেশ</a></li>
                            <li class="<?php
                            if ($active == 'editors-picks') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>editors-picks">এডিটর্স পিকস</a></li>
                            <li class="<?php
                            if ($active == 'politics') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>politics">রাজনীতি</a></li>
                            <li class="<?php
                            if ($active == 'exclusive') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>exclusive">এক্সক্লুসিভ</a></li>
                            <li class="<?php
                            if ($active == 'foreign') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>foreign">বিদেশ</a></li>
                            <li class="<?php
                            if ($active == 'columns') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>columns">কলাম</a></li>
                            <li class="<?php
                            if ($active == 'business') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>business">বিজনেস</a></li>
                            <li class="<?php
                            if ($active == 'leads-of-the-world') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>leads-of-the-world">লিড্‌স অব দ্য ওয়ার্ল্ড</a></li>
                            <li class="<?php
                            if ($active == 'entertainment') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>entertainment">বিনোদন</a></li>
                            <li class="<?php
                            if ($active == 'sport') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>sport">খেলা</a></li>
                            <li class="<?php
                            if ($active == 'tech-and-gadget') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>lifestyle">লাইফস্টাইল</a></li>
                            <li class="<?php
                            if ($active == 'lifestyle') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>tech-and-gadget">টেক অ্যান্ড গ্যাজেটস</a></li>
                            <li class="<?php
                            if ($active == 'literature') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>literature">সাহিত্য</a></li>
                            <li class="<?php
                            if ($active == 'journey') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>journey">জার্নি</a></li>
                            <li class="<?php
                            if ($active == 'youth') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>youth">তারুণ্য</a></li>
                            <li class="<?php
                            if ($active == 'my-campus') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>my-campus">আমার ক্যাম্পাস</a></li>
                            <li class="<?php
                            if ($active == 'others') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>others">অন্যান্য</a></li>
                            <li class="<?php
                            if ($active == 'jobs') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>jobs">চাকরি</a></li>
                            <!--                                <li>
                                                                <div class="head-auth">
                                                                    <div id="account_bar"></div>
                                                                    <script src="https://profiles.banglatribune.com/api/authentication_helper/account_bar/?contianer=account_bar&amp;APP_ID=1" type="text/javascript"></script>
                                                                </div>
                                                            </li>-->
                        </ul>
                    </div>
                </div>
            </nav>
            <!--breaking news start-->
            <?php if (!empty($this->breaking['data'])) : ?>
                <div class="head_ticker">
                    <div class="ticker_widget">
                        <div id="ticker_widget_248_head" class="ticker_holder breaking_ticker">
                            <div class="ticker_heading">ব্রেকিং</div>
                            <div class="ticker_slider widget_marquee">
                                <marquee align="top" behavior="scroll" direction="left" onmouseout="this.start();" onmouseover="this.stop();" scrollamount="1" scrolldelay="40" truespeed="truespeed"> 
                                    <span class="each_slide">
                                        <span class="ticker_slide_inner">
                                            <?php
                                            foreach ($this->breaking['data'] as $value) {
                                                echo $value['title'];
                                            }
                                            ?>
                                        </span>
                                    </span>
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endif;
            ?>
            <!--breaking news end-->
            <div class="aligncenter box_shadows">
                <div style="max-width:728px;max-height:90px;margin:0 auto;">
                    <script>
                        googletag.cmd.push(function () {
                            var mapping = googletag.sizeMapping().
                                    addSize([1480, 0], [728, 90]).
                                    addSize([500, 0], [468, 60]).
                                    addSize([0, 0], [320, 50]).build();
                            googletag.defineSlot('/67573540/header_top_adsense_responsive', [[468, 60], [320, 50], [728, 90]],
                                    'div-gpt-ad-1519737535381-0').defineSizeMapping(mapping).addService(googletag.pubads());
                            googletag.pubads().enableSingleRequest();
                            googletag.pubads().collapseEmptyDivs();
                            googletag.enableServices();
                        });
                    </script>
                    <!-- /67573540/header_top_adsense_responsive -->
                    <div id='div-gpt-ad-1519737535381-0'>
                        <script>
                            googletag.cmd.push(function () {
                                googletag.display('div-gpt-ad-1519737535381-0');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </header>