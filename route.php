<?php
require(__DIR__."/functions.php");
Route::add('delete',function(){
	$u=new User();
	$u->delete();
});
Route::add('hello',function(){
	global $url,$root,$jsroot,$cookie_name;
	require(__DIR__.'/public/test.php');
});
$folders = array(
);
foreach ($folders as $folder){
	require(__DIR__."/public/$folder/route.php");
}
require('main_route.php');