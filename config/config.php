<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lotto";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

function CheckLogin(){
    if(!isset($_SESSION["users"])){
      header('refresh: 0.1;logout.php');
    }
}
function CheckLoginUser(){
    if($_SESSION["groups"] == "admins") {
        header('refresh: 0.1;logout.php');
    }
}
function CheckLoginAdmin(){
    if($_SESSION["groups"] != "admins") {
        header('refresh: 0.1;logout.php');
    }
}
?>