<?php


/**
 * show and set session
 * @param string $key
 * @param mixed $vlaue 
 * @return mixed 
 */
function session(string $key, mixed $value = null): mixed {

    if (!is_null($value)) {
        $_SESSION[$key] = $value;
    }

    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    
}

/**
 * delete one session by $key
 * @param string $key
 * @return void 
 */
function session_delete(string $key) : mixed {

   if(isset($_SESSION[$key])) {
       $session = $_SESSION[$key];
       unset($_SESSION[$key]);  
   }

   return $session;
}

/**
 * delete all session (empty session)
 * @return mixed 
 */
function session_delete_all(): void {
    session_destroy();
}