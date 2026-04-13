<?php

 ob_start();
 require_once __DIR__ . "/includes/app.php";
 session_start([
     'cookie_lifetime' => config('session.timeout'),
     ]);
require_once __DIR__ . "/routes/web.php";
require_once __DIR__ . "/includes/exception_error.php";
 

  route_init();


     
 ob_end_flush();
 mysqli_close($connect);