<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khuyến mãi</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
</head>

<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sqlSanPham = "select * from `sanpham`";
                $resultSanPham = mysqli_query($conn, $sqlSanPham);

                $dataSanPham = [];
                while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $sp_tomtat = sprintf(
                        "Sản phẩm %s, giá: %s",
                        $rowSanPham['sp_ten'],
                        number_format($rowSanPham['sp_gia'], 2, ".", ",") . ' vnđ'
                    );
                    $dataSanPham[] = array(
                        'sp_id' => $rowSanPham['sp_id'],
                        'sp_tomtat' => $sp_tomtat,
                    );
                }
                ?>
                <div class="container-fluid">
                    <div class="row mb-10">
                        <div class="col-md-12 text-center">
                            <h1 id="frmtitle" class="h3 mb-0 text-gray-800 mb-3 shadow">Thêm mới hình sản phẩm</h1>
                        </div>
                        <?php

                        $sqlSanPham = "select * from `sanpham`";
                        $resultSanPham = mysqli_query($conn, $sqlSanPham);
                        $dataSanPham = [];
                        while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                            $sp_tomtat = sprintf(
                                "Sản phẩm %s, giá: %s",
                                $rowSanPham['sp_ten'],
                                number_format($rowSanPham['sp_gia'], 2, ".", ",") . ' vnđ'
                            );
                            $dataSanPham[] = array(
                                'sp_id' => $rowSanPham['sp_id'],
                                'sp_tomtat' => $sp_tomtat,
                            );
                        }
                        ?>

                        <form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="sp_id">Sản phẩm</label>
                                <select class="form-control" id="sp_id" name="sp_id">
                                    <?php foreach ($dataSanPham as $sanpham) : ?>
                                        <option value="<?= $sanpham['sp_id'] ?>"><?= $sanpham['sp_tomtat'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hsp_tenfile">Tập tin ảnh</label>
                                <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                                <div class="preview-img-container">
                                    <img src="../../../assets/shared/img/default.png" id="preview-img" width="200px" />
                                </div>
                                <!-- Input cho phép người dùng chọn FILE -->
                                <input type="file" class="form-control" id="hsp_tenfile" name="hsp_tenfile">
                            </div>
                            <button class="btn btn-primary" name="btnSave">Lưu</button>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_POST['btnSave'])) {
                    // Nếu người dùng có chọn file để upload
                    $sp_id=$_POST['sp_id'];
                    if (isset($_FILES['hsp_tenfile'])) {

                        $upload_dir = __DIR__ . "/../../../assets/uploads/";
                        $subdir = 'img-product/';

                        if ($_FILES['hsp_tenfile']['error'] > 0) {
                            echo 'File Upload Bị Lỗi';
                            die;
                        } else {

                            $hsp_tenfile = $_FILES['hsp_tenfile']['name'];
                            $tenfile = date('YmdHis') . '_' . $hsp_tenfile;

                            move_uploaded_file($_FILES['hsp_tenfile']['tmp_name'], $upload_dir . $subdir . $tenfile);
                        }

                        $sql = "INSERT INTO `hinhsanpham` (hsp_tenfile, sanpham_sp_id) VALUES ('$tenfile', $sp_id);";
                        // print_r($sql); die;
                        // Thực thi INSERT
                        mysqli_query($conn, $sql);
                        //var_dump($sql); die();
                        mysqli_close($conn);

                        echo '<script>location.href = "index.php";</script>';
                    }
                }
                ?>

            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('lh_mota');
    </script>
</body>

</html>