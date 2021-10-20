<?php
include '../config/config.php';
$lottonumber = $_POST['lottonumber'];
$installment = $_POST['installment'];
$userId = 1;
$timestamp = $_POST["datelotto"];
$lottoname = $_POST["lottoname"];

$sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";

$query = mysqli_query($conn, $sql);
if ($query) {
    // echo "สมัครข้อมูลเสร็จสิ้น";
    // header( "refresh: 0; url=/lotto/pages/lotto-match/index.php" );
    echo '<script type="text/javascript">window.location="lottonumber.php"</script>;';
} else {
    echo "สมัครไม่สำเร็จ" .$sql. "<br>". $conn->error ;
    header( "refresh: 0; url=/lotto/pages/lotto-match/index.php" );
}
?>