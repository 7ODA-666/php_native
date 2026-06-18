<?php

ob_start();
$helpers = ['request','helper', 'AES','routing','db', 'session', 'mail','lang' ,'view'];

foreach ($helpers as $helper) {
      require_once __DIR__ ."/helpers/$helper.php";
}

session_save_path(config('session.session_save_path'));
 ini_set('session.gc_probility', 1);
 session_start([
        'cookie_lifetime' => config('session.timeout'),
      ]);

 $connect = mysqli_connect(
       config('database.hostname'),
       config('database.username'),
       config('database.password'),
       config('database.database'),
       config('database.port'),
 );

 if(!$connect) {
      die("Connection failed: " . mysqli_connect_error());
 }


require_once base_path('/routes/web.php');
require_once base_path('/includes/exception_error.php');




 


