<?php
// aes encryption
function encrypt($message,$key)
{
    $cipher_method = 'aes-128-ctr';
    $enc_key = openssl_digest($key, 'SHA256', TRUE);
    $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
    $cipher = openssl_encrypt($message, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
    return $cipher;
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