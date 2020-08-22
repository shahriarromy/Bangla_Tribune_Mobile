<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
        $this->bt_breaking_most_read = $this->cache->memcached->get('bt_breaking_most_read');
        //$this->load->model('Users_model');
        //$this->load->helper('form');
        $this->APP_KEY = 'APP_KEY=key';
        $this->APP_KEY_ID = array(
            'APP_ID' => 1,
            'APP_KEY' => '2theWorldwar'
        );
        $this->api_url = 'http://www.banglatribune.com/api/mobile_api/get_contents?APP_ID=1';
        $this->comment_url = 'http://www.banglatribune.com/api/comments/get_comments_json/?content_id=';
        //$this->api_url_with_limit_for_news = $this->api_url.'&start=0&limit=10&content_types=news&pages=';
        $this->detailed_article = $this->api_url . '&content_id=';
        //$this->detailed = $this->api_url.'&';
        $this->featured_url = $this->api_url . '&start=0&limit=10&content_types=news&special_filter=featured';
        $this->featured_column_url = $this->api_url . '&start=0&limit=5&content_types=opinion&special_filter=featured';
        $this->cover_url = $this->api_url . '&start=0&limit=5&content_tags=24&special_filter=featured';
        $this->most_read = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=view_count';
        $this->exclusive_home = $this->api_url . '&start=0&limit=5&content_types=news&content_tags=25&special_filter=latest';
        $this->main_news_home = $this->api_url . '&start=0&limit=10&content_types=news&content_tags=133&special_filter=latest';
        $this->leadsoftheworld_home = $this->api_url . '&start=0&limit=10&content_types=news&pages=883&special_filter=latest';
        $this->latest = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=latest';
        $this->breaking_news = $this->api_url . '&start=0&limit=5&content_types=breaking_news&pages=837&special_filter=featured';
        if (!$this->bt_breaking_most_read) {
            $breaking_news = $this->common->doCURLRequest($this->breaking_news, $this->APP_KEY);
            $this->breaking = json_decode($breaking_news, TRUE);
            $mostread = $this->common->doCURLRequest($this->most_read, $this->APP_KEY);
            $this->mostread = json_decode($mostread, TRUE);
            $latest = $this->common->doCURLRequest($this->latest, $this->APP_KEY);
            $this->latest_all = json_decode($latest, TRUE);
            $tocache['breaking_news'] = $this->breaking;
            $tocache['mostread'] = $this->mostread;
            $tocache['latest'] = $this->latest_all;
            $this->cache->memcached->delete('bt_breaking_most_read');
            $this->cache->memcached->save('bt_breaking_most_read', $tocache);
        } else {
            $this->breaking = $this->bt_breaking_most_read['breaking_news'];
            $this->mostread = $this->bt_breaking_most_read['mostread'];
            $this->latest_all = $this->bt_breaking_most_read['latest'];
        }
        //$this->menu = $this->common->doCURLRequest('http://www.banglatribune.com/api/mobile_api/get_pages?APP_ID=1', $this->APP_KEY);
        //$this->t_o_c = $this->common->doCURLRequest($this->api_url.'&start=0&limit=5&content_types=toc', $this->APP_KEY);
    }

    function index() {
        $data['pagetitle'] = 'Bangla Tribune - The news behind the news of Bangladesh';
        $bt_home_cache = $this->cache->memcached->get('bt_home_page');
        if (!$bt_home_cache) {
            $featured_column = $this->common->doCURLRequest($this->featured_column_url, $this->APP_KEY);
            $featured = $this->common->doCURLRequest($this->featured_url, $this->APP_KEY);
            $covers = $this->common->doCURLRequest($this->cover_url, $this->APP_KEY);
            $exclusive_home = $this->common->doCURLRequest($this->exclusive_home, $this->APP_KEY);
            $main_news_home = $this->common->doCURLRequest($this->main_news_home, $this->APP_KEY);
            $leadsoftheworld_home = $this->common->doCURLRequest($this->leadsoftheworld_home, $this->APP_KEY);
            $data["leadsoftheworld_home"] = json_decode($leadsoftheworld_home, TRUE);
            $data["main_news_home"] = json_decode($main_news_home, TRUE);
            $data["exclusive"] = json_decode($exclusive_home, TRUE);
            $data["cover"] = json_decode($covers, TRUE);
            $data["column"] = json_decode($featured_column, TRUE);
            $data["features"] = json_decode($featured, TRUE);
            $this->cache->memcached->delete('bt_home_page');
            $this->cache->memcached->save('bt_home_page', $data);
            //$data['menu'] = json_decode($this->menu, TRUE);
        } else {
            $data["leadsoftheworld_home"] = $bt_home_cache['leadsoftheworld_home'];
            $data["main_news_home"] = $bt_home_cache['main_news_home'];
            $data["exclusive"] = $bt_home_cache['exclusive'];
            $data["cover"] = $bt_home_cache['cover'];
            $data["column"] = $bt_home_cache['column'];
            $data["features"] = $bt_home_cache['features'];
            //$data['menu'] = $bt_home_cache['menu'];
        }
        //$data['toc'] = json_decode($this->t_o_c, TRUE);
        $data['active'] = 'home';
        $this->load->view('home', $data);
    }

    public function urlRewrite($seg, $type = NULL, $id = NULL, $slug = NULL) {
        if (!empty($seg)) {
            if ($this->uri->total_segments() == 1) {
                switch ($seg){
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
                        $data['page_id'] = '719';
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
                    default:
                        $data['pagetitle'] = 'পাওয়া যায়নি';
                        $data['pagination'] = 'পাওয়া যায়নি';
                        $not_found = 1;
                        break;
                }
                if(isset($data['page_id'])){
                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
                    $data['start'] = (int) $data['start'] * 10;
                    $limit = (int) $this->input->get('page') * 10;
                    if (empty($limit)) {
                        $limit = 10;
                        $back = 0;
                    } else {
                        $back = $limit - 10;
                        $limit = $limit + 10;
                    }

                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types='.$data['content_types'].'&pages=';
                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
                    $data['details'] = json_decode($detailed, TRUE);
                    $data['pagetitle'] = $data['pagination'].' - বাংলা ট্রিবিউন';
                    $data['active'] = $this->uri->segment(1);
                    $data['limit'] = $limit / 10;
                    $data['back'] = $back / 10;
                    $this->load->view('pages/country', $data);
                } elseif(isset($data['tag_id'])){
                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
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
                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
                    $data['details'] = json_decode($detailed, TRUE);
                    $data['pagetitle'] = $data['pagination'].' - বাংলা ট্রিবিউন';
                    $data['active'] = $this->uri->segment(1);
                    $data['limit'] = $limit / 10;
                    $data['back'] = $back / 10;
                    $this->load->view('pages/country', $data);
                } else {
                    $this->load->view('pages/not_found', $data);
                }
//                if ($this->uri->uri_string() == 'national') {
//                    $data['page_id'] = '963';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'জাতীয় - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'country') {
//                    $data['page_id'] = '717';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'দেশ - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'politics') {
//                    $data['page_id'] = '718';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'রাজনীতি - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'exclusive') {
//                    $data['tag_id'] = '25';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&content_tags=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'এক্সক্লুসিভ - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'main-news') {
//                    $data['tag_id'] = '133';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news,opinion&content_tags=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'প্রধান খবর - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'foreign') {
//                    $data['page_id'] = '719';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'বিদেশ - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'columns') {
//                    $data['page_id'] = '725';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=opinion&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'দেশ - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'business') {
//                    $data['page_id'] = '720';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'বিজনেস - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'entertainment') {
//                    $data['page_id'] = '712';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'বিনোদন - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'sport') {
//                    $data['page_id'] = '710';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'খেলা - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'tech-and-gadget') {
//                    $data['page_id'] = '721';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'টেক অ্যান্ড গ্যাজেটস - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'lifestyle') {
//                    $data['page_id'] = '722';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'লাইফস্টাইল - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'literature') {
//                    $data['page_id'] = '723';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'সাহিত্য - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'leads-of-the-world') {
//                    $data['page_id'] = '723';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'লিড্‌স অব দ্য ওয়ার্ল্ড - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'others') {
//                    $data['page_id'] = '724';
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=news&pages=';
//                    $detailed = $this->common->doCURLRequest($data['api_url'] . $data['page_id'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'অন্যান্য - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } elseif ($this->uri->uri_string() == 'talk-of-the-country') {
//                    $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
//                    $data['start'] = (int) $data['start'] * 10;
//                    $limit = (int) $this->input->get('page') * 10;
//                    if (empty($limit)) {
//                        $limit = 10;
//                        $back = 0;
//                    } else {
//                        $back = $limit - 10;
//                        $limit = $limit + 10;
//                    }
//
//                    $data['api_url'] = $this->api_url . '&start=' . $data['start'] . '&limit=10&content_types=toc';
//                    $detailed = $this->common->doCURLRequest($data['api_url'], $this->APP_KEY);
//                    $data['details'] = json_decode($detailed, TRUE);
//                    $data['pagetitle'] = 'টক অব দ্য কান্ট্রি - বাংলা ট্রিবিউন';
//                    $data['active'] = $this->uri->segment(1);
//                    //$data['toc'] = json_decode($this->t_o_c, TRUE);
//                    $data['limit'] = $limit / 10;
//                    $data['back'] = $back / 10;
//                    $this->load->view('pages/country', $data);
//                } else {
//                    $this->load->view('pages/not_found');
//                }
            } elseif ($this->uri->total_segments() == 2) {
                if ($seg == 'topic') {
                    $topic_id = (int) $type;
                    if (is_numeric($topic_id)) {
                        $data['tag_id'] = $type;
                        $data['start'] = $this->input->get('page') ? $this->input->get('page') : 0;
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
                        $detailed = $this->common->doCURLRequest($data['api_url'] . $data['tag_id'], $this->APP_KEY);
                        $data['details'] = json_decode($detailed, TRUE);
                        $data['pagetitle'] = 'দেশ । বাংলা ট্রিবিউন';
                        $data['active'] = $this->uri->segment(1);
                        //$data['toc'] = json_decode($this->t_o_c, TRUE);
                        $data['limit'] = $limit / 10;
                        $data['back'] = $back / 10;
                        $this->load->view('pages/country', $data);
                    }
                } else {
                    $this->load->view('pages/not_found');
                }
            } elseif ($this->uri->total_segments() == 4 || $this->uri->total_segments() == 3 || $this->uri->total_segments() > 4) {
                $data['pagination'] = $seg;
                $data['active'] = $this->uri->segment(1);
                $cache = $this->cache->memcached->get('bt_news_' . $id);
                if (!$cache['details']) {
                    //$comment = $this->common->doCURLRequest($this->comment_url . $id, $this->APP_KEY_ID);
                    $detailed = $this->common->doCURLRequest($this->detailed_article . $id, $this->APP_KEY);
                    $data['details'] = json_decode($detailed, TRUE);
                    //$data['comment'] = json_decode($comment, TRUE);
                    $data['pagetitle'] = $data['details']['title'];
                    $this->cache->memcached->save('bt_news_' . $id, $data,180);
                } else {
                    $data['details'] = $cache['details'];
                    //$data['comment'] = $cache['comment'];
                    $data['pagetitle'] = $cache['pagetitle'];
                }
                $this->load->view('details', $data);
            } else {
                $this->load->view('pages/not_found');
            }
        } else {
            redirect(base_url());
        }
    }

    public function comments_load_json() {
        $url = 'http://www.banglatribune.com/api/comments/get_comments_json';
        $id = $this->input->post('content_id');
        $cache = $this->cache->memcached->get('bt_comment_'.$id);
        if(!$cache) {
            $responses = $this->common->doCURLRequest($this->comment_url . $id, $this->APP_KEY_ID);
            $this->cache->save('bt_comment_'.$id,$responses,180);
        } else {
            $responses = $cache;
        }        
        echo $responses;
    }
    public function comments_process_json() {
        $url = 'http://www.banglatribune.com/api/comments/comments_process_json';
        $responses = curl_api_call(
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
        $url = 'http://www.banglatribune.com/api/content_management/content_like';

        $responses = curl_api_call(
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
        $url = 'http://www.banglatribune.com/api/comments/like_dislike_comment';
        
        $responses = curl_api_call(
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
        $url = 'http://www.banglatribune.com/api/authentication_helper/login_check?APP_ID=1';
        $response = curl_api_call(
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
}
