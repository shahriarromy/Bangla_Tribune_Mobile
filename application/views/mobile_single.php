<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (isset($content['error'])) {
    echo '<p style="display:none;">' . $content['error'] . '</p>';
    exit('Problem Loading Content..Please Try again');
}
?>
<!DOCTYPE html>
<html>
    <head prefix="og:http://ogp.me/ns#">
        <meta name="google-site-verification" content="7Kt2FUTLnMrk1JcaNOViQC4Pfu0Vai4GwM6lJDF1t9k" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <title><?php echo isset($content['title']) ? $content['title'] : 'Bangla Tribune - Bangla news, Behind The News'; ?></title>
        <meta property="fb:pages" content="290094144492659" />
        <meta content="<?php echo isset($content['description']) ? limit_words_without_dot($content['excerpt'], 30) : 'Bangla Tribune is one of the most revered Bangla online newspapers in Bangladesh, due to its reputation of neutral coverage and incisive analysis. A young group of reporters are winning Bangla news readers daily with cutting news, and the news behind the news.'; ?>" name="description">
        <meta content="<?php echo isset($content['title']) ? $content['title'] : 'Bangla Tribune - Bangla news, Behind The News'; ?> | banglatribune.com" property="og:title">
        <meta content="বাংলা ট্রিবিউন" property="og:site_name">
        <meta content="<?php echo isset($content['description']) ? limit_words_without_dot($content['excerpt'], 30) : 'Bangla Tribune is one of the most revered Bangla online newspapers in Bangladesh, due to its reputation of neutral coverage and incisive analysis. A young group of reporters are winning Bangla news readers daily with cutting news, and the news behind the news.'; ?>" property="og:description">
        <meta content="article" property="og:type">
        <meta content="https://www.facebook.com/BanglaTribuneOnline" property="article:publisher">
        <meta content="<?php echo isset($content['web_url']) ? $content['web_url'] : '' ?>" property="og:url">
        <?php if (isset($content['content_thumbnail_image'])) { ?>
            <meta content="http:<?php echo media_image_url_formating_600x315($content['content_thumbnail_image']); ?>" property="og:image">
        <?php } ?>
        <meta content="600" property="og:image:width">
        <meta content="315" property="og:image:height">
        <meta content="579576052208440" property="fb:app_id" name="fb:app_id">
        <link href="<?php echo isset($content['web_url']) ? $content['web_url'] : '' ?>" rel="canonical">
        <link href="<?php echo isset($content['web_url']) ? $content['web_url'] . '?desktop=1' : '' ?>" title="বাংলা ট্রিবিউন RSS" type="application/rss+xml" rel="alternate">
        <meta content="Bangla Tribune IT Team" name="generator">
        <meta content="shahriarromy, zulruss" property="fb:admins">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mobile.css">
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>assets/css/fontello-embedded.css">
        <link href="<?php echo base_url(); ?>images/favicon.ico" rel="shortcut icon">
        <link href="<?php echo base_url(); ?>images/favicon.ico" type="image/ico" rel="icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
        ga('create', 'UA-71788435-6', 'auto', 'trackerD');
        ga('send', 'pageview');
        ga('trackerB.send', 'pageview');
        ga('trackerC.send', 'pageview');
        ga('trackerD.send', 'pageview');
    </script>
    <div class="wrapper">
        <div class="aligncenter box_shadows">
            <div style="max-width:320px;height:100px;margin:0 auto;">
                <script>
                    googletag.cmd.push(function () {
                        googletag.defineSlot('/67573540/BT_mobile_ia_320x100', [320, 100], 'div-gpt-ad-1512985158488-0').addService(googletag.pubads());
                        googletag.pubads().enableSingleRequest();
                        googletag.pubads().collapseEmptyDivs();
                        googletag.enableServices();
                    });
                </script>
                <!--                /67573540/BT_mobile_ia_320x100 -->
                <div id='div-gpt-ad-1512985158488-0' style='height:100px; width:320px;'>
                    <script>
                        googletag.cmd.push(function () {
                            googletag.display('div-gpt-ad-1512985158488-0');
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="title_time_author_holder bb1cc mb10">
            <h2 class="title_holder">
                <span class="subtitle"><?php echo $content['subtitle']; ?></span>
                <span class="title"><?php echo $content['title']; ?></span>
            </h2>
            <div class="time_info clearfix">
                <span class="author_holder"><span class="author"><?php echo $content['author_display_name']; ?></span></span>
                <span data-published="<?php echo date('Y-m-d\TH:i:sP', strtotime($content['published_time'])); ?>" data-modified="<?php echo date('Y-m-d\TH:i:sP', strtotime($content['modified_time'])); ?>" class="time"><?php echo cutom_date_time($content['published_time']); ?></span>
            </div>
        </div>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <div id="content" class="summery mb10 pb10 clearfix" itemtype="http://schema.org/Article" itemscope="">
            <?php echo $content['description']; ?>
            <div style="font-size: 11px;"><?php echo $content['initials']; ?></div>
        </div>
        <script>
                        $('<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-2935961069639123" data-ad-slot="6201410109"></ins>').insertAfter($("#content img:first").parent());
        </script>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        <div class="aligncenter box_shadows">
            <div style="max-width:300px;height:250px;margin:0 auto;">
                <script>
                    googletag.cmd.push(function () {
                        googletag.defineSlot('/67573540/bt_m_adsense_300x250', [300, 250], 'div-gpt-ad-1509374709182-0').addService(googletag.pubads());
                        googletag.pubads().enableSingleRequest();
                        googletag.pubads().collapseEmptyDivs();
                        googletag.enableServices();
                    });
                </script>
                <!-- /67573540/bt_m_adsense_300x250 -->
                <div id='div-gpt-ad-1509374709182-0' style='height:250px; width:300px;'>
                    <script>
                        googletag.cmd.push(function () {
                            googletag.display('div-gpt-ad-1509374709182-0');
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="first_row clearfix">
                <div class="footer_item"><img src="//cdn.banglatribune.com/contents/themes/public/style/images/footer-logo.png" alt="বাংলা ট্রিবিউন" height="43"></div>
                <div class="footer_item"><span class="editor"><strong>সম্পাদক: জুলফিকার রাসেল</strong></span></div>
                <div class="footer_item"><span class="publish"><strong>প্রকাশক: কাজী আনিস আহমেদ</strong></span></div>
            </div>
            <div class="third_row">
                <span>এফ আর টাওয়ার, ৮/সি পান্থপথ, শুক্রাবাদ, ঢাকা-১২০৭ | ফোন: ৯১৩৩২০৭, ৯১৩৩২০৮, ফ্যাক্স: ৯১৩৩২৭৪ | মোবাইল: ০১৭৩০৭৯৪৫২৭, ০১৭৩০৭৯৪৫২৮</span>
            </div>
        </div>
    </div>
    <?php
//    echo '<pre>';
//    print_r($content);
//    echo '</pre>';
    ?>
    <script type="text/javascript">
        var all_image = $("#content").find("img");
        $(all_image).each(function (i, v) {
            if ($(v).attr('width') >= 800) {
                var myStr = $(v).attr('src').split("/");
                myStr[6] = '800x0x1';
                var tem = myStr.join('/');
                $(v).attr('src', tem);
                $(v).attr('width', '800');
            } else {
                var myStr = $(v).attr('src').split("/");
                var myimagewidth = myStr[6].split('x');
                $(v).attr('width', myimagewidth[0]);
            }
            if ($(v).attr('title') != null) {
                $(v).after('<span class="media_caption">' + $(v).attr('title') + '</span>');
                $(this).next('span').andSelf().wrapAll('<div id="media_' + i + '" style="width:' + $(this).attr('width') + 'px" class="mediaContent ' + $(this).attr('class') + '"></div>');
            } else {
                $(this).wrapAll('<div id="media_' + i + '" style="width:' + $(this).attr('width') + '" class="mediaContent ' + $(this).attr('class') + '"></div>');
            }
        });
    </script>
</body>
</html>