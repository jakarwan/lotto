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
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</head>
<style>
  .font-custom {
    font-size: 15px;
  }
</style>

<body background="../images/lotto.jpeg">
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
            <div class="col-md-12">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card bg-dark">
                    <div class="card-body">
                      <h4 class="text-white mb-3">เพิ่มเลขล็อตเตอรี่</h4>
                      <!-- <p class="card-description">
                        Basic form layout
                      </p> -->
                      <form class="forms-sample" action="lottonumber" method="post" id="lottosubmit">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-5 col-sm-6 col-md-2">
                                  <label for="installment" class="text-white">งวดที่</label>
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
                                  <label for="installment" class="text-white">วันที่</label>
                                  <input <?= (!empty($_COOKIE["datelotto"]) ? ($_COOKIE["datelotto"]) : '')  ?> type="date" class="form-control form-control-xl" id="datelotto" name="datelotto" value="<?php if (!empty($_COOKIE['datelotto'])) {
                                                                                                                                                                                                        } ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                  <label for="installment" class="text-white">หมายเหตุ</label>
                                  <input <?= (!empty($_COOKIE["lottoname"]) ? ($_COOKIE["lottoname"]) : '')  ?> type="text" class="form-control form-control-xl" id="lottoname" name="lottoname" value="<?php if (!empty($_COOKIE['lottoname'])) {
                                                                                                                                                                                                        } ?>">
                                </div>
                                <div class="col-12">
                                  <label for="lottonumber" class="mt-4 text-white">เลขลอตเตอรี่</label>
                                  <input type="text" class="form-control col-12 col-sm-6 col-md-4" id="lottonumber" name="lottonumber" placeholder="เลขล็อตเตอรี่" maxlength="6" onkeypress="submitForm()" autofocus>
                                </div>
                                <?php
                                if ($_SESSION['status'] == 'Admin') {
                                ?>
                                  <div class="col-12 col-sm-12 col-md-7">
                                    <label for="lottonumber" class="mt-4 text-danger">** เลขลอตเตอรี่ (สำหรับสแกนจากรูปภาพ)</label>
                                    <textarea class="form-control" id="lottonumall" name="lottonumall" rows="10"></textarea>
                                  </div>
                                <?php
                                }
                                ?>
                                <?php


                                // $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";

                                // $query = mysqli_query($conn, $sql);
                                if (!empty($_POST["lottonumber"])) {
                                  // if (strlen($_POST["lottonumber"]) == 6) {
                                  $lottonumber = $_POST['lottonumber'];
                                  $installment = $_POST['installment'];
                                  // $userId = 1;
                                  $userId = $_SESSION["userId"];
                                  $timestamp = $_POST["datelotto"];
                                  $lottoname = $_POST["lottoname"];


                                  $sqlCheck = "SELECT * FROM lotto_number WHERE lotto_number='" . $lottonumber . "' AND user_id='" . $_SESSION["userId"] . "' ";
                                  $queryCheck = $conn->query($sqlCheck);
                                  $result = mysqli_fetch_array($queryCheck);
                                  // $_SESSION["lottoId"] = $result["lotto_id"];

                                  // print_r($result);
                                  if (strlen($_POST["lottonumber"]) == 6) {
                                    $count = mysqli_num_rows($queryCheck);
                                    // echo strlen($_POST["lottonumber"]);
                                    if ($count > 0) {
                                      $lottoId = $result["lotto_id"];
                                      $matchDate = date('Y-m-d H:i:s');
                                      $sql = "INSERT INTO lotto_match VALUES (NULL, '$lottoId', '$matchDate', '$userId', '$lottoname', '$installment', 0)";
                                      $query = mysqli_query($conn, $sql);
                                      // echo strlen($_POST["lottonumber"]);
                                      echo '<script type="text/javascript">Swal.fire("Match!","You clicked the button!","success")</script>';
                                    } else {
                                      if (!empty($_COOKIE['datelotto'])) {
                                        // echo 'false cookie';
                                        $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";

                                        echo '<script type="text/javascript">toastr.success("บันทึกข้อมูลสำเร็จ")</script>';
                                      } else {
                                        // echo 'false date';
                                        $datetoday = date('Y-m-d');
                                        $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$datetoday', '$userId')";
                                        echo '<script type="text/javascript">toastr.success("บันทึกข้อมูลสำเร็จ")</script>';
                                      }
                                      // $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";
                                      // echo $sql;
                                      $query = mysqli_query($conn, $sql);
                                      // echo 'test';
                                    }
                                  } else {
                                    echo '<script type="text/javascript">Swal.fire("Error!","กรุณากรอกเลขล็อตเตอรี่ให้ครบ 6 หลัก!","error")</script>';
                                  }
                                }
                                ?>
                                <?php
                                if ($_SESSION['status'] == 'Admin') {
                                ?>
                                  <div class="col-12 col-sm-12 col-md-5">
                                    <h4 class="text-white">รายการบันทึกไม่สำเร็จ</h4>
                                    <span class="text-white">
                                      <?php
                                      if (!empty($_POST["lottonumall"])) {
                                        $lottonumber = $_POST['lottonumber'];
                                        $installment = $_POST['installment'];
                                        // $userId = 1;
                                        $userId = $_SESSION["userId"];
                                        $timestamp = $_POST["datelotto"];
                                        $lottoname = $_POST["lottoname"];
                                        $lottoArray = array();
                                        // $lotto = preg_replace('/\s*/m' , '' , $_POST["lottonumall"]);
                                        $lottoall = preg_split('/([\n]+)/', $_POST["lottonumall"], 0, PREG_SPLIT_DELIM_CAPTURE);
                                        // print_r($lottoall);
                                        // $trimmed_array = array_map('trim', $lottoall);
                                        // print_r($trimmed_array);
                                        foreach ($lottoall as $item) {
                                          // if (preg_match('/^[a-z0-9]+$/i', $item)) {
                                          $lotto = preg_replace('/\s*/m', '', $item);
                                          array_push($lottoArray, $lotto);


                                          // }
                                        }
                                        // $a = " ";
                                        foreach ($lottoArray as $data) {
                                          if (strlen($data) > 6 || strlen($data) < 6 || !is_numeric($data)) {
                                            $a = " ";
                                            $a .= $data;
                                            echo $a;
                                            // echo $data;
                                            if (preg_replace('/\s+/', '', $data)) {
                                              echo '<script type="text/javascript">toastr.error("บันทึกข้อมูลไม่สำเร็จ ' . $data . '")</script>';
                                            }
                                            // echo '<script type="text/javascript">alert('.strval($a).')</script>';
                                          } else {
                                            $sqlCheck = "SELECT * FROM lotto_number WHERE lotto_number='" . $data . "' AND user_id='" . $_SESSION["userId"] . "' ";
                                            $queryCheck = $conn->query($sqlCheck);
                                            $result = mysqli_fetch_array($queryCheck);
                                            $count = mysqli_num_rows($queryCheck);
                                            if ($count > 0) {
                                              $matchDate = date('Y-m-d H:i:s');
                                              $sql = "INSERT INTO lotto_match VALUES (NULL, '" . $result["lotto_id"] . "', '$matchDate', '$userId', '$lottoname', '$installment', 0)";
                                              $query = mysqli_query($conn, $sql);
                                              // echo strlen($_POST["lottonumber"]);
                                              echo '<script type="text/javascript">Swal.fire("Match!","You clicked the button!","success")</script>';
                                            } else {
                                              if (!empty($_COOKIE['datelotto'])) {
                                                // echo 'false cookie';
                                                $sql = "INSERT INTO lotto_number VALUES (NULL, '$data', '$installment', '$lottoname', '$timestamp', '$userId')";

                                                echo '<script type="text/javascript">toastr.success("บันทึกข้อมูลสำเร็จ")</script>';
                                              } else {
                                                // echo 'false date';
                                                $datetoday = date('Y-m-d');
                                                $sql = "INSERT INTO lotto_number VALUES (NULL, '$data', '$installment', '$lottoname', '$datetoday', '$userId')";
                                                echo '<script type="text/javascript">toastr.success("บันทึกข้อมูลสำเร็จ")</script>';
                                              }
                                              // $sql = "INSERT INTO lotto_number VALUES (NULL, '$lottonumber', '$installment', '$lottoname', '$timestamp', '$userId')";
                                              // echo $sql;
                                              $query = mysqli_query($conn, $sql);
                                              // echo 'test';
                                            }
                                          }
                                        }
                                        // var_dump($lottoArray);

                                      }
                                      ?>
                                    </span>
                                  </div>
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-2">บันทึก</button>
                        <?php
                        $sql = "SELECT lotto_number.*, lotto_match.* FROM lotto_match 
                        JOIN lotto_number ON lotto_match.lotto_id=lotto_number.lotto_id WHERE lotto_match.user_id='" . $_SESSION["userId"] . "' AND isActive=0 ORDER BY lotto_match.match_id DESC ";
                        // WHERE lotto_match.user_id='" . $_SESSION["userId"] . "'
                        $query = $conn->query($sql);
                        $rowCount = mysqli_num_rows($query);
                        ?>
                        <div class="row">
                          <div class="mt-4 col-12 col-sm-6 col-md-9">
                            <span class="text-white">เลขตรงกันทั้งหมด </span><span class="badge badge-danger"> <?php echo $rowCount; ?></span>
                          </div>
                          <form action="lottonumber?mode=delete" method="POST" id="submitDel">
                            <div class="col-12 col-sm-6 col-md-3 float-end text-end">
                              <button class="btn btn-danger text-end float-end" name="submitDel" onclick="submitDelete()" type="button">ลบเลขที่ตรงกันทั้งหมด</button>
                            </div>
                          </form>
                          <?php
                          if (!empty($_GET["mode"])) {
                            $sql = "DELETE FROM lotto_match WHERE user_id='" . $_SESSION["userId"] . "' AND isActive=0 ";
                            $conn->query($sql);
                          }
                          ?>

                        </div>

                        <!-- <hr style="background-color:white"> -->
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-white">ลำดับ</th>
                                  <th class="text-white">เลขล็อตเตอรี่</th>
                                  <th class="text-white">งวด</th>
                                  <th class="text-white">วันที่</th>
                                  <th class="text-white">หมายเหตุ</th>
                                  <th class="text-white">ตรงกับ</th>
                                  <th class="text-white">จัดเก็บ</th>
                                </tr>
                              </thead>
                              <?php
                              // $rowCount = mysqli_num_rows($query);
                              if ($query->num_rows > 0) {
                                $i = 1;
                                while ($row = $query->fetch_assoc()) {
                              ?>
                                  <tbody>
                                    <tr>
                                      <td class="text-white"><?php echo $i++; ?></td>
                                      <td class="text-white"><?php echo $row["lotto_number"]; ?></td>
                                      <td class="text-white"><?php echo $row["installment"]; ?></td>
                                      <td class="text-white"><?php echo $row["lotto_match_date"]; ?></td>
                                      <td class="text-white">
                                        <label class="badge badge-danger"><?php echo $row["lotto_name_match"]; ?></label>
                                      </td>
                                      <td class="text-white">
                                        <label class="badge badge-primary"><?php echo $row["lotto_name"]; ?></label>
                                      </td>
                                      <?php
                                      if ($_SESSION['status'] == 'Admin') {
                                      ?>
                                      <form action="lottonumber?save=complete" method="POST" id="submitSave">
                                        <td><a class="btn btn-info text-end float-end" name="submitSave" href="JavaScript:window.location='lottonumber?match_id=<?php echo $row["match_id"]; ?>';">จัดเก็บ</a></td>
                                      </form>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                  </tbody>
                              <?php
                                }
                              }
                              ?>
                            </table>
                            <?php
                            if (!empty($_GET["match_id"])) {
                              // echo $_GET["save"];
                              $sql = "UPDATE lotto_match SET isActive = 1 WHERE match_id = '" . $_GET["match_id"] . "' ";
                              // echo $sql;
                              $query = $conn->query($sql);
                              if ($query) {
                                echo "<script>window.location.href = 'lottonumber';</script>";
                            }
                            }
                            ?>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

    // $(document).ready(function() {
    //   $('.delete-row').click(function() {
    //     $.post('lottonumber.php?mode=delete', {
    //       row_id: $(this).data('row_id')
    //     }).done(function(data) {
    //       // Reload your table/data display
    //     });
    //   });
    // });

    function submitDelete() {
      Swal.fire({
        title: 'ต้องการลบข้อมูลหรือไม่?',
        text: "ต้องการลบข้อมูลล็อตเตอรี่ที่ตรงกันทั้งหมดหรือไม่!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ต้องการลบ!'
      }).then((result) => {
        if (result.isConfirmed) {
          setTimeout(function() {
            window.location.href = 'lottonumber?mode=delete';
          }, 1000);
          Swal.fire(
            'สำเร็จ!',
            'ลบข้อมูลเรียบร้อยแล้ว.',
            'success'
          )
        }
      }).then((response) => {
        setTimeout(function() {
          window.location.href = 'lottonumber';
        }, 1000);
      })
    }
    // }

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