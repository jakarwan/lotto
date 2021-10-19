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
                                            <h4 class="card-title">ค้นหาล็อตเตอรี่</h4>
                                            <form class="forms-sample" action="lottosearch.php" method="get" id="submitSearch">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="mt-4">เลขล็อตเตอรี่</label>
                                                            <input type="text" class="form-control col-8" id="lottosearch" name="lottosearch" placeholder="เลขล็อตเตอรี่" onkeypress="submitSearch()" autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2">Search</button>
                                            </form>
                                            <div class="row flex-grow">
                                                <?php
                                                include '../config/config.php';
                                                $lottosearch = null;
                                                if (!empty($_GET["lottosearch"])) {
                                                    $lottosearch = $_GET["lottosearch"];

                                                    $sql = "SELECT * FROM lotto_number WHERE lotto_number='" . $lottosearch . "' ";
                                                    $result = $conn->query($sql);
                                                    $rowcount = mysqli_num_rows($result);
                                                    echo "<div class='col-12 mt-4 alert alert-primary'>";
                                                    echo "<div class='text-center'>";
                                                    echo "<span>เลขตรงกัน $rowcount รายการ</span>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                    // echo $rowcount;
                                                    // print_r($result);
                                                    if ($rowcount > 0) {
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            // print_r($row);

                                                ?>
                                                            <div class="col-2 mt-4">
                                                                <div class="card shadow text-center">
                                                                    <div>
                                                                        <span class="badge badge-danger">
                                                                            <h5>
                                                                                <div class="m-2">
                                                                                    <?php
                                                                                    echo $row["lotto_number"];
                                                                                    ?>
                                                                                </div>
                                                                                <div class="m-2">
                                                                                    งวดที่ :
                                                                                    <?php
                                                                                    echo $row["installment"];
                                                                                    ?>
                                                                                </div>
                                                                                <div class="m-2">
                                                                                    <?php
                                                                                    echo $row["date"];
                                                                                    ?>
                                                                                </div>
                                                                            </h5>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                <?php
                                                        }
                                                    }
                                                    //                         else {
                                                    //                             // echo "ไม่พบข้อมูล";
                                                    //                             echo '<script type="text/javascript">Swal.fire("Good job!",
                                                    // "You clicked the button!",
                                                    //   "success"
                                                    // )</script>';
                                                    //                         }
                                                }
                                                // else {
                                                //   echo '<script type="text/javascript">swal("", "ไม่พบข้อมูล !!", "warning"); </script>';
                                                // }
                                                ?>
                                            </div>
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
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                            <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                            <i class="mdi mdi-heart text-danger"></i>
                        </span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script>
        function submitSearch() {
            let len = document.getElementById("lottosearch").value.length;
            if (len == 5) {
                setTimeout(function() {
                    document.getElementById("submitSearch").submit();
                }, 100);
            } else {
                return false;
            }
        }
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