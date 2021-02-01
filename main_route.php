<?php
Route::add('global.css',function (){
    global $url,$access_denied;
    if ($access_denied and !isset($_SERVER['HTTP_REFERER']) or strpos($_SERVER['HTTP_REFERER'],$url)===false){
        header("HTTP/1.0 404 Not Found");
        return;
    }else{
        header("Content-Type: text/css");
    }
	require(__DIR__.'/global.css');
});
Route::add('global.js',function (){
    global $url,$jsroot,$access_denied;
    if ($access_denied and (!isset($_SERVER['HTTP_REFERER']) or strpos($_SERVER['HTTP_REFERER'],$url)===false)){
        header("HTTP/1.0 404 Not Found");
        return;
    }else{
        header("Content-Type: text/javascript");
    }
    echo "
        var url = '$url';
        var jsroot = '$jsroot';
    ";
	require(__DIR__.'/global.js');
});
Route::add('[a-zA-Z0-9/\.\-]+\.css',function (){
	global $url,$access_denied;
	if ($access_denied and (!isset($_SERVER['HTTP_REFERER']) or strpos($_SERVER['HTTP_REFERER'],$url)===false)){
		header("HTTP/1.0 404 Not Found");
		return;
	}else{
		header("Content-Type: text/css");
	}
	$uri = $_SERVER['REQUEST_URI'];
	$uri = substr($uri, strpos($uri,'/',1)+1);
	require(__DIR__ . '/public/' .$uri);
});
Route::add('[a-zA-Z0-9/\.\-]+\.js',function (){
    global $url,$jsroot,$access_denied;
    if ($access_denied and !isset($_SERVER['HTTP_REFERER']) or strpos($_SERVER['HTTP_REFERER'],$url)===false){
        header("HTTP/1.0 404 Not Found");
        return;
    }else{
        header("Content-Type: text/javascript");
    }
    echo "
        var url = '$url';
        var jsroot = '$jsroot';
    ";
	$uri = $_SERVER['REQUEST_URI'];
    $uri = substr($uri, strpos($uri,'/',1)+1);
	require(__DIR__.'/public/'.$uri);
});
Route::run();