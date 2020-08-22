<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'home/index';
$route['404_override'] = 'home/r_404';

/*admin*/
$route['feed/(:any)'] = 'feed/$1';
$route['(:any)'] = 'home/urlRewrite/$1';
$route['(:any)/(:any)'] = 'home/urlRewrite/$1/$1';
$route['(:any)/(:any)/(:any)'] = 'home/urlRewrite/$1/$1/$1';
$route['(:any)/(:any)/(:any)/(:any)'] = 'home/urlRewrite/$1/$1/$1/$1';
$route['home/test'] = 'home/test';
$route['cron/no_delay'] = 'cron/no_delay';
$route['cron/five_delay'] = 'cron/five_delay';
$route['cron/ten_delay'] = 'cron/ten_delay';
$route['cron/fifteen_delay'] = 'cron/fifteen_delay';
$route['cron/mem'] = 'cron/mem';
$route['ajax_comment'] = 'home/comments_process_json';
$route['ajax_like'] = 'home/like_dislike';
$route['login_check_json'] = 'home/login_check_json';
$route['comments_load_json'] = 'home/comments_load_json';
$route['ajax_comment_like'] = 'home/ajax_comment_like';
$route['test_time'] = 'test_time/index';
$route['cron/for_feed'] = 'cron/for_feed';
$route['mobile/redirection'] = 'mobile/redirection';
$route['api/api_pages'] = 'api/api_pages';
$route['api/api_catagory_pages'] = 'api/api_catagory_pages';
$route['api/api_tabs'] = 'api/api_tabs';
$route['api/api_single_page_template'] = 'api/api_single_page_template';
$route['api_en/api_pages'] = 'api_en/api_pages';
$route['api_en/api_catagory_pages'] = 'api_en/api_catagory_pages';
$route['api_en/api_tabs'] = 'api_en/api_tabs';
$route['api_en/api_single_page_template'] = 'api_en/api_single_page_template';
/* End of file routes.php */
/* Location: ./application/config/routes.php */