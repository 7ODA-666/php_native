<?php


function view(string $path,array $vars=[]) {
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
        if(!empty($vars)) {
            foreach($vars as $key => $value) {
                $$key = $value;
            }
        }
        
        include $file;
    } else if(file_exists($file_error)) {
        $title = 'error page';
        include $file_error;
    } else {
         echo '<h1 style="color:red" > 404 Error Page Required </h1>';
         exit;
    }

}

