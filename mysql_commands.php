<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_NAME', 'BuSy'); //Create a DB with the name 'BuSy'
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Connect to database
function mysql_conn(){
    return new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n".$mysqli->connect_error);
        exit();
    }
}

//Query the database for information
function mysql_ask($task, $query){
    //Different task are: 'resultnumber', 'fetch', 'update'

    if($task == 'resultnumber'){
        $mysqli = mysql_conn();
        $run = $mysqli->query($query);
        return $run->num_rows;
        $mysqli->close();
    }
    elseif($task == 'fetch'){
        $mysqli = mysql_conn();
        $run = $mysqli->query($query);
        return $run->fetch_array(MYSQLI_BOTH);
        $mysqli->close();
    }
    elseif($task == 'update'){
        $mysqli = mysql_conn();
        if($mysqli->query($query) === TRUE)
            return "New record updated successfully.";
        else return "Error: ".$query."<br>".$mysqli->error;
        $mysqli->close();
    }
}

function addPrivatperson($firstname,$lastname,$email,$tlf,$adress,$business){
    $query = "INSERT INTO privatperson (firstname, lastname, email, tlf, adress, business)
                VALUES ('$firstname','$lastname','$email','$tlf','$adress','$business');";
    $reuslt = mysql_ask('update',$query);
    if ($reuslt != "New record updated successfully."){
        $force = "CREATE TABLE privatperson (
                id int NOT NULL AUTO_INCREMENT,
                firstname varchar(255),
                lastname varchar(255),
                email varchar(255),
                tlf int(64),
                adress varchar(255),
                business varchar(255),
                PRIMARY KEY (id)
                );";
        mysql_ask('update',$force);
        mysql_ask('update',$query);
    }
}

function addBusiness($name,$email,$tlf,$adress){
    $query = "INSERT INTO business (name, email, tlf, adress)
                VALUES ('$name','$email','$tlf','$adress');";
    $reuslt = mysql_ask('update',$query);
    if ($reuslt != "New record updated successfully."){
        $force = "CREATE TABLE business (
                id int NOT NULL AUTO_INCREMENT,
                name varchar(255),
                email varchar(255),
                tlf int(64),
                adress varchar(255),
                PRIMARY KEY (id)
                );";
        mysql_ask('update',$force);
        mysql_ask('update',$query);
    }
    return "true";
}

?>