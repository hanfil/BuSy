<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_NAME', 'BuSy')
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Connect to database
function mysql_conn($force){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
        if($force == 'yes'){
            $query="CREATE DATABASE".DB_NAME;
            mysql_ask('update', $query);
        }
    }
}

//Query the database for information
function mysql_ask($task, $query){
    //Different task are: 'resultnumber', 'fetch', 'update'

    if($task == 'resultnumber'){
        mysql_conn('');
        $run = $mysqli->query($query);
        return $run->num_rows;
        $mysqli->close();
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