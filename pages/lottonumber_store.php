<?php
include '../config/config.php';
$lottonumber = $_POST['lottonumber'];
$installment = $_POST['installment'];
$name = "test";
$userId = 1;
$timestamp = date('Y-m-d');

$sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$name', '$timestamp', '$userId')";

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