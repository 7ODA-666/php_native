<?php
/**
 * translate string to current language my file in resources/lang
 * @param string $key
 * @return string
 */
if(!function_exists('trans')) {
    function trans(string $key) {

        $trans = explode('.', $key);

        if(session_has('local')) {
            $lang = session('local');
        } else {
            $lang = config('lang.default');
        }

        if(count($trans) < 2) {

            return 'trans is empty or is not complete';
        } 

        $full_path = config('lang.path') . "/$lang/$trans[0].php" ; 

        if(!file_exists($full_path)) {

            return 'lang file not found';
        }

        $result = include $full_path;

        return isset($result[$trans[1]]) ? $result[$trans[1]] : $key;
    }
}


/**
 * set want language into session
 * @param string $lang
 * @return void
 */
if(!function_exists('set_local')) {
    function set_local(string $lang) {
        session('local', $lang);
    }
}


/**
 * get current language from session
 * 
 */
if(!function_exists('get_local')) {
    function get_local() {
        return session_has('local') ? session('local') : config('lang.default');
    }
}