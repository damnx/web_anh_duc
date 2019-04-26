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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// manger
$route['manager/login\.html'] = 'manager/login';
$route['manager/logout\.html'] = 'manager/logout';

$route['manager\.html'] = 'manager/main';

$route['manager/users-admin\.html'] = 'manager/use_admin';
$route['manager/users-admin-(:any)\.html'] = 'manager/use_admin/index/$1';
$route['manager/ajax-user-admin/(:any)'] = 'manager/use_admin/ajax/$1';

$route['manager/users\.html'] = 'manager/use_use';
$route['manager/users-(:any)\.html'] = 'manager/use_use/index/$1';
$route['manager/ajax-user/(:any)'] = 'manager/use_use/ajax/$1';




$route['manager/slideshow\.html'] = 'manager/slideshow';
$route['manager/slideshow-(:any)\.html'] = 'manager/slideshow/index/$1';
$route['manager/ajax-slideshow/(:any)'] = 'manager/slideshow/ajax/$1';
$route['manager/delete-(:num)'] = 'manager/slideshow/delete/$1';


$route['manager/upload\.html'] = 'manager/upload';
$route['manager/list-files\.html'] = 'manager/upload/listFiles';

$route['manager/category\.html'] = 'manager/category';
$route['manager/ajax-category/(:any)'] = 'manager/category/ajax/$1';

$route['manager/menu\.html'] = 'manager/menu';
$route['manager/ajax-menu/(:any)'] = 'manager/menu/ajax/$1';

$route['manager/posts\.html'] = 'manager/posts';
$route['manager/posts/(:any)\.html'] = 'manager/posts/index/$1';
$route['manager/posts-iteam\.html'] = 'manager/posts/iteam';
$route['manager/posts-iteam/(:any)\.html'] = 'manager/posts/iteam/$1';
$route['manager/ajax-posts/(:any)'] = 'manager/posts/ajax/$1';

$route['manager/product/attribute\.html'] = 'manager/attribute';
$route['manager/product/attribute-iteam\.html'] = 'manager/attribute/iteam';
$route['manager/product/attribute-iteam/(:any)\.html'] = 'manager/attribute/iteam/$1';
$route['manager/ajax-attribute/(:any)'] = 'manager/attribute/ajax/$1';


$route['manager/product\.html'] = 'manager/product';
$route['manager/product/(:any)\.html'] = 'manager/product/index/$1';
$route['manager/product-iteam\.html'] = 'manager/product/iteam';
$route['manager/product-iteam/(:num)\.html'] = 'manager/product/iteam/$1';
$route['manager/ajax-product/(:any)'] = 'manager/product/ajax/$1';

$route['manager/product/pratt/(:num)\.html'] = 'manager/pratt/index/$1';
$route['manager/ajax-pratt/(:any)'] = 'manager/pratt/ajax/$1';


$route['manager/card\.html'] = 'manager/card';
$route['manager/ajax-card/(:any)'] = 'manager/card/ajax/$1';

$route['manager/orders\.html'] = 'manager/orders';
$route['manager/ajax-orders/(:any)'] = 'manager/orders/ajax/$1';
$route['manager/settings\.html'] = 'manager/settings/index';

$route['ajax/(:any)'] = "ajax/$1";

$route['nap-the.html'] = 'cardloaded/index/$1';
#$route['tin-tuc.html'] = 'posts/index/$1';
$route['tai-khoan\.html'] = 'account/index';
$route['tai-khoan/doi-mat-khau\.html'] = 'account/change_pass';
$route['tin-tuc/(:any)\.html'] = 'single_post/index/$1';
$route['tin-tuc/tags/(:any)\.html'] = 'tags/index/$1';
$route['dang-ky\.html'] = 'register/index/$1';
$route['dang-nhap\.html'] = 'signin/index/$1';
$route['dang-xuat\.html'] = 'logout/index/$1';
$route['cart\.html'] = 'cart/index/$1';
$route['(:any)\.html'] = 'products/index/$1';
$route['sp/(:any)\.html'] = 'single/index/$1';





