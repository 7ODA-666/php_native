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
             
            
            $view = $file;
        } else if(file_exists($file_error)) {
            $title = 'error page';
            $view = $file_error;
        } else {
            echo '<h1 style="color:red" > 404 Error Page Required </h1>';
            exit;
        }

        view_engine($view);

    }
}


if(!function_exists('view_engine')) {
    function view_engine(string $view) {

        $array_full_path = explode('/', $view);
        $file_name = end($array_full_path);

        $full_base = base_path("storage/views/$file_name");

        if(!file_exists($full_base)) {
            
            $file = file_get_contents($view);

            $file = str_replace('{{', '<?php echo ', $file);
            $file = str_replace('}}', ' ;?>', $file);

            $file = str_replace('{%', '<?php', $file);
            $file = str_replace('%}', '?>', $file);

            $file = str_replace('@php', '<?php', $file);
            $file = str_replace('@endphp', '?>', $file);

            // if statement
            $file = preg_replace('/@if\((.*?)\)+/i', '<?php if($1): ?>', $file);
            $file = preg_replace('/@endif/i', '<?php endif; ?>', $file);
                
            // foreach statment
            $file = preg_replace('/@foreach\((.*?) as (.*?)\)+/i', '<?php foreach($1 as $2): ?>', $file);
            $file = preg_replace('/@endforeach/i', '<?php endforeach; ?>', $file);


            file_put_contents($full_base, $file);
        }

        include $full_base;
    }
}