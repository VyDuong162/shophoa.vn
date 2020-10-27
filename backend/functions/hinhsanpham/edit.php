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
    <title>Shop hoa | Chỉnh sửa hình sản phẩm</title>
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
                        "Sản phẩm %s, giá: %d",
                        $rowSanPham['sp_ten'],
                        number_format($rowSanPham['sp_gia'], 2, ".", ",") . ' vnđ'
                    );
                    $dataSanPham[] = array(
                        'sp_id' => $rowSanPham['sp_id'],
                        'sp_tomtat' => $sp_tomtat
                    );
                }

                $hasp_id = $_GET['hasp_id'];
                $sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hasp_id=$hasp_id;";
                $resultSelect = mysqli_query($conn, $sqlSelect);
                $hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
                ?>
                <div class="container-fluid">
                    <div class="row mb-10">
                        <div class="col-md-12 text-center">
                            <h1 id="frmtitle" class="h3 mb-0 text-gray-800 mb-3 shadow">Sửa đổi hình sản phẩm</h1>
                        </div>
                        <form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Hình ảnh hiện tại</label>
                                <br />
                                <img src="/shophoa.vn/assets/uploads/img-product/<?= $hinhsanphamRow['hsp_tenfile'] ?>" class="img-fluid" width="300px" />
                            </div>
                            <div class="form-group">
                                <label for="sp_id">Sản phẩm</label>
                                <select class="form-control" id="sp_id" name="sp_id">
                                    <?php foreach ($dataSanPham as $sanpham) : ?>
                                        <?php if ($sanpham['sp_id'] == $hinhsanphamRow['sanpham_sp_id']) : ?>
                                            <option value="<?= $sanpham['sp_id'] ?>" selected><?= $sanpham['sp_tomtat'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $sanpham['sp_id'] ?>"><?= $sanpham['sp_tomtat'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-group">
                                    <label for="hsp_tenfile">Tập tin ảnh</label>

                                    <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                                    <div class="preview-img-container">
                                        <img src="/shophoa.vn/assets/shared/img/default.png" id="preview-img" width="200px" />
                                    </div>

                                    <!-- Input cho phép người dùng chọn FILE -->
                                    <input type="file" class="form-control" id="hsp_tenfile" name="hsp_tenfile">
                                </div>
                                <button class="btn btn-primary" name="btnSave">Lưu</button>
                                <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                        </form>
                    </div>
                </div>


                <?php
                if (isset($_POST['btnSave'])) {
                    $hasp_id = $_GET['hasp_id'];
                    if (isset($_FILES['hsp_tenfile'])) {

                        $upload_dir = __DIR__ . "/../../../assets/uploads/";

                        $subdir = 'img-product/';

                        if ($_FILES['hsp_tenfile']['error'] > 0) {
                            echo 'File Upload Bị Lỗi';
                            die;
                        } else {
                            // Xóa file cũ để tránh rác trong thư mục UPLOADS
                            // Kiểm tra nếu file có tổn tại thì xóa file đi
                            $old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tenfile'];
                            if (file_exists($old_file)) {
                                // Hàm unlink(filepath) dùng để xóa file trong PHP
                                unlink($old_file);
                            }

                            $hsp_tenfile = $_FILES['hsp_tenfile']['name'];
                            $tenfile = date('YmdHis') . '_' . $hsp_tenfile;

                            move_uploaded_file($_FILES['hsp_tenfile']['tmp_name'], $upload_dir . $subdir . $tenfile);
                        }

                        $sql = "UPDATE `hinhsanpham` SET hsp_tenfile='$tenfile' WHERE hasp_id=$hasp_id;";

                        mysqli_query($conn, $sql);
                        //var_dump($sql); die;
                        // Đóng kết nối
                        mysqli_close($conn);
                        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
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
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tenfile");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
        CKEDITOR.replace('lh_mota');
    </script>
</body>

</html>