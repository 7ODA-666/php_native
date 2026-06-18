<?php


/**
 * show and set session
 * @param string $key
 * @param mixed $value 
 * @return mixed 
 */
if(!function_exists('session')) {
    function session(string $key, mixed $value = null): mixed {

        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }

        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : null;
    
    }
}



/**
 * show and set session
 * @param string $key
 * @return bool 
 */
if(!function_exists('session_has')) {
    function session_has(string $key): bool {
        return isset($_SESSION[$key]);    
    }
}



/**
 * delete one session by $key
 * @param string $key
 * @return mixed 
 */
if(!function_exists('session_delete')) {
    function session_delete(string $key) : mixed {

        if(isset($_SESSION[$key])) {
            $session = $_SESSION[$key];
            unset($_SESSION[$key]);  
        }

        return $session;
    }
}


/**
 * delete all session (empty session)
 * @return void 
 */
if(!function_exists('session_delete_all')) {
    function session_delete_all(): void {
        session_destroy();
    }
}
