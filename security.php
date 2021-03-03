<?php
// aes encryption
function encryption($message,$key)
{
	$cipher_method = 'aes-128-ctr';
	$enc_key = openssl_digest($key, 'SHA256', TRUE);
	$enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
	$cipher = openssl_encrypt($message, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
	return $cipher;
}
function decryption($encrypted,$key)
{
	list($crypted_token, $enc_iv) = explode("::", $encrypted);
	$cipher_method = 'aes-128-ctr';
	$enc_key = openssl_digest($key, 'SHA256', TRUE);
	$plain = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
	return $plain;
}
function encrypt2($message,$key){
	$cipher = "";
	$last = 0;
	$len = strlen($key);
	$p = 0;
	for ($i=0; $i<$len; $i++){
		$p ^= ord($key[$i]);
	}
	for ($j=0;$j<strlen($message);$j++) {
		$d = ord($message[$j]) ^ $p;
		$d ^= ord($key[$j%$len]);
		$d ^= $last;
		$last = $d;
		$cipher .= chr($d);
	}
	return $cipher;
}
function encrypt($msg,$k){
	$l = intval(random_string(1,'1'));
	$pre = random_string(4);
	$post = random_string($l);
	$len = random_int(10,15);
	$key = random_string($len);
	$cipher = encrypt2($post.$msg,$key);
	$enc_key = encrypt2($pre.$len.$key.$post,$k);
	$encoded = base64_encode($cipher."::".$enc_key);
	return $encoded;
}
function decrypt2($message,$key){
	$dec = "";
	$last = 0;
	$len = strlen($key);
	if ($len==0)return $message;
	$p = 0;
	for ($i=0; $i<$len; $i++){
		$p ^= ord($key[$i]);
	}
	for ($i=0; $i < strlen($message); $i++){
		$d = ord($message[$i]) ^ $p;
		$d ^= ord($key[$i%$len]);
		$d ^= $last;
		$last = ord($message[$i]);
		$dec = $dec.chr($d);
	}
	return $dec;
}
function decrypt($msg,$k){
	$cipher = base64_decode($msg);
	$cipher = explode('::',$cipher);
	if (count($cipher)!==2)return $msg;
	$key = decrypt2($cipher[1],$k);
	$key = substr($key,4);
	$key = substr($key,4);
	$len = intval(substr($key,0,2));
	$key = substr($key,2);
	$tlen = strlen($key)-$len;
	$key = substr($key,0,$len);
	$result = decrypt2($cipher[0],$key);
	$result = substr($result,$tlen);
	return $result;
}
// prevent session hijacking
if (session_status()==PHP_SESSION_ACTIVE){
	session_regenerate_id(true);
}
?>
