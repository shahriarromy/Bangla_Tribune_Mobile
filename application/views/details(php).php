<?php
$url_share = urlencode(url_format_fnc($details['web_url']));
$url_web = urlencode($details['web_url']);
$title_share = urlencode($details['title']);
$this->load->view('includes/header');
if (count($comment) > 0) {
    foreach ($comment as $key => $val) {

        if ($val['parent'] != "0") {

            $newKey = $val['parent'];

            if (count($comment[$newKey]) == 14) {

                //echo $val['text'] . "<br>";
                $comment[$newKey]['comment_replied'] = array($val);
            } else {

                $newKey = $val['parent'];
                array_push($comment[$newKey]['comment_replied'], $val);
            }
        }
    }
}
global $response;
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
                            $pagination_name = 'টেক';
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
                        case 'leads-of-the-world':
                            $pagination_name = 'লিড্‌স অব দ্য ওয়ার্ল্ড';
                            break;


                        default:
                            $pagination_name = 'নিউজ';
                            break;
                    }
                    echo $pagination_name;
                    ?></strong></a></li>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="javascript:"><strong itemprop="title">নিউজ</strong></a></li>
    </ul>
</div>
<div class="details_page content_page">
    <div class="title_time_author_holder">
        <h2 class="title_holder">
            <span class="subtitle"><?php echo $details['subtitle']; ?></span>
            <span class="title"><?php echo $details['title']; ?></span>
        </h2>
        <div class="time_info clearfix">
            <span class="author_holder"><span class="author"><?php echo $details['author_display_name']; ?></span></span>
            <span data-modified="2016-02-22T20:27:28+06:00" data-published="2016-02-22T20:12:00+06:00" class="time"><?php echo cutom_date_time($details['published_time']); ?></span>
            <div class="social_shares_jw">
                <a title="Facebook" target="_blank" href="https://www.facebook.com/dialog/share?app_id=436163869915872&amp;href=<?php echo $url_share ?>&amp;redirect_uri=<?php echo $url_share ?>" class="ss_facebook ss_item"><span class="ss_title">Share on Facebook</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M17.9 14h-3v8H12v-8h-2v-2.9h2V8.7C12 6.8 13.1 5 16 5c1.2 0 2 .1 2 .1v3h-1.8c-1 0-1.2.5-1.2 1.3v1.8h3l-.1 2.8z"/></svg></span><span id="facebook_count" class="ss_count"></span></a>
                <a title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title_share; ?>&amp;url=<?php echo $url_share ?>" class="ss_twitter ss_item"><span class="ss_title">Share on Twitter</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M21.3 10.5v.5c0 4.7-3.5 10.1-9.9 10.1-2 0-3.8-.6-5.3-1.6.3 0 .6.1.8.1 1.6 0 3.1-.6 4.3-1.5-1.5 0-2.8-1-3.3-2.4.2 0 .4.1.7.1l.9-.1c-1.6-.3-2.8-1.8-2.8-3.5.5.3 1 .4 1.6.4-.9-.6-1.6-1.7-1.6-2.9 0-.6.2-1.3.5-1.8 1.7 2.1 4.3 3.6 7.2 3.7-.1-.3-.1-.5-.1-.8 0-2 1.6-3.5 3.5-3.5 1 0 1.9.4 2.5 1.1.8-.1 1.5-.4 2.2-.8-.3.8-.8 1.5-1.5 1.9.7-.1 1.4-.3 2-.5-.4.4-1 1-1.7 1.5z"/></svg></span><span class="ss_count"></span></a>
                <a title="Email" target="_blank" href="mailto:?subject=<?php echo $title_share; ?>&amp;body=<?php echo $url_share ?>" class="ss_mail ss_item"><span class="ss_title">Share via Email</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M20.2 11.7l-.4-.4-5.7 2.7-5.7-2.7-.3.4 6 4.9 6.1-4.9zM21.4 7H6.5L5 9.5v9.3L6.6 20h14.9l1.5-1.2V9.5L21.4 7zm-.5 10.8H7.1V9.2h13.8v8.6z"/></svg></span></a>
                <a title="WhatsApp" target="_blank" href="whatsapp://send?text=<?php echo $title_share . $url_share; ?>" class="ss_whatsapp ss_item"><span class="ss_title">Share on WhatsApp</span><span class="ss_icon"><svg viewBox="0 0 30 30" height="32" width="32"><path d="M22.09 7.87c-1.88-1.88-4.38-2.92-7.05-2.92-5.49 0-9.96 4.47-9.96 9.96 0 1.75.46 3.47 1.33 4.98L5 25.04l5.28-1.38c1.45.79 3.09 1.21 4.76 1.21 5.49 0 9.96-4.47 9.96-9.96 0-2.65-1.03-5.15-2.91-7.04m-7.05 15.32c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.13.82.84-3.05-.2-.31C7.2 18 6.76 16.47 6.77 14.91c0-4.56 3.71-8.27 8.28-8.27 2.21 0 4.29.86 5.85 2.43 1.56 1.56 2.42 3.64 2.42 5.85 0 4.56-3.72 8.27-8.28 8.27m4.54-6.2c-.25-.12-1.47-.73-1.7-.81s-.39-.12-.56.12c-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01-.17 0-.44.06-.66.31-.22.25-.87.85-.87 2.08 0 1.22.89 2.41 1.02 2.57.12.17 1.75 2.68 4.25 3.76.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18s.21-1.08.14-1.18c-.06-.08-.23-.14-.48-.27"/></svg></span></a>
                <a title="Viber" target="_blank" href="viber://forward?text=<?php echo $title_share . $url_share; ?>" class="ss_viber ss_item"><span class="ss_title">Share on Viber</span><span class="ss_icon"><svg viewBox="0 0 950.000000 950.000000" height="32" width="32"><g stroke="none" fill="#transparent" transform="translate(0.000000,950.000000) scale(0.100000,-0.100000)"><path d="M1485 9418 c-181 -20 -385 -85 -564 -178 -421 -222 -734 -654 -817 -1130 -18 -101 -19 -237 -19 -3380 l0 -3275 23 -102 c144 -651 604 -1111 1255 -1255 l102 -23 3290 0 3290 0 102 23 c651 144 1111 604 1255 1255 l23 102 0 3275 c0 3143 -1 3279 -19 3380 -25 146 -75 293 -151 445 -237 477 -713 807 -1247 865 -122 13 -6405 12 -6523 -2z m3573 -1663 c344 -43 622 -126 927 -275 300 -147 492 -286 746 -539 238 -239 370 -420 510 -701 195 -392 306 -858 325 -1371 7 -175 2 -214 -38 -264 -76 -97 -243 -81 -300 28 -18 36 -23 67 -29 207 -10 215 -25 354 -55 520 -118 651 -430 1171 -928 1544 -415 312 -844 464 -1406 497 -190 11 -223 18 -266 51 -80 63 -84 211 -7 280 47 43 80 49 243 44 85 -3 210 -13 278 -21z m-2286 -108 c35 -12 89 -40 120 -60 190 -126 719 -803 892 -1141 99 -193 132 -336 101 -442 -32 -114 -85 -174 -322 -365 -95 -77 -184 -156 -198 -177 -36 -52 -65 -154 -65 -226 1 -167 109 -470 251 -703 110 -181 307 -413 502 -591 229 -210 431 -353 659 -466 293 -146 472 -183 603 -122 33 15 68 35 79 44 10 9 87 103 171 207 162 204 199 237 310 275 141 48 285 35 430 -39 110 -57 350 -206 505 -314 204 -143 640 -499 699 -570 104 -128 122 -292 52 -473 -74 -191 -362 -549 -563 -702 -182 -138 -311 -191 -481 -199 -140 -7 -198 5 -377 79 -1404 579 -2525 1443 -3415 2630 -465 620 -819 1263 -1061 1930 -141 389 -148 558 -32 757 50 84 263 292 418 408 258 192 377 263 472 283 65 14 178 3 250 -23z m2355 -617 c607 -89 1077 -371 1385 -829 173 -258 281 -561 318 -886 13 -119 13 -336 -1 -372 -13 -34 -55 -80 -91 -99 -39 -20 -122 -18 -168 6 -77 39 -100 101 -100 269 0 259 -67 532 -183 744 -132 242 -324 442 -558 581 -201 120 -498 209 -769 231 -98 8 -152 28 -189 71 -57 65 -63 153 -15 226 52 81 132 94 371 58z m213 -755 c197 -42 348 -117 477 -238 166 -157 257 -347 297 -620 27 -178 16 -248 -47 -306 -59 -54 -168 -56 -234 -5 -48 36 -63 74 -74 177 -13 137 -37 233 -78 322 -88 189 -243 287 -505 319 -123 15 -160 29 -200 76 -73 87 -45 228 56 280 38 19 54 21 138 16 52 -3 129 -12 170 -21z"/></g></svg></span></a>
            </div>
        </div>
    </div>
    <div class="comment_count_and_social">
        <div class="fl">
            <a href="javascript:" data-contentid="<?php echo $details['content_id']; ?>" class="<?php if (isset($response['user'])) { ?>bt_content_like <?php } ?>jw_content_like_system detail_like" title="Like"><span class="count"><?php echo toBangla($details['like_count']); ?></span> <span class="button_label mi_24x24 mi_24x24_cont_like"></span></a>
            <?php if ($details['comment_count'] > 0) { ?>
                <a class="detail_comment_count" href="#comments"><span class="count"><?php echo toBangla($details['comment_count']); ?></span><span class="mi_24x24 mi_24x24_comment"></span></a>
            <?php } ?>
        </div>
    </div>
    <div id="content" class="summery mb10 pb10 clearfix" itemtype="http://schema.org/Article"><?php echo $details['description']; ?></div>
    <div class="time_info clearfix">
        <div class="social_shares_jw">
            <a title="Facebook" target="_blank" href="https://www.facebook.com/dialog/share?app_id=436163869915872&amp;href=<?php echo $url_share ?>&amp;redirect_uri=<?php echo $url_share ?>" class="ss_facebook ss_item"><span class="ss_title">Share on Facebook</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M17.9 14h-3v8H12v-8h-2v-2.9h2V8.7C12 6.8 13.1 5 16 5c1.2 0 2 .1 2 .1v3h-1.8c-1 0-1.2.5-1.2 1.3v1.8h3l-.1 2.8z"/></svg></span><span id="facebook_count" class="ss_count"></span></a>
            <a title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title_share; ?>&amp;url=<?php echo $url_share ?>" class="ss_twitter ss_item"><span class="ss_title">Share on Twitter</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M21.3 10.5v.5c0 4.7-3.5 10.1-9.9 10.1-2 0-3.8-.6-5.3-1.6.3 0 .6.1.8.1 1.6 0 3.1-.6 4.3-1.5-1.5 0-2.8-1-3.3-2.4.2 0 .4.1.7.1l.9-.1c-1.6-.3-2.8-1.8-2.8-3.5.5.3 1 .4 1.6.4-.9-.6-1.6-1.7-1.6-2.9 0-.6.2-1.3.5-1.8 1.7 2.1 4.3 3.6 7.2 3.7-.1-.3-.1-.5-.1-.8 0-2 1.6-3.5 3.5-3.5 1 0 1.9.4 2.5 1.1.8-.1 1.5-.4 2.2-.8-.3.8-.8 1.5-1.5 1.9.7-.1 1.4-.3 2-.5-.4.4-1 1-1.7 1.5z"/></svg></span><span class="ss_count"></span></a>
            <a title="Email" target="_blank" href="mailto:?subject=<?php echo $title_share; ?>&amp;body=<?php echo $url_share ?>" class="ss_mail ss_item"><span class="ss_title">Share via Email</span><span class="ss_icon"><svg viewBox="-2 -2 32 32" height="32" width="32"><path d="M20.2 11.7l-.4-.4-5.7 2.7-5.7-2.7-.3.4 6 4.9 6.1-4.9zM21.4 7H6.5L5 9.5v9.3L6.6 20h14.9l1.5-1.2V9.5L21.4 7zm-.5 10.8H7.1V9.2h13.8v8.6z"/></svg></span></a>
            <a title="WhatsApp" target="_blank" href="whatsapp://send?text=<?php echo $title_share . $url_share; ?>" class="ss_whatsapp ss_item"><span class="ss_title">Share on WhatsApp</span><span class="ss_icon"><svg viewBox="0 0 30 30" height="32" width="32"><path d="M22.09 7.87c-1.88-1.88-4.38-2.92-7.05-2.92-5.49 0-9.96 4.47-9.96 9.96 0 1.75.46 3.47 1.33 4.98L5 25.04l5.28-1.38c1.45.79 3.09 1.21 4.76 1.21 5.49 0 9.96-4.47 9.96-9.96 0-2.65-1.03-5.15-2.91-7.04m-7.05 15.32c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.13.82.84-3.05-.2-.31C7.2 18 6.76 16.47 6.77 14.91c0-4.56 3.71-8.27 8.28-8.27 2.21 0 4.29.86 5.85 2.43 1.56 1.56 2.42 3.64 2.42 5.85 0 4.56-3.72 8.27-8.28 8.27m4.54-6.2c-.25-.12-1.47-.73-1.7-.81s-.39-.12-.56.12c-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.48-.01-.17 0-.44.06-.66.31-.22.25-.87.85-.87 2.08 0 1.22.89 2.41 1.02 2.57.12.17 1.75 2.68 4.25 3.76.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18s.21-1.08.14-1.18c-.06-.08-.23-.14-.48-.27"/></svg></span></a>
            <a title="Viber" target="_blank" href="viber://forward?text=<?php echo $title_share . $url_share; ?>" class="ss_viber ss_item"><span class="ss_title">Share on Viber</span><span class="ss_icon"><svg viewBox="0 0 950.000000 950.000000" height="32" width="32"><g stroke="none" fill="#transparent" transform="translate(0.000000,950.000000) scale(0.100000,-0.100000)"><path d="M1485 9418 c-181 -20 -385 -85 -564 -178 -421 -222 -734 -654 -817 -1130 -18 -101 -19 -237 -19 -3380 l0 -3275 23 -102 c144 -651 604 -1111 1255 -1255 l102 -23 3290 0 3290 0 102 23 c651 144 1111 604 1255 1255 l23 102 0 3275 c0 3143 -1 3279 -19 3380 -25 146 -75 293 -151 445 -237 477 -713 807 -1247 865 -122 13 -6405 12 -6523 -2z m3573 -1663 c344 -43 622 -126 927 -275 300 -147 492 -286 746 -539 238 -239 370 -420 510 -701 195 -392 306 -858 325 -1371 7 -175 2 -214 -38 -264 -76 -97 -243 -81 -300 28 -18 36 -23 67 -29 207 -10 215 -25 354 -55 520 -118 651 -430 1171 -928 1544 -415 312 -844 464 -1406 497 -190 11 -223 18 -266 51 -80 63 -84 211 -7 280 47 43 80 49 243 44 85 -3 210 -13 278 -21z m-2286 -108 c35 -12 89 -40 120 -60 190 -126 719 -803 892 -1141 99 -193 132 -336 101 -442 -32 -114 -85 -174 -322 -365 -95 -77 -184 -156 -198 -177 -36 -52 -65 -154 -65 -226 1 -167 109 -470 251 -703 110 -181 307 -413 502 -591 229 -210 431 -353 659 -466 293 -146 472 -183 603 -122 33 15 68 35 79 44 10 9 87 103 171 207 162 204 199 237 310 275 141 48 285 35 430 -39 110 -57 350 -206 505 -314 204 -143 640 -499 699 -570 104 -128 122 -292 52 -473 -74 -191 -362 -549 -563 -702 -182 -138 -311 -191 -481 -199 -140 -7 -198 5 -377 79 -1404 579 -2525 1443 -3415 2630 -465 620 -819 1263 -1061 1930 -141 389 -148 558 -32 757 50 84 263 292 418 408 258 192 377 263 472 283 65 14 178 3 250 -23z m2355 -617 c607 -89 1077 -371 1385 -829 173 -258 281 -561 318 -886 13 -119 13 -336 -1 -372 -13 -34 -55 -80 -91 -99 -39 -20 -122 -18 -168 6 -77 39 -100 101 -100 269 0 259 -67 532 -183 744 -132 242 -324 442 -558 581 -201 120 -498 209 -769 231 -98 8 -152 28 -189 71 -57 65 -63 153 -15 226 52 81 132 94 371 58z m213 -755 c197 -42 348 -117 477 -238 166 -157 257 -347 297 -620 27 -178 16 -248 -47 -306 -59 -54 -168 -56 -234 -5 -48 36 -63 74 -74 177 -13 137 -37 233 -78 322 -88 189 -243 287 -505 319 -123 15 -160 29 -200 76 -73 87 -45 228 56 280 38 19 54 21 138 16 52 -3 129 -12 170 -21z"/></g></svg></span></a>
        </div>
    </div>
    <div class="comment_count_and_social">
        <div class="fl">
            <a href="javascript:" data-contentid="<?php echo $details['content_id']; ?>" class="<?php if (isset($response['user'])) { ?>bt_content_like <?php } ?>jw_content_like_system detail_like" title="Like"><span class="count"><?php echo toBangla($details['like_count']); ?></span> <span class="button_label mi_24x24 mi_24x24_cont_like"></span></a>
            <?php if ($details['comment_count'] > 0) { ?>
                <a class="detail_comment_count" href="#comments"><span class="count"><?php echo toBangla($details['comment_count']); ?></span><span class="mi_24x24 mi_24x24_comment"></span></a>
            <?php } ?>
        </div>
        <!--        <div class="fr">
                    <a href="javascript:" title="Print" class="mi_24x24 mi_24x24_print addthis_print"></a>
                    <a href="javascript:" data-container="jw_detail_content_holder" title="Zoom Out" class="mi_24x24 mi_24x24_zoomout jw_content_zoom_out"></a>
                    <a href="javascript:" data-container="jw_detail_content_holder" title="Zoom In" class="mi_24x24 mi_24x24_zoomin jw_content_zoom_in"></a>
                </div>-->
    </div>
    <script type="text/javascript">
        $(document).ready(function (e) {
            //fetching like/dislike count for all like/dislike buttons on the page.
            //taking action on like/dislike event
            $('.bt_content_like').on('click', function () {
                if (__is_jadewits_user_logged_in) {
                    var element = $(this);
                    var ths = $('.button_label', this);
                    var action = '';
                    if ($(element).hasClass('detail_like'))
                        action = $(ths).hasClass('liked') ? 'nothing' : 'like';
                    else if ($(element).hasClass('detail_dislike'))
                        action = $(ths).hasClass('disliked') ? 'nothing' : 'dislike';
                    $.ajax({
                        type: 'post',
                        url: base_url+'ajax_like',
                        data: 'the_content=' + $(element).attr('data-contentid') + '&status=like_dislike&action=' + action,
                        dataType: 'json',
                        success: function (reply_data) {
                            if (reply_data && !reply_data.error){
                                $('.bt_content_like.detail_like[data-contentid=' + $(element).attr('data-contentid') + ']').each(function (index, ele) {
                                    if (reply_data.action_type == 'like')
                                        $('.button_label', ele).addClass('liked');
                                    else if (reply_data.action_type == 'nothing' || reply_data.action_type == 'dislike')
                                        $('.button_label', ele).removeClass('liked');
                                    if (!reply_data.like_count)
                                        reply_data.like_count = languageNumber(0, 'bn');
                                    $('.count', ele).html(languageNumber(reply_data.like_count, 'bn'));
                                });
                                $('.bt_content_like.detail_dislike[data-contentid=' + $(element).attr('data-contentid') + ']').each(function (index, ele) {
                                    if (reply_data.action_type == 'dislike')
                                        $('.button_label', ele).addClass('disliked');
                                    else if (reply_data.action_type == 'nothing' || reply_data.action_type == 'like')
                                        $('.button_label', ele).removeClass('disliked');
                                    if (!reply_data.dislike_count)
                                        reply_data.dislike_count = languageNumber(0, 'bn');
                                    $('.count', ele).html(languageNumber(reply_data.dislike_count, 'bn'));
                                });
                            }
                        },
                        error: function (e, msg) {
                            alert('Network Error');
                        }
                    });
                }
                else {
                    if (confirm("Login to Like"))
                        window.location.href = 'https://profiles.banglatribune.com/login/?APP_ID=1&amp;next=http%3A%2F%2Fwww.banglatribune.com%2Fnational%2Fnews%2F79657%2F%25E0%25A6%2586%25E0%25A6%25AC%25E0%25A7%258D%25E0%25A6%25AC%25E0%25A6%25BE%25E0%25A6%2595%25E0%25A7%2587-%25E0%25A6%25AC%25E0%25A6%25B8%25E0%25A6%25BF%25E0%25A7%259F%25E0%25A7%2587-%25E0%25A6%25B0%25E0%25A7%2587%25E0%25A6%2596%25E0%25A7%2587-%25E0%25A6%25AC%25E0%25A6%25BF%25E0%25A6%25B2%25E0%25A7%2587%25E0%25A6%25B0-%25E0%25A6%259C%25E0%25A6%25A8%25E0%25A7%258D%25E0%25A6%25AF-%25E0%25A6%25AB%25E0%25A6%25BE%25E0%25A6%2587%25E0%25A6%259F-%25E0%25A6%2595%25E0%25A6%25B0%25E0%25A6%25A4%25E0%25A7%2587-%25E0%25A6%25AA%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A6%25BF-%25E0%25A6%25A8%25E0%25A6%25BE%25E2%2580%2599';
                }
            });
        });
    </script>
        <div id="comments" class="comment_div">
            <h4 class="comments_title">পাঠকের মন্তব্য ( <?php echo toBangla($details['comment_count']); ?> )</h4>
            <div class="comments_holder">
                <ul class="comments_holder_ul">
                    <?php
                    foreach ($comment as $key => $comments) {
                        if ($comments['comment_status'] == 'published' && $comments['parent'] == 0) {
                            if (count($comments) == 14) {
                                ?>
                                <li id="comment_<?php echo $comments['comment_id'] ?>">
                                    <div class="individual_comment">
                                        <div class="comment_user_info">
                                            <a href="javascript:" class="user_images">
                                                <?php if ($comments['commenter_name'] != 'hidden') { ?>
                                                    <img width="48" height="48" alt="User Picture" src="<?php echo $comments['commenter_image']; ?>">
                <?php } ?>
                                            </a>
                                            <div class="info">
                                                <a href="javascript:" class="uname"><?php echo ($comments['commenter_name'] == 'hidden') ? 'নাম প্রকাশে অনিচ্ছুক' : $comments['commenter_name']; ?></a>
                                                <div class="date_via">
                                                    <span class="comment_date"><?php echo toBangla($comments['create_time']); ?></span>
                                                    <span class="comment_via via_<?php echo $comments['device']; ?>" title="<?php echo $comments['device']; ?>">
                                                        <span>via <?php echo $comments['device']; ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment_portion">
                                            <p><?php echo $comments['comment']; ?></p>
                                        </div>
                                        <div class="comment_bottom">
                                            <div class="comment_data">
                                                <div class="comment_data_each">
                                                    <a href="javascript:" class="like_dislike like_btn like_count" data-content-id="<?php echo $comments['content_id']; ?>" data-comment-id="<?php echo $comments['comment_id']; ?>" data-type="like" title="Like"></a><span id="like_comment_<?php echo $comments['comment_id']; ?>"><?php echo $comments['like_count']; ?></span>
                                                </div>
                                                <div class="comment_data_each">
                                                    <a href="javascript:" class="like_dislike dislike_btn dislike_count" data-content-id="<?php echo $comments['content_id']; ?>" data-comment-id="<?php echo $comments['comment_id']; ?>" data-type="dislike" title="Dislike"></a><span id="dislike_comment_<?php echo $comments['comment_id']; ?>"><?php echo $comments['dislike_count']; ?></span>
                                                </div>
                                            </div>
                                            <div class="reply_button" style="display: none;">
                                                <a id="reply_id_57" class="reply_comment" rel="1">রিপ্লাই</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
            <?php } else { ?>
                                <li id="comment_<?php echo $comments['comment_id'] ?>">
                                    <div class="individual_comment">
                                        <div class="comment_user_info">
                                            <a href="javascript:" class="user_images">
                                                <?php if ($comments['commenter_name'] != 'hidden') { ?>
                                                    <img width="48" height="48" alt="User Picture" src="<?php echo $comments['commenter_image']; ?>">
                <?php } ?>
                                            </a>
                                            <div class="info">
                                                <a href="javascript:" class="uname"><?php echo ($comments['commenter_name'] == 'hidden') ? 'নাম প্রকাশে অনিচ্ছুক' : $comments['commenter_name']; ?></a>
                                                <div class="date_via">
                                                    <span class="comment_date"><?php echo toBangla($comments['create_time']); ?></span>
                                                    <span class="comment_via via_<?php echo $comments['device']; ?>" title="<?php echo $comments['device']; ?>">
                                                        <span>via <?php echo $comments['device']; ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment_portion">
                                            <p><?php echo $comments['comment']; ?></p>
                                        </div>
                                        <div class="comment_bottom">
                                            <div class="comment_data">
                                                <div class="comment_data_each">
                                                    <a href="javascript:" class="like_dislike like_btn like_count" data-content-id="<?php echo $comments['content_id']; ?>" data-comment-id="<?php echo $comments['comment_id']; ?>" data-type="like" title="Like"></a><span id="like_comment_<?php echo $comments['comment_id']; ?>"><?php echo $comments['like_count']; ?></span>
                                                </div>
                                                <div class="comment_data_each">
                                                    <a href="javascript:" class="like_dislike dislike_btn dislike_count" data-content-id="<?php echo $comments['content_id']; ?>" data-comment-id="<?php echo $comments['comment_id']; ?>" data-type="dislike" title="Dislike"></a><span id="dislike_comment_<?php echo $comments['comment_id']; ?>"><?php echo $comments['dislike_count']; ?></span>
                                                </div>
                                            </div>
                                            <div class="reply_button" style="display: none;">
                                                <a id="reply_id_57" class="reply_comment" rel="1">রিপ্লাই</a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul>
                <?php foreach ($comments['comment_replied'] as $k => $v) { ?>
                                            <li id="comment_<?php echo $v['comment_id'] ?>">
                                                <div class="individual_comment">
                                                    <div class="comment_user_info">
                                                        <a href="javascript:" class="user_images">
                                                            <?php if ($v['commenter_name'] != 'hidden') { ?>
                                                                <img width="48" height="48" alt="User Picture" src="<?php echo $v['commenter_image']; ?>">
                    <?php } ?>
                                                        </a>
                                                        <div class="info">
                                                            <a href="javascript:" class="uname"><?php echo ($v['commenter_name'] == 'hidden') ? 'নাম প্রকাশে অনিচ্ছুক' : $v['commenter_name']; ?></a>
                                                            <div class="date_via">
                                                                <span class="comment_date"><?php echo toBangla($v['create_time']); ?></span>
                                                                <span class="comment_via via_<?php echo $v['device']; ?>" title="<?php echo $v['device']; ?>">
                                                                    <span>via <?php echo $v['device']; ?></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment_portion">
                                                        <p><?php echo $v['comment']; ?></p>
                                                    </div>
                                                    <div class="comment_bottom">
                                                        <div class="comment_data">
                                                            <div class="comment_data_each">
                                                                <a href="javascript:" class="like_dislike like_btn like_count" data-content-id="<?php echo $v['content_id']; ?>" data-comment-id="<?php echo $v['comment_id']; ?>" data-type="like" title="Like"></a><span id="like_comment_<?php echo $v['comment_id']; ?>"><?php echo $v['like_count']; ?></span>
                                                            </div>
                                                            <div class="comment_data_each">
                                                                <a href="javascript:" class="like_dislike dislike_btn dislike_count" data-content-id="<?php echo $v['content_id']; ?>" data-comment-id="<?php echo $v['comment_id']; ?>" data-type="dislike" title="Dislike"></a><span id="dislike_comment_<?php echo $v['comment_id']; ?>"><?php echo $v['dislike_count']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                <?php } ?>
                                    </ul>
                                </li>   
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>
        <?php
//    echo '<pre>';
//    print_r($response);
//    echo '</pre>';
    if (isset($response['user'])) {
        ?>
        <div id="write_comments" class="write_comments_form dn clearfix">
            <form onsubmit="return false;" id="comment_form" name="comment_form" action="" method="post">
                <input type="hidden" name="fk_content_id" value="<?php echo $details['content_id']; ?>">
                <input type="hidden" name="parent" value="0">
                <input type="hidden" name="label_depth" value="0">
                <div class="textarea_holder comment_input input_wrap">
                    <textarea class="textarea jadewits_keyboard bangla-enabled banglaActive2009" name="comment" cols="40" rows="5" id="banglaEnabled1" index="1"></textarea>
                </div>
                <div class="text_holder">আপনার পরিচয় গোপন রাখতে    
                    <label><input class="checkbox checkbox-inline" type="checkbox" name="hidden_name" id="hidden_name" value="1"> এখানে ক্লিক করুন।</label>
                </div>
                <div class="text_holder">আমি <a target="_blank" href="http://www.banglatribune.com/user-terms-and-conditions">নীতিমালা</a> মেনে মন্তব্য করছি।</div>
                <div class="input_wrap">
                    <input type="button" class="button_light comment_submit" name="jadewits_insert_update" value="মন্তব্য">
                </div>
                <div class="comment_message"></div>
            </form>
        </div>
        <script type="text/javascript">
            jw_limit_text_chars({element: 'textarea[name=comment]', char_limit: 5000, language: 'bn'});
            function get_comments_first_label(comment_id, comment_status, like_me, dislike_me, user_name, user_profile_link, user_img_link, comment, create_time, content_id, like_count, dislike_count, label_depth, client_device) {
                comments_html = '';
                reply = '';
                if (comment_status == 'published' && label_depth == '0') {
                    reply = "<div class='reply_button'><a rel='1' class='reply_comment' id='reply_id_" + comment_id + "'>রিপ্লাই</a></div>";
                }
                else if (comment_status == 'pending') {
                    reply = "<div class='reply_button'>অপেক্ষমান</div>";
                }
                if (like_me == 1)
                    like_class = 'liked_this';
                else
                    like_class = 'like_count';
                if (dislike_me == 1)
                    dislike_class = 'disliked_this';
                else
                    dislike_class = 'dislike_count';
                if (user_name == 'hidden') {
                    get_user_name = "নাম প্রকাশে অনিচ্ছুক";
                    get_user_profile_image_link = '';
                }
                else {
                    get_user_profile_image_link = "<img height='48' width='48' src='" + user_profile_link + "' alt='User Picture'/>";
                    get_user_name = user_name;
                }

                create_time = languageNumber(create_time, 'bn');
                comments_html = comments_html + "<li id='comment_" + comment_id + "'>\<div class='individual_comment'>\<div class='comment_user_info'>\<a class='user_images' href='javascript:'>" + get_user_profile_image_link + "</a>\<div class='info'>\<a class=\"uname\" href='javascript:'>" + get_user_name + "</a>\<div class=\"date_via\">\<span class='comment_date'>" + create_time + " </span>\<span title=\"" + client_device + "\" class=\"comment_via via_" + client_device + "\">\<span>via " + client_device + "</span>\</span>\</div>\</div>\</div>\<div class='comment_portion'>\<p>" + comment + "</p>\</div>\<div class=\"comment_bottom\">\<div class='comment_data'>\<div class='comment_data_each'>\<a title='Like' data-type='like' data-comment-id='" + comment_id + "' data-content-id='" + content_id + "' class='like_dislike like_btn " + like_class + "'  href='javascript:'></a>\<span id='like_comment_" + comment_id + "'>" + like_count + "</span>\</div>\<div class='comment_data_each'>\<a title='Dislike' data-type='dislike' data-comment-id='" + comment_id + "' data-content-id='" + content_id + "' class='like_dislike dislike_btn " + dislike_class + "' href='javascript:'></a>\<span id='dislike_comment_" + comment_id + "'>" + dislike_count + "</span>\</div>\</div>\
                                                        " + reply + "\</div>\</div>";
                comments_html = comments_html + "</li>";
                return 	comments_html;
            }
    //            var limit = 5000;
    //            $('textarea[name=comment]').on('keyup', function (e) {
    //                if (e.which < 0x20) {
    //                    // e.which < 0x20, then it's not a printable character
    //                    // e.which === 0 - Not a character
    //
    //                    return; // Do nothing
    //                }
    //                var comment_char_counter = $(this).parent().find('.comment_char_count');
    //                if (!comment_char_counter.length) {
    //                    $(this).before('<div class="comment_char_count p10" align="left"></div>');
    //                    comment_char_counter = $(this).parent().find('.comment_char_count');
    //                }
    //                if (this.value.length <= 1) {
    //                    //$(this).before('<div class="comment_char_count p10">' + languageNumber(this.value.length + '/' + limit) + '</div>');
    //                } else if (this.value.length < 5000) {
    //                    //$(this).prev('div').html(languageNumber(this.value.length + '/' + limit));
    //                } else if (this.value.length == 5000) {
    //                    //$(this).prev('div').html(languageNumber(this.value.length + '/' + limit));
    //                    e.preventDefault();
    //                } else if (this.value.length > 5000) {
    //                    // Maximum exceeded
    //                    this.value = this.value.substring(0, 5000);
    //                }
    //                comment_char_counter.html(languageNumber($(this).val().length,'bn')+'/'+languageNumber(limit,'bn'));
    //            });
            var user_check = <?php echo isset($response['user']) ? $response['user']['user_id'] : 'undefined'; ?>;
            var fk_content_id = document.getElementsByName('fk_content_id')[0].value;
            $('.comment_submit').on('click', function () {
                var theForm = $('#comment_form');
                if (!$('[name="comment"]', theForm).val()) {
                    alert('Please write your comment.');
                    return false;
                }
                var data = theForm.serialize();
                $(":input", theForm).attr("disabled", true);
                if (typeof (user_check) != 'undefined') {
                    $.ajax({
                        cache: false,
                        type: 'post',
                        data: data,
                        url: base_url + 'ajax_comment',
                        dataType: 'json',
                        //beforeSend: function(){},
                        success: function (reply_data) {
                            console.log(reply_data);
                            if (reply_data['error'])
                                $('.comment_message', theForm).html(reply_data['error']);
                            else {
                                comm = get_comments_first_label(reply_data['success']['comment_id'], reply_data['success']['comment_status'], reply_data['success']['like_me'], reply_data['success']['dislike_me'], reply_data['success']['commenter_name'], reply_data['success']['commenter_image'], reply_data['success']['commenter_profile_link'], reply_data['success']['comment'], reply_data['success']['create_time'], reply_data['success']['content_id'], reply_data['success']['like_count'], reply_data['success']['dislike_count'], reply_data['success']['label_depth'], reply_data['success']['device']);
                                $('.comment_message', theForm).html('মন্তব্য করার জন্য ধন্যবাদ, আপনার মন্তব্যটি প্রকাশের জন্য অপেক্ষমান');
                                $('[name=comment]', theForm).val('');
                                $('.comments_holder_ul').append(comm);
                            }
                            $(":input", theForm).attr("disabled", false);
                        },
                        error: function () {
                            $('.comment_message', theForm).html('অপ্রত্যাশিত ভুল।');
                            $(":input", theForm).attr("disabled", false);
                        }
                    });
                } else {
                    alert('Please login again to post a comment');
                    return false;
                }
            });</script>
        <?php
    } else {
        ?>
        <li class="login-link">মন্তব্য করতে <a href="<?php echo $response['login_link'] . urlencode(base_url() . $this->uri->uri_string()); ?>">লগইন</a> করুন</li>
            <?php
        }
        ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var url_en = '<?php echo $url_web ?>';
        $.get("https://api.facebook.com/method/links.getStats", {urls: url_en, format: "JSON"}).done(function (data) {
            $(data).each(function (i, v) {
                if (v.share_count != 0) {
                    $('.ss_facebook .ss_count').html(v.total_count);
                    $('.ss_facebook .ss_count').show();
                }
            });
        });
        var all_image = $("#content").find("img");
        var all_youtube = $("#content").find("iframe");
        $(all_image).each(function (i, v) {
            if ($(v).attr('width') >= 400) {
                var myStr = $(v).attr('src').split("/");
                myStr[6] = '400x0x1';
                var tem = myStr.join('/');
                $(v).attr('src', tem);
                $(v).attr('width', '400');
            }
            if ($(v).attr('title') != null) {
                $(v).after('<span class="media_caption"><b>' + $(v).attr('title') + '</b></span>');
                $(this).next('span').andSelf().wrapAll('<div id="media_' + i + '" style="width:' + $(this).attr('width') + 'px" class="mediaContent ' + $(this).attr('class') + '"></div>');
            } else {
                $(this).wrapAll('<div id="media_' + i + '" style="width:' + $(this).attr('width') + '" class="mediaContent ' + $(this).attr('class') + '"></div>');
            }
        });
        var width = $(window).width();
        var height = width/1.6;
        $(all_youtube).each(function(ind,ele){
            if(width<801) {
                $(ele).attr('width',width);
                $(ele).attr('height',height);
            } else {
                return;
            }
        });
    });
</script>
<?php $this->load->view('includes/footer'); ?>