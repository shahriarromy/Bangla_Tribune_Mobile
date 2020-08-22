<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
        $this->APP_KEY = 'APP_KEY=2theWorldwar';
        $this->api_url = main_site_url('api/mobile_api/get_contents?APP_ID=1');
        // all en links
        $this->api_url_en = 'http://en.banglatribune.com/api/mobile_api/get_contents?APP_ID=1';
        $this->detailed_article_en = $this->api_url_en . '&content_id=';
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
        $this->jobs = $this->api_url . '&start=0&limit=5&content_types=news&pages=991&special_filter=latest';
        $this->latest = $this->api_url . '&start=0&limit=10&content_types=news,opinion&special_filter=latest';
        $this->breaking_news = $this->api_url . '&start=0&limit=5&content_types=breaking_news&pages=837&special_filter=featured';
        $this->journey_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=1053&special_filter=latest';
        $this->politics_home = $this->api_url . '&start=0&limit=5&content_types=news&pages=718&special_filter=latest';
        $this->worlcup_home = $this->api_url . '&start=0&limit=5&content_tags=1017&special_filter=latest';
        $this->live_ref = '438787';
        $this->live_home_content = $this->detailed_article . $this->live_ref;
        $this->election_details_first20 = $this->api_url . '&start=0&limit=20&special_filter=latest&ref='.$this->live_ref;
        $this->election_details_second20 = $this->api_url . '&start=20&limit=20&special_filter=latest&ref='.$this->live_ref;
    }

    public function no_delay() {
        $news["mostread"] = $this->common->doCURLRequest($this->most_read, $this->APP_KEY);
        sleep(1);
        $news["latest"] = $this->common->doCURLRequest($this->latest, $this->APP_KEY);
        sleep(1);
        $news['breaking_news'] = $this->common->doCURLRequest($this->breaking_news, $this->APP_KEY);
        sleep(1);
        $news["features"] = $this->common->doCURLRequest($this->featured_url, $this->APP_KEY);
        $this->cache->memcached->delete('bt_breaking_most_read');
        $this->cache->memcached->save('bt_breaking_most_read', $news);
    }

    public function five_delay() {
        sleep(1);
        $data_one["column"] = $this->common->doCURLRequest($this->featured_column_url, $this->APP_KEY);
        sleep(1);
        $data_one["editors_picks"] = $this->common->doCURLRequest($this->editors_picks, $this->APP_KEY);
        sleep(1);
        $data_one["current_home"] = $this->common->doCURLRequest($this->current_home, $this->APP_KEY);
        sleep(1);
        $data_one["exclusive"] = $this->common->doCURLRequest($this->exclusive_home, $this->APP_KEY);
        $this->cache->memcached->delete('bt_home_page_col_ed');
        $this->cache->memcached->save('bt_home_page_col_ed', $data_one);
    }

    public function ten_delay() {
        sleep(1);
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
    }

    public function fifteen_delay() {
        sleep(1);
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
        /*for home live*/
        sleep(1);
/*        $data_three["live_home_content"] = $this->common->doCURLRequest($this->live_home_content, $this->APP_KEY);
        sleep(1);
        $data_three["election_details_first20"] = $this->common->doCURLRequest($this->election_details_first20, $this->APP_KEY);
        sleep(1);
        $data_three["election_details_second20"] = $this->common->doCURLRequest($this->election_details_second20, $this->APP_KEY);
        sleep(1);
        $election_details_a = array();
        foreach ($data_three["election_details_first20"]['data'] as $value) {
            $election_details_a[] = $this->common->doCURLRequest($this->detailed_article.$value['content_id'], $this->APP_KEY);
            sleep(1);
        }
        foreach ($data_three["election_details_second20"]['data'] as $value) {
            $election_details_a[] = $this->common->doCURLRequest($this->detailed_article.$value['content_id'], $this->APP_KEY);
            sleep(1);
        }
        $data_three['election_details_all'] = $election_details_a;*/
        $this->cache->memcached->delete('bt_home_page_life_busi');
        $this->cache->memcached->save('bt_home_page_life_busi', $data_three);
    }

    function for_feed(){
        sleep(1);
        $data = $this->cache->memcached->get('bt_breaking_most_read');
        $feed = array();
        $feed_en = array();
        $cache = array();
        foreach ($data['latest']['data'] as $datas) {
            $feed[] = $this->common->doCURLRequest($this->detailed_article.$datas['content_id'], $this->APP_KEY);
            sleep(1);
        }
        $data = $this->common->doCURLRequest($this->api_url_en.'&start=0&limit=10&content_types=news,opinion&special_filter=latest', $this->APP_KEY);
        sleep(1);
        foreach ($data['data'] as $datas) {
            $feed_en[] = $this->common->doCURLRequest($this->detailed_article_en.$datas['content_id'], $this->APP_KEY);
            sleep(1);
        }
        $cache['bn'] = $feed;
        $cache['en'] = $feed_en;
        // echo "<pre>";
        // print_r($feed);
        $this->cache->memcached->delete('for_feed');
        $this->cache->memcached->save('for_feed', $cache);
    }
}