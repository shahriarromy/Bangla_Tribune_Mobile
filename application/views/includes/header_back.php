<!DOCTYPE html>
<html>
    <head prefix="og: http://ogp.me/ns#">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <title><?php echo $pagetitle ? $pagetitle : 'Bangla Tribune - The news behind the news of Bangladesh'; ?></title>
        <meta content="<?php echo isset($details['description']) ? limit_words($details['excerpt'],30) : ''; ?>" name="description">
        <meta content="<?php echo $pagetitle ? $pagetitle : 'Bangla Tribune - The news behind the news of Bangladesh'; ?> | banglatribune.com" property="og:title">
        <meta content="বাংলা ট্রিবিউন" property="og:site_name">
        <meta content="<?php echo isset($details['description']) ? limit_words($details['excerpt'],30) : ''; ?>" property="og:description">
        <meta content="article" property="og:type">
        <meta content="https://www.facebook.com/BanglaTribuneOnline" property="article:publisher">
        <meta content="<?php echo base_url() . $this->uri->uri_string() ?>" property="og:url">
        <?php if(isset($details['content_thumbnail_image'])) { ?>
        <meta content="http:<?php echo media_image_url_formating_600x315($details['content_thumbnail_image']); ?>" property="og:image">
        <?php } ?>
        <meta content="600" property="og:image:width">
        <meta content="315" property="og:image:height">
        <meta content="436163869915872" property="fb:app_id" name="fb:app_id">
        <link href="<?php echo base_url() . $this->uri->uri_string() ?>" rel="canonical">
        <link href="http://www.banglatribune.com/feed/national" title="বাংলা ট্রিবিউন RSS" type="application/rss+xml" rel="alternate">
        <meta content="Bangla Tribune IT Team" name="generator">
        <meta content="shahriarromy, zulruss" property="fb:admins">
        <meta content="dvKFk2OCedvvcgz_DzAZes7nIXI" name="alexaVerifyID">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/media.css">
<!--        <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/fonts/shonar_bangla2.css">-->
        <link type="text/css" rel="stylesheet" media="all" href="http://www.banglatribune.com/contents/themes/public/style/fonts/shonar_bangla2.css?v=1.30">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>images/favicon.ico" rel="shortcut icon">
        <link href="<?php echo base_url(); ?>images/favicon.ico" type="image/ico" rel="icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js"></script>
<!--        <script type="text/javascript">
            $(document).ready(function () {
                $('#tabbedLinks .nav-tabs a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        </script>-->
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <?php
        if (isset($active)) {
            if ($active == 'home') {
                ?>
                <script type="text/javascript">
        //                    setInterval(function(){
        //                        location.reload()
        //                    }, 300000);
        //                    setTimeout(function () {
        //                        location = ''
        //                    }, 60000)
                </script>   
            <?php
            }
        }
        ?>
    </head>
    <body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"i1wLl1aU8KL34B", domain:"banglatribune.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=i1wLl1aU8KL34B" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
        <div class="wrapper">
            <header id="header">
                <div class="head-top">
                    <div class="head-social clearfix">
                        <ul class="social-icons">
                            <li class="facebook"><a href="https://www.facebook.com/BanglaTribuneOnline/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="https://twitter.com/banglatribune" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="youtube"><a href="https://www.youtube.com/channel/UCPbpOnmqK8O_FC4ejdzDTHQ" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            <li class="linkedin"><a href="https://www.linkedin.com/company/bangla-tribune" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li class="feed"><a href="http://www.banglatribune.com/feed/" target="_blank"><i class="fa fa-feed"></i></a></li>
                            <li class="desktop"><a href="#"><i class="fa fa-desktop"></i></a></li>
                            <li class="dt"><a href="http://www.dhakatribune.com/" target="_blank"><img src="http://cdn.banglatribune.com/contents/themes/public/style/images/social-dt-icon.png" alt="Dhaka Tribune"></a></li>
                        </ul>
                    </div>
                    <div class="head-auth">
                        <ul class="auth-links">
                            <?php
                            $auth_check_link = 'http://www.banglatribune.com/api/authentication_helper/login_check?APP_ID=1';
                            global $response;
                            session_start();
                            if ($_SESSION['_api_user_cache']['expire'] > time() && false) {
                                $response = $_SESSION['_api_user_cache']['response'];
                            } else {
                                //api call to get user data and check authentication
                                $response = curl_api_call(
                                        array(
                                            'url' => $auth_check_link,
                                            'post_data' => array(
                                                'APP_ID' => 1,
                                                'APP_KEY' => '2theWorldwar'
                                            )
                                        )
                                );
                                if (isset($response['user'])) {
                                    $_SESSION['_api_user_cache']['expire'] = time() + 120;
                                    $_SESSION['_api_user_cache']['response'] = $response;
                                }
                            }

                            if (!isset($response['error'])) {
                                if (isset($_GET['_jw_connect_state'])) {
                                    session_destroy();
                                    //the request is now connect state; lets load the js to make the session
                                    ?>
                                    <script type="application/javascript" src="<?php echo $response['cross_session_js_link'] ?>'"></script>
                                    <?php
                                }
                                if (isset($response['user'])) {
                                    ?>
                                    <li class="profile_link"><a href="javascript:"><img src="<?php echo $response['user']['profile_image'] ?>" height="20" width="20"><span><?php echo $response['user']['user_name'] ?></span></a></li>
                                    <li class="logout_link"><a href="<?php echo $response['logout_link'] . urlencode(base_url() . $this->uri->uri_string()) ?>">লগ আউট</a></li>
                                    <script type="text/javascript">var __is_jadewits_user_logged_in = 1;</script>
                                    <?php
                                }
                            }
                            if (!isset($response['user'])) {
                                ?>
                                <li class="login-link"><a href="<?php echo $response['login_link'] . urlencode(base_url() . $this->uri->uri_string()); ?>">লগইন</a></li>
                                <li class="register-link"><a href="<?php echo $response['register_link'] . urlencode(base_url() . $this->uri->uri_string()); ?>">রেজিস্টার</a></li>
                                <?php
                            }

//                            echo '<pre>';
//                            print_r($response);
//                            print_r($_COOKIE);
//                            echo '</pre>';
                            ?>
                        </ul>
                    </div>
                    <div class="bt-banner">
                        <img height="28" alt="behind the news" src="//cdn.banglatribune.com/contents/themes/public/style/images/behind-the-news.gif">
                    </div>
                </div>
                <div class="header-middle">
                    <div class="header-logo">
                        <a href="<?php echo base_url(); ?>"><img height="40" alt="বাংলা ট্রিবিউন" src="//cdn.banglatribune.com/contents/themes/public/style/images/logo_bati.png"></a>
                    </div>
                    <div class="date-after">
                        <i class="fa fa-clock-o"></i>&nbsp;<!--a href="/archive" title="Updated" class="time">২ মিনিট আগে</a-->
                        <span><?php echo cutom_date_time_header(); ?></span>
                    </div>
                </div>
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
<?php endif; ?>
                <!--div class="hot_news">
                    <div class="ticker_holder">
                        <div class="ticker_heading">শিরোনাম</div>
                        <div class="ticker_slider">
                            <div class="marquee">
                                <ul>
                                    <li class="each_slide"><a href="#" class="ticker_slide_inner">দিনাজপুরে ইস্কন মন্দিরে বোমা হামলা ও গুলি: আহত ২, আটক ১</a></li>
                                    <li class="each_slide"><a href="#" class="ticker_slide_inner">মিনায় নিহতের সংখ্যা সৌদি ঘোষিত সংখ্যার তিনগুণ</a></li>
                                    <li class="each_slide"><a href="#" class="ticker_slide_inner">পাকিস্তানে শরিয়াহ আইন চেয়ে সুপ্রিম কোর্টে লাল মসজিদের ইমাম</a></li>
                                    <li class="each_slide"><a href="#" class="ticker_slide_inner">৫ বছরের মধ্যে বিলুপ্ত হবে স্মার্টফোন!</a></li>
                                    <li class="each_slide"><a href="#" class="ticker_slide_inner">হাইড্রোজেন বোমা আছে উত্তর কোরিয়ার: দাবি কিম জংয়ের</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div-->
                <!--div class="toc_searchbox">
                    <div class="talkofcountry">
                        <h3><a href="<?php //echo base_url();         ?>talk-of-the-country">টক অব দ্য কান্ট্রি</a></h3>
                        <div class="toc-container">
                <?php
//                            $i = 0;
//                            foreach ($toc['data'] as $value) {
//                                
                ?>
                                <a href="//<?php //echo isset($value['excerpt']) ? url_format_fnc($value['excerpt']) : 'javascript:';       ?>"><?php //echo $value['title'];       ?></a>
                                //<?php
//                                if ($i == 0)
//                                    break;
//                            }
                ?>
                        </div>
                    </div>
                    <div class="searchbox">
                        <div class="jadewits_fresh_search_form">
                            <form action="<?php //echo base_url();            ?>search" id="jadewits_search_form_1223">
                                <button type="submit" class="search_button"><span>সার্চ</span></button>
                                <div class="search_input_holder">
                                    <input type="text" id="banglaEnabled0" name="q" class="search_input jadewits_keyboard q bangla-enabled" index="0" placeholder="সার্চ">
                                </div>
                            </form>
                            <script type="text/javascript">
//                                $('#jadewits_search_form_1223').submit(function () {
//                                    var search_text = $.trim($('[name=q]', this).val());
//                                    if (search_text == 'কী খুঁজতে চান?' || !search_text) {
//                                        alert('Please type something to search');
//                                        return false;
//                                    }
//                                    return true;
//                                });
                            </script>
                        </div>
                    </div>
                </div-->
                <nav class="navbar navbar-default bt_nav">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="manu_border_container">
                            <div class="navbar-header">
                                <a href="javascript:void(0)" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">মেনু</a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
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
                                    ?>"><a href="<?php echo base_url(); ?>tech-and-gadget">টেক অ্যান্ড গ্যাজেটস</a></li>
                                    <li class="<?php
                                    if ($active == 'literature') {
                                        echo 'active';
                                    }
                                    ?>"><a href="<?php echo base_url(); ?>literature">সাহিত্য</a></li>
                                    <li class="<?php
                                    if ($active == 'others') {
                                        echo 'active';
                                    }
                                    ?>"><a href="<?php echo base_url(); ?>others">অন্যান্য</a></li>
                                </ul>
                            </div>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>       