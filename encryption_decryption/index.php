<?php
//$key = getToken(128); - get token for yourself
$key = 'aPS8WqLrru80z4vnjIJvQ2OevHmfZUWCCeGxBC3AK7VYztjJ1TIClKIO4QLeGFWAClQeDQ8M9DHyNaujhWeKUUZ1aSIVKtt0YkyEcWbPMAPG79T0kSNLaWEWTLcFlOdi';

//$key previously generated safely, ie: openssl_random_pseudo_bytes
$plaintext = "This is a test string";
$ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
// To add random bytes (16 in this case)
$iv = openssl_random_pseudo_bytes($ivlen);
$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
$ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
print $plaintext . '<hr>';
print $ciphertext; print '<hr>';

//decrypt later....
$c = base64_decode($ciphertext);
$ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len = 32);
$ciphertext_raw = substr($c, $ivlen + $sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
if (hash_equals($hmac, $calcmac)) {
  //PHP 5.6+ timing attack safe comparison
  print $original_plaintext;
}

function getToken($length) {
  $token = '';
  $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $codeAlphabet.= 'abcdefghijklmnopqrstuvwxyz';
  $codeAlphabet.= '0123456789';
  $max = strlen($codeAlphabet); // edited

  for ($i = 0; $i < $length; $i++) {
    $token .= $codeAlphabet[rand(0, $max - 1)];
  }

  return $token;
}

get_cription_methods();

function get_cription_methods() {
  $ciphers             = openssl_get_cipher_methods();
  $ciphers_and_aliases = openssl_get_cipher_methods(true);
  $cipher_aliases      = array_diff($ciphers_and_aliases, $ciphers);

  //ECB mode should be avoided
  $ciphers = array_filter( $ciphers, function($n) { return stripos($n,"ecb")===FALSE; } );

  //At least as early as Aug 2016, Openssl declared the following weak: RC2, RC4, DES, 3DES, MD5 based
  $ciphers = array_filter( $ciphers, function($c) { return stripos($c,"des")===FALSE; } );
  $ciphers = array_filter( $ciphers, function($c) { return stripos($c,"rc2")===FALSE; } );
  $ciphers = array_filter( $ciphers, function($c) { return stripos($c,"rc4")===FALSE; } );
  $ciphers = array_filter( $ciphers, function($c) { return stripos($c,"md5")===FALSE; } );
  $cipher_aliases = array_filter($cipher_aliases,function($c) { return stripos($c,"des")===FALSE; } );
  $cipher_aliases = array_filter($cipher_aliases,function($c) { return stripos($c,"rc2")===FALSE; } );
}