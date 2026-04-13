<?php

/**
 *  insert data in the table 
 * @param string $table
 * @param array $data
 * @return array 
 */

function db_create(string $table,array $data):array {

   $sql = "INSERT INTO $table";
   $columns = "";
   $values = "";

   foreach ($data as $key => $value) {
     $columns .= $key . ",";
     $values .= "'$value'" . ",";
   }   

   $columns = rtrim($columns,",");
   $values = rtrim($values,",");

   $sql .= "($columns) VALUES ($values);";
   
   
  mysqli_query($GLOBALS['connect'], $sql);  
  
  $id = mysqli_insert_id($GLOBALS['connect']);

   $result = db_find($table, $id);

   return $result;

}

/**
 *  update row in table
 * @param string $table
 * @param int $id
 * @param array $data
 * @return array 
 */

function db_update(string $table, int $id, array $data):array {

   $sql = "UPDATE $table SET ";
   $columns_values = "";

   foreach ($data as $key => $value) {
     $columns_values .= "$key = '$value',";
   }   

   $columns_values = rtrim($columns_values,",");

   $sql .= "$columns_values WHERE id = $id;";
   
   mysqli_query($GLOBALS['connect'], $sql);  
  
   $result = db_find($table, $id);

   return $result;

}

/**
 *  delete row in table by id
 * @param string $table
 * @param int $id
 * @return boolean 
 */
function db_delete(string $table, int $id):bool {
    $sql = "DELETE FROM $table WHERE id = $id";

    $check = db_find($table, $id);

    if(!isset($check)) {
        return false;
    }

    mysqli_query($GLOBALS['connect'] , $sql);

    return true;
 }

/**
 *  select one row in table by id 
 * @param string $table
 * @param int $id
 * @return mixed array or NULL
 */
function db_find(string $table, int $id): mixed {
    $query = mysqli_query($GLOBALS['connect'],
    "SELECT * FROM $table WHERE id=$id");

    return mysqli_fetch_array($query);
}

/**
 *  select all rows in table
 * @param string $table
 * @return mixed array or NULL
 */
function db_get(string $table):mixed {
    $query = mysqli_query($GLOBALS['connect'], "SELECT * FROM $table;");

    $result = [];
    while($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}

/**
 *  filter rows in table by where condition  
 * @param string $table
 * @param string $where
 * @return mixed array or NULL
 */
function db_where(string $table, string $where): mixed {

    $query = mysqli_query($GLOBALS['connect'], 
    "SELECT * FROM $table WHERE $where");

    $result = [];
    while($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}


/**
 *  pagination rows data from table
 * @param string $table
 * @param int $limit
 * @param int $page
 * @param string $where 
 * @param string $order
 * @return mixed array or NULL
 */
function db_pagination(string $table, int $limit, int $page, string $where = "", string $order = "ASC"): mixed {
    

    if($where == "")
       $rows = mysqli_query($GLOBALS['connect'], "SELECT * FROM $table;");
    else 
        $rows = mysqli_query($GLOBALS['connect'], "SELECT * FROM $table WHERE $where;");

    $total_rows = mysqli_num_rows($rows);


    $total_pages = ceil($total_rows / $limit);

    if($page > $total_pages) {
        $page = $total_pages;
    } else if($page < 0) {
        $page = 1;
    }

    $start = ($page - 1) * $limit;

    if($where == "")
        $query = mysqli_query($GLOBALS['connect'], 
        "SELECT * FROM $table ORDER BY id $order LIMIT $start,$limit;");
    else 
        $query = mysqli_query($GLOBALS['connect'], 
        "SELECT * FROM $table WHERE $where ORDER BY id $order LIMIT $start,$limit;");

    $result = [];
    while($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return [
        'data' => $result,
        'total_rows' => $total_rows,
        'render' => db_render($total_pages),
        'current_page' => $page,
        'total_pages' => $total_pages,
    ];
}


function db_render(int $total_pages):string {
    $html = "<lu>";
  
    for($i = 1;$i <= $total_pages ; $i++) {
       $html .= "<li><a href='?page=$i' >$i</a></li>";
    }

    $html .= "</lu>";

    return $html;
}
