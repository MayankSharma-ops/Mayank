<?php

error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// $mysqli = new mysqli("localhost","root","","Login");
$conn = mysqli_connect("localhost","root","","form");

if($conn){
    // echo"Connection ok";
}
else{
    echo"Connection Failed".mysqli_connect_error();
}
?>