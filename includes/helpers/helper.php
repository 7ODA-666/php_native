<?php 


/**
 * return data from config files
 * @param string $path
 * @return mixed string or null
 */
function config(string $path) {
  $path_info = explode(".", $path);

  if(count($path_info) > 1) {
      $data = include base_path("config/$path_info[0].php");
      return $data[$path_info[1]];
  }

}

/**
 * get short path return full path
 * @param string $path
 * @return string 
 */
function base_path(string $path): string {
  return getcwd() . "/$path";
}