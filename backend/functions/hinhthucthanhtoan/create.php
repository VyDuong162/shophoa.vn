<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHoa</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php
    include_once(__DIR__ . '/../../layouts/styles.php');
    ?>
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>

    <!-- end header -->

    <div class="container-fluid">
        <div class="row">

            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div class="text-justify pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="text-justify">Danh sách hình thức thanh toán</h1>
                </div>

                <!-- Block content -->


                <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->

                <form name="frmsanpham" id="frmsanpham" method="post" action="">
                    <div class="form-group">
                        <label for="sp_ten">Tên hình thức thanh toán</label>
                        <input type="text" class="form-control" id="sp_hinhthucthanhtoan" name="sp_hinhthucthanhtoan" placeholder="Hình thức thanh toán" value="">
                    </div>
                    <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
                    <a href="index.php" class="btn btn-info" name="btnBack" id="btnBack">Quay về</a>
                </form>
                <!-- End block content -->
            </main>
        </div>
    </div>
    <!--     Phần content         -->

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->


    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts//scripts.php'); ?>
    <!-- end footer -->


</body>

</html>