<?php

if (!isset($_SESSION)) {
    session_start();
}
error_reporting(1);
// Database connection

$host = "localhost";
$username = "root";
$pwd = "";
$database = "classroom";

$sql = new mysqli($host,$username,$pwd,$database);
if ($sql->connect_error) {
    echo $sql->connect_error;
} else {
     //echo "Connected";
}

