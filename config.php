<?php
$default_timezone='Asia/Kolkata';

$cookie_name='user';
//$url='http://192.168.0.114';
$url='http://localhost';
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	$root='/xampp/htdocs/ADAS';
else
	$root='/opt/lampp/htdocs/ADAS';
$jsroot='/ADAS';

$admin_email='example@gmail.com';
$admin_password='xyzxyz';
$admin_name='Admin_name';
$recieve_email='example@gmail.com';

$database_url='localhost';
$database_username='root';
$database_password='';
$database_name='test';

$access_denied = true;