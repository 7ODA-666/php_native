<?php

$routes = [];

function route_get($segment, $view = null): void {
    global $routes;

    $routes['GET'][] = [
        'view' => $view,
        'segment' => '/' . ltrim($segment,'/'),
    ];

}




function route_post($segment, $view = null): void {
    global $routes;

    $routes['POST'][] = [
        'view' => $view,
        'segment' => '/' . ltrim($segment,'/'),
    ];

}


function redirect($path) {
    header('Location: ' . url($path));
    exit();
}


function segment() {
    $segment = ltrim( $_SERVER['REQUEST_URI'], '/');
    $segment = ltrim( $segment, config('app.app_name'));
    $segment = ltrim( $segment,'/');
    $segment_remove_parameter = explode('?', $segment);
    return '/' . $segment_remove_parameter[0];
}


function route_init() {
    global $routes;

    $ROUTES_GET = $routes['GET'] ?? [];
    $ROUTES_POST = $routes['POST'] ?? [];


    if(isset($_POST) && count($_POST) > 0 && strtolower($_POST['_method']) == 'post') {
        foreach($ROUTES_POST as $rpost) {
            if(segment() == $rpost['segment']) 
                view($rpost['view']); 
        }
    } else {
        foreach($ROUTES_GET as $rget) {
            if(segment() == $rget['segment']) 
                view($rget['view']);
        }
    }
    
}


function url($segment) {
    $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
    $url .= $_SERVER['HTTP_HOST'];
    // if run local host + exist app name
    $url .= '/' . config('app.app_name');

    return $url . '/' . ltrim($segment, '/');
}