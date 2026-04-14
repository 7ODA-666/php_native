<?php


function encrypt($value) : string {
    $mode = config('session.encryption_mode');
    $key = config('session.encryption_key');

    $ivlen = openssl_cipher_iv_length($mode);
    $iv = openssl_random_pseudo_bytes($ivlen);

    $ciphertext_raw = openssl_encrypt($value,$mode,$key,OPENSSL_RAW_DATA, $iv);

    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
    
    $ciphertext = base64_encode($iv.$hmac.$ciphertext_raw);

    return $ciphertext;
}


function decrypt($value) : string {
    $mode = config('session.encryption_mode');
    $key = config('session.encryption_key');

    $ciphertext = base64_decode($value);

    $ivlen = openssl_cipher_iv_length($mode);
    $iv = substr($ciphertext, 0, $ivlen);

    $hmac = substr($ciphertext, $ivlen, 32);

    $ciphertext_raw = substr($ciphertext, $ivlen+32);
    $plaintext = openssl_decrypt($ciphertext_raw, $mode, $key, OPENSSL_RAW_DATA, $iv);

    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);

    if(hash_equals($hmac,$calcmac)) {
        return $plaintext;
    } else {
        return '';
    }
}

