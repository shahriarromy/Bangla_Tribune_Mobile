<?php
include('simple_html_dom.php');
class mbcount {
    public function __construct() {
        $this->counts = 0;
    }
    public function parsetext($text){ 
        // parses text and sets literals A - C to lower case 
        // this works 
        return preg_replace_callback('#(<p>.*?</p>)#', 'mbcount::callback_func', $text); 
    }    
    public function callback_func($matches) {
        $ret = $matches[1];
        if (++$this->counts == 2) {
            $ret .= '<figure class="op-interactive vision"><iframe class="vision_if" src="http://service.banglatribune.com/ads/vision/index.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="420" height="80"></iframe></figure><figure class="op-interactive rfl"><iframe class="rfl_if" src="http://service.banglatribune.com/ads/rfl/index.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="420" height="80"></iframe></figure>';
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
    public function __construct($xmlns, $a_channel = array(), $site_url, $site_name) {
        // initialize
        $this->xmlns = ($xmlns ? ' ' . $xmlns : '');
        $this->channel_properties = $a_channel;
        $this->site_url = $site_url;
        $this->site_name = $site_name;
    }

    function get_from_cache() {
        $cache = new Memcached();
        $cache->addServer('127.0.0.1', 11311);
        $cache->addServer('127.0.0.1', 11411);
        $cache->addServer('127.0.0.1', 11511);
        $alls = $cache->get('for_feed');
        return $alls[0];
    }

//    function get_from_cache() {
//        $cache = new Memcache();
//        $cache->addServer('127.0.0.1', 11211);
//        $alls = $cache->get('for_feed');
//        return $alls[0];
//    }

    function media_image_url_formating_304_171($content_img) {
        $exp_url = explode('/', $content_img);
        $exp_url[6] = '400x225x1';
        $imp_url = implode('/', $exp_url);
        return $imp_url;
    }

    function category_name($url) {
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
    
    public function create_feed() {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<rss version="2.0"' . $this->xmlns . '>' . "\n";
        // channel required properties
        $xml .= '<channel>' . "\n";
        $xml .= '<title>' . $this->channel_properties["title"] . '</title>' . "\n";
        $xml .= '<link>' . $this->channel_properties["link"] . '</link>' . "\n";
        $xml .= '<description>' . $this->channel_properties["description"] . '</description>' . "\n";
        // channel optional properties
        if (array_key_exists("language", $this->channel_properties)) {
            $xml .= '<language>' . $this->channel_properties["language"] . '</language>' . "\n";
        }
        if (array_key_exists("image_title", $this->channel_properties)) {
            $xml .= '<image>' . "\n";
            $xml .= '<title>' . $this->channel_properties["image_title"] . '</title>' . "\n";
            $xml .= '<link>' . $this->channel_properties["image_link"] . '</link>' . "\n";
            $xml .= '<url>' . $this->channel_properties["image_url"] . '</url>' . "\n";
            $xml .= '</image>' . "\n";
        }
        $rss_items = $this->get_from_cache();
//        var_dump($rss_items);
//        exit();
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        foreach ($rss_items as $rss_item) {
            if (!empty($rss_item['subtitle'])) {
                $titles = '<h2>'.$rss_item['subtitle'] . '</h2><h1>' . $rss_item['title'].'</h1>';
            } else {
                $titles = '<h1>' . $rss_item['title'].'</h1>';
            }
            $xml .= '<item>' . "\n";
            $xml .= '<title><![CDATA[' . $rss_item['title'] . ']]></title>' . "\n";
            $xml .= '<link>' . $rss_item['web_url'] . '</link>' . "\n";
            $xml .= '<category>' . $this->category_name($rss_item['web_url']) . '</category>' . "\n";
            $xml .= '<author>' . $rss_item['author_display_name'] . '</author>' . "\n";
            $xml .= '<description><![CDATA[' . $rss_item['excerpt'] . ']]></description>' . "\n";
            $xml .= '<pubDate>' . date('D, d M Y H:i:s O', strtotime($rss_item['published_time'])) . '</pubDate>' . "\n";
//            $dom->loadHTML(mb_convert_encoding($rss_item['description'], 'HTML-ENTITIES', 'UTF-8'));
//            $content = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si", "!</body></html>$!si"), "", $dom->saveHTML());
            //$result = preg_replace('/(<img[^>]+>(?:<\/img>)?)/i', '$1<br />', $content);//add br after
            //$decoded = html_entity_decode(trim($content));
            $newcontent = preg_replace('#<br\s*/?>#', "</p><p>", $rss_item['description']);//replace <br> with <p></p>
            $pStart = preg_replace('/<p>(<img[^>]*>)/', '$1<p>', $newcontent);//send p start tag to end from img start
            $pClose = preg_replace('/(<img[^>]*>)<\/p>/', '</p>$1', $pStart);//send p close tag to start from img end
            //remove strong with p
            $pStrongStart = preg_replace('/<p><strong>(<img[^>]*>)/', '$1<p><strong>', $pClose);//send p start tag to end from img start
            $pStrongClose = preg_replace('/(<img[^>]*>)<\/strong><\/p>/', '</strong></p>$1', $pStrongStart);//send p close tag to start from img end
            
            $without_class = preg_replace('/ class=".*?"/', '', $pStrongClose);//remove all classes
            $iframeTrim = preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $without_class);//remove p from iframe
            //$imgTrim = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html_xml);//remove p from img
            //$dom = new DOMDocument();
            
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
            /*$without_p = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $content);//remove empty <p>*/
            $without_p = preg_replace('/<p[^>]*>[\s|&nbsp;]*<\/p>/', '', $content);//remove empty <p>
            $without_empty = preg_replace('/<[^\/>]*>([\s]?)*<\/[^>]*>/', '', $without_p);//remove any empty <tag>
            $mbcount = new mbcount();
            $lastContent = $mbcount->parsetext($without_empty);
            $xml .= '<content:encoded>';
            $xml .= '<![CDATA[';
            $xml .= '<!doctype html>';
            $xml .= '<html lang="en" prefix="op: http://media.facebook.com/op#">';
            $xml .= '<head>';
            $xml .= '<meta charset="utf-8">';
            $xml .= '<link rel="canonical" href="' . $rss_item['web_url'] . '">';
            $xml .= '<title>' . $rss_item['title'] . '</title>';
            $xml .= '<meta property="op:markup_version" content="v1.0">';
            $xml .= '<meta property="fb:article_style" content="default">';
            $xml .= '<meta property="fb:likes_and_comments" content="enable">';
            $xml .= '<meta property="fb:use_automatic_ad_placement" content="true">';
            $xml .= '</head>';
            $xml .= '<body>' . "\n";
            $xml .= '<article>' . "\n";
            $xml .= '<figure class="op-tracker"><iframe>' . "\n";
            $xml .= '<!-- Start Alexa Certify Javascript -->
                    <script type="text/javascript">
                    _atrk_opts = { atrk_acct:"i1wLl1aU8KL34B", domain:"banglatribune.com",dynamic: true};
                    (function() { var as = document.createElement(\'script\'); as.type = \'text/javascript\'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName(\'script\')[0];s.parentNode.insertBefore(as, s); })();
                    </script>
                    <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=i1wLl1aU8KL34B" style="display:none" height="1" width="1" alt="" /></noscript>
                    <!-- End Alexa Certify Javascript -->' . "\n";
            $xml .= "<script>(function (i, s, o, g, r, a, m) {
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
                    </script>
                </iframe>
            </figure>";
            $xml .= '<header><figure class="op-ad"><iframe width="300" height="250" style="border:0; margin:0;" src="https://www.facebook.com/adnw_request?placement=1807042432871602_1807052426203936&adtype=banner300x250"></iframe></figure>';
            $xml .= '<figure><img src="http:' . $this->media_image_url_formating_304_171($rss_item['content_thumbnail_image']) . '" alt=""></figure>' . $titles . '<address><a>' . $rss_item['author_display_name'] . '</a></address><h3 class="op-kicker">' . $this->category_name($rss_item['web_url']) . '</h3>';
            $xml .= '<time class="op-modified" datetime="' . date('Y-m-d\TH:i:sP', strtotime($rss_item['modified_time'])) . '">' . date('Y-m-d\TH:i:sP', strtotime($rss_item['modified_time'])) . '</time>';
            $xml .= '<time datetime="' . date('Y-m-d\TH:i:sP', strtotime($rss_item['published_time'])) . '" class="op-published"></time>';
            $xml .= '</header>';
            $xml .= $lastContent;
            $xml .= '<p>'.$rss_item['initials'].'</p>';
            //$xml .= '<footer><aside>Bangla Tribune</aside><small>&copy; '.date('Y').'</small></footer>';
            $xml .= '<figure class="op-interactive ipdc_60"><iframe class="ipdc_60_if" src="http://service.banglatribune.com/ads/ipdc/435x250.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="300" height="250" frameborder="0"></iframe></figure>';
            $xml .= '<figure class="op-interactive square"><iframe class="square_if" src="http://service.banglatribune.com/ads/square/index.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="420" height="110"></iframe></figure>';
            $xml .= '<figure class="op-interactive asus"><iframe class="asus_if" src="http://service.banglatribune.com/ads/asus/300x250_Canvas.html" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="420" height="80" frameborder="0"></iframe></figure>';
            $xml .= '</article>';
            $xml .= '</body>';
            $xml .= '</html>';
            $xml .= ']]>';
            $xml .= '</content:encoded>' . "\n";
            $xml .= '</item>' . "\n";
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        return $xml;
    }

}