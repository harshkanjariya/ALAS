<?php
Route::add('.*\.(jpg|png|svg|webp|ico|mp4|mp3)',function(){
	$uri = $_SERVER['REQUEST_URI'];
	$uri = substr($uri, strpos($uri,'/',1)+1);
	readfile('public/'.$uri);
//	global $jsroot;
//	header("Location: $jsroot/public/$uri");
});
Route::add('global.css',function (){
	header("Content-Type: text/css");
	require(__DIR__.'/global.css');
});
Route::add('global.js',function (){
	global $url,$jsroot;
	header("Content-Type: text/javascript");
	echo "
        var url = '$url';
        var jsroot = '$jsroot';
    ";
	require(__DIR__.'/global.js');
});
Route::add('[a-zA-Z0-9/_\.\-]+\.css',function (){
	$uri = $_SERVER['REQUEST_URI'];
	$uri = substr($uri, strpos($uri,'/',1)+1);
	require(__DIR__ . '/public/' .$uri);
});
Route::add('[a-zA-Z0-9/_\.\-]+\.js',function (){
	global $url,$jsroot;
	header("Content-Type: text/javascript");
	echo "
        var url = '$url';
        var jsroot = '$jsroot';
    ";
	$uri = $_SERVER['REQUEST_URI'];
	$uri = substr($uri, strpos($uri,'/',1)+1);
	require(__DIR__.'/public/'.$uri);
});
Route::add('',function(){
	global $url,$root,$jsroot,$cookie_name;
	require(__DIR__.'/public/index.php');
},'get',true);
Route::run();