<?php
if (isset($error)) {
if (is_array($error)) {
echo '<p style="display:none;">';
    print_r($error);
    //print_r($national_election);
echo '</p>';
} else {
echo '<p style="display:none;">' . $error . '</p>';
}
//    echo '<p>' . $error . '</p>';
}
//echo "------------------- live----------------<pre>";
    /*$i=0;
    foreach ($live_details['data'] as $key => $value) {
        $i++;
        echo $i.' '.$value['title'].'<br>'.$value['content_type'].'<br>';
    }*/
    //print_r($election_details_all);
//echo "</pre>------------------- end----------------";
$cache_ext = '.html'; //file extension
$cache_time = 10;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder = "cache/";
if (ENVIRONMENT == 'production') {
    $cache_folder = "/var/www/btdocs/mobdocs/cache_dir/";
    $cache_time = 60;
}
//$cache_folder = "/var/www/btdocs/mobdocs/cache_dir/"; //folder to store Cache files
//$cache_folder = "cache/"; //folder to store Cache files
$ignore_pages = array('', '');
$dynamic_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; // requested dynamic page (full url)
$cache_file = $cache_folder . md5($dynamic_url) . $cache_ext; // construct a cache file
$ignore = (in_array($dynamic_url, $ignore_pages)) ? true : false; //check if url is in ignore list
if (!$ignore && file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) { //check Cache exist and it's not expired.
ob_start(); //Turn on output buffering, "ob_gzhandler" for the compressed page with gzip.
readfile($cache_file); //read Cache file
echo '<!-- cached page - ' . date('l jS \of F Y h:i:s A', filemtime($cache_file)) . ', Page : ' . $dynamic_url . ' -->';
ob_end_flush(); //Flush and turn off output buffering
exit(); //no need to proceed further, exit the flow.
}
//Turn on output buffering with gzip compression.
ob_start();
######## Your Website Content Starts Below #########
include 'includes/header.php';
if (is_array($features['data'])) {
//$cover_story = array_slice($features['data'], 0, 1);
//$editors = array_slice($features['data'], 1, 4);
//$editors = array_slice($features['data'], 1, 4);
$top_stories = array_slice($features['data'], 0, 13);
$editors_picks = array_slice($features['data'], 13, 4);
}
// echo '<pre>';
    // print_r($live_home);
// echo '</pre>';
// exit();
?>

<div class="home_temp">
<!-- election score -->
<div class="election_score">
<style>
    .wrap {
max-width: 300px;
width: 100%;
}
.first_info {
width: 100%;
/*max-width: 300px;*/
}
.header_elections img {
    max-width: 100%;
}
.seat_right,
.seat_left {
float:left;
width: 50%;
height: 30px;
line-height: 30px;
}
.prospond_seat,
.total_vote {
width: 100%;
background-color: #b7b7b7;
padding-top: 5px;
}
.total_vote {
height: 30px;
line-height: 30px;
margin-bottom: 5px;
}
.second_info {
width: 100%;
border-top: 1px solid #000;
}
.second_info .left_col,
.second_info .right_col {
height: 40px;
/* line-height: 40px; */
padding-top: 5px;
float:left;
width: 50%;
box-sizing: border-box;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
}
.second_info .right_col.header_s,
.second_info .left_col {
background-color: #fff;
color: #000;
}
.second_info .right_col {
background-color: #fff;
color: #000;
border-left: 1px solid #000;
}
.second_info img {
height: 25px;

}
.e_row {
    width: 100%;
    border-bottom: 1px solid #000;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
.second_info .e_row .left_col,
.second_info .e_row .right_col {
    padding-left: 10px;
}
.e_row .right_col .final_seat,
.e_row .right_col .ahead {
    height: 30px;
    line-height: 30px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
.e_row .right_col .ahead {
    border-top: 1px solid #fff;
}
/*live csss*/
.election_live {
    padding: 3px;
    background-color: #f2f2f2;
    border:3px solid #ec1a2e;
    border-radius: 10px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    }
.has_live .imgContainer::after {
    content: ' ';
    background: url(http://cdn.banglatribune.com/contents/themes/public/style/images/live_blink.gif) no-repeat left center;
    position: absolute;
    line-height: 20px;
    width: 60px;
    height: 20px;
    top: 0;
    right: 0;
    z-index: 1;
    /* padding: 0 5px; */
}
.live_list .title_time_author_holder .title_holder a:before {
    content: "\e810";
    font-family: fontello;
    float: left;
    margin-right: 5px;
    margin-top: 10px;
    background-color: #ec1a2e;
    border-radius: 50%;
    color: #fff !important;
    width: 16px;
    font-size: 11px;
    text-align: center;
    height: 16px;
    line-height: 16px;
}
</style>
<div class="wrap">
    <div class="aligncenter header_elections"><img src="http://cdn.banglatribune.com/contents/uploads/media/2019/03/10/553af57f3a9674fb66417d361abb0abd-5c84c6ca8d0b4.jpg"></div>
    <div class="second_info">
<div class="e_row clearfix" style="text-align:center;font-weight: bold;">চেয়ারম্যান পদের ফল</div>
        <div class="e_row clearfix" style="text-align:center;">উপজেলা - ৮৭টি, স্থগিত - ৯টি</div>
        <div class="e_row clearfix">
            <div class="left_col">আ.লীগ</div>
            <div class="right_col awami_league">০</div>
        </div>
        <div class="e_row clearfix">
            <div class="left_col">জাপা</div>
            <div class="right_col jatiyo_party">০</div>
        </div>
        <div class="e_row clearfix">
            <div class="left_col">অন্যান্য</div>
            <div class="right_col others">০</div>
        </div>
    </div>
</div>
</div>
<script src="http://service.banglatribune.com/vote_count"></script>
<div class="sec_left article LeftalignedImg shadowBox TopStoriesPage">
    <div class="red_gradient">
        <h4 class="headbar"><a href="<?php echo base_url(); ?>topic/387">টপ স্টোরিজ</a></h4>
    </div>
    <div class="inner clearfix">
        <ul class="clearfix">
            <?php
            $i = 1;
            foreach ($top_stories as $value) {
            ?>
            <li>
                <?php if ($i == 1) { ?>
                <div class="imgContainer">
                    <a href="<?php echo url_format_fnc($value['web_url']); ?>"><img src="<?php echo media_image_url_formating_304_171($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>" ></a>
                </div>
                <?php } else { ?>
                <div class="imgContainer">
                    <a href="<?php echo url_format_fnc($value['web_url']); ?>"><img src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>" ></a>
                </div>
                <?php } ?>
                <div class="text_container">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']); ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                    <div class="author_time_holder"><div class="author_holder"><span class="author"><?php echo $value['author_display_name']; ?></span></div></div>
                    <div class="summery">
                        <a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo limit_words($value['excerpt'], 15); ?><span class="excerpt_more" title="বিস্তারিত"><span>বিস্তারিত</span></span></a>
                    </div>
                </div>
            </li>
            <?php
            $i++;
            if ($i == 11) {
            break;
            }
            }
            ?>
        </ul>
        <div class="footbar"><a href="<?php echo base_url(); ?>topic/387" class="more_link">আরও</a></div>
    </div>
</div>
<!--top stories end-->
<div class="sec_right">
    <div class="election_live">
        <div class="article LeftalignedImg column FiveArticles">
            <div class="inner">
                <div class="clearfix">
                    <div class="item top <?php if($live_home_content['live_status'] == 'yes') echo 'has_live'; ?>">
                        <div class="imgContainer"><a href="<?php echo url_format_fnc($live_home_content['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($live_home_content['content_thumbnail_image']); ?>" alt="<?php echo $live_home_content['title']; ?>"></a></div>
                    </div>
                    <div class="right_content">
                        <h2 class="title_holder">
                        <a href="<?php echo url_format_fnc($live_home_content['web_url']) ?>">
                            <span class="subtitle"><?php echo $live_home_content['subtitle']; ?></span>
                            <span class="title"><?php echo $live_home_content['title']; ?></span>
                        </a>
                        </h2>
                    </div>
                </div>
                <?php
                $i = 1;
                foreach ($election_details_first20['data'] as $value) {
                ?>
                <div class="wrap_each">
                    <div class="each list_item live_list">
                        <div class="title_time_author_holder">
                            <h2 class="title_holder"><a href="<?php
                            if($i == 1){
                                echo url_format_fnc($live_home_content['web_url']);
                            } else {
                                echo url_format_fnc($live_home_content['web_url'].'#ilive-'.$value['content_id']);
                            }
                            ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                        </div>
                    </div>
                </div>
                <?php
                    $i++;
                    if ($i>5) {
                        break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!--div class="aligncenter"><script src="http://service.banglatribune.com/admin/get_youtube"></script></div-->
    <!--Gazi Ashraf Lipu-->
    <!-- <div class="aligncenter"><a href="<?php //echo base_url(); ?>topic/811"><img src="http://cdn.banglatribune.com/contents/uploads/media/2017/03/07/d25218d109460f0fec740630abca8ffe-58bebc79a5c45.jpg" alt="গাজী আশরাফ লিপুর কলাম"></a></div> -->
    <!--most read articles-->
    <div class="sections">
        <div class="tabbedLinks">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active" data-tab="recent_articles">সর্বশেষ</li>
                <li data-tab="most_read">সর্বাধিক পঠিত</li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="recent_articles">
                    <ul>
                        <?php
                        $i = 1;
                        foreach ($this->latest_all['data'] as $value) {
                        ?>
                        <li><a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo $value['title']; ?></a></li>
                        <?php
                        if ($i > 9) {
                        break;
                        }$i++;
                        }
                        ?>
                    </ul>
                    <div class="oh db"><a class="view_all all_view_count" href="<?php echo base_url(); ?>archive">সকল সর্বশেষ</a></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="most_read">
                    <ul>
                        <?php
                        $i = 1;
                        foreach ($this->mostread['data'] as $value) {
                        ?>
                        <li><a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo $value['title']; ?></a></li>
                        <?php
                        if ($i > 9) {
                        break;
                        }$i++;
                        }
                        ?>
                    </ul>
                    <div class="oh db"><a class="view_all all_view_count" href="<?php echo base_url(); ?>most-viewed">সকল সর্বাধিক পঠিত</a></div>
                </div>
            </div>
        </div>
    </div>
    <!--most read articles end-->
    <div class="aligncenter box_shadows">
        <div style="max-width:300px;height:250px;margin:0 auto;">
            <script>
            googletag.cmd.push(function() {
            googletag.defineSlot('/67573540/bdads_300x250_mobile', [300, 250], 'div-gpt-ad-1528015971276-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
            });
            </script>
            <!-- /67573540/bdads_300x250_mobile -->
            <div id='div-gpt-ad-1528015971276-0' style='height:250px; width:300px;'>
                <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1528015971276-0'); });
                </script>
            </div>
        </div>
    </div>
    <!--column-->
    <div class="article LeftalignedImg column radius">
        <div class="black_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>columns">কলাম</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 0;
            foreach ($column['data'] as $key => $value) {
            ?>
            <div class="left_item">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><img class="thumb" src="<?php echo media_image_url_formating_50_50($value['content_thumbnail_image_square']); ?>" alt=""></a></div>
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']); ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
                <div class="author_time_holder">
                    <div class="author_holder"><span class="author"><?php echo $value['author_display_name']; ?></span></div>
                </div>
            </div>
            <?php
            $i++;
            if ($i == 3)
            break;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>columns" class="more_link">আরও</a></div>
        </div>
    </div>
    <!--        column end-->
    <div class="aligncenter">
        <div style="max-width: 300px;height: 100px;margin: 0 auto;">
            <script>
            googletag.cmd.push(function() {
            googletag.defineSlot('/67573540/walton_300x100', [300, 100], 'div-gpt-ad-1537110473235-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
            });
            </script>
            <!-- /67573540/walton_300x100 -->
            <div id='div-gpt-ad-1537110473235-0' style='height:100px; width:300px;'>
                <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1537110473235-0'); });
                </script>
            </div>
        </div>
    </div>
    <!--dw news box-->
    <div class="aligncenter" style="">
        <a style="max-width: 300px;overflow:hidden;" href="http://www.dw.com/bn/%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F/s-11929?maca=ben-CB_ben_BanglaTribune-20061-html-cb" target="_blank">
            <img src="http://cdn.banglatribune.com/contents/uploads/media/2017/12/16/ac40ef534b2d800bb99ed40961838ae5-5a35153bb132f.jpg" alt="">
        </a>
    </div>
    <!--dw news box end-->
</div>
<div class="clear"></div>
<div class="sec_left fifty">
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>topic/269">এডিটর্স পিকস</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($editors_picks as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>topic/269" class="more_link">আরও</a></div>
        </div>
    </div>
    <div class="aligncenter box_shadows">
        <div style="width:100%;max-width:728px;margin:0 auto;">
            <script>
            googletag.cmd.push(function() {
            googletag.defineSlot('/67573540/bt_home_728x90_1', [728, 90], 'div-gpt-ad-1509972090002-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
            });
            </script>
            <!-- /67573540/bt_home_728x90_1 -->
            <div id='div-gpt-ad-1509972090002-0' style='height:90px; width:728px;'>
                <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1509972090002-0'); });
                </script>
            </div>
        </div>
    </div>
</div>
<!--editor's picks-->
<div class="sec_right fifty">
    <!--current stories news-->
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>topic/122">কারেন্ট স্টোরিজ</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($current_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>topic/122" class="more_link">আরও</a></div>
        </div>
    </div>
    <!--current stories end-->
    <!--editor's picks end-->
    <div class="aligncenter box_shadows">
        <div style="width: 300px;height: 250px; margin: 0 auto;">
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
</div>
<div class="clear"></div>
<!-- politics start -->
<div class="sec_left fifty">
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>politics">রাজনীতি</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($politics_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>politics" class="more_link">আরও</a></div>
        </div>
    </div>
</div>
<!-- politics start -->
<!--journey-->
<div class="sec_right fifty">
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>journey">জার্নি</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($journey_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>journey" class="more_link">আরও</a></div>
        </div>
    </div>
</div>
<!--journey end-->
<div class="clear"></div>
<div class="sec_left fifty">
    <!--exclusive-->
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>exclusive">এক্সক্লুসিভ</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($exclusive['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a href="<?php echo base_url(); ?>exclusive" class="more_link">আরও</a></div>
        </div>
    </div>
    <!--exclusive end-->
    <div class="mb10">
        <div class="aligncenter">
            <script>
            googletag.cmd.push(function () {
            googletag.defineSlot('/67573540/ulab_300x50_unit', [320, 50], 'div-gpt-ad-1508415386767-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
            });
            </script>
            <!-- /67573540/ulab_300x50_unit -->
            <div id='div-gpt-ad-1508415386767-0' style='height:50px; width:320px;'>
                <script>
                googletag.cmd.push(function () {
                googletag.display('div-gpt-ad-1508415386767-0');
                });
                </script>
            </div>
        </div>
    </div>
    <!-- sports -->
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>sport">স্পোর্টস</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($sports_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>sport">আরও</a></div>
        </div>
    </div>
    <!--sports end-->
</div>
<div class="sec_right fifty">
    <!--entertainment-->
    <div class="article articleBox title_image_with_left TopStoriesPage">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>entertainment">এন্টারটেইনমেন্ট</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($entertainment_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="item top">
                <div class="imgContainer">
                    <a href="<?php echo url_format_fnc($value['web_url']); ?>"><img src="<?php echo media_image_url_formating_304_171($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>" ></a>
                </div>
                <div class="author_time_holder"></div>
                <h2 class="title_holder">
                <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                    <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                    <span class="title"><?php echo $value['title']; ?></span>
                </a>
                </h2>
            </div>
            <div class="article_bottom"><a class="more" title="বিস্তারিত" href="<?php echo url_format_fnc($value['web_url']); ?>"><span>বিস্তারিত</span></a></div>
            <?php } else { ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>entertainment">আরও</a></div>
        </div>
    </div>
    <!--entertainment end-->
</div>
<div class="clear"></div>
<div class="sec_left fifty">
    <!--foreign-->
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>foreign">বিদেশ</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($foreign_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>foreign">আরও</a></div>
        </div>
    </div>
</div>
<!--foreign end-->
<!--jobs-->
<div class="sec_right fifty">
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>jobs">চাকরি</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($jobs['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>jobs">আরও</a></div>
        </div>
    </div>
</div>
<!--jobs end-->
<div class="clear"></div>
<!--Lifestyle-->
<div class="sec_left fifty article LeftalignedImg column FiveArticles">
    <div class="red_gradient">
        <h4 class="headbar"><a href="<?php echo base_url(); ?>lifestyle">লাইফস্টাইল</a></h4>
    </div>
    <div class="inner">
        <?php
        $i = 1;
        foreach ($lifestyle_home['data'] as $value) {
        if ($i == 1) {
        ?>
        <div class="left_item image_left clearfix">
            <div class="leftImg_title">
                <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
            </div>
            <div class="right_content">
                <h2 class="title_holder">
                <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                    <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                    <span class="title"><?php echo $value['title']; ?></span>
                </a>
                </h2>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div class="wrap_each">
            <div class="each list_item">
                <div class="title_time_author_holder">
                    <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                </div>
            </div>
        </div>
        <?php
        }
        $i++;
        }
        ?>
        <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>lifestyle">আরও</a></div>
    </div>
</div>
<!--Lifestyle end-->
<!--business-->
<div class="sec_right fifty">
    <div class="article LeftalignedImg column FiveArticles">
        <div class="red_gradient">
            <h4 class="headbar"><a href="<?php echo base_url(); ?>business">বিজনেস</a></h4>
        </div>
        <div class="inner">
            <?php
            $i = 1;
            foreach ($business_home['data'] as $value) {
            if ($i == 1) {
            ?>
            <div class="left_item image_left clearfix">
                <div class="leftImg_title">
                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_url_formating_160_90($value['content_thumbnail_image']); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                </div>
                <div class="right_content">
                    <h2 class="title_holder">
                    <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                        <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                        <span class="title"><?php echo $value['title']; ?></span>
                    </a>
                    </h2>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="wrap_each">
                <div class="each list_item">
                    <div class="title_time_author_holder">
                        <h2 class="title_holder"><a href="<?php echo url_format_fnc($value['web_url']); ?>"><span class="title"><?php echo $value['title']; ?></span></a></h2>
                    </div>
                </div>
            </div>
            <?php
            }
            $i++;
            }
            ?>
            <div class="footbar"><a class="more_link" href="<?php echo base_url(); ?>business">আরও</a></div>
        </div>
    </div>
</div>
<!--business end-->
<div class="clear"></div>
</div>
<?php
include 'includes/footer.php';
if (!$ignore) {
    $fp = fopen($cache_file, 'w');  //open file for writing
    file_put_contents($cache_file, ob_get_contents()); //write contents of the output buffer in Cache file
    fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering