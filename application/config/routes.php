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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ******************************
 * Front
 ****************************** */

$route['default_controller'] 		= "front"; // index() Landing page
$route['terms'] 					= "front/terms";
$route['start'] 					= "front/start_bootcamp";
$route['contact'] 					= "front/contact";
$route['faq'] 					    = "front/faq";
$route['ses'] 						= "front/ses"; //Raw session logs
$route['login']						= "front/login"; //Bootcamp Operator login

$route['bootcamps/(:any)/enroll'] 	= "front/bootcamp_enroll/$1";
$route['bootcamps/(:any)']	        = "front/bootcamp_load/$1";
$route['bootcamps'] 				= "front/bootcamps_browse";


/* ******************************
 * Marketplace ADMIN-ONLY
 ****************************** */

//Admin Guides:
$route['guides/status_bible'] 						= "marketplace/status_bible";
$route['guides/showdown_markup'] 					= "marketplace/showdown_markup";

//Users & Authentication:
$route['login_process'] 							= "marketplace/login_process";
$route['logout'] 									= "marketplace/logout";
$route['account'] 								    = "marketplace/account_manage";

//Bootcamps:
$route['marketplace/(:num)'] 			            = "marketplace/bootcamp_dashboard/$1";
$route['marketplace/(:num)/content/(:num)'] 		= "marketplace/content_lib/$1/$2";
$route['marketplace/(:num)/content'] 				= "marketplace/content_lib/$1";
$route['marketplace/(:num)/cohorts/(:num)'] 		= "marketplace/cohort_view/$1/$2";
$route['marketplace/(:num)/cohorts/new'] 			= "marketplace/cohort_create/$1";
$route['marketplace/(:num)/cohorts'] 				= "marketplace/cohorts_browse/$1";
$route['marketplace/(:num)/community'] 				= "marketplace/community_browse/$1";
$route['marketplace/(:num)/timeline'] 				= "marketplace/timeline_view/$1";
$route['marketplace/new'] 					        = "marketplace/bootcamp_create";
$route['marketplace'] 								= "marketplace/bootcamps_browse";


