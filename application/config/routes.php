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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller']   = 'index_controller';
$route['404_override']         = 'admin_controller/error404';
$route['translate_uri_dashes'] = FALSE;
$route['error-404']            = 'admin_controller/error404';

//Auth
$route['inicio-sesion']         = 'auth_controller/cargar_login';
$route['login']['POST']         = 'auth_controller/login';
$route['logout']                = 'auth_controller/logout';
$route['register']              = 'auth_controller/register';
$route['forgot-password']       = 'auth_controller/forgot_password';
$route['reset-password']        = 'auth_controller/reset_password';

// Admin
$route['admin/dashboard']                  = 'admin_controller';
$route['admin/activity-logs']['GET']       = 'admin_controller/activity_logs';

// Usuarios
$route['admin/user-profile/(:num)']   = 'users_controller/profile/$1';
$route['admin/user-add']['GET']       = 'users_controller/add_user';
$route['admin/users']['GET']          = 'users_controller/users';

//Settings
$route['admin/settings']['GET']           = 'settings_controller';
$route['admin/email-settings']['GET']     = 'email_controller';
$route['admin/mqtt-settings']['GET']      = 'settings_controller/mqtt_settings';

// Devices
$route['admin/devices-add']['GET']           = 'devices_controller/deviceAdd';
$route['admin/devices-store']['POST']        = 'devices_controller/deviceStore';
$route['admin/devices-list']['GET']          = 'devices_controller/deviceList';
$route['admin/devices/view/(:any)']          = 'devices_controller/deviceView/$1';


// API para respuestas desde los recursos de EMQX.
$route['api/v1/devices/status']['POST']      = 'api/apidevices_controller/status';
$route['api/v1/devices/store']['POST']       = 'api/apidevices_controller/store';
