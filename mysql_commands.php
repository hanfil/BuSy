<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '')

//Connect to database
function mysql_conn($dbname){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,$dbname);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
}

//Query the database for information
function mysql_ask($query, $task){
    //Different task are: 'resultnumber', 'fetch'
    
    $run = $mysqli->query($query);

    if($task == 'resultnumber'){
        return $run->num_rows;
    }
    elseif($task == 'fetch'){
        return $run->fetch_array(MYSQLI_BOTH);
        /*Example to use the return:
        $string1 $run['name']
        foreach (var string in $run){
            <td>string</td>
        }
        */
    }
}


?>