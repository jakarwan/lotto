<?php
// session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lotto";
date_default_timezone_set("Asia/Bangkok");
// $servername = "localhost";
// $username = "takitsa_lotto";
// $password = "11223344";
// $dbname = "takitsa_lotto";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

function CheckLogin(){
    if(!isset($_SESSION["status"])){
        header("location: login");
        exit;
    }
}
?>