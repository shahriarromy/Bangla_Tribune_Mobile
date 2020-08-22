<?php
require_once 'rss_feed.php';// configure appropriately
$url = 'http://www.banglatribune.com/sport/news/268997/%E0%A6%AE%E0%A6%BE%E0%A6%B0%E0%A7%8D%E0%A6%B6%E0%A7%87%E0%A6%B0-%E0%A6%B8%E0%A7%87%E0%A6%9E%E0%A7%8D%E0%A6%9A%E0%A7%81%E0%A6%B0%E0%A6%BF%E0%A6%A4%E0%A7%87-%E0%A6%87%E0%A6%82%E0%A6%B2%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A8%E0%A7%8D%E0%A6%A1%E0%A7%87%E0%A6%B0-%E0%A6%85%E0%A6%B8%E0%A7%8D%E0%A6%AC%E0%A6%B8%E0%A7%8D%E0%A6%A4%E0%A6%BF';
$id = explode('/', $url);
if (is_numeric($id[5])) {
    $rss = new rss_feed();
    $returns = $rss->single_article($id[5]);
    print_r($returns);
} else {
    echo 'Please enter a valid url';
}
