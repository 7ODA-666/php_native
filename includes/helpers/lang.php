<?php

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


function set_local(string $lang) {
    session('local', $lang);
}