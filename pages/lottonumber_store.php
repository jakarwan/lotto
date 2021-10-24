<?php
include '../config/config.php';
$lottonumber = $_POST['lottonumber'];
$installment = $_POST['installment'];
// $userId = 1;
// $userId = $_SESSION["userId"];
$timestamp = $_POST["datelotto"];
$lottoname = $_POST["lottoname"];

// $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";

// $query = mysqli_query($conn, $sql);

$sqlCheck = "SELECT * FROM lotto_number WHERE lotto_number='".$lottonumber."' ";
$queryCheck = $conn->query($sqlCheck);
$result = mysqli_fetch_array($queryCheck);
// print_r($result);
$count = mysqli_num_rows($queryCheck);
echo $count;
if($count > 0) {
    $lottoId = $result["lotto_id"];
    $sql = "INSERT INTO lotto_match VALUES (NULL, '$lottoId' ";
    $query = mysqli_query($conn, $sql);
    echo '<script type="text/javascript">Swal.fire("Match!","You clicked the button!","success").then(function() {
        window.location = "lottonumber.php";
    });</script>';
} else {
    $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '".$_SESSION["userId"]."')";
    $query = mysqli_query($conn, $sql);
}

// if ($query) {
//     // echo "สมัครข้อมูลเสร็จสิ้น";
//     // header( "refresh: 0; url=/lotto/pages/lotto-match/index.php" );
//     echo '<script type="text/javascript">window.location="lottonumber.php"</script>;';
// } else {
//     echo "ผิดพลาด" .$sql. "<br>". $conn->error ;
//     // header( "refresh: 0; url=/lotto/pages/index.php" );
// }
