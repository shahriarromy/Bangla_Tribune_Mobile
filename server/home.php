<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    private $server_url;
    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
        $this->bt_breaking_most_read = $this->cache->memcached->get('bt_breaking_most_read');
        $this->APP_KEY = 'APP_KEY=2theWorldwar';
        $this->APP_KEY_ID = array(
            'APP_ID' => 1,
            'APP_KEY' => '2theWorldwar'
        );
        $this->server_url = main_site_url();
        $this->api_url = main_site_url('api/mobile_api/get_contents?APP_ID=1');
        $this->comment_url = main_site_url('api/comments/get_comments_json/?content_id=');
        //$this->api_url_with_limit_for_news = $this->api_url.'&start=0&limit=10&content_types=news&pages=';
        $this->detailed_article = $this->api_url . '&content_id=';
        //$this->detailed = $this->api_url.'&';
        $this->featured_url = $this->api_url . '&start=0&limit=20&content_types=news&special_filter=featured';
        $this->featured_column_url = $this->api_url . '&start=0&limit=5&content_types=opinion&special_filter=featured';
        //$this->cover_url = $this->api_url . '&start=0&limit=5&content_tags=24&special_filter=featured';        
        $this->most_read = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=view_count';
        $this->editors_picks = $this->api_url . '&start=0&limit=5&content_tags=269';
        $this->current_home = $this->api_url . '&start=0&limit=5&content_tags=122';
        $this->tag_api = $this->api_url . '&start=0&limit=5&content_tags=';
        $this->exclusive_home = $this->api_url . '&start=0&limit=5&content_types=news&content_tags=25&special_filter=latest';
        $this->leadsoftheworld_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=883&special_filter=latest';
        $this->lifestyle_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=722&special_filter=latest';
        $this->business_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=720&special_filter=latest';
        $this->entertainment_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=712&special_filter=latest';
        $this->sports_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=710&special_filter=latest';
        $this->jobs = $this->api_url . '&start=0&limit=5&content_types=news&pages=991&special_filter=latest';
        $this->latest = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=latest';
        $this->breaking_news = $this->api_url . '&start=0&limit=5&content_types=breaking_news&pages=837&special_filter=featured';
        $this->journey_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=1053&special_filter=latest';
        $this->politics_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=718&special_filter=latest';
        $this->worlcup_home = $this->api_url . '&start=0&limit=5&content_tags=1017&special_filter=latest';
        $this->live_ref = '438787';
        $this->live_home_c = $this->api_url . '&special_filter=latest&ref='.$this->live_ref;
        $this->live_home_content = $this->detailed_article . $this->live_ref;
        //header("Location: http://www.banglatribune.com/");
        if (!$this->bt_breaking_most_read) {
            $this->breaking = $this->common->doCURLRequest($this->breaking_news, $this->APP_KEY);
            $this->mostread = $this->common->doCURLRequest($this->most_read, $this->APP_KEY);
            $this->latest_all = $this->common->doCURLRequest($this->latest, $this->APP_KEY);
            $this->features = $this->common->doCURLRequest($this->featured_url, $this->APP_KEY);
            $tocache['breaking_news'] = $this->breaking;
            $tocache['mostread'] = $this->mostread;
            $tocache['latest'] = $this->latest_all;
            $tocache['features'] = $this->features;
            $this->cache->memcached->delete('bt_breaking_most_read');
            $this->cache->memcached->save('bt_breaking_most_read', $tocache);
        } else {
            $this->breaking = $this->bt_breaking_most_read['breaking_news'];
            $this->mostread = $this->bt_breaking_most_read['mostread'];
            $this->latest_all = $this->bt_breaking_most_read['latest'];
            $this->features = $this->bt_breaking_most_read['features'];
        }
    }

    function index() {
        header("Location: $this->server_url");
        $data['pagetitle'] = 'Bangla Tribune - News, Behind The News';
        $bt_home_page_col_ed = $this->cache->memcached->get('bt_home_page_col_ed');
        $bt_home_page_en_sport = $this->cache->memcached->get('bt_home_page_en_sport');
        $bt_home_page_life_busi = $this->cache->memcached->get('bt_home_page_life_busi');
        if (!$bt_home_page_col_ed) {
            $data_one["column"] = $this->common->doCURLRequest($this->featured_column_url, $this->APP_KEY);
            sleep(1);
            $data_one["editors_picks"] = $this->common->doCURLRequest($this->editors_picks, $this->APP_KEY);
            sleep(1);
            $data_one["current_home"] = $this->common->doCURLRequest($this->current_home, $this->APP_KEY);
            sleep(1);
            $data_one["exclusive"] = $this->common->doCURLRequest($this->exclusive_home, $this->APP_KEY);
            sleep(1);
            $this->cache->memcached->delete('bt_home_page_col_ed');
            $this->cache->memcached->save('bt_home_page_col_ed', $data_one);
            array_push($data, $data_one);
        } else {
            $data["column"] = $bt_home_page_col_ed['column'];
            $data["editors_picks"] = $bt_home_page_col_ed['editors_picks'];
            $data["current_home"] = $bt_home_page_col_ed['current_home'];
            $data["exclusive"] = $bt_home_page_col_ed['exclusive'];
        }
        if (!$bt_home_page_en_sport) {
            $data_two["entertainment_home"] = $this->common->doCURLRequest($this->entertainment_home, $this->APP_KEY);
            sleep(1);
            $data_two["sports_home"] = $this->common->doCURLRequest($this->sports_home, $this->APP_KEY);
            sleep(1);
            $data_two["foreign_home"] = $this->common->doCURLRequest($this->foreign_home, $this->APP_KEY);
            sleep(1);
            $data_two["leadsoftheworld_home"] = $this->common->doCURLRequest($this->leadsoftheworld_home, $this->APP_KEY);
            sleep(1);
            $this->cache->memcached->delete('bt_home_page_en_sport');
            $this->cache->memcached->save('bt_home_page_en_sport', $data_two);
            array_push($data, $data_two);
        } else {
            $data["entertainment_home"] = $bt_home_page_en_sport['entertainment_home'];
            $data["sports_home"] = $bt_home_page_en_sport['sports_home'];
            $data["foreign_home"] = $bt_home_page_en_sport['foreign_home'];
            $data["leadsoftheworld_home"] = $bt_home_page_en_sport['leadsoftheworld_home'];
        }
        if (!$bt_home_page_life_busi) {
            $data_three["lifestyle_home"] = $this->common->doCURLRequest($this->lifestyle_home, $this->APP_KEY);
            sleep(1);
            $data_three["business_home"] = $this->common->doCURLRequest($this->business_home, $this->APP_KEY);
            sleep(1);
            $data_three["jobs"] = $this->common->doCURLRequest($this->jobs, $this->APP_KEY);
            sleep(1);
            $data_three["journey_home"] = $this->common->doCURLRequest($this->journey_home, $this->APP_KEY);
            sleep(1);
            $data_three["politics_home"] = $this->common->doCURLRequest($this->politics_home, $this->APP_KEY);
            sleep(1);
            $data_three["worlcup_home"] = $this->common->doCURLRequest($this->worlcup_home, $this->APP_KEY);
            sleep(1);
/*            $data_three["bpl_home"] = $this->common->doCURLRequest($this->bpl_home, $this->APP_KEY);
            sleep(1);
            $data_three["live_home_content"] = $this->common->doCURLRequest($this->live_home_content, $this->APP_KEY);
            sleep(1);
            $data_three["election_details_first20"] = $this->common->doCURLRequest($this->live_home_c, $this->APP_KEY);
            sleep(1);*/
            $this->cache->memcached->delete('bt_home_page_life_busi');
            $this->cache->memcached->save('bt_home_page_life_busi', $data_three);
            array_push($data, $data_three);
        } else {
            $data["lifestyle_home"] = $bt_home_page_life_busi['lifestyle_home'];
            $data["business_home"] = $bt_home_page_life_busi['business_home'];
            $data["jobs"] = $bt_home_page_life_busi['jobs'];
            $data["journey_home"] = $bt_home_page_life_busi['journey_home'];
            $data["politics_home"] = $bt_home_page_life_busi['politics_home'];
            $data["worlcup_home"] = $bt_home_page_life_busi['worlcup_home'];
/*            $data["bpl_home"] = $bt_home_page_life_busi['bpl_home'];
            $data["live_home_content"] = $bt_home_page_life_busi['live_home_content'];
            $data["election_details_first20"] = $bt_home_page_life_busi['election_details_first20'];*/
        }
        $data['features'] = $this->features;
        $data['active'] = 'home';
        $this->load->view('home', $data);
    }

    public function urlRewrite($seg, $type = NULL, $id = NULL, $slug = NULL) {
	$data['cache_disable'] = 0;
        header("Location: $this->server_url.$_SERVER[REQUEST_URI]/");
        if (!empty($seg)) {
            if ($this->uri->total_segments() == 1) {
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
                        $data['cache_disable'] = 1;
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
                    case 'journey':
                        $data['pagination'] = 'জার্নি';
                        $data['page_id'] = '1053';
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
                    case 'eleven-national-election':
                        $data['pagination'] = 'একাদশ জাতীয় সংসদ নির্বাচন';
                        $data['tag_id'] = '947';
                        $data['content_types'] = 'news';
                        break;
                    case 'cricket-worldcup-2019':
                        $data['pagination'] = 'বিশ্বকাপ ক্রিকেট ২০১৯';
                        $data['tag_id'] = '1017';
                        $data['content_types'] = 'news';
                        break;
                    default:
                        $data['pagetitle'] = 'পাওয়া যায়নি';
                        $data['pagination'] = 'পাওয়া যায়নি';
                        $not_found = 1;
                        break;
                }
                if (isset($data['page_id'])) {
                    $data['category_ad'] = 'yes';
                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
                    $cache = $this->cache->memcached->get('category' . $data['page_id'] . $data['start']);
                    $data['start'] = (int) $data['start'] * 10;
                    $limit = (int) $this->input->get('page') * 10;
                    if (empty($limit)) {
                        $limit = 10;
                        $back = 0;
                    } else {
                        $back = $limit - 10;
                        $limit = $limit + 10;
                    }

                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=' . $data['content_types'] . '&pages=';
                    if (!$cache) {
                        $data['details'] = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
                        if (!isset($data['details']['error'])) {
                            $this->cache->memcached->save('category' . $data['page_id'] . $data['start'], $data['details'], 180);
                        } else {
                            $data['error'] = $data['details']['error'];
                        }
                    } else {
                        $data['details'] = $cache;
                    }
                    $data['pagetitle'] = $this->input->get('page') ? $data['pagination'] . '-পাতা ' . toBangla($this->input->get('page')) . ' - বাংলা ট্রিবিউন' : $data['pagination'] . ' - বাংলা ট্রিবিউন';
                    $data['active'] = $this->uri->segment(1);
                    $data['limit'] = $limit / 10;
                    $data['back'] = $back / 10;
                    $this->load->view('category', $data);
                } elseif (isset($data['tag_id'])) {
                    $data['category_ad'] = 'yes';
                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
                    $cache = $this->cache->memcached->get('tags' . $data['tag_id'] . $data['start']);
                    $data['start'] = (int) $data['start'] * 10;
                    $limit = (int) $this->input->get('page') * 10;
                    if (empty($limit)) {
                        $limit = 10;
                        $back = 0;
                    } else {
                        $back = $limit - 10;
                        $limit = $limit + 10;
                    }

                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&content_tags=';
                    if (!$cache) {
                        $data['details'] = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
                        if (!isset($data['details']['error'])) {
                            $this->cache->memcached->save('tags' . $data['tag_id'] . $data['start'], $data['details'], 180);
                        } else {
                            $data['error'] = $data['details']['error'];
                        }
                    } else {
                        $data['details'] = $cache;
                    }
                    $data['pagetitle'] = $data['pagination'] . ' - বাংলা ট্রিবিউন';
                    $data['active'] = $this->uri->segment(1);
                    $data['limit'] = $limit / 10;
                    $data['back'] = $back / 10;
                    $this->load->view('category', $data);
                } elseif (isset($data['special_filter'])) {
                    $data['category_ad'] = 'yes';
                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
        		    $cache = '';
        			if(isset($data['cache_disable']) && $data['cache_disable'] != 1) {
                        $cache = $this->cache->memcached->get('featureds_' . $data['start']);
        			}
                    $data['start'] = (int) $data['start'] * 10;
                    $limit = (int) $this->input->get('page') * 10;
                    if (empty($limit)) {
                        $limit = 10;
                        $back = 0;
                    } else {
                        $back = $limit - 10;
                        $limit = $limit + 10;
                    }

                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&special_filter=' . $data['special_filter'];
                    if (!$cache) {
                        $data['details'] = $this->common->doCURLRequest($data['api_url'], $this->APP_KEY);
                        if (!isset($data['details']['error'])) {
                            $this->cache->memcached->save('featureds_' . $data['start'], $data['details'], 180);
                        } else {
                            $data['error'] = $data['details']['error'];
                        }
                    } else {
                        $data['details'] = $cache;
                    }
                    $data['pagetitle'] = $data['pagination'] . ' - বাংলা ট্রিবিউন';
                    $data['active'] = $this->uri->segment(1);
                    $data['limit'] = $limit / 10;
                    $data['back'] = $back / 10;
                    $this->load->view('category', $data);
                } else {
                    $this->load->view('pages/not_found', $data);
                }
            } elseif ($this->uri->total_segments() == 2) {
                $data['category_ad'] = 'yes';
                if ($seg == 'topic') {
                    $topic_id = $type;
                    if (is_numeric($topic_id)) {
                        $data['tag_id'] = $type;
                        $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
                        $cache = $this->cache->memcached->get('tags' . $data['tag_id'] . $data['start']);
                        $data['start'] = (int) $data['start'] * 10;
                        $limit = (int) $this->input->get('page') * 10;
                        if (empty($limit)) {
                            $limit = 10;
                            $back = 0;
                        } else {
                            $back = $limit - 10;
                            $limit = $limit + 10;
                        }

                        $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&content_tags=';
                        if (!$cache) {
                            $data['details'] = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
                            if (!isset($data['details']['error'])) {
                                $this->cache->memcached->save('tags' . $data['tag_id'] . $data['start'], $data['details'], 180);
                            } else {
                                $data['error'] = $data['details']['error'];
                            }
                        } else {
                            $data['details'] = $cache;
                        }
                        $data['pagination'] = 'প্রসঙ্গ';
                        $data['pagetitle'] = 'দেশ । বাংলা ট্রিবিউন';
                        $data['active'] = $this->uri->segment(1);
                        //$data['toc'] = json_decode($this->t_o_c, TRUE);
                        $data['limit'] = $limit / 10;
                        $data['back'] = $back / 10;
                        $this->load->view('category', $data);
                    } else {
                        $this->load->view('pages/not_found');
                    }
                } elseif ($seg == 'archive') {
                    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$type)) {
                        $data['archive_time'] = $type;
                        $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
                        $cache = $this->cache->memcached->get('archive_time' . $data['archive_time'] . $data['start']);
                        $data['start'] = (int) $data['start'] * 10;
                        $limit = (int) $this->input->get('page') * 10;
                        if (empty($limit)) {
                            $limit = 10;
                            $back = 0;
                        } else {
                            $back = $limit - 10;
                            $limit = $limit + 10;
                        }

                        $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&archive_time=';
                        if (!$cache) {
                            $data['details'] = $this->common->doCURLRequest($data['api_url'] . $data['archive_time'], $this->APP_KEY);
                            if (!isset($data['details']['error'])) {
                                $this->cache->memcached->save('archive_time' . $data['archive_time'] . $data['start'], $data['details'], 180);
                            } else {
                                $data['error'] = $data['details']['error'];
                            }
                        } else {
                            $data['details'] = $cache;
                        }
                        $data['pagination'] = 'আর্কাইভ';
                        $data['pagetitle'] = 'আর্কাইভ । বাংলা ট্রিবিউন';
                        $data['active'] = $this->uri->segment(1);
                        $data['limit'] = $limit / 10;
                        $data['back'] = $back / 10;
                        $this->load->view('category', $data);
                    } else {
                        $this->load->view('pages/not_found');
                    }
                } else {
                    $this->load->view('pages/not_found');
                }
            } elseif ($this->uri->total_segments() == 4 || $this->uri->total_segments() == 3 || $this->uri->total_segments() > 4) {
                $data['pagination'] = $seg;
                $data['active'] = $this->uri->segment(1);
                $cache = $this->cache->memcached->get('bt_news_' . $id);
                $cache_live = $this->cache->memcached->get('bt_live_news_'.$id);
                $data['for_election'] = $this->cache->memcached->get('bt_home_page_life_busi');
                $data['election_details_all'] = $data['for_election']['election_details_all'];
                if($this->uri->segment(1) == 'lives'){
                    if(!$cache_live){
                        $data['details_live_intro'] = $this->common->doCURLRequest($this->detailed_article . $id, $this->APP_KEY);
                        sleep(1);
                        $data['details_live_list_first20'] = $this->common->doCURLRequest($this->api_url . '&start=0&limit=20&special_filter=latest&ref='.$id, $this->APP_KEY);
                        $data['details_live_list_second20'] = $this->common->doCURLRequest($this->api_url . '&start=20&limit=20&special_filter=latest&ref='.$id, $this->APP_KEY);
                        if (!isset($data['details_live_intro']['error'])) {
                            $data['pagetitle'] = $data['details_live_intro']['title'];
                            $this->cache->memcached->save('bt_live_news_' . $id, $data, 40);
                        } else {
                            $data['error'] = $data['details_live_intro']['error'];
                        }
                    } else {
                        $data['details_live_intro'] = $cache_live['details_live_intro'];
                        $data['details_live_list_first20'] = $cache_live['details_live_list_first20'];
                        $data['details_live_list_second20'] = $cache_live['details_live_list_second20'];
                        $data['pagetitle'] = $cache_live['pagetitle'];
                    }
                    $this->load->view('details_live', $data);
                } else {
                    if (!$cache) {
                        $data['details'] = $this->common->doCURLRequest($this->detailed_article . $id, $this->APP_KEY);
                        if (!isset($data['details']['error'])) {
                            $data['pagetitle'] = $data['details']['title'];
                            $this->cache->memcached->save('bt_news_' . $id, $data, 120);
                        } else {
                            $data['error'] = $data['details']['error'];
                        }
                    } else {
                        $data['details'] = $cache['details'];
                        $data['pagetitle'] = $cache['pagetitle'];
                        $data['cache_ignore_detail'] = 0;
                    }
                    $this->load->view('details', $data);
                }
            } else {
                $this->load->view('pages/not_found');
            }
        } else {
            redirect(base_url());
        }
    }

    public function comments_load_json() {
        //$url = 'http://www.banglatribune.com/api/comments/get_comments_json';
        $id = $this->input->post('content_id');
        $cache = $this->cache->memcached->get('bt_comment_' . $id);
        if (!$cache) {
            $responses = $this->common->doCURLRequest($this->comment_url . $id, $this->APP_KEY_ID);
            $this->cache->save('bt_comment_' . $id, $responses, 180);
        } else {
            $responses = $cache;
        }
        echo json_encode($responses);
    }

    public function comments_process_json() {
        $url = main_site_url('api/comments/comments_process_json');
        $responses = $this->common->doCURLRequest(
                array(
                    'url' => $url,
                    'post_data' => array(
                        'fk_content_id' => $this->input->post('fk_content_id'),
                        'parent' => $this->input->post('parent'),
                        'label_depth' => $this->input->post('label_depth'),
                        'comment' => $this->input->post('comment'),
                        'hidden_name' => $this->input->post('hidden_name'),
                    )
                )
        );
        echo json_encode($responses);
    }

    public function like_dislike() {
        $url = main_site_url('api/content_management/content_like');

        $responses = $this->common->doCURLRequest(
                array(
                    'url' => $url,
                    'post_data' => array(
                        'action' => $this->input->post('action'),
                        'status' => $this->input->post('status'),
                        'the_content' => $this->input->post('the_content'),
                    )
                )
        );
        echo json_encode($responses);
    }

    public function ajax_comment_like() {
        $url = main_site_url('api/comments/like_dislike_comment');

        $responses = $this->common->doCURLRequest(
                array(
                    'url' => $url,
                    'post_data' => array(
                        'comment_id' => $this->input->post('comment_id'),
                        'content_link' => $this->input->post('content_link'),
                        'fk_content_id' => $this->input->post('fk_content_id'),
                        'like_dislike' => $this->input->post('like_dislike'),
                    )
                )
        );
        echo json_encode($responses);
    }

    public function login_check_json() {
        $url = main_site_url('api/authentication_helper/login_check?APP_ID=1');
        $response = $this->common->doCURLRequest(
                array(
                    'url' => $url,
                    'post_data' => array(
                        'APP_ID' => 1,
                        'APP_KEY' => '2theWorldwar'
                    )
                )
        );
        echo json_encode($response);
    }

    public function r_404() {
        $this->load->view('pages/not_found');
    }

    /*         everythin is test under that line        */

    function test_live() {
        /*live */
        $data['live_home_content'] = $this->common->doCURLRequest($this->live_home_content, $this->APP_KEY);
        $data['election_details_first20'] = $this->common->doCURLRequest($this->live_home_c, $this->APP_KEY);
        $data['for_election'] = $this->cache->memcached->get('bt_home_page_life_busi');
        $data['election_details_all'] = $data['for_election']['election_details_all'];
/*        echo "<pre>";
        print_r($data['for_election']['election_details_all']);
        exit();*/
        $data['pagetitle'] = 'Bangla Tribune - News, Behind The News';
        $bt_home_page_col_ed = $this->cache->memcached->get('bt_home_page_col_ed');
        $bt_home_page_en_sport = $this->cache->memcached->get('bt_home_page_en_sport');
        $bt_home_page_life_busi = $this->cache->memcached->get('bt_home_page_life_busi');
        if (!$bt_home_page_col_ed) {
            $data_one["column"] = $this->common->doCURLRequest($this->featured_column_url, $this->APP_KEY);
            sleep(1);
            $data_one["editors_picks"] = $this->common->doCURLRequest($this->editors_picks, $this->APP_KEY);
            sleep(1);
            $data_one["current_home"] = $this->common->doCURLRequest($this->current_home, $this->APP_KEY);
            sleep(1);
            $data_one["exclusive"] = $this->common->doCURLRequest($this->exclusive_home, $this->APP_KEY);
            sleep(1);
            $this->cache->memcached->delete('bt_home_page_col_ed');
            $this->cache->memcached->save('bt_home_page_col_ed', $data_one);
            array_push($data, $data_one);
        } else {
            $data["column"] = $bt_home_page_col_ed['column'];
            $data["editors_picks"] = $bt_home_page_col_ed['editors_picks'];
            $data["current_home"] = $bt_home_page_col_ed['current_home'];
            $data["exclusive"] = $bt_home_page_col_ed['exclusive'];
        }
        if (!$bt_home_page_en_sport) {
            $data_two["entertainment_home"] = $this->common->doCURLRequest($this->entertainment_home, $this->APP_KEY);
            sleep(1);
            $data_two["sports_home"] = $this->common->doCURLRequest($this->sports_home, $this->APP_KEY);
            sleep(1);
            $data_two["foreign_home"] = $this->common->doCURLRequest($this->foreign_home, $this->APP_KEY);
            sleep(1);
            $data_two["leadsoftheworld_home"] = $this->common->doCURLRequest($this->leadsoftheworld_home, $this->APP_KEY);
            sleep(1);
            $this->cache->memcached->delete('bt_home_page_en_sport');
            $this->cache->memcached->save('bt_home_page_en_sport', $data_two);
            array_push($data, $data_two);
        } else {
            $data["entertainment_home"] = $bt_home_page_en_sport['entertainment_home'];
            $data["sports_home"] = $bt_home_page_en_sport['sports_home'];
            $data["foreign_home"] = $bt_home_page_en_sport['foreign_home'];
            $data["leadsoftheworld_home"] = $bt_home_page_en_sport['leadsoftheworld_home'];
        }
        if (!$bt_home_page_life_busi) {
            $data_three["lifestyle_home"] = $this->common->doCURLRequest($this->lifestyle_home, $this->APP_KEY);
            sleep(1);
            $data_three["business_home"] = $this->common->doCURLRequest($this->business_home, $this->APP_KEY);
            sleep(1);
            $data_three["jobs"] = $this->common->doCURLRequest($this->jobs, $this->APP_KEY);
            sleep(1);
            $data_three["journey_home"] = $this->common->doCURLRequest($this->journey_home, $this->APP_KEY);
            sleep(1);
            $data_three["politics_home"] = $this->common->doCURLRequest($this->politics_home, $this->APP_KEY);
            $this->cache->memcached->delete('bt_home_page_life_busi');
            $this->cache->memcached->save('bt_home_page_life_busi', $data_three);
            array_push($data, $data_three);
        } else {
            $data["lifestyle_home"] = $bt_home_page_life_busi['lifestyle_home'];
            $data["business_home"] = $bt_home_page_life_busi['business_home'];
            $data["jobs"] = $bt_home_page_life_busi['jobs'];
            $data["journey_home"] = $bt_home_page_life_busi['journey_home'];
            $data["politics_home"] = $bt_home_page_life_busi['politics_home'];
        }
        $data['features'] = $this->features;
        $data['active'] = 'home';
        $this->load->view('home_test', $data);
    }

    function test() {
        $data['pagetitle'] = 'Bangla Tribune - News, Behind The News';
        $bt_home_page_col_ed = $this->cache->memcached->get('bt_home_page_col_ed');
        $bt_home_page_en_sport = $this->cache->memcached->get('bt_home_page_en_sport');
        $bt_home_page_life_busi = $this->cache->memcached->get('bt_home_page_life_busi');
        if (!$bt_home_page_col_ed) {
            $data_one["column"] = $this->common->doCURLRequest($this->featured_column_url, $this->APP_KEY);
            sleep(1);
            $data_one["editors_picks"] = $this->common->doCURLRequest($this->editors_picks, $this->APP_KEY);
            sleep(1);
            $data_one["current_home"] = $this->common->doCURLRequest($this->current_home, $this->APP_KEY);
            sleep(1);
            $data_one["exclusive"] = $this->common->doCURLRequest($this->exclusive_home, $this->APP_KEY);
            $this->cache->memcached->delete('bt_home_page_col_ed');
            $this->cache->memcached->save('bt_home_page_col_ed', $data_one);
            array_push($data, $data_one);
        } else {
            $data["column"] = $bt_home_page_col_ed['column'];
            $data["editors_picks"] = $bt_home_page_col_ed['editors_picks'];
            $data["current_home"] = $bt_home_page_col_ed['current_home'];
            $data["exclusive"] = $bt_home_page_col_ed['exclusive'];
        }
        if (!$bt_home_page_en_sport) {
            $data_two["entertainment_home"] = $this->common->doCURLRequest($this->entertainment_home, $this->APP_KEY);
            sleep(1);
            $data_two["sports_home"] = $this->common->doCURLRequest($this->sports_home, $this->APP_KEY);
            sleep(1);
            $data_two["foreign_home"] = $this->common->doCURLRequest($this->foreign_home, $this->APP_KEY);
            sleep(1);
            $data_two["leadsoftheworld_home"] = $this->common->doCURLRequest($this->leadsoftheworld_home, $this->APP_KEY);
            $this->cache->memcached->delete('bt_home_page_en_sport');
            $this->cache->memcached->save('bt_home_page_en_sport', $data_two);
            array_push($data, $data_two);
        } else {
            $data["entertainment_home"] = $bt_home_page_en_sport['entertainment_home'];
            $data["sports_home"] = $bt_home_page_en_sport['sports_home'];
            $data["foreign_home"] = $bt_home_page_en_sport['foreign_home'];
            $data["leadsoftheworld_home"] = $bt_home_page_en_sport['leadsoftheworld_home'];
        }
        if (!$bt_home_page_life_busi) {
            $data_three["lifestyle_home"] = $this->common->doCURLRequest($this->lifestyle_home, $this->APP_KEY);
            sleep(1);
            $data_three["business_home"] = $this->common->doCURLRequest($this->business_home, $this->APP_KEY);
            sleep(1);
            $data_three["jobs"] = $this->common->doCURLRequest($this->jobs, $this->APP_KEY);
            sleep(1);
            $data_three["journey_home"] = $this->common->doCURLRequest($this->journey_home, $this->APP_KEY);
            sleep(1);
            $data_three["politics_home"] = $this->common->doCURLRequest($this->politics_home, $this->APP_KEY);
            sleep(1);
            $data_three["bpl_home"] = $this->common->doCURLRequest($this->bpl_home, $this->APP_KEY);
            $this->cache->memcached->delete('bt_home_page_life_busi');
            $this->cache->memcached->save('bt_home_page_life_busi', $data_three);
            array_push($data, $data_three);
        } else {
            $data["lifestyle_home"] = $bt_home_page_life_busi['lifestyle_home'];
            $data["business_home"] = $bt_home_page_life_busi['business_home'];
            $data["jobs"] = $bt_home_page_life_busi['jobs'];
            $data["journey_home"] = $bt_home_page_life_busi['journey_home'];
            $data["politics_home"] = $bt_home_page_life_busi['politics_home'];
            $data["bpl_home"] = $bt_home_page_life_busi['bpl_home'];
        }
        $data['features'] = $this->features;
        $data['active'] = 'home';
        $this->load->view('home', $data);
    }

}
