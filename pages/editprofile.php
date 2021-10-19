<?php
session_start();
include '../config/config.php';
CheckLogin();

$rs = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_SESSION['users']."'" );
$num = mysqli_num_rows($rs);
$row = mysqli_fetch_array($rs); 

$password = $row["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
#$checkpassword = password_verify($password, $hashed_password);
#echo $hashed_password;
#var_dump($hashed_password);
#echo password_hash('".$_POST["txtpass"]."', PASSWORD_DEFAULT);
if(isset($_POST["txtC_id"])&&(!empty($_POST["txtC_id"]))){
  $pic = "";
    if(is_uploaded_file($_FILES['files']['tmp_name'])){
      move_uploaded_file($_FILES['files']['tmp_name'],"imgpf/".$_FILES['files']['name']);
      $pic .= ",image ='imgpf/".$_FILES['files']['name']."'";
    }else{
      $pic .= ",image =''";
    }
    if($_POST["txtpass"] != null){
      $password = $_POST["txtpass"];
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "UPDATE users SET password = '".$hashed_password."',user_name = '".$_POST["txtname"]."',phone = '".$_POST["txtphone"]."'$pic WHERE user_id LIKE '".$_POST["txtC_id"]."'";
    }else{
      $sql = "UPDATE users SET user_name = '".$_POST["txtname"]."',phone = '".$_POST["txtphone"]."'$pic WHERE user_id LIKE '".$_POST["txtC_id"]."'";
    }
   if(mysqli_query($conn,$sql)){
     echo '<script>alert("แก้ไขข้อมูลแล้ว")</script>';
     //echo $sql;
     header( "refresh: 0.1;index.php");
   }else{
     //echo $sql;
     echo '<script>alert("แก้ไขข้อมูลไม่ได้")</script>';
   }
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap-4 Admin Dashboard Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../vendors/icheck/skins/all.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
<form method="post" enctype="multipart/form-data">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php
    include 'navbar/navbar.php';
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php
      include 'navbar/navbarLeft.php';
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Accounts</h4>
                  <p class="card-description">
                    Edit Profile
                  </p>
                  
                    <div class="form-group">
                      <label for="exampleInputName1">Username</label>
                      <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Name" disabled="disabled" value="<?=$row['username']?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Name</label>
                      <input type="text" class="form-control" id="txtname" name="txtname" placeholder="Name" value="<?=$row['user_name']?>">
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputCity1">Phone</label>
                      <input type="text" class="form-control" id="txtphone" name="txtphone" placeholder="Phone" value="<?=$row['phone']?>">
                    </div>               
                    <div class="form-group">
                      <label>File upload</label>
                      <!-- <input type="file" name="img[]" class="file-upload-default"> -->
                      <div class="input-group col-xs-12">
                        <!-- <input type="file" class="form-control" id="files" name="files" placeholder="รูปโปรไฟล์" value="">   -->
                        <input type="file" class="form-control file-upload-info" id="files" name="files" placeholder="Upload Image">
                        <!-- <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                        </span> -->
                      </div>
                    </div>
                    
                    <!-- <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="2"></textarea>
                    </div> -->
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light" href="index.php">Cancel</button>
                    <input type="hidden" name="txtC_id" id="txtC_id" value="<?=$row["user_id"]?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php
        include '../pages/navbar/footer.php'
        ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  </form>
</body>

</html>