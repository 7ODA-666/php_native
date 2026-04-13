<?php


function view(string $path) {
    $current_paths = explode(".", $path);

    $full_path = '';

    foreach($current_paths as $current) {
        if(end($current_paths) != $current) {
            $full_path .= "/$current";
        }
    }

    $file = config('view.path') . $full_path . '/'  . end($current_paths) . '.php';
    $file_error = config('view.path') . '/404.php';
    
    if(file_exists($file)) {
        include $file;
    } else if(file_exists($file_error)) {
        include $file_error;
    } else {
         echo '<h1 style="color:red" > 404 Error Page Required </h1>';
         exit;
    }

}

