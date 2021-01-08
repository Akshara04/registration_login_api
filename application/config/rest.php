<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['rest_auth'] = 'basic';
$config['rest_valid_logins'] = ['admin' => '1234'];
$config['rest_keys_table'] = 'keys';
$config['rest_enable_keys'] = TRUE;