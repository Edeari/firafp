<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'LoginController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['fitxes'] = 'FitxapdfController/fitxa';
$route['fitxa'] = 'FitxapdfController/fitxa';
// codicentre 8 digits code, Lleida codes starts with 25
$route['fitxa/(25[0-9]{6})'] = 'FitxapdfController/fitxacentre/$1'; 
$route['fitxa/centres'] = 'FitxapdfController/fitxacentre'; 
$route['fitxa/([a-z]+)'] = 'FitxapdfController/fitxa/$1';

$route['home'] = 'HomeController/index';

$route['login'] = 'LoginController/login';
$route['login/out'] = 'LoginController/logout';

$route['admin/(:any)'] = 'AdminController/index/$1';
$route['admin/delete/(:any)/(:any)'] = "AdminController/deleteRegister/$1/$2";

$route['editar/(:any)/(:any)'] = 'EditController/index/$1/$2';

$route['centres_estudis/(:any)'] = 'CentresEstudisController/index/$1';
$route['centres_estudis/add/(:any)/(:any)'] = 'CentresEstudisController/addStudy/$1/$2';
$route['centres_estudis/delete/(:any)/(:any)'] = 'CentresEstudisController/deleteStudy/$1/$2';
$route['centres_estudis/modify/(:any)'] = 'CentresEstudisController/editDataStudy/$1';

$route['apirest/allregisters/(:any)']['GET'] = 'REST/RESTController/getDades/$1';
$route['apirest/familiestudies-(:any)']['GET'] = 'REST/RESTController/getFamiliesWithStudies/$1';
$route['apirest/studies']['GET'] = 'REST/RESTController/getFamiliesStudies';
$route['apirest/dual']['GET'] = 'REST/RESTController/getCentersDual';
$route['apirest/specialfamilies']['GET'] = 'REST/RESTController/getSpecialFamilies';

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
