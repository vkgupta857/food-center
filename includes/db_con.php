<?php
$host = "localhost";
$username = "vinod";
$password = "password";
$db_name = "foodshala";

$con = new mysqli($host,$username,$password,$db_name);

if(!$con){
    die("Error connecting to database. $con->error");
}

session_start();
?>