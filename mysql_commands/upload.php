<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '')

function upload($string){

}

function mysql_connect($dbname){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
}

?>