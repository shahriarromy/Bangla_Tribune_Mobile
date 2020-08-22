<?php
$url_share = urlencode(url_format_fnc($details_live_intro['web_url']));
$url_web = urlencode($details_live_intro['web_url']);
$title_share = urlencode($details_live_intro['title']);
/*foreach ($$details_live_list_first20['data'] as $value) {
    curl_api_call($args);
}*/
$live_list_data = array_merge($details_live_list_first20['data'],$details_live_list_second20['data']);
//$share_final = $title_share.'%20%20'.$url_share;
if (isset($error)) {
    echo '<p>' . $error . '</p>';
}
$cache_ext = '.html'; //file extension
$cache_time = 10;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder = "cache/";
if (ENVIRONMENT == 'production') {
    $cache_folder = "/var/www/btdocs/mobdocs/cache_dir/";
    $cache_time = 120;
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
include 'includes/header.php';
//echo '<pre>';
//print_r($comment);
//echo '</pre>';
?>
<div class="breadcrumb clearfix">
    <ul>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="<?php echo base_url(); ?>"><strong itemprop="title">হোম</strong></a></li>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="<?php echo base_url() . $pagination; ?>"><strong itemprop="title"><?php
                    switch ($pagination) {
                        case 'national':
                            $pagination_name = 'জাতীয়';
                            break;
                        case 'country':
                            $pagination_name = 'দেশ';
                            break;
                        case 'politics':
                            $pagination_name = 'রাজনীতি';
                            break;
                        case 'exclusive':
                            $pagination_name = 'এক্সক্লুসিভ';
                            break;
                        case 'foreign':
                            $pagination_name = 'বিদেশ';
                            break;
                        case 'columns':
                            $pagination_name = 'কলাম';
                            break;
                        case 'business':
                            $pagination_name = 'বিজনেস';
                            break;
                        case 'entertainment':
                            $pagination_name = 'বিনোদন';
                            break;
                        case 'lifestyle':
                            $pagination_name = 'লাইফ';
                            break;
                        case 'sport':
                            $pagination_name = 'খেলা';
                            break;
                        case 'literature':
                            $pagination_name = 'সাহিত্য';
                            break;
                        case 'others':
                            $pagination_name = 'অন্যান্য';
                            break;
                        case 'search':
                            $pagination_name = 'সার্চ';
                            break;
                        case 'main-news':
                            $pagination_name = 'প্রধান খবর';
                            break;
                        case 'tech-and-gadget':
                            $pagination_name = 'টেক অ্যান্ড গ্যাজেটস';
                            break;
                        case 'leads-of-the-world':
                            $pagination_name = 'লিড্‌স অব দ্য ওয়ার্ল্ড';
                            break;
                        case 'my-campus':
                            $pagination_name = 'আমার ক্যাম্পাস';
                            break;
                        case 'youth':
                            $pagination_name = 'তারুণ্য';
                            break;
                        case 'jobs':
                            $pagination_name = 'চাকরি';
                            break;
                        case 'lives':
                            $pagination_name = 'লাইভ';
                            break;
                        default:
                            $pagination_name = 'নিউজ';
                            break;
                    }
                    echo $pagination_name;
                    ?></strong></a></li>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="javascript:"><strong itemprop="title">লাইভ</strong></a></li>
    </ul>
</div>
<div class="aligncenter box_shadows">
    <?php if ($pagination == 'entertainment') { ?>
    <div style="max-width:728px;max-height:90px;margin:0 auto;">
        <script>
        googletag.cmd.push(function() {
                var mapping = googletag.sizeMapping().
                        addSize([1366, 0], [728, 90]).
                        addSize([500, 0], [468, 60]).
                        addSize([0, 0], [320, 50]).build();
                googletag.defineSlot('/67573540/bt_biman_responsive', [[320, 50], [468, 60], [728, 90]],
                'div-gpt-ad-1525606083609-0').defineSizeMapping(mapping).addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
        });
        </script>
        <!-- /67573540/bt_biman_responsive -->
        <div id='div-gpt-ad-1525606083609-0'>
            <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1525606083609-0'); });
            </script>
        </div>
    </div>
    <?php } else { ?>
    <div style="max-width:728px;max-height:90px;margin:0 auto;">
        <script>
            googletag.cmd.push(function () {
                var mapping = googletag.sizeMapping().
                        addSize([1000, 0], [728, 90]).
                        addSize([500, 0], [468, 60]).
                        addSize([0, 0], [320, 50]).build();
                googletag.defineSlot('/67573540/content_top_responsive_ad_unit', [[468, 60], [320, 50], [728, 90]],
                        'div-gpt-ad-1512656967416-0').defineSizeMapping(mapping).addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.pubads().collapseEmptyDivs();
                googletag.enableServices();
            });
        </script>
        <!-- /67573540/content_top_responsive_ad_unit -->
        <div id='div-gpt-ad-1512656967416-0'>
            <script>
                googletag.cmd.push(function () {
                    googletag.display('div-gpt-ad-1512656967416-0');
                });
            </script>
        </div>
    </div>
    <?php } ?>
</div>
<div class="details_page content_page">
    <div class="sec_left">
        <div class="title_time_author_holder bb1cc mb10">
            <h2 class="title_holder">
                <span class="subtitle"><?php echo $details_live_intro['subtitle']; ?></span>
                <span class="title"><?php echo $details_live_intro['title']; ?></span>
            </h2>
            <div class="time_info clearfix">
                <span class="author_holder"><span class="author"><?php echo $details_live_intro['author_display_name']; ?></span></span>
                <span data-published="<?php echo date('Y-m-d\TH:i:sP', strtotime($details_live_intro['published_time'])); ?>" data-modified="<?php echo date('Y-m-d\TH:i:sP', strtotime($details_live_intro['modified_time'])); ?>" class="time"><?php echo cutom_date_time($details_live_intro['published_time']); ?></span>
                <div class="social_shares_jw">
                    <div class="fb-save" data-href="<?php echo $details_live_intro['web_url']; ?>">Save to Facebook</div>
                    <a title="Facebook" target="_blank" href="https://www.facebook.com/dialog/share?app_id=436163869915872&amp;href=<?php echo $url_web ?>&amp;redirect_uri=<?php echo $url_share ?>" class="ss_facebook ss_item"><span class="ss_title">Share on Facebook</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M17.9 14h-3v8H12v-8h-2v-2.9h2V8.7C12 6.8 13.1 5 16 5c1.2 0 2 .1 2 .1v3h-1.8c-1 0-1.2.5-1.2 1.3v1.8h3l-.1 2.8z"/></svg></span><span id="facebook_count" class="ss_count"></span></a>
                    <a title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title_share; ?>&amp;url=<?php echo $url_share ?>" class="ss_twitter ss_item"><span class="ss_title">Share on Twitter</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M21.3 10.5v.5c0 4.7-3.5 10.1-9.9 10.1-2 0-3.8-.6-5.3-1.6.3 0 .6.1.8.1 1.6 0 3.1-.6 4.3-1.5-1.5 0-2.8-1-3.3-2.4.2 0 .4.1.7.1l.9-.1c-1.6-.3-2.8-1.8-2.8-3.5.5.3 1 .4 1.6.4-.9-.6-1.6-1.7-1.6-2.9 0-.6.2-1.3.5-1.8 1.7 2.1 4.3 3.6 7.2 3.7-.1-.3-.1-.5-.1-.8 0-2 1.6-3.5 3.5-3.5 1 0 1.9.4 2.5 1.1.8-.1 1.5-.4 2.2-.8-.3.8-.8 1.5-1.5 1.9.7-.1 1.4-.3 2-.5-.4.4-1 1-1.7 1.5z"/></svg></span><span class="ss_count"></span></a>
                    <a title="Email" target="_blank" href="mailto:?subject=<?php echo $title_share; ?>&amp;body=<?php echo $url_share ?>" class="ss_mail ss_item"><span class="ss_title">Share via Email</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M20.2 11.7l-.4-.4-5.7 2.7-5.7-2.7-.3.4 6 4.9 6.1-4.9zM21.4 7H6.5L5 9.5v9.3L6.6 20h14.9l1.5-1.2V9.5L21.4 7zm-.5 10.8H7.1V9.2h13.8v8.6z"/></svg></span></a>
                    <a title="WhatsApp" target="_blank" href="whatsapp://send?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_whatsapp ss_item"><span class="ss_title">Share on WhatsApp</span><span class="ss_icon"><svg viewBox="0 0 30 30" height="32" width="32"><path d="M22.09 7.87c-1.88-1.88-4.38-2.92-7.05-2.92-5.49 0-9.96 4.47-9.96 9.96 0 1.75.46 3.47 1.33 4.98L5 25.04l5.28-1.38c1.45.79 3.09 1.21 4.76 1.21 5.49 0 9.96-4.47 9.96-9.96 0-2.65-1.03-5.15-2.91-7.04m-7.05 15.32c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.13.82.84-3.05-.2-.31C7.2 18 6.76 16.47 6.77 14.91c0-4.56 3.71-8.27 8.28-8.27 2.21 0 4.29.86 5.85 2.43 1.56 1.56 2.42 3.64 2.42 5.85 0 4.56-3.72 8.27-8.28 8.27m4.54-6.2c-.25-.12-1.47-.73-1.7-.81s-.39-.12-.56.12c-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01-.17 0-.44.06-.66.31-.22.25-.87.85-.87 2.08 0 1.22.89 2.41 1.02 2.57.12.17 1.75 2.68 4.25 3.76.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18s.21-1.08.14-1.18c-.06-.08-.23-.14-.48-.27"/></svg></span></a>
                    <a title="Viber" target="_blank" href="viber://forward?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_viber ss_item"><span class="ss_title">Share on Viber</span><span class="ss_icon"><svg viewBox="0 0 950.000000 950.000000" height="32" width="32"><g stroke="none" fill="#transparent" transform="translate(0.000000,950.000000) scale(0.100000,-0.100000)"><path d="M1485 9418 c-181 -20 -385 -85 -564 -178 -421 -222 -734 -654 -817 -1130 -18 -101 -19 -237 -19 -3380 l0 -3275 23 -102 c144 -651 604 -1111 1255 -1255 l102 -23 3290 0 3290 0 102 23 c651 144 1111 604 1255 1255 l23 102 0 3275 c0 3143 -1 3279 -19 3380 -25 146 -75 293 -151 445 -237 477 -713 807 -1247 865 -122 13 -6405 12 -6523 -2z m3573 -1663 c344 -43 622 -126 927 -275 300 -147 492 -286 746 -539 238 -239 370 -420 510 -701 195 -392 306 -858 325 -1371 7 -175 2 -214 -38 -264 -76 -97 -243 -81 -300 28 -18 36 -23 67 -29 207 -10 215 -25 354 -55 520 -118 651 -430 1171 -928 1544 -415 312 -844 464 -1406 497 -190 11 -223 18 -266 51 -80 63 -84 211 -7 280 47 43 80 49 243 44 85 -3 210 -13 278 -21z m-2286 -108 c35 -12 89 -40 120 -60 190 -126 719 -803 892 -1141 99 -193 132 -336 101 -442 -32 -114 -85 -174 -322 -365 -95 -77 -184 -156 -198 -177 -36 -52 -65 -154 -65 -226 1 -167 109 -470 251 -703 110 -181 307 -413 502 -591 229 -210 431 -353 659 -466 293 -146 472 -183 603 -122 33 15 68 35 79 44 10 9 87 103 171 207 162 204 199 237 310 275 141 48 285 35 430 -39 110 -57 350 -206 505 -314 204 -143 640 -499 699 -570 104 -128 122 -292 52 -473 -74 -191 -362 -549 -563 -702 -182 -138 -311 -191 -481 -199 -140 -7 -198 5 -377 79 -1404 579 -2525 1443 -3415 2630 -465 620 -819 1263 -1061 1930 -141 389 -148 558 -32 757 50 84 263 292 418 408 258 192 377 263 472 283 65 14 178 3 250 -23z m2355 -617 c607 -89 1077 -371 1385 -829 173 -258 281 -561 318 -886 13 -119 13 -336 -1 -372 -13 -34 -55 -80 -91 -99 -39 -20 -122 -18 -168 6 -77 39 -100 101 -100 269 0 259 -67 532 -183 744 -132 242 -324 442 -558 581 -201 120 -498 209 -769 231 -98 8 -152 28 -189 71 -57 65 -63 153 -15 226 52 81 132 94 371 58z m213 -755 c197 -42 348 -117 477 -238 166 -157 257 -347 297 -620 27 -178 16 -248 -47 -306 -59 -54 -168 -56 -234 -5 -48 36 -63 74 -74 177 -13 137 -37 233 -78 322 -88 189 -243 287 -505 319 -123 15 -160 29 -200 76 -73 87 -45 228 56 280 38 19 54 21 138 16 52 -3 129 -12 170 -21z"/></g></svg></span></a>
                </div>
            </div>
        </div>
        <div id="content" class="summery mb10 pb10 clearfix" itemtype="http://schema.org/Article" itemscope="">
            <?php if($details_live_intro['live_status'] == 'yes') { ?>
                <img src="http://cdn.banglatribune.com/contents/themes/public/style/images/live_blink.gif" align="right" alt="">
            <?php } ?>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <?php echo $details_live_intro['description']; ?>
            <div class="all_live">
                <?php $i=1; //print_r($live_list_data); ?>
                <?php foreach ($election_details_all as $key => $value){
                    //echo $i.' '.$value['title'].'<br>';
                    ?>
                    <div id="ilive-<?php echo $value['content_id']; ?>">
                        <hr>    
                        <h2 class="title_holder">
                            <?php if ($value['content_type'] == 'news'){ ?>
                            <a href="<?php echo $value['web_url']; ?>">
                                <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                                <span class="title"><?php echo $value['title']; ?></span>
                            </a>
                            <?php } else { ?>
                                <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                                <span class="title"><?php echo $value['title']; ?></span>
                            <?php } ?>                            
                        </h2>
                        <div class="time_info clearfix">
                            <span class="author_holder"><span class="author"><?php echo $value['author_display_name']; ?></span></span>
                            <span data-published="<?php echo date('Y-m-d\TH:i:sP', strtotime($value['published_time'])); ?>" data-modified="<?php echo date('Y-m-d\TH:i:sP', strtotime($value['modified_time'])); ?>" class="time"><?php echo cutom_date_time($value['published_time']); ?></span>
                            <div class="social_shares_jw">
                                <a title="Facebook" target="_blank" href="https://www.facebook.com/dialog/share?app_id=436163869915872&amp;href=<?php echo $url_web ?>&amp;redirect_uri=<?php echo $url_share ?>" class="ss_facebook ss_item"><span class="ss_title">Share on Facebook</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M17.9 14h-3v8H12v-8h-2v-2.9h2V8.7C12 6.8 13.1 5 16 5c1.2 0 2 .1 2 .1v3h-1.8c-1 0-1.2.5-1.2 1.3v1.8h3l-.1 2.8z"/></svg></span><span id="facebook_count" class="ss_count"></span></a>
                                <a title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title_share; ?>&amp;url=<?php echo $url_share ?>" class="ss_twitter ss_item"><span class="ss_title">Share on Twitter</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M21.3 10.5v.5c0 4.7-3.5 10.1-9.9 10.1-2 0-3.8-.6-5.3-1.6.3 0 .6.1.8.1 1.6 0 3.1-.6 4.3-1.5-1.5 0-2.8-1-3.3-2.4.2 0 .4.1.7.1l.9-.1c-1.6-.3-2.8-1.8-2.8-3.5.5.3 1 .4 1.6.4-.9-.6-1.6-1.7-1.6-2.9 0-.6.2-1.3.5-1.8 1.7 2.1 4.3 3.6 7.2 3.7-.1-.3-.1-.5-.1-.8 0-2 1.6-3.5 3.5-3.5 1 0 1.9.4 2.5 1.1.8-.1 1.5-.4 2.2-.8-.3.8-.8 1.5-1.5 1.9.7-.1 1.4-.3 2-.5-.4.4-1 1-1.7 1.5z"/></svg></span><span class="ss_count"></span></a>
                                <a title="Email" target="_blank" href="mailto:?subject=<?php echo $title_share; ?>&amp;body=<?php echo $url_share ?>" class="ss_mail ss_item"><span class="ss_title">Share via Email</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M20.2 11.7l-.4-.4-5.7 2.7-5.7-2.7-.3.4 6 4.9 6.1-4.9zM21.4 7H6.5L5 9.5v9.3L6.6 20h14.9l1.5-1.2V9.5L21.4 7zm-.5 10.8H7.1V9.2h13.8v8.6z"/></svg></span></a>
                                <a title="WhatsApp" target="_blank" href="whatsapp://send?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_whatsapp ss_item"><span class="ss_title">Share on WhatsApp</span><span class="ss_icon"><svg viewBox="0 0 30 30" height="32" width="32"><path d="M22.09 7.87c-1.88-1.88-4.38-2.92-7.05-2.92-5.49 0-9.96 4.47-9.96 9.96 0 1.75.46 3.47 1.33 4.98L5 25.04l5.28-1.38c1.45.79 3.09 1.21 4.76 1.21 5.49 0 9.96-4.47 9.96-9.96 0-2.65-1.03-5.15-2.91-7.04m-7.05 15.32c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.13.82.84-3.05-.2-.31C7.2 18 6.76 16.47 6.77 14.91c0-4.56 3.71-8.27 8.28-8.27 2.21 0 4.29.86 5.85 2.43 1.56 1.56 2.42 3.64 2.42 5.85 0 4.56-3.72 8.27-8.28 8.27m4.54-6.2c-.25-.12-1.47-.73-1.7-.81s-.39-.12-.56.12c-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01-.17 0-.44.06-.66.31-.22.25-.87.85-.87 2.08 0 1.22.89 2.41 1.02 2.57.12.17 1.75 2.68 4.25 3.76.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18s.21-1.08.14-1.18c-.06-.08-.23-.14-.48-.27"/></svg></span></a>
                                <a title="Viber" target="_blank" href="viber://forward?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_viber ss_item"><span class="ss_title">Share on Viber</span><span class="ss_icon"><svg viewBox="0 0 950.000000 950.000000" height="32" width="32"><g stroke="none" fill="#transparent" transform="translate(0.000000,950.000000) scale(0.100000,-0.100000)"><path d="M1485 9418 c-181 -20 -385 -85 -564 -178 -421 -222 -734 -654 -817 -1130 -18 -101 -19 -237 -19 -3380 l0 -3275 23 -102 c144 -651 604 -1111 1255 -1255 l102 -23 3290 0 3290 0 102 23 c651 144 1111 604 1255 1255 l23 102 0 3275 c0 3143 -1 3279 -19 3380 -25 146 -75 293 -151 445 -237 477 -713 807 -1247 865 -122 13 -6405 12 -6523 -2z m3573 -1663 c344 -43 622 -126 927 -275 300 -147 492 -286 746 -539 238 -239 370 -420 510 -701 195 -392 306 -858 325 -1371 7 -175 2 -214 -38 -264 -76 -97 -243 -81 -300 28 -18 36 -23 67 -29 207 -10 215 -25 354 -55 520 -118 651 -430 1171 -928 1544 -415 312 -844 464 -1406 497 -190 11 -223 18 -266 51 -80 63 -84 211 -7 280 47 43 80 49 243 44 85 -3 210 -13 278 -21z m-2286 -108 c35 -12 89 -40 120 -60 190 -126 719 -803 892 -1141 99 -193 132 -336 101 -442 -32 -114 -85 -174 -322 -365 -95 -77 -184 -156 -198 -177 -36 -52 -65 -154 -65 -226 1 -167 109 -470 251 -703 110 -181 307 -413 502 -591 229 -210 431 -353 659 -466 293 -146 472 -183 603 -122 33 15 68 35 79 44 10 9 87 103 171 207 162 204 199 237 310 275 141 48 285 35 430 -39 110 -57 350 -206 505 -314 204 -143 640 -499 699 -570 104 -128 122 -292 52 -473 -74 -191 -362 -549 -563 -702 -182 -138 -311 -191 -481 -199 -140 -7 -198 5 -377 79 -1404 579 -2525 1443 -3415 2630 -465 620 -819 1263 -1061 1930 -141 389 -148 558 -32 757 50 84 263 292 418 408 258 192 377 263 472 283 65 14 178 3 250 -23z m2355 -617 c607 -89 1077 -371 1385 -829 173 -258 281 -561 318 -886 13 -119 13 -336 -1 -372 -13 -34 -55 -80 -91 -99 -39 -20 -122 -18 -168 6 -77 39 -100 101 -100 269 0 259 -67 532 -183 744 -132 242 -324 442 -558 581 -201 120 -498 209 -769 231 -98 8 -152 28 -189 71 -57 65 -63 153 -15 226 52 81 132 94 371 58z m213 -755 c197 -42 348 -117 477 -238 166 -157 257 -347 297 -620 27 -178 16 -248 -47 -306 -59 -54 -168 -56 -234 -5 -48 36 -63 74 -74 177 -13 137 -37 233 -78 322 -88 189 -243 287 -505 319 -123 15 -160 29 -200 76 -73 87 -45 228 56 280 38 19 54 21 138 16 52 -3 129 -12 170 -21z"/></g></svg></span></a>
                            </div>
                        </div>
                        <?php echo $value['description']; ?>
                    </div>
                    <?php
                $i++; } ?>

            </div>
            <div class="aligncenter box_shadows">
                <div style="max-width:320px;max-height:50px;margin:0 auto;">
                    <script>
                      googletag.cmd.push(function() {
                        googletag.defineSlot('/67573540/only_mobile_content_bottom_320x50', [320, 50], 'div-gpt-ad-1537108382331-0').addService(googletag.pubads());
                        googletag.pubads().enableSingleRequest();
                        googletag.enableServices();
                      });
                    </script>
                    <!-- /67573540/only_mobile_content_bottom_320x50 -->
                    <div id='div-gpt-ad-1537108382331-0' style='height:50px; width:320px;'>
                        <script>
                            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1537108382331-0'); });
                        </script>
                    </div>
                </div>
            </div>
            <p><?php echo $details_live_intro['initials']; ?></p>
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
        <!-- <div style="height: 200px;"></div> -->
            <p>
                <style type="text/css">
                    .fb-comments,.fb-comments span, .fb-comments span iframe{
                    width:100% !important;
                    }
                </style>
                <script>
                var ___u = '<?php echo $details['web_url']; ?>';
                document.write('<div class="fb-comments" data-href="'+___u+'" data-numposts="5"></div>');
                </script>
            </p>
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
    <!--            <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-2935961069639123" data-ad-slot="6201410109"></ins>-->
        </div>
        <script>
            //$('').insertAfter($("#content img:first").parent());
        </script>
<!--        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>-->
        <div class="time_info clearfix">
            <div class="social_shares_jw">
                <div class="fb-save" data-uri="<?php echo $details_live_intro['web_url']; ?>">Save</div>
                <a title="Facebook" target="_blank" href="https://www.facebook.com/dialog/share?app_id=436163869915872&amp;href=<?php echo $url_web ?>&amp;redirect_uri=<?php echo $url_share ?>" class="ss_facebook ss_item"><span class="ss_title">Share on Facebook</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M17.9 14h-3v8H12v-8h-2v-2.9h2V8.7C12 6.8 13.1 5 16 5c1.2 0 2 .1 2 .1v3h-1.8c-1 0-1.2.5-1.2 1.3v1.8h3l-.1 2.8z"/></svg></span><span id="facebook_count" class="ss_count"></span></a>
                <a title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title_share; ?>&amp;url=<?php echo $url_share ?>" class="ss_twitter ss_item"><span class="ss_title">Share on Twitter</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M21.3 10.5v.5c0 4.7-3.5 10.1-9.9 10.1-2 0-3.8-.6-5.3-1.6.3 0 .6.1.8.1 1.6 0 3.1-.6 4.3-1.5-1.5 0-2.8-1-3.3-2.4.2 0 .4.1.7.1l.9-.1c-1.6-.3-2.8-1.8-2.8-3.5.5.3 1 .4 1.6.4-.9-.6-1.6-1.7-1.6-2.9 0-.6.2-1.3.5-1.8 1.7 2.1 4.3 3.6 7.2 3.7-.1-.3-.1-.5-.1-.8 0-2 1.6-3.5 3.5-3.5 1 0 1.9.4 2.5 1.1.8-.1 1.5-.4 2.2-.8-.3.8-.8 1.5-1.5 1.9.7-.1 1.4-.3 2-.5-.4.4-1 1-1.7 1.5z"/></svg></span><span class="ss_count"></span></a>
                <a title="Email" target="_blank" href="mailto:?subject=<?php echo $title_share; ?>&amp;body=<?php echo $url_share ?>" class="ss_mail ss_item"><span class="ss_title">Share via Email</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M20.2 11.7l-.4-.4-5.7 2.7-5.7-2.7-.3.4 6 4.9 6.1-4.9zM21.4 7H6.5L5 9.5v9.3L6.6 20h14.9l1.5-1.2V9.5L21.4 7zm-.5 10.8H7.1V9.2h13.8v8.6z"/></svg></span></a>
                <a title="WhatsApp" target="_blank" href="whatsapp://send?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_whatsapp ss_item"><span class="ss_title">Share on WhatsApp</span><span class="ss_icon"><svg viewBox="0 0 30 30" height="32" width="32"><path d="M22.09 7.87c-1.88-1.88-4.38-2.92-7.05-2.92-5.49 0-9.96 4.47-9.96 9.96 0 1.75.46 3.47 1.33 4.98L5 25.04l5.28-1.38c1.45.79 3.09 1.21 4.76 1.21 5.49 0 9.96-4.47 9.96-9.96 0-2.65-1.03-5.15-2.91-7.04m-7.05 15.32c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.13.82.84-3.05-.2-.31C7.2 18 6.76 16.47 6.77 14.91c0-4.56 3.71-8.27 8.28-8.27 2.21 0 4.29.86 5.85 2.43 1.56 1.56 2.42 3.64 2.42 5.85 0 4.56-3.72 8.27-8.28 8.27m4.54-6.2c-.25-.12-1.47-.73-1.7-.81s-.39-.12-.56.12c-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01-.17 0-.44.06-.66.31-.22.25-.87.85-.87 2.08 0 1.22.89 2.41 1.02 2.57.12.17 1.75 2.68 4.25 3.76.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18s.21-1.08.14-1.18c-.06-.08-.23-.14-.48-.27"/></svg></span></a>
                <a title="Viber" target="_blank" href="viber://forward?text=<?php echo $title_share . '%20%20' . $url_share; ?>" class="ss_viber ss_item"><span class="ss_title">Share on Viber</span><span class="ss_icon"><svg viewBox="0 0 950.000000 950.000000" height="32" width="32"><g stroke="none" fill="#transparent" transform="translate(0.000000,950.000000) scale(0.100000,-0.100000)"><path d="M1485 9418 c-181 -20 -385 -85 -564 -178 -421 -222 -734 -654 -817 -1130 -18 -101 -19 -237 -19 -3380 l0 -3275 23 -102 c144 -651 604 -1111 1255 -1255 l102 -23 3290 0 3290 0 102 23 c651 144 1111 604 1255 1255 l23 102 0 3275 c0 3143 -1 3279 -19 3380 -25 146 -75 293 -151 445 -237 477 -713 807 -1247 865 -122 13 -6405 12 -6523 -2z m3573 -1663 c344 -43 622 -126 927 -275 300 -147 492 -286 746 -539 238 -239 370 -420 510 -701 195 -392 306 -858 325 -1371 7 -175 2 -214 -38 -264 -76 -97 -243 -81 -300 28 -18 36 -23 67 -29 207 -10 215 -25 354 -55 520 -118 651 -430 1171 -928 1544 -415 312 -844 464 -1406 497 -190 11 -223 18 -266 51 -80 63 -84 211 -7 280 47 43 80 49 243 44 85 -3 210 -13 278 -21z m-2286 -108 c35 -12 89 -40 120 -60 190 -126 719 -803 892 -1141 99 -193 132 -336 101 -442 -32 -114 -85 -174 -322 -365 -95 -77 -184 -156 -198 -177 -36 -52 -65 -154 -65 -226 1 -167 109 -470 251 -703 110 -181 307 -413 502 -591 229 -210 431 -353 659 -466 293 -146 472 -183 603 -122 33 15 68 35 79 44 10 9 87 103 171 207 162 204 199 237 310 275 141 48 285 35 430 -39 110 -57 350 -206 505 -314 204 -143 640 -499 699 -570 104 -128 122 -292 52 -473 -74 -191 -362 -549 -563 -702 -182 -138 -311 -191 -481 -199 -140 -7 -198 5 -377 79 -1404 579 -2525 1443 -3415 2630 -465 620 -819 1263 -1061 1930 -141 389 -148 558 -32 757 50 84 263 292 418 408 258 192 377 263 472 283 65 14 178 3 250 -23z m2355 -617 c607 -89 1077 -371 1385 -829 173 -258 281 -561 318 -886 13 -119 13 -336 -1 -372 -13 -34 -55 -80 -91 -99 -39 -20 -122 -18 -168 6 -77 39 -100 101 -100 269 0 259 -67 532 -183 744 -132 242 -324 442 -558 581 -201 120 -498 209 -769 231 -98 8 -152 28 -189 71 -57 65 -63 153 -15 226 52 81 132 94 371 58z m213 -755 c197 -42 348 -117 477 -238 166 -157 257 -347 297 -620 27 -178 16 -248 -47 -306 -59 -54 -168 -56 -234 -5 -48 36 -63 74 -74 177 -13 137 -37 233 -78 322 -88 189 -243 287 -505 319 -123 15 -160 29 -200 76 -73 87 -45 228 56 280 38 19 54 21 138 16 52 -3 129 -12 170 -21z"/></g></svg></span></a>
            </div>
        </div>
        <?php if ($pagination == 'country') { ?>
        <div class="aligncenter box_shadows">
            <div style="max-width:300px;height:250px;margin:0 auto;">
                <script>
                googletag.cmd.push(function() {
                googletag.defineSlot('/67573540/bt_cbc_300x250', [300, 250], 'div-gpt-ad-1527104677750-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
                });
                </script>
                <!-- /67573540/bt_cbc_300x250 -->
                <div id='div-gpt-ad-1527104677750-0' style='height:250px; width:300px;'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1527104677750-0'); });
                    </script>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="aligncenter box_shadows">
            <div style="max-width:300px;height:100px;margin:0 auto;">
                <script>
                  googletag.cmd.push(function() {
                    googletag.defineSlot('/67573540/walton_300x100', [300, 100], 'div-gpt-ad-1527069428651-0').addService(googletag.pubads());
                    googletag.pubads().enableSingleRequest();
                    googletag.enableServices();
                  });
                </script>
                <!-- /67573540/walton_300x100 -->
                <div id='div-gpt-ad-1527069428651-0' style='height:100px; width:300px;'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1527069428651-0'); });
                    </script>
                </div>
            </div>
        </div>
        <?php if ($pagination == 'sport') { ?>
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
        <?php } ?>
        <!--dw news box-->
        <div class="aligncenter" style="">
            <a style="max-width: 300px;overflow:hidden;" href="http://www.dw.com/bn/%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F/s-11929?maca=ben-CB_ben_BanglaTribune-20061-html-cb" target="_blank">
                <img src="http://cdn.banglatribune.com/contents/uploads/media/2017/12/16/ac40ef534b2d800bb99ed40961838ae5-5a35153bb132f.jpg" alt="">
            </a>
        </div>
        <!--dw news box end-->
    </div>
    <div class="sec_right">
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
        <!--        <div class="aligncenter box_shadows">
                    <div style="max-width:336px;height:280px;margin:0 auto;">
                        <script>
                            googletag.cmd.push(function () {
                                googletag.defineSlot('/67573540/bt_adsense_336x280', [336, 280], 'div-gpt-ad-1508924860929-0').addService(googletag.pubads());
                                googletag.pubads().enableSingleRequest();
                                googletag.pubads().collapseEmptyDivs();
                                googletag.enableServices();
                            });
                        </script>
                         /67573540/bt_adsense_336x280 
                        <div id='div-gpt-ad-1508924860929-0' style='height:280px; width:336px;'>
                            <script>
                                googletag.cmd.push(function () {
                                    googletag.display('div-gpt-ad-1508924860929-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>-->
    </div>
    <div class="clear"></div>
    <script type="text/javascript">
        jw_limit_text_chars({element: 'textarea[name=comment]', char_limit: 5000, language: 'bn'});
    </script>
</div>
<script type="text/javascript">
    function fb_share_callback(r) {
        var share_count = r.share.share_count;
        if (share_count) {
            if (share_count > 1000) {
                share_count = Math.round(share_count / 100) / 10 + 'K';
            }
            $('.ss_facebook .ss_count').html(share_count).show();
        }
    }
</script>
<script type="text/javascript" src="https://graph.facebook.com/?id=<?php echo urlencode($details['web_url']); ?>&callback=fb_share_callback"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //var url_en = '<?php //echo $details['web_url'];  ?>';
//        $.get("https://graph.facebook.com/v2.12", {ids: url_en, access_token: "579576052208440|73ebd4a67125fdd8ec2947194bfc252a"}).done(function (data) {
//
////        var url_f = url_en+','+url_en_m;
//            var count = 0;
//            //$.get("https://graph.facebook.com/", {ids: url_en}).done(function (data) {
//            //console.log(data);
//            $.each(data, function (i, v) {
//                count = parseInt(v.share.share_count);
//            });
//            //console.log(count);
//            if (count !== 0) {
//                $('.ss_facebook .ss_count').html(nFormatter(count));
//                $('.ss_facebook .ss_count').show();
//            }
//        });
        // Create the XHR object.
//        function createCORSRequest(method, url) {
//            var xhr = new XMLHttpRequest();
//            if ("withCredentials" in xhr) {
//                // XHR for Chrome/Firefox/Opera/Safari.
//                xhr.open(method, url, true);
//            } else if (typeof XDomainRequest != "undefined") {
//                // XDomainRequest for IE.
//                xhr = new XDomainRequest();
//                xhr.open(method, url);
//            } else {
//                // CORS not supported.
//                xhr = null;
//            }
//            return xhr;
//        }
// Helper method to parse the title tag from the response.
//        function getTitle(text) {
//            return text.match('<title>(.*)?</title>')[1];
//        }
// Make the actual CORS request.
//        function makeCorsRequest() {
//            // This is a sample server that supports CORS.
//            var url = '<?php //echo $value['web_url'];  ?>&jwcvi=1';
//            var xhr = createCORSRequest('POST', url);
//            if (!xhr) {
//                console.log('CORS not supported');
//                return;
//            }
//            // Response handlers.
//            xhr.onload = function () {
//                var text = xhr.responseText;
//                console.log('Response from CORS request to ' + url + ': ' + text);
//            };
//            xhr.onerror = function () {
//                console.log('Woops, there was an error making the request.');
//            };
//            xhr.send();
//        }
//        makeCorsRequest();
//        $.post('<?php //echo $value['web_url'];    ?>&jwcvi=1').done(function (data) {
//            alert(data);
//        });
        var all_image = $("#content").find("img");
        var all_youtube = $("#content").find("iframe");
        $(all_image).each(function (i, v) {
            if ($(v).attr('width') >= 620) {
                var myStr = $(v).attr('src').split("/");
                myStr[6] = '620x0x1';
                var tem = myStr.join('/');
                $(v).attr('src', tem);
                $(v).attr('width', '620');
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
        var width = $(window).width();
        var height = width / 1.6;
        $(all_youtube).each(function (ind, ele) {
            if (width < 801) {
                $(ele).attr('width', width);
                $(ele).attr('height', height);
            } else {
                return;
            }
        });
    });
</script>
<?php
include 'includes/footer.php';
if (!$ignore) {
    $fp = fopen($cache_file, 'w');  //open file for writing
    file_put_contents($cache_file, ob_get_contents()); //write contents of the output buffer in Cache file
    fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering