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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

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
    <script language="JavaScript">
        function ClickCheckAll(vol) {

            var i = 1;
            for (i = 1; i <= document.frmMain.hdnCount.value; i++) {
                if (vol.checked == true) {
                    eval("document.frmMain.checkbox" + i + ".checked=true");
                } else {
                    eval("document.frmMain.checkbox" + i + ".checked=false");
                }
            }
        }

        // function onDelete() {
        //     if (confirm('Do you want to delete ?') == true) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
    </script>


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
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <h4 class="text-white mb-4">ล็อตเตอรี่ทั้งหมด</h4>
                                            <form class="forms-sample" action="lottoall" method="POST" id="submitDel" name="frmMain">

                                                <?php
                                                $sql = "SELECT * FROM lotto_number ORDER BY lotto_id DESC ";
                                                $query = $conn->query($sql);
                                                $rowCount = mysqli_num_rows($query);
                                                ?>
                                                <div class="row">
                                                    <div class="mt-4 col-12 col-sm-6 col-md-9">
                                                        <span class="text-white">ล็อตเตอรี่ทั้งหมด </span><span class="badge badge-danger"> <?php echo $rowCount; ?></span>
                                                    </div>
                                                    <!-- <form action="lottonumber.php?mode=delete" method="POST" id="submitDel">
                                                        <div class="col-12 col-sm-6 col-md-3 float-end text-end">
                                                            <button class="btn btn-danger text-end float-end" name="submitDel" onclick="submitDelete()" type="button">ลบเลขที่ตรงกันทั้งหมด</button>
                                                        </div>
                                                    </form> -->
                                                    <?php
                                                    if ($_GET) {
                                                        $sql = "DELETE FROM lotto_number WHERE lotto_id='" . $_GET["lotto_id"] . "' ";
                                                        // echo $sql;
                                                        $conn->query($sql);
                                                    }
                                                    ?>

                                                </div>
                                                <div class="m-3">
                                                    <input type="text" class="form-control col-12 col-sm-6 col-md-4" id="lottosearch" name="lottosearch" value="<?= !empty($_GET["lottosearch"]); ?>" placeholder="ค้นหาเลขล็อตเตอรี่" autofocus>
                                                    <input name="search" class="btn btn-primary mt-2" type="submit" value="ค้นหา">
                                                </div>
                                                <?php
                                                if ($_SESSION['status'] == 'Admin') {
                                                ?>
                                                    <div class="col-12 m-4">
                                                        <input name="delete" class="btn btn-danger" type="submit" value="ลบรายการที่เลือก">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if (!empty($_POST["lottosearch"])) {
                                                    $sql = "SELECT * FROM lotto_number WHERE lotto_number='" . $_POST["lottosearch"] . "' ";
                                                    $query = $conn->query($sql);
                                                }
                                                ?>
                                                <!-- <hr style="background-color:white"> -->
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="table-responsive text-white">
                                                        <table id="example" class="table" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onclick="ClickCheckAll(this);"></th>
                                                                    <th class="text-white">ลำดับ</th>
                                                                    <th class="text-white">เลขล็อตเตอรี่</th>
                                                                    <th class="text-white">งวด</th>
                                                                    <th class="text-white">วันที่</th>
                                                                    <th class="text-white">หมายเหตุ</th>
                                                                    <?php
                                                                    if ($_SESSION['status'] == 'Admin') {
                                                                    ?>
                                                                        <th class="text-white">ลบ</th>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // $rowCount = mysqli_num_rows($query);
                                                                if ($query->num_rows > 0) {
                                                                    $i = 1;
                                                                    while ($row = $query->fetch_assoc()) {
                                                                        // print_r($row);
                                                                ?>

                                                                        <tr>
                                                                            <td class="text-center"><input name="checkbox[]" id="checkbox<?php echo $i; ?>" type="checkbox" value="<?php echo $row['lotto_id']; ?>"></td>
                                                                            <td class="text-white"><?php echo $i++; ?></td>
                                                                            <td class="text-white"><?php echo $row["lotto_number"]; ?></td>
                                                                            <td class="text-white"><?php echo $row["installment"]; ?></td>
                                                                            <td class="text-white"><?php echo $row["date"]; ?></td>
                                                                            <td class="text-white">
                                                                                <label class="badge badge-danger"><?php echo $row["lotto_name"]; ?></label>
                                                                            </td>
                                                                            <?php
                                                                            if ($_SESSION['status'] == 'Admin') {
                                                                            ?>
                                                                                <td><a class="btn btn-danger text-start" name="submitDel" href="JavaScript:if(confirm('ต้องการลบข้อมูลหรือไม่?')==true){window.location='lottoall?lotto_id=<?php echo $row["lotto_id"]; ?>'; window.location.href = 'lottoall';}">ลบ</a></td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tr>

                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>

                                                            <?php
                                                            if (isset($_POST['delete']) && !empty($_POST['checkbox'])) {

                                                                $checkbox = $_POST['checkbox'];
                                                                for ($i = 0; $i < count($checkbox); $i++) {

                                                                    $del_id = $checkbox[$i];
                                                                    $sql = "DELETE FROM lotto_number WHERE lotto_id=$del_id ";
                                                                    $query = $conn->query($sql);
                                                                }
                                                                // if successful redirect to delete_multiple.php 
                                                                if ($query) {
                                                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=lottoall\">";
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="hdnCount" value="<?php echo $i; ?>">
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
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