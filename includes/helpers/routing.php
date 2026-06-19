<?php

/**
 * routing system
 * @var mixed
 */
$routes = [];

/**
 *  register get route
 * @param mixed $segment
 * @param string|null $view
 * @return void
 */
if(!function_exists('route_get')) {
    function route_get(mixed $segment, $view = null): void {
        global $routes;

        $routes['GET'][] = [
            'view' => $view,
            'segment' => '/' . ltrim($segment,'/'),
        ];

    }
}



/**
 *  register post route
 * @param mixed $segment
 * @param string|null $view
 * @return void
 */
if(!function_exists('route_post')) {
    function route_post(mixed $segment, $view = null): void {
        global $routes;

        $routes['POST'][] = [
            'view' => $view,
            'segment' => '/' . ltrim($segment,'/'),
        ];

    }
}


/**
 * redirect to another path
 * @param string $path
 * @return void
 */
if(!function_exists('redirect')) {
    function redirect(string $path) {
        header('Location: ' . url($path));
        exit();
    }
}


/**
 * segment is path in url
 * @return string
 */
if(!function_exists('segment')) {
    function segment() {
        $segment = ltrim( $_SERVER['REQUEST_URI'], '/');
        $segment = ltrim( $segment, config('app.app_name'));
        $segment = ltrim( $segment,'/');
        $segment_remove_parameter = explode('?', $segment);
        return '/' . $segment_remove_parameter[0];
    }
}


/**
 * inital routing in sysytem
 * @return void
 */
if(!function_exists('route_init')) {
    function route_init() {
        global $routes;

        $ROUTES_GET = $routes['GET'] ?? [];
        $ROUTES_POST = $routes['POST'] ?? [];

    

        if(isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            foreach($ROUTES_POST as $rpost) {
                if(segment() == $rpost['segment']) {
                    view($rpost['view']); 
                    break;
                }
            }
        } else {
            foreach($ROUTES_GET as $rget) {
                if(segment() == $rget['segment']) {
                    view($rget['view']);
                    break;
                }
            }
        }
    
    }
}


/**
 * return full path url
 * @param mixed $segment
 * @return string
 */
if(!function_exists('url')) {
    function url(mixed $segment) {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        // if run local host + exist app name
        $url .= '/' . config('app.app_name');

        return $url . '/' . ltrim($segment, '/');
    }
}
