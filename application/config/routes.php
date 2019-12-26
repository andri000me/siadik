<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/

# ROUTE WEB
$route['default_controller'] = 'main';
$route['login'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;

$route['user/(:num)'] = 'user/detail/$1';

$route['survei_foto/add'] = 'survei_foto/add';
$route['survei_foto/edit/(:any)'] = 'survei_foto/edit/$1';
$route['survei_foto/confirm/(:any)'] = 'survei_foto/confirm/$1';
$route['survei_foto/(:any)'] = 'survei_foto/detail/$1';

$route['properti/add'] = 'properti/add';
$route['properti/edit/(:any)'] = 'properti/edit/$1';
$route['properti/(:any)'] = 'properti/detail/$1';

$route['showing/add'] = 'showing/add';
$route['showing/edit/(:any)'] = 'showing/edit/$1';
$route['showing/(:any)'] = 'showing/detail/$1';

$route['deal/add'] = 'deal/add';
$route['deal/edit/(:any)'] = 'deal/edit/$1';
$route['deal/(:any)'] = 'deal/detail/$1';

$route['report_penjualan'] = 'report/penjualan';

# ROUTE REST API

/*
| -------------------------------------------------------------------------
| REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/user/add'] = 'api/user/add';
$route['api/user/(:num)'] = 'api/user/detail/$1';

$route['api/survei_foto/add'] = 'api/survei_foto/add';
$route['api/survei_foto/(:any)'] = 'api/survei_foto/detail/$1';

$route['api/properti/add'] = 'api/properti/add';
$route['api/properti/(:any)'] = 'api/properti/detail/$1';

$route['api/iklan/add'] = 'api/iklan/add';
$route['api/iklan/(:any)'] = 'api/iklan/detail/$1';

$route['api/showing/add'] = 'api/showing/add';
$route['api/showing/(:any)'] = 'api/showing/detail/$1';

$route['api/deal/add'] = 'api/deal/add';
$route['api/deal/(:any)'] = 'api/deal/detail/$1';
