<?php

/**
 * return rquest paramter from form
 * @param string $request
 * @return string|null
 */
if(!function_exists('request')) {
    function request(string $request) {

        if(isset($_FILES[$request])) {
            return $_FILES[$request];
        }
        
        return isset($_REQUEST[$request]) ? $_REQUEST[$request] : null;
    }
}

/**
 * redirect back url
 * @return void
 */
if(!function_exists('redirect_back')) {
    function redirect_back() {
        $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: {$redirect_url}");
        exit;
    }
}

/**
 * return old value request by name field
 * or return other value if old value not exist
 * @param string $field
 * @param string|null $other_value
 * @return string|null $value
 */
if(!function_exists('old')) {
    function old(string $field, $other_value = null) {
        return session_has("old_{$field}") ? session_delete("old_{$field}") : $other_value;
    }
}

/**
 * set field value into session
 * @param string $field
 * @param string $vlaue
 */
if(!function_exists('set_old')) {
    function set_old(string $field, string $value) {
        session("old_{$field}", $value);
    }
}

