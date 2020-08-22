<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {
    private $api_url;
    private $call_url;
    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
    }

    public function api_pages() {
        $machine_code = $this->input->post("MACHINE_KEY");
        if ($machine_code == 'romy_dosto_emran') {
            $caches = $this->cache->memcached->get('bt_cache_pages');
            if (!$caches) {
                $url = main_site_url('api/mobile_api/get_pages?APP_ID=1');
                $response = curl_api_call(
                        array(
                            'url' => $url,
                            'post_data' => array(
                                'APP_KEY' => '2theWorldwar'
                            )
                        )
                );
                $this->cache->memcached->delete('bt_cache_pages');
                $this->cache->memcached->save('bt_cache_pages', $response, 600);
            } else {
                $response = $caches;
            }
            $response = $this->modify_pages($response);
            print_r($response);
            /*header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT);*/
        } else {
            $data['error'] = 'Invalid key';
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function modify_pages($param = array()) {
        $modified = array();
        $i = 0;
        foreach ($param as $value) {
            $restArray = $this->arguments($value['api_arguments']);
            $modified = array(
                'id' => $value['id'],
                'parent' => $value['parent'],
                'title' => $value['title']
            );
            if (!array_key_exists('pages', $restArray)) {
                $restArray['pages'] = '';
            }
            $final['mainMenu'][$i] = array_merge($modified, $restArray);
            $i++;
        }
        return $final;
    }

    public function arguments($param) {
        $expl = explode('&', $param);
        $final_ar = array();
        foreach ($expl as $value) {
            $mofd = explode('=', $value);
            $final_ar[$mofd[0]] = $mofd[1];
        }
        return $final_ar;
    }

    function media_image_url_formating_800_450($content_img) {
        $exp_url = explode('/', $content_img);
        $exp_url[6] = '800x450x1';
        $imp_url = implode('/', $exp_url);
        return $imp_url;
    }

    function media_image_url_formating_320_180($content_img) {
        $exp_url = explode('/', $content_img);
        $exp_url[6] = '320x180x1';
        $imp_url = implode('/', $exp_url);
        return $imp_url;
    }

    function media_image_url_formating_320_320($content_img) {
        $exp_url = explode('/', $content_img);
        $exp_url[6] = '320x320x1';
        $imp_url = implode('/', $exp_url);
        return $imp_url;
    }

    public function format_image_url($response = array()) {
        foreach ($response['data'] as $key => $value) {
            $size320x180 = $this->media_image_url_formating_800_450($value['content_thumbnail_image']);
            $response['data'][$key]['content_thumbnail_image'] = 'http:' . $size320x180;
            $size320x320 = $this->media_image_url_formating_320_320($value['content_thumbnail_image_square']);
            $response['data'][$key]['content_thumbnail_image_square'] = 'http:' . $size320x320;
            $response['data'][$key]['web_url'] = $response['data'][$key]['web_url'].','.base_url('api/api_single_page_template?content_id=') . $response['data'][$key]['content_id'];
        }
        return $response;
    }

    public function api_catagory_pages() {
        $machine_code = $this->input->post("MACHINE_KEY");
        $content_types = $this->input->post("content_types");
        $pages = $this->input->post("pages");
        $content_tags = $this->input->post("content_tags");
        $special_filter = $this->input->post("special_filter");
        $start = $this->input->post("start");
        $limit = $this->input->post("limit");
        if ($machine_code == 'romy_dosto_emran') {
            $cache_keys = 'bt_cache_category_pages_';
            $post_data = array();
            $post_data['APP_KEY'] = '2theWorldwar';
            $url = main_site_url('api/mobile_api/get_contents?APP_ID=1');
            if (!empty($content_types)) {
                $cache_keys = $cache_keys . $content_types;
                $url = $url . '&content_types=' . $content_types;
            }
            if (!empty($pages)) {
                $cache_keys = $cache_keys . $pages;
                $url = $url . '&pages=' . $pages;
            }
            if (!empty($content_tags)) {
                $cache_keys = $cache_keys . $content_tags;
                $url = $url . '&content_tags=' . $content_tags;
            }
            if (!empty($special_filter)) {
                $cache_keys = $cache_keys . $special_filter;
                $url = $url . '&special_filter=' . $special_filter;
            }
            if (!empty($start)) {
                $cache_keys = $cache_keys . $start;
                $url = $url . '&start=' . $start;
            }
            if (!empty($limit)) {
                $cache_keys = $cache_keys . $limit;
                $url = $url . '&limit=' . $limit;
            }
            $caches = $this->cache->memcached->get($cache_keys);
            if (!$caches) {
                //$url = 'http://www.banglatribune.com/api/mobile_api/get_contents?APP_ID=1'.$content_types . $pages . $content_tags . $special_filter;
                $responses = curl_api_call(
                        array(
                            'url' => $url,
                            'post_data' => $post_data
                        )
                );
                $response = $this->format_image_url($responses);
                $this->cache->memcached->delete($cache_keys);
                $this->cache->memcached->save($cache_keys, $response, 600);
            } else {
                $response = $caches;
            }
            $data['content'] = array_values($response['data']);
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $data['error'] = 'Invalid key';
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function api_single_page_template() {
        //$machine_code = $this->input->post("MACHINE_KEY");
        $content_id = $this->input->get('content_id');
        //if ($machine_code == 'romy_dosto_emran') {
        $cache_keys = 'bt_cache_details_app_pages_' . $content_id;
        $caches = $this->cache->memcached->get($cache_keys);
        if (!$caches) {
            $url = main_site_url('api/mobile_api/get_contents?APP_ID=1&content_id=' . $content_id);
            $post_data['APP_KEY'] = '2theWorldwar';
            $response = curl_api_call(
                    array(
                        'url' => $url,
                        'post_data' => $post_data
                    )
            );
            //$response = $this->format_web_url($responses, $content_id);
            $this->cache->memcached->delete($cache_keys);
            $this->cache->memcached->save($cache_keys, $response, 600);
        } else {
            $response = $caches;
        }
        $data['content'] = $response;
        $this->load->view('mobile_single', $data);
        //} else {
        /* $data['error'] = 'Invalid key';
          header('Content-Type: application/json');
          echo json_encode($data, JSON_PRETTY_PRINT); */
        //}
    }

    public function api_tabs() {
        $machine_code = $this->input->post("MACHINE_KEY");
        $data = array();
        if ($machine_code == 'romy_dosto_emran') {
            $data['tabs'] = array(
                array(
                    'id' => '1',
                    'title' => 'নির্বাচিত',
                    'api_urls' => base_url('api/api_catagory_pages'),
                    'content_types' => 'news',
                    'content_tags' => '',
                    'special_filter' => 'featured'
                ), array(
                    'id' => '2',
                    'title' => 'সর্বশেষ',
                    'api_urls' => base_url('api/api_catagory_pages'),
                    'content_types' => 'news,opinion',
                    'content_tags' => '',
                    'special_filter' => 'latest'
                ), array(
                    'id' => '3',
                    'title' => 'সর্বাধিক পঠিত',
                    'api_urls' => base_url('api/api_catagory_pages'),
                    'content_types' => 'news,opinion',
                    'content_tags' => '',
                    'special_filter' => 'view_count'
                )
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $data['error'] = 'Invalid key';
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

}
