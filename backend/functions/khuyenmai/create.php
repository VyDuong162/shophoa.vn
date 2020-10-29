<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Thêm mới khuyến mãi</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/DataTables/css/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css" type="text/css">

</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                $sql = "SELECT km_id,km_ten,km_noidung,km_tungay,km_denngay,km_anh FROM khuyenmai";
                $result = mysqli_query($conn, $sql);
                $dataKhuyenMai = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataKhuyenMai[] = array(
                        'km_id' => $row['km_id'],
                        'km_ten' => $row['km_ten'],
                        'km_noidung' => $row['km_noidung'],
                        'km_tungay' => $row['km_tungay'],
                        'km_denngay' => $row['km_denngay'],
                        'km_anh' => $row['km_anh']
                    );
                }
                ?>

                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 mt-5">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="form-row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle" class="h3 mb-0 text-gray-800 mb-3 shadow">Thêm khuyến mãi</h1>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="km_ten">Tên khuyến mãi</label>
                                    <input type="text" class="form-control" id="km_ten" name="km_ten" placeholder="Tên khuyến mãi" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="km_tungay">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" id="km_tungay" name="km_tungay" placeholder="Ngày bắt đầu" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="km_denngay">Ngày kết thúc</label>
                                    <input type="date" class="form-control" id="km_denngay" name="km_denngay" placeholder="Ngày kết thúc" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="km_anh">Ảnh khuyến mãi</label>
                                    <div class="preview-img-container">
                                        <img src="/shophoa.vn/assets/shared/img/default.png" id="preview-img" name="preview-img" width="200px" />
                                    </div>
                                    <input type="file" class="form-control" id="km_anh" name="km_anh" placeholder="Ảnh khuyến mãi" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="km_noidung">Nội dung khuyến mãi</label>
                                    <textarea type="text" name="km_noidung" id="km_noidung" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-primary" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    if (isset($_POST['btnsave'])) {
                        $km_tungay = $_POST['km_tungay'];
                        $km_denngay = $_POST['km_denngay'];
                        $km_ten = htmlentities($_POST['km_ten']);
                        $km_noidung = htmlentities($_POST['km_noidung']);
                        $km_anh=$_FILES['km_anh'];
                        if (isset($_FILES['km_anh'])) {
                            $upload_dir = __DIR__ . "/../../../assets/uploads/";
                            $subdir = 'img-km/';
                            if ($_FILES['km_anh']['error'] > 0) {
                                echo 'File Upload Bị Lỗi';
                            } elseif ($_FILES['km_anh']['size'] > 800000) {
                                echo 'Kích thước File Upload không cho phép';
                            } elseif (!($_FILES['km_anh']['type'] = 'jpg' || $_FILES['km_anh']['type'] = 'png' || $_FILES['km_anh']['type'] = 'jpge')) {
                                echo 'Chỉ cho phép File Upload là JPG hoặc PNG và JPEG';
                            } else {
                                $km_anh = $_FILES['km_anh']['name'];
                                $tentaptin = date('YmdHis') . '_' . $km_anh;
                                move_uploaded_file($_FILES['km_anh']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                            }
                            $sql = "INSERT INTO `khuyenmai` (km_ten,km_tungay,km_denngay,km_noidung,km_anh) VALUES ('$km_ten','$km_tungay','$km_denngay','$km_noidung','$tentaptin');";
                            mysqli_query($conn, $sql);
                            mysqli_close($conn);
                            echo '<script>location.href = "index.php";</script>';
                        }
                        else{
                            $km_anh = $_FILES['preview-img']['name'];
                            $tentaptin = date('YmdHis') . '_' . $km_anh;
                            move_uploaded_file($_FILES['km_anh']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                            $sql = "INSERT INTO `khuyenmai` (km_ten,km_tungay,km_denngay,km_noidung,km_anh) VALUES ('$km_ten','$km_tungay','$km_denngay','$km_noidung','$tentaptin');";
                            mysqli_query($conn, $sql);
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
    <script src="/shophoa.vn/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('km_noidung');
    </script>
    <script>
        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("km_anh");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
    <script>
        $(document).ready(function() {
            // Kiểm tra logic phần frontend
            $('#frmthemmoi').validate({
                // Phần logic
                rules: {
                    lh_ten: {
                        required: true,
                        maxlength: 50,
                    },
                },
                // Phần thông báo
                messages: {
                    lh_ten: {
                        required: "Nhập tên dữ liệu",
                        maxlenght: "Tên chỉ có tối đa 50 ký tự",
                    },
                },
                // Phần mặc định
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>

</html>