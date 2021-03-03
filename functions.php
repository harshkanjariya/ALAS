<?php
require(__DIR__.'/config.php');
require(__DIR__.'/language.php');
require(__DIR__.'/security.php');
require(__DIR__.'/libs.php');
require(__DIR__.'/extra_functions.php');
require(__DIR__ . '/main_classes/Database.class.php');
require(__DIR__ . '/main_classes/Route.class.php');
spl_autoload_register(function($classname){
	if(!class_exists($classname));
		require_once(__DIR__.'/classes/'.$classname.'.class.php');
});
date_default_timezone_set($default_timezone);
function newid(){
	return round(microtime(true)*1000);
}
function idtomillis($id){
	return ($id)/1000;
}
function datefromid($string,$id){
	return date($string,($id)/1000);
}
function allow_only($str, $allowed){
    $str = htmlspecialchars($str);
    foreach( $allowed as $a ){
        $str = str_replace("&lt;".$a."&gt;", "<".$a.">", $str);
        $str = str_replace("&lt;/".$a."&gt;", "</".$a.">", $str);
    }
    return $str;
}
function prt($ar){
	echo "<pre>";
	if (is_array($ar))
		print_r($ar);
	else
		echo $ar;
	echo "</pre>";
}
function compile_alas($match){
	$match = $match[0];
	$match = substr($match,2,strlen($match)-4);
//	$func = substr($match,0,strpos($match,'{'));
//	$match = substr($match,strpos($match,'{')+1,strlen($match)-3-strlen($func));
//	$params = explode(',',$match);
	return $match;
}
function view($filename){
	ob_start();
	require($filename);
	$content = ob_get_clean();
	if (preg_match('/{[a-zA-Z0-9_]+{.*}}/',$content,$mattch)){
		$content = preg_replace_callback('/{[a-zA-Z0-9_]+{.*}}/','compile_alas',$content);
	}
	echo $content;
}
function upload_file($file,$path){
	$tmp=$file['tmp_name'];
	if(move_uploaded_file($tmp,$path)){
		return "success";
	}else{
		return "error";
	}
}
function upload_image($file,$path){
	$img=$file['tmp_name'];
	$img_info=getimagesize($img);
	$width = $img_info[0];
	$height = $img_info[1];
	switch ($img_info[2]) {
		case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
		case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
		default : die("Unknown filetype ".$img_info[2]);
	}
	$tmp = imagecreatetruecolor($width,$height);
	imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
	imagejpeg($tmp,$path.'.jpg');
	imagedestroy($tmp);
	return "success";
}
function send_mail($email,$name,$subject,$body){
	global $admin_email,$admin_password,$admin_name,$root;
	require_once($root.'/PHPMailer/src/PHPMailer.php');
	require_once($root.'/PHPMailer/src/Exception.php');
	require_once($root.'/PHPMailer/src/SMTP.php');
	$mail=new PHPMailer\PHPMailer\PHPMailer();
    if(!$mail->validateAddress($email)){
    	echo 'Invalid Email Address : '.$email;
        return;
    }
    $mail->IsSMTP();
    //$mail->SMTPDebug = 3;
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    // $mail->Port = 465;
    // $mail->SMTPSecure = 'ssl';
    $mail->Username = $admin_email;
    $mail->Password = $admin_password;
    $mail->setFrom($admin_email,$admin_name);
    $mail->AddReplyTo($admin_email,$admin_name);
    $mail->addAddress($email,$name);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    if(!$mail->send()){
        return 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        return 'success';
    }
}
function random_string($n,$s='aA1'){
	$a='';
	if(strpos($s,'a')!==false){
		$a.='abcdefghijklmnopqrstuvwxyz';
	}
	if(strpos($s,'A')!==false){
		$a.='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
	if(strpos($s,'1')!==false){
		$a.='0123456789';
	}
	if(strpos($s,'@')!==false){
		$a.='@#$%^?&.,\'";:+-*/';
	}
	$r='';
	for ($i=0;$i<$n;$i++) { 
		$r.=$a[rand(0,strlen($a)-1)];
	}
	return $r;
}
function device(){
	if (is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"))) {
        $device=is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "tablet")) ? 'Tablet' : 'Phone or Mobile' ;
      }else {
        $device='Desktop';
      }
	return $device;
}
function ipAddress(){
	if($_SERVER['REMOTE_ADDR']=='::1') {
   		$ip_address='127.0.0.1';
	}else 
   		$ip_address=$_SERVER['REMOTE_ADDR'];
   	return $ip_address;
}
function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result;
}
function object_to_array($obj, &$arr)
{
 if (!is_object($obj) && !is_array($obj))
 {
  $arr = $obj;
  return $arr;
 }

 foreach ($obj as $key => $value)
 {
  if (!empty($value))
  {
   $arr[$key] = array();
   object_to_array($value, $arr[$key]);
  }
  else {$arr[$key] = $value;}
 }

 return $arr;
} 
function db(){
	if(!isset($GLOBALS['database'])){
		global $database_url,$database_username,$database_password,$database_name;
		$GLOBALS['database']=new Database($database_url,$database_username,$database_password,$database_name);
	}
	return $GLOBALS['database'];
}
