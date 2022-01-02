<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['add/submit'] = 'IndexController/addItem';

$route['api/setPayment'] = 'RestController/setPayment';
$route['api/getCartInfo'] = 'RestController/getCartInfo';
$route['api/getItemDetail'] = 'RestController/getItemDetail';
$route['api/getHistory'] = 'RestController/getHistory';
