<?php

$default_timezone='Asia/Kolkata';

$cookie_name='user';
$url='http://localhost';
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	$root='/xampp/htdocs/ADAS';
else
	$root='/opt/lampp/htdocs/ADAS';
$jsroot='/ADAS';

$admin_email='example@gmail.com';
$admin_password='xyzxyz';
$admin_name='Adas';
$recieve_email='example@gmail.com';

$database_url='localhost';
$database_username='root';
$database_password='';
$database_name='test';
?>