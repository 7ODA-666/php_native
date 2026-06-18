<?php 


/**
 * return data from config files
 * @param string $path
 * @return mixed string or null
 */
if(!function_exists('config')) {
  function config(string $path) {
    $path_info = explode(".", $path);

    if(count($path_info) > 1) {
        $data = include base_path("config/$path_info[0].php");
        return $data[$path_info[1]];
    }

  }
}


/**
 * get short path return full path
 * @param string $path
 * @return string 
 */
if(!function_exists('base_path')) {
  function base_path(string $path): string {
    return getcwd() . "/../$path";
  }
}


/**
 * get short path return full public path
 * @param string $path
 * @return string 
 */
if(!function_exists('public_path')) {
  function public_path(string $path): string {
    return getcwd() . "/$path";
  }
}


/**
 * return name public folder
 * @return string 
 */
if(!function_exists('public_')) {
  function public_(): string {
    return 'public';
  }
}
