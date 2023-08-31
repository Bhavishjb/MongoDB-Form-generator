<?php

defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'login';
$route['users/login_form'] = 'users/login_form';
$route['login'] = 'Login';
$route['register'] = 'register';
$route['login/logout'] = 'login/logout';
$route['FormController/update_form/(:any)'] = 'FormController/update_form/$1';


$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['display_form/(:any)'] = 'FormController/display_form/$1';
