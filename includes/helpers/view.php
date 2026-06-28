<?php

/**
 * redirect to view path and if exist vars pass it
 * @param string $path
 * @param array $vars
 * @return void
 */
if(!function_exists('view')) {
    function view(string $path,array $vars=[]) {

        $full_path = str_replace('.', '/', $path);
        
        $file = config('view.path') . '/' . $full_path . '.php';
        $file_error = config('view.path') . '/404.php';
        
        if(file_exists($file)) {
            if(!empty($vars)) {
                foreach($vars as $key => $value) {
                    $$key = $value;
                }
            }

            $request_data = null;
            
            if(isset($_POST) && count($_POST) > 0) {
                 $request_data = $_POST;
            } else if(isset($_GET) && count($_GET) > 0 ) {
                $request_data = $_GET;
            }

            if(isset($request_data) && !empty($request_data)) {
                foreach($request_data as $key => $value) {
                    set_old($key, $value);
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
}


