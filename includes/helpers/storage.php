<?php

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
        
        $filename = time() . '_' . $file['name'];
        move_uploaded_file($file['tmp_name'], $upload_path . '/' . $filename);
        return $filename;
    }
}