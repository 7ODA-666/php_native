<?php

/**
 * return rquest paramter from form
 * @param string $request
 * @return string|null
 */
if(!function_exists('request')) {
    function request(string $request) {
        return isset($_REQUEST[$request]) ? $_REQUEST[$request] : null;
    }
}
