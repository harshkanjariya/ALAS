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
function rotateLeft($n){
    return (($n&128)==128)+(($n*2)&255);
}
function encrypt2($message,$key){
	$cipher = "";
	$last = 0;
	$len = strlen($key);
	for ($j=0;$j<strlen($message);$j++) {
		$d = ord($message[$j]);
		$d ^= ord($key[$j%$len]);
		$d ^= $last;
        $last = $d;
		$cipher .= chr($d);
	}
	return $cipher;
}
function encrypt($msg){
    $l = intval(random_string(1,'1'));
	$pre = random_string(4);
	$post = random_string($l);
	$len = random_string(2,'1');
	$key = random_string(intval($len));
	$cipher = encrypt2($post.$msg,$key);
    $enc_key = encrypt2($pre.$len.$key.$post,"onmoving");
    return base64_encode($cipher."::".$enc_key);
}
// aes decryption
function decrypt($encrypted,$key)
{
    list($crypted_token, $enc_iv) = explode("::", $encrypted);
    $cipher_method = 'aes-128-ctr';
    $enc_key = openssl_digest($key, 'SHA256', TRUE);
    $plain = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
    return $plain;
}
// prevent session hijacking
if (session_status()==PHP_SESSION_ACTIVE){
	session_regenerate_id(true);
}
?>