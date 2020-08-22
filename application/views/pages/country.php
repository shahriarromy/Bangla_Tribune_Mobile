<?php
if (isset($error)) {
    echo '<p>' . $error . '</p>';
}
$temp_active = "";
if ($active == 'topic') {
    $temp_active = $active;
    $active = base_url() . $this->uri->uri_string();
} else {
    $temp_active = $active;
    $active = base_url() . $active;
}
$cache_ext = '.html'; //file extension
$cache_time = 120;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder = "/var/www/btdocs/mobdocs/cache_dir/"; //folder to store Cache files
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
$this->load->view('includes/header');
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
            <a href="http://admissions.ulab.edu.bd/" target="_blank" onclick="ga('set', 'nonInteraction', true);ga('send', 'event', {eventCategory: 'advertisement', eventAction: 'click', eventLabel: 'ULAB'});">
                <img src="http://cdn.banglatribune.com/contents/uploads/media/2016/08/28/877c05fc19ae1f30ce51b5572505d182-57c2cbc7dfbaf.gif" onload="ga('set', 'nonInteraction', true);ga('send', 'event', {eventCategory: 'advertisement', eventAction: 'Impression', eventLabel: 'ULAB'});" alt="ULAB">
            </a>
        </div>
    </div>
<?php } ?>
<div class="categoryContainer country">
    <div class="article LeftalignedImg categoryPage">
        <div class="inner clearfix">
            <ul>
                <?php

                foreach ($details['data'] as $value) {
                        ?>
                        <li>
                            <div class="left_item clearfix">
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
                ?>
            </ul>
        </div>
        <div class="pagination">
            <a style="<?php if (!$this->input->get('page') && $back == 0) echo 'display:none'; ?>" href="<?php echo $back != 0 ? $active . '?page=' . $back : $active; ?>" class="next_page"><span>&lt;&lt;</span></a>
            <a style="<?php if (count($details['data']) < 10) echo 'display:none'; ?>" href="<?php echo $active . '?page=' . $limit; ?>" class="next_page"><span>&gt;&gt;</span></a></div>
    </div>
</div>
<?php
$this->load->view('includes/footer');
if (!$ignore) {
    $fp = fopen($cache_file, 'w');  //open file for writing
    fwrite($fp, ob_get_contents()); //write contents of the output buffer in Cache file
    fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering