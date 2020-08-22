<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
        $this->APP_KEY = 'APP_KEY=key';
        $this->api_url = 'http://www.banglatribune.com/api/mobile_api/get_contents?APP_ID=1';
        //$this->api_url_with_limit_for_news = $this->api_url.'&start=0&limit=10&content_types=news&pages=';
        $this->detailed_article = $this->api_url . '&content_id=';
        $this->featured_url = $this->api_url . '&start=0&limit=20&content_types=news&special_filter=featured';
        $this->featured_column_url = $this->api_url . '&start=0&limit=5&content_types=opinion&special_filter=featured';
        $this->most_read = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=view_count';
        $this->editors_picks = $this->api_url . '&start=0&limit=5&content_tags=269';
        $this->current_home = $this->api_url . '&start=0&limit=5&content_tags=122';
        $this->tag_api = $this->api_url . '&start=0&limit=5&content_tags=';
        $this->exclusive_home = $this->api_url . '&start=0&limit=5&content_types=news&content_tags=25&special_filter=latest';
        $this->entertainment_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=712&special_filter=latest';
        $this->sports_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=710&special_filter=latest';
        $this->foreign_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=719&special_filter=latest';
        $this->leadsoftheworld_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=883&special_filter=latest';
        $this->lifestyle_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=722&special_filter=latest';
        $this->business_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=720&special_filter=latest';
        $this->latest = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=latest';
    }

    public function index($seg) {
        if (!empty($seg)) {
            if ($this->uri->total_segments() == 1) {
                $data = array();
                $data = $this->segment_cat($seg);
                if (isset($data['page_id'])) {
                    $cache = $this->cache->memcached->get('category' . $data['page_id']);
                    $data['api_url'] = $this->api_url . '&content_types=' . $data['content_types'] . '&pages=';
                    if (!$cache) {
                        $server_direct = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
                        $data['details'] = $server_direct['data'];
                        if (!isset($data['details']['error'])) {
                            $this->cache->memcached->save('category' . $data['page_id'], $data['details'], 180);
                        } else {
                            $data['error'] = $data['details']['error'];
                        }
                    } else {
                        $data['details'] = $cache;
                    }
                    $data['pagetitle'] = $data['pagination'];
                    $data['active'] = $this->uri->segment(1);
                    
                } else {
                    $this->load->view('pages/not_found', $data);
                }
            } else {
                $this->load->view('pages/not_found');
            }
        } else {
            redirect(base_url());
        }
    }
    function all_details(){
        sleep(20);
        $data = $this->cache->memcached->get('bt_breaking_most_read');
        $feed = array();
        foreach ($data['latest']['data'] as $datas) {
            $feed[] = $this->common->doCURLRequest($this->detailed_article.$datas['content_id'], $this->APP_KEY);
            sleep(1);
        }
        $this->cache->memcached->delete('for_feed');
        $this->cache->memcached->save('for_feed', $feed);
    }

    private function segment_cat($seg) {
        switch ($seg) {
            case 'national':
                $data['pagination'] = 'জাতীয়';
                $data['page_id'] = '963';
                $data['content_types'] = 'news';
                break;
            case 'country':
                $data['pagination'] = 'দেশ';
                $data['page_id'] = '717';
                $data['content_types'] = 'news';
                break;
            case 'politics':
                $data['pagination'] = 'রাজনীতি';
                $data['page_id'] = '718';
                $data['content_types'] = 'news';
                break;
            case 'editors-picks':
                $data['pagination'] = 'এডিটর্স পিকস';
                $data['special_filter'] = 'featured';
                $data['content_types'] = 'news';
                break;
            case 'most-viewed':
                $data['pagination'] = 'সর্বাধিক পঠিত';
                $data['special_filter'] = 'mostread';
                $data['content_types'] = 'news,opinion';
                break;
            case 'archive':
                $data['pagination'] = 'সর্বশেষ';
                $data['special_filter'] = 'latest';
                $data['content_types'] = 'news,opinion';
                break;
            case 'exclusive':
                $data['pagination'] = 'এক্সক্লুসিভ';
                $data['tag_id'] = '25';
                $data['content_types'] = 'news';
                break;
            case 'main-news':
                $data['pagination'] = 'প্রধান খবর';
                $data['tag_id'] = '133';
                $data['content_types'] = 'news';
                break;
            case 'foreign':
                $data['pagination'] = 'বিদেশ';
                $data['page_id'] = '719';
                $data['content_types'] = 'news';
                break;
            case 'columns':
                $data['pagination'] = 'কলাম';
                $data['page_id'] = '725';
                $data['content_types'] = 'opinion';
                break;
            case 'business':
                $data['pagination'] = 'বিজনেস';
                $data['page_id'] = '720';
                $data['content_types'] = 'news';
                break;
            case 'entertainment':
                $data['pagination'] = 'বিনোদন';
                $data['page_id'] = '712';
                $data['content_types'] = 'news';
                break;
            case 'sport':
                $data['pagination'] = 'খেলা';
                $data['page_id'] = '710';
                $data['content_types'] = 'news';
                break;
            case 'tech-and-gadget':
                $data['pagination'] = 'টেক অ্যান্ড গ্যাজেটস';
                $data['page_id'] = '721';
                $data['content_types'] = 'news';
                break;
            case 'lifestyle':
                $data['pagination'] = 'লাইফস্টাইল';
                $data['page_id'] = '722';
                $data['content_types'] = 'news';
                break;
            case 'literature':
                $data['pagination'] = 'সাহিত্য';
                $data['page_id'] = '723';
                $data['content_types'] = 'news';
                break;
            case 'leads-of-the-world':
                $data['pagination'] = 'লিড্‌স অব দ্য ওয়ার্ল্ড';
                $data['page_id'] = '883';
                $data['content_types'] = 'news';
                break;
            case 'others':
                $data['pagination'] = 'অন্যান্য';
                $data['page_id'] = '724';
                $data['content_types'] = 'news';
                break;
            case 'my-campus':
                $data['pagination'] = 'আমার ক্যাম্পাস';
                $data['page_id'] = '979';
                $data['content_types'] = 'news';
                break;
            case 'youth':
                $data['pagination'] = 'তারুণ্য';
                $data['page_id'] = '726';
                $data['content_types'] = 'news';
                break;
            case 'jobs':
                $data['pagination'] = 'চাকরি';
                $data['page_id'] = '991';
                $data['content_types'] = 'news';
                break;
            case 'bpl-2017':
                $data['pagination'] = 'বিপিএল ২০১৭';
                $data['tag_id'] = '691';
                $data['content_types'] = 'news';
                break;
            default:
                $data['pagetitle'] = 'পাওয়া যায়নি';
                $data['pagination'] = 'পাওয়া যায়নি';
                $not_found = 1;
                break;
        }
        return $data;
    }
    private function create_feed($rss_items) {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<rss version="2.0"' . $this->xmlns . '>' . "\n";
        // channel required properties
        $xml .= '<channel>' . "\n";
        $xml .= '<title/>' . "\n";
        $xml .= '<link>Bangla Tribune</link>' . "\n";
        $xml .= '<description/>' . "\n";
        $xml .= '<language>en</language>' . "\n";
        foreach ($rss_items as $rss_item) {
            if (!empty($rss_item['subtitle'])) {
                $titles = $rss_item['subtitle'] . $rss_item['title'];
            } else {
                $titles = $rss_item['title'];
            }
            $xml .= '<item>' . "\n";
            $xml .= '<Articleid><![CDATA[' . $rss_item['title'] . ']]></Articleid>' . "\n";
            $xml .= '<title><![CDATA[' . $rss_item['title'] . ']]></title>' . "\n";
            $xml .= '<excerpt><![CDATA[' . $rss_item['excerpt'] . ']]></excerpt>' . "\n";
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
