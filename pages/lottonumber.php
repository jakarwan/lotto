<?php
session_start();
include '../config/config.php';
CheckLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lotto</title>
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php
    include 'navbar/navbar.php'
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php
      include 'navbar/navbarLeft.php'
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">เพิ่มเลขล็อตเตอรี่</h4>
                      <!-- <p class="card-description">
                        Basic form layout
                      </p> -->
                      <form class="forms-sample" action="lottonumber.php" method="post" id="lottosubmit">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-5 col-sm-6 col-md-2">
                                  <label for="installment">งวดที่</label>
                                  <select class="form-control form-control-lg" id="installment" name="installment">
                                    <?php
                                    // $ins = $_POST["installment"];
                                    for ($i = 1; $i < 25; $i++) {
                                      $_SESSION["installment"] = $i;
                                    ?>
                                      <option <?= (!empty($_COOKIE["installment"]) ? ($_COOKIE["installment"] == $i  ? 'selected' : '') : '')  ?> id="<?php echo $i ?>" value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-7 col-sm-6 col-md-3">
                                  <label for="installment">วันที่</label>
                                  <input <?= (!empty($_COOKIE["datelotto"]) ? ($_COOKIE["datelotto"]) : '')  ?> type="date" class="form-control form-control-xl" id="datelotto" name="datelotto" value="<?php echo $_COOKIE['datelotto'] ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                  <label for="installment">หมายเหตุ</label>
                                  <input <?= (!empty($_COOKIE["lottoname"]) ? ($_COOKIE["lottoname"]) : '')  ?> type="text" class="form-control form-control-xl" id="lottoname" name="lottoname" value="<?php if (!empty($_COOKIE['lottoname'])) {
                                                                                                                                                                                                          echo $_COOKIE['lottoname'];
                                                                                                                                                                                                        } ?>">
                                </div>
                                <div class="col-12">
                                  <label for="lottonumber" class="mt-4">เลขล็อตเตอรี่</label>
                                  <input type="text" class="form-control col-12 col-sm-6 col-md-4" id="lottonumber" name="lottonumber" placeholder="เลขล็อตเตอรี่" maxlength="6" onkeypress="submitForm()" autofocus required>
                                </div>
                                <?php


                                // $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";

                                // $query = mysqli_query($conn, $sql);
                                if (!empty($_POST["lottonumber"])) {
                                  $lottonumber = $_POST['lottonumber'];
                                  $installment = $_POST['installment'];
                                  // $userId = 1;
                                  $userId = $_SESSION["userId"];
                                  $timestamp = $_POST["datelotto"];
                                  $lottoname = $_POST["lottoname"];


                                  $sqlCheck = "SELECT * FROM lotto_number WHERE lotto_number='" . $lottonumber . "' ";
                                  $queryCheck = $conn->query($sqlCheck);
                                  $result = mysqli_fetch_array($queryCheck);
                                  // $_SESSION["lottoId"] = $result["lotto_id"];

                                  // print_r($result);
                                  $count = mysqli_num_rows($queryCheck);
                                  if ($count > 0) {
                                    $lottoId = $result["lotto_id"];
                                    $matchDate = date('Y-m-d H:i:s');
                                    $sql = "INSERT INTO lotto_match VALUES (NULL, '$lottoId', '$matchDate')";
                                    $query = mysqli_query($conn, $sql);
                                    //     echo '<script type="text/javascript">Swal.fire("Match!","You clicked the button!","success").then(function() {
                                    //     window.location = "lottonumber.php";
                                    // });</script>';
                                  } else {
                                    $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";
                                    $query = mysqli_query($conn, $sql);
                                  }
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-2">บันทึก</button>
                        <?php
                        if (!empty($lottoId)) {
                          $sql = "SELECT lotto_match.*, lotto_number.*  FROM lotto_match 
                                  JOIN lotto_number ON lotto_match.lotto_id=lotto_number.lotto_id
                                  WHERE lotto_match.lotto_id='" . $lottoId . "' ";
                          $query = $conn->query($sql);
                          $fetch = mysqli_fetch_array($query);
                          $rowCount = mysqli_num_rows($query);
                        ?>
                          <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">เลขล็อตเตอรี่ตรงกัน <?php echo $rowCount ?> รายการ</h4>
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>ลำดับ</th>
                                        <th>เลขล็อตเตอรี่</th>
                                        <th>งวด</th>
                                        <th>วันที่</th>
                                        <th>หมายเหตุ</th>
                                      </tr>
                                    </thead>

                                    <?php

                                    if ($rowCount > 0) {
                                      for ($i = 0; $i < $rowCount; $i++) {
                                    ?>
                                        <tbody>
                                          <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $fetch["lotto_number"]; ?></td>
                                            <td><?php echo $fetch["installment"]; ?></td>
                                            <td><?php echo $fetch["date"]; ?></td>
                                            <td>
                                              <label class="badge badge-danger"><?php echo $fetch["lotto_name"]; ?></label>
                                            </td>
                                          </tr>
                                        </tbody>
                                    <?php
                                      }
                                    }

                                    ?>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Basic form</h4>
                  <p class="card-description">
                    Basic form elements
                  </p>
                  <form class="forms-sample" action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>File upload</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="submit">Upload</button>
                        </span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php
        include 'navbar/footer.php';
        ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script>
    $('#installment').on('change', function() {
      const d = new Date();
      d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
      let expires = "expires=" + d.toUTCString();
      document.cookie = 'installment' + "=" + $('#installment').val() + ";" + expires + ";path=/";
    })

    $('#datelotto').on('change', function() {
      const d = new Date();
      d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
      let expires = "expires=" + d.toUTCString();
      document.cookie = 'datelotto' + "=" + $('#datelotto').val() + ";" + expires + ";path=/";
    })

    $('#lottoname').on('change', function() {
      const d = new Date();
      d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
      let expires = "expires=" + d.toUTCString();
      document.cookie = 'lottoname' + "=" + $('#lottoname').val() + ";" + expires + ";path=/";
    })

    function submitForm() {

      let maxlen = 5;
      let len = document.getElementById("lottonumber").value.length;
      if (len == maxlen) {
        // if ($_POST["installment"] == 1) {
        //   document.getElementById("lotto1").setAttribute('selected', 'selected');
        // } else if($_POST["installment"] == 2) {
        //   document.getElementById("lotto2").setAttribute('selected', 'selected');
        // }
        // $_SESSION["installment"] = $_POST["installment"];
        // document.getElementById('installment').value=Person_ID;

        setTimeout(function() {
          document.getElementById("lottosubmit").submit();
        }, 100);
      } else {
        return false;
      }
    }

    // function selectInstallment() {
    //   // console.log(document.getElementById("installment").value = );
    //   var dop = document.getElementById("installment").value;
    //   dop.setAttribute("selected", "");
    //   console.log(dop);
    // }
  </script>
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
</body>

</html>