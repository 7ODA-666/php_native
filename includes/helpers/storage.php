<?php


/**
 * create symbolic link to storage upload
 * @return void
 */
if(!function_exists('storage_link')) {
    function storage_link() {
       
        symlink(base_path('storage/uploads'), public_path('storage'));
        
    }
}

/**
 * delete file from storage uploads
 * @param string $path
 * @return bool
 */
if(!function_exists('delete_file')) {
    function delete_file(string $path) : bool {
        $file_path = config('upload.upload_path') . '/' . ltrim($path, '/');
        if(file_exists($file_path)) {
            unlink($file_path);
            return true;
        }
        return false;
    }
}

/**
 * delete folder from storage uploads
 * @param string $path
 * @return bool
 */
if(!function_exists('delete_folder')) {
    function delete_folder(string $path) : bool {

        $folder_path = config('upload.upload_path') . '/' . ltrim($path, '/');

        if(file_exists($folder_path) && is_dir($folder_path)) {
            rmdir($folder_path);
            return true;
        }

        return false;
    }
}


/**
 * store any file in storage upload
 * @param mixed $file
 * @param string $path
 * @return mixed
 */
if(!function_exists('store_file')) {
    function store_file(mixed $file, string $path) {
        
        if(!isset($file['tmp_name'])) {
            return false;
        }
    
        $upload_path = config('upload.upload_path') . '/' . ltrim($path, '/');

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        // $filename = time() . '_' . $file['name'];
        $filename = $file['name'];
        move_uploaded_file($file['tmp_name'], $upload_path . '/' . $filename);
        return $filename;
    }
}

if(!function_exists('storage')) {
    function storage(string $path) {
       
        
        if(!file_exists($path)) {
            exit();
        }

        header('Content-Description: file from server');
        header('Content-Type: attachment; filename="' . basename($path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit();

    }
}