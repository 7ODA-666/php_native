<?php

$ROUTES_GET = $routes['GET'] ?? [];
$ROUTES_POST = $routes['POST'] ?? [];

// handle exception error to post request 
if(isset($_POST) && count($_POST) > 0 && strtolower($_POST['_method']) == 'post') {
    $ROUTES_POST_SEARCH = array_column($ROUTES_POST,'segment');
    if(!in_array(segment(), $ROUTES_POST_SEARCH)) {
        view('404');
    }
} else {
    // handle exception error to get request 
    $ROUTES_GET_SEARCH = array_column($ROUTES_GET,'segment');
    if(!in_array(segment(), $ROUTES_GET_SEARCH)) {
        // $segment = ltrim(segment(),'/');
        // if(preg_match('/^storage/i', $segment)) {
        //     storage($segment);
        // } else {
        //     }
            
        view('404');
    }
}

// 01040998703 احمد  550



