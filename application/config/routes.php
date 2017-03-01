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

$route['admin'] = 'pagescontroller';
$route['admin/addstore/checkfields'] = 'StoreRegisterController/check_store_credentials';
$route['admin/register/checkfields'] = 'RegistrationController/check_user_credentials';
$route['admin/register'] = 'pagescontroller/register';
$route['admin/viewvendors'] = 'pagescontroller/viewvendors';
$route['admin/removedvendors'] = 'pagescontroller/viewremovedvendors';
$route['admin/addstore'] = 'pagescontroller/storeregister';
$route['admin/viewstores'] = 'pagescontroller/viewstores';
$route['admin/removedstores'] = 'pagescontroller/viewremovedstores';
$route['admin/viewreport'] = 'pagescontroller/viewreport';
$route['vendor/viewcategories'] = 'vendorpagescontroller/viewcategories';
$route['vendor/deletedcategories'] = 'vendorpagescontroller/deletedcategories';
$route['vendor/updateProduct'] = 'vendorpagescontroller/updateProduct';
$route['vendor/deleteProduct'] = 'vendorpagescontroller/deleteProduct';
$route['vendor/viewOrders'] = 'vendorpagescontroller/viewOrders';
$route['vendor/orderHistory'] = 'vendorpagescontroller/orderHistory';
$route['vendor/viewproduct'] = 'vendorpagescontroller/viewproduct';
$route['vendor/deletedproducts'] = 'vendorpagescontroller/viewdelproduct';
$route['vendor/addproduct'] = 'vendorpagescontroller/addproduct';
$route['vendor/addcategory'] = 'vendorpagescontroller/addcategory';
$route['vendor/vendorreport'] = 'vendorpagescontroller/vendorreport';
$route['vendor/viewcoupons'] = 'vendorpagescontroller/viewcoupons';
$route['vendor/profile'] = 'vendorpagescontroller/profile';
$route['vendor'] = 'vendorpagescontroller';
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
