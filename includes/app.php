 <?php

$helpers = ['request','helper','routing','db', 'session', 'mail','lang' ,'view'];

foreach ($helpers as $helper) {
      require_once __DIR__ ."/helpers/$helper.php";
}

 $connect = mysqli_connect(
       config('database.hostname'),
       config('database.username'),
       config('database.password'),
       config('database.database'),
       config('database.port'),
 );



 


