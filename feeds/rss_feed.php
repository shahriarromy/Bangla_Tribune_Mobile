<?php
include('simple_html_dom.php');
require_once 'vendor/autoload.php';
include_once 'connection.php';

use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Elements\Header;
use Facebook\InstantArticles\Elements\Time;
use Facebook\InstantArticles\Elements\Ad;
use Facebook\InstantArticles\Elements\Analytics;
use Facebook\InstantArticles\Elements\Author;
use Facebook\InstantArticles\Elements\Image;
use Facebook\InstantArticles\Elements\Video;
use Facebook\InstantArticles\Elements\Caption;
use Facebook\InstantArticles\Elements\Footer;
use Facebook\InstantArticles\Transformer\Transformer;
use Facebook\InstantArticles\Client\Client;
use Facebook\InstantArticles\Client\Helper;
use Facebook\InstantArticles\Validators\Type;
use Facebook\Facebook;

class mbcount {

    public function __construct() {
        $this->counts = 0;
    }

    public function parsetext($text) {
        // parses text and sets literals A - C to lower case 
        // this works 
        return preg_replace_callback('#(<p>.*?</p>)#', 'mbcount::callback_func', $text);
    }

    public function callback_func($matches) {
        $ret = $matches[1];
        if (++$this->counts == 2) {
            $ret .= '<iframe class="vision_if" src="http://service.banglatribune.com/ads/vision/index.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="320" height="60"></iframe>';
            $ret .= '<iframe class="rfl_if" src="http://service.banglatribune.com/ads/rfl/index.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="320" height="60"></iframe>';
        }
        return $ret;
    }

}

class rss_feed {

    /**
     * Constructor
     *
     * @param array $a_db database settings
     * @param string $xmlns XML namespace
     * @param array $a_channel channel properties
     * @param string $site_url the URL of your site
     * @param string $site_name the name of your site
     * @param bool $full_feed flag for full feed (all topic content)
     */
    private $APP_ID = '';
    private $APP_SECRET = '';
    private $PAGE_ID = '';
    //private $ACCESS_TOKEN = '';
    private $ACCESS_TOKEN = '';
    private $client;
    private $is_development = false;
    private $is_published = false;
    private $IA_PLUGIN_VERSION = 'v1.0';
    private $cache;
    private $environment = 'server';

    public function __construct() {
        // initialize
        if ($this->environment == 'server') {
            $this->cache = new Memcached();
            $this->cache->addServer('127.0.0.1', 11311);
            $this->cache->addServer('127.0.0.1', 11411);
            $this->cache->addServer('127.0.0.1', 11511);
        } else {
            $this->cache = new Memcache();
            $this->cache->addServer('127.0.0.1', 11211);
        }
    }

    function get_from_cache($lang) {
        $alls = $this->cache->get('for_feed');
        return $alls[0]['bn'];
    }

    function media_image_url_formating_304_171($content_img) {
        $exp_url = explode('/', $content_img);
        $exp_url[6] = '400x225x1';
        $imp_url = implode('/', $exp_url);
        return 'http:' . $imp_url;
    }

    function category_name($url,$lan) {
        $cat = explode('/', $url);
        switch ($cat[3]) {
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
                $pagination_name = 'লাইফস্টাইল';
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
            default:
                $pagination_name = 'নিউজ';
                break;
        }
        return $pagination_name;
    }

    private function processDescription($contents,$initials) {
        $newcontent = preg_replace('#<br\s*/?>#', "</p><p>", $contents); //replace <br> with <p></p>
        $pStart = preg_replace('/<p>(<img[^>]*>)/', '$1<p>', $newcontent); //send p start tag to end from img start
        $pClose = preg_replace('/(<img[^>]*>)<\/p>/', '</p>$1', $pStart); //send p close tag to start from img end
        //remove strong with p
        $pStrongStart = preg_replace('/<p><strong>(<img[^>]*>)/', '$1<p><strong>', $pClose); //send p start tag to end from img start
        $pStrongClose = preg_replace('/(<img[^>]*>)<\/strong><\/p>/', '</strong></p>$1', $pStrongStart); //send p close tag to start from img end

        $without_class = preg_replace('/ class=".*?"/', '', $pStrongClose); //remove all classes
        $iframeTrim = preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $without_class); //remove p from iframe
        //$imgTrim = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html_xml);//remove p from img
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<html><head><meta charset="UTF-8" /></head><body>' . $iframeTrim . '</body></html>');
        $coverimage = $dom->getElementsByTagName('img')->item(0);
        if (!empty($coverimage))
            $coverimage->parentNode->removeChild($coverimage);
        $bodyNode = $dom->getElementsByTagName('body')->item(0);
        $allImage = $dom->getElementsByTagName('img');
        foreach ($allImage as $allimg) {
            $allimg->removeAttribute('data-jadewitsmedia');
            $allimg->removeAttribute('title');
            $allimg->removeAttribute('alt');
            $allimg->removeAttribute('itemprop');
        }
        $results = '';
        foreach ($bodyNode->childNodes as $childNode) {
            $results .= ($childNode->nodeType === XML_TEXT_NODE) ? '<p>' . $dom->saveHTML($childNode) . '</p>' : $dom->saveHTML($childNode);
        }
        $content = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si", "!</body></html>$!si"), "", $results);
        //$add_p = preg_replace('/^(?!<).*(?!>)/m', '<p>$0</p>', $iframeTrim);//add p in unwraped text
        /* $without_p = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $content);//remove empty <p> */
        $without_p = preg_replace('/<p[^>]*>[\s|&nbsp;]*<\/p>/', '', $content); //remove empty <p>
        $without_empty = preg_replace('/<[^\/>]*>([\s]?)*<\/[^>]*>/', '', $without_p); //remove any empty <tag>
        // $mbcount = new mbcount();
        // $lastContent = $mbcount->parsetext($without_empty);
        $without_empty .= '<p>' . $initials . '</p>';
        return $without_empty;
    }

    private function push_article($rss_item = array(),$language) {
        $this->client = Client::create(
                        $this->APP_ID, $this->APP_SECRET, $this->ACCESS_TOKEN, $this->PAGE_ID, $this->is_development
        );
        if (!empty($rss_item['subtitle'])) {
            $titles = '<h2>' . $rss_item['subtitle'] . '</h2><h1>' . $rss_item['title'] . '</h1>';
        } else {
            $titles = '<h1>' . $rss_item['title'] . '</h1>';
        }
        $header = Header::create()
                ->withPublishTime(
                        Time::create(Time::PUBLISHED)->withDatetime(
                                \DateTime::createFromFormat(
                                        'j-M-Y G:i:s', date('j-M-Y G:i:s', strtotime($rss_item['published_time']))
                        ))
                )
                ->withModifyTime(
                        Time::create(Time::MODIFIED)->withDatetime(
                                \DateTime::createFromFormat(
                                        'j-M-Y G:i:s', date('j-M-Y G:i:s', strtotime($rss_item['modified_time']))
                        ))
                )
                ->withTitle($rss_item['title'])
                ->withKicker($this->category_name($rss_item['web_url'],$language));
        $rules_file_content = file_get_contents("rules.json", true);
        $transformer = new Transformer();
        $transformer->loadRules($rules_file_content);
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="utf-8" ?><h1>' . $rss_item['title'] . '</h1>');
        libxml_use_internal_errors(false);
        $transformer->transform($header, $document);
        $fragment = $document->createDocumentFragment();
        if($language == 'bn') {
            $fragment->appendXML(
                    "<!-- Start Alexa Certify Javascript -->
                        <script type='text/javascript'>
                        _atrk_opts = { atrk_acct:'i1wLl1aU8KL34B', domain:'banglatribune.com',dynamic: true};
                        (function() { var as = document.createElement(\'script\'); as.type = \'text/javascript\'; as.async = true; as.src = 'https://d31qbv1cthcecs.cloudfront.net/atrk.js'; var s = document.getElementsByTagName(\'script\')[0];s.parentNode.insertBefore(as, s); })();
                        </script>
                        <noscript><img src='https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=i1wLl1aU8KL34B' style='display:none' height='1' width='1' alt='' /></noscript>
                        <!-- End Alexa Certify Javascript --><script>(function (i, s, o, g, r, a, m) {
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
                        ga('create', 'UA-71788435-5', 'auto', 'trackerB');
                        ga('require', 'displayfeatures');
                        ga('set', 'campaignSource', 'Facebook');
                        ga('trackerB.set', 'campaignSource', 'Facebook');
                        ga('set', 'campaignMedium', 'Social Instant Article');
                        ga('trackerB.set', 'campaignMedium', 'Social Instant Article');
                        ga('send', 'pageview', {title: '" . $rss_item['title'] . "'});
                        ga('trackerB.send', 'pageview', {title: '" . $rss_item['title'] . "'});
                    </script>"
            );
        }
        if ($rss_item['subtitle']) {
            $header->withSubTitle($rss_item['subtitle']);
        }
        $header->withCover(
                Image::create()
                        ->withURL($this->media_image_url_formating_304_171($rss_item['content_thumbnail_image']))
        );
        $header->addAuthor(
                Author::create()
                        ->withName($rss_item['author_display_name'])
        );
        $ads[0] = Ad::create()
                ->withSource('https://www.facebook.com/adnw_request?placement=563284084109581_563284100776246&adtype=banner300x250')
                ->withWidth('300')
                ->withHeight('250');
        $header->withAds($ads);
        $instant_article = InstantArticle::create()
                ->withCanonicalUrl($rss_item['web_url'])
                ->withHeader($header)
                ->addMetaProperty('op:generator:application', 'facebook-instant-articles')
                ->addMetaProperty('op:generator:application:version', $this->IA_PLUGIN_VERSION)
                ->addMetaProperty('fb:likes_and_comments', 'enable')
                ->addMetaProperty('fb:use_automatic_ad_placement', 'true')
                ->addChild(
                Analytics::create()
                ->withHTML($fragment)
        );
        $instant_article->withStyle('bangla');
        $coverted_content = $this->processDescription($rss_item['description'],$rss_item['initials']);
        $transformer->transformString($instant_article, $coverted_content, 'utf-8');
        $error = array();
        try {
            $this->client->importArticle($instant_article, $this->is_published);
        } catch (Exception $e) {
            $error[$rss_item['content_id']] = $e->getMessage();
        }
        return $error;
    }

    public function create_feed() {

        $rss_items_bn = $this->get_from_cache('bn');
        // $rss_items_en = $this->get_from_cache('en');
        $this->prepare_lang($rss_items_bn,'bn');
        // $this->prepare_lang($rss_items_en,'en');
//        var_dump($rss_items);
//        exit();
    }
    private function prepare_lang($items,$lang){
        $error = array();
        foreach ($items as $item) {
            $error[] = $this->push_article($item,$lang);
        }
        return $error;
    }

    public function single_article($id) {
        error_reporting(E_ALL);
        $url = 'http://www.banglatribune.com/api/mobile_api/get_contents?APP_ID=1&content_id=' . $id;
        $content = $this->cache->get('ia_content_' . $id);
        if ($content) {
            $result = $this->push_article($content);
        } else {
            $content = curl_api_call(
                    array(
                        'url' => $url,
                        'post_data' => array(
                            'APP_KEY' => '2theWorldwar'
                        )
            ));
            $this->cache->delete('ia_content_' . $id);
            $this->cache->set('ia_content_' . $id, $content, 180);
            $result = $this->push_article($content);
        }
        return $result;
    }

}
