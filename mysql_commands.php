<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Connect to database
function mysql_conn($dbname, $force){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,$dbname);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
        if($force == 'yes'){
            $query="CREATE DATABASE".$dbname;
            mysql_ask($query,'update');
        }
    }
}

//Query the database for information
function mysql_ask($query, $task){
    //Different task are: 'resultnumber', 'fetch', 'update'

    if($task == 'resultnumber'){
        $run = $mysqli->query($query);
        return $run->num_rows;
    }
    elseif($task == 'fetch'){
        $run = $mysqli->query($query);
        return $run->fetch_array(MYSQLI_BOTH);
        /*Example to use the return:
        $string1 $run['name']
        foreach (var string in $run){
            <td>string</td>
        }
        */
    }
    elseif($task == 'update'){
        if($mysqli->query($query) === TRUE)
            return "New record updated successfully.";
        else return "Error: ".$query."<br>".$mysqli->error;
    }
}


?>