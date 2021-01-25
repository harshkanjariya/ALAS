<?php
require(__DIR__."/functions.php");

Route::add('delete',function(){
	$u=new User();
	$u->delete();
});
Route::add('',function(){
	require(__DIR__.'/public/index.php');
});
Route::run();
?>