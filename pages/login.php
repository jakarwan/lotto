<?php
include '../config/config.php';
session_start();


if(isset($_POST['submit'])){
  $password = $_POST['txtPassword'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  #$rs = mysqli_query($conn,"SELECT * FROM users WHERE username ='".$_POST['txtUsername']."' AND password ='".$_POST['txtPassword']."'" );
  $sql = mysqli_query($conn,"SELECT * FROM users WHERE username ='".$_POST['txtUsername']."'" );
  $rs = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($rs);
  
    
    if ($num>0) {
        $row = mysqli_fetch_array($rs);
        if(password_verify($row["password"], $hashed_password)){
          $_SESSION["users"] = $row["username"];
          $_SESSION["name"] = $row["user_name"];
          $_SESSION["date"] = $row["date"];
          $_SESSION["phone"] = $row["phone"];
          $_SESSION["status"] = $row["status"];
            if($row['image'] != null){
              $_SESSION["pic"] = $row["image"];
            }else{
              $_SESSION["pic"] = "../images/faces/face1.jpg";
            }
          header('refresh: 0.1;index.php');
        }else{
          echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด \nไม่สามารถเข้าระบบได้");</script>';
        }     
    }else{
      echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด \nไม่สามารถเข้าระบบได้");</script>';
    }		
}
// if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])){
// 	$rs = mysqli_query($conn,"SELECT * FROM users WHERE username ='".$_POST['txtUsername']."' AND password ='".$_POST['txtPassword']."'" );
// 	$num = mysqli_num_rows($rs);
// 	$row = mysqli_fetch_array($rs);
// 	if ($num>0) {
// 			$_SESSION["users"] = $row["username"];
// 			$_SESSION["name"] = $row["user_name"];
// 			$_SESSION["date"] = $row["date"];
//       $_SESSION["phone"] = $row["phone"];
//       $_SESSION["status"] = $row["status"];
// 				if($row['image'] != null){
// 					$_SESSION["pic"] = $row["image"];
// 				}else{
// 					$_SESSION["pic"] = "../images/faces/face1.jpg";
// 				}
// 			header('refresh: 0.1;index.php');
// 	}else{
// 		echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด \nไม่สามารถเข้าระบบได้");</script>';
// 	}		
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
<form method="post">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">  
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" id="txtUsername" name="txtUsername" required="">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="*********" id="txtPassword" name="txtPassword" required="">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" id="submit" name="submot" class="btn btn-primary submit-btn btn-block">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <!-- <div class="form-group">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div> -->
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.php" class="text-black text-small">Create new account</a>
                </div>
              
            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
  </form>
</body>

</html>