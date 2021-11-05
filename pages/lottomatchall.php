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
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <h4 class="text-white mb-4">ล็อตเตอรี่ที่ตรงกันทั้งหมด</h4>
                                            <form class="forms-sample" action="lottomatchall.php" method="POST" id="submitDel">

                                                <?php
                                                $sql = "SELECT lotto_number.*, lotto_match.* FROM lotto_match 
                                                JOIN lotto_number ON lotto_match.lotto_id=lotto_number.lotto_id ";
                                                $query = $conn->query($sql);
                                                $rowCount = mysqli_num_rows($query);
                                                ?>
                                                <div class="row">
                                                    <div class="mt-4 col-12 col-sm-6 col-md-9">
                                                        <span class="text-white">เลขตรงกันทั้งหมด </span><span class="badge badge-danger"> <?php echo $rowCount; ?></span>
                                                    </div>
                                                    <!-- <form action="lottonumber.php?mode=delete" method="POST" id="submitDel">
                                                        <div class="col-12 col-sm-6 col-md-3 float-end text-end">
                                                            <button class="btn btn-danger text-end float-end" name="submitDel" onclick="submitDelete()" type="button">ลบเลขที่ตรงกันทั้งหมด</button>
                                                        </div>
                                                    </form> -->
                                                    <?php
                                                    if ($_GET) {
                                                        $sql = "DELETE FROM lotto_match WHERE match_id='" . $_GET["match_id"] . "' ";
                                                        // echo $sql;
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
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            // $rowCount = mysqli_num_rows($query);
                                                            if ($query->num_rows > 0) {
                                                                $i = 1;
                                                                while ($row = $query->fetch_assoc()) {
                                                                    // print_r($row);
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
                                                                                <label class="badge badge-danger"><?php echo $row["lotto_name"]; ?></label>
                                                                            </td>
                                                                            <td><a class="btn btn-danger text-end float-end" name="submitDel" href="JavaScript:if(confirm('ต้องการลบข้อมูลหรือไม่?')==true){window.location='lottomatchall.php?match_id=<?php echo $row["match_id"]; ?>'; window.location.href = 'lottomatchall.php';}">ลบ</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </table>
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
        // function submitDelete() {
        //     Swal.fire({
        //         title: 'ต้องการลบข้อมูลหรือไม่?',
        //         text: "ต้องการลบข้อมูลล็อตเตอรี่ที่ตรงกันทั้งหมดหรือไม่!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'ใช่, ต้องการลบ!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             setTimeout(function() {
        //                 window.location.href = 'lottomatchall.php?mode=delete';
        //             }, 1000);
        //             Swal.fire(
        //                 'สำเร็จ!',
        //                 'ลบข้อมูลเรียบร้อยแล้ว.',
        //                 'success'
        //             )
        //         }
        //     })
        // .then((response) => {
        //     setTimeout(function() {
        //         window.location.href = 'lottomatchall.php';
        //     }, 1000);
        // })
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