<?php
require_once 'rss_feed.php';// configure appropriately
$rss = new rss_feed();
$rss->create_feed();
//print_r($rss->create_feed());
//echo $rss->create_feed();