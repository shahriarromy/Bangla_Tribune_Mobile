<?php
if (isset($error)) {
    echo '<p>' . $error . '</p>';
}
if($cache_disable == 1){
echo '<p>'.$cache_disable.'</p>';
}
$temp_active = "";
if ($active == 'topic' || $active == 'archive') {
    $temp_active = $active;
    $active = base_url() . $this->uri->uri_string();
} else {
    $temp_active = $active;
    $active = base_url() . $active;
}
$cache_ext = '.html'; //file extension
$cache_time = 10;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder = "cache/";
if (ENVIRONMENT == 'production') {
    $cache_folder = "/var/www/html/btdocs/mobdocs/cache_dir/";
    $cache_time = 2;
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
//echo '<pre>';
//print_r( media_image_url_formating_160_90($details['data']['c_78985']['content_thumbnail_image']));
//echo '</pre>';
?>
<div class="breadcrumb clearfix">
    <ul>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="<?php echo base_url(); ?>"><strong itemprop="title">হোম</strong></a></li>
        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><a itemprop="url" href="<?php echo $active; ?>"><strong itemprop="title"><?php echo $pagination; ?></strong></a></li>
    </ul>
</div>
<?php if ($temp_active == 'sport') { ?>
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
<div class="categoryContainer country">
    <div class="article LeftalignedImg categoryPage">
        <div class="inner clearfix">
            <ul>
                <?php
                $i = 0;
                foreach ($details['data'] as $value) {
                    if ($i == 5) {
                        ?>
                        <li>
                            <div class="left_item clearfix">
                                <div class="leftImg_title">
                                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_resize($value['content_thumbnail_image'],170,96); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                                </div>
                                <div class="right_content">
                                    <h2 class="title_holder">
                                        <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                                            <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                                            <span class="title"><?php echo $value['title']; ?></span>
                                        </a>
                                    </h2>
        <?php if ($temp_active == 'columns') { ?>
                                        <div class="author_time_holder">
                                            <div class="author_holder"><span class="author"><?php echo $value['author_display_name']; ?></span></div>
                                        </div>
        <?php } ?>
                                    <div class="summery">
                                        <a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo limit_words($value['excerpt'], 15); ?><span class="excerpt_more" title="বিস্তারিত"><span>বিস্তারিত</span></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!--dw news box-->
                        <div class="aligncenter" style="">
                            <a style="max-width: 300px;overflow:hidden;" href="https://www.dw.com/bn/%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F/s-11929?maca=ben-CB_ben_BanglaTribune-20061-html-cb" target="_blank">
                                <img src="http://cdn.banglatribune.com/contents/uploads/media/2017/12/16/ac40ef534b2d800bb99ed40961838ae5-5a35153bb132f.jpg" alt="">
                            </a>
                        </div>
                        <!--dw news box end-->
                    <?php } else {
                        ?>
                        <li>
                            <div class="left_item clearfix">
                                <div class="leftImg_title">
                                    <div class="imgContainer leftImg"><a href="<?php echo url_format_fnc($value['web_url']) ?>"><img class="thumb" src="<?php echo media_image_resize($value['content_thumbnail_image'],170,96); ?>" alt="<?php echo $value['title']; ?>"></a></div>
                                </div>
                                <div class="right_content">
                                    <h2 class="title_holder">
                                        <a href="<?php echo url_format_fnc($value['web_url']) ?>">
                                            <span class="subtitle"><?php echo $value['subtitle']; ?></span>
                                            <span class="title"><?php echo $value['title']; ?></span>
                                        </a>
                                    </h2>
        <?php if ($temp_active == 'columns') { ?>
                                        <div class="author_time_holder">
                                            <div class="author_holder"><span class="author"><?php echo $value['author_display_name']; ?></span></div>
                                        </div>
        <?php } ?>
                                    <div class="summery">
                                        <a href="<?php echo url_format_fnc($value['web_url']); ?>"><?php echo limit_words($value['excerpt'], 15); ?><span class="excerpt_more" title="বিস্তারিত"><span>বিস্তারিত</span></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    $i++;
                }
                ?>
            </ul>
        </div>
        <div class="pagination">
            <a style="<?php if (!$this->input->get('page') && $back == 0) echo 'display:none'; ?>" href="<?php echo $back != 0 ? $active . '?page=' . $back : $active; ?>" class="next_page"><span>&lt;&lt;</span></a>
            <a style="<?php if (count($details['data']) < 10) echo 'display:none'; ?>" href="<?php echo $active . '?page=' . $limit; ?>" class="next_page"><span>&gt;&gt;</span></a>
        </div>
    </div>
    <div class="aligncenter box_shadows">
        <div style="max-width:336px;height:280px;margin:0 auto;">
            <script>
                googletag.cmd.push(function () {
                    googletag.defineSlot('/67573540/bt_adsense_336x280', [336, 280], 'div-gpt-ad-1508924860929-0').addService(googletag.pubads());
                    googletag.pubads().enableSingleRequest();
                    googletag.pubads().collapseEmptyDivs();
                    googletag.enableServices();
                });
            </script>
            <!-- /67573540/bt_adsense_336x280 -->
            <div id='div-gpt-ad-1508924860929-0' style='height:280px; width:336px;'>
                <script>
                    googletag.cmd.push(function () {
                        googletag.display('div-gpt-ad-1508924860929-0');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
if (!$ignore) {
    //$fp = file_get_contents($cache_file);
    $fp = ob_get_contents();
    //$fp = fopen($cache_file, 'w');  //open file for writing
    file_put_contents($cache_file, $fp); //write contents of the output buffer in Cache file
    //fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering
