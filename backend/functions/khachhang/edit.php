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
    <title>Shop hoa | Chỉnh sửa khách hàng</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
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
                $kh_id = $_GET['kh_id'];
                $sql = "SELECT * FROM khachhang WHERE kh_id=$kh_id";
                $result = mysqli_query($conn, $sql);
                $dataKhachHang = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataKhachHang = array(
                        'kh_id' => $row['kh_id'],
                        'kh_hoten' => $row['kh_hoten'],
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_matkhau' => $row['kh_matkhau'],
                        'kh_gioitinh' => $row['kh_gioitinh'],
                        'kh_ngaysinh' => $row['kh_ngaysinh'],
                        'kh_sodienthoai' => $row['kh_sodienthoai'],
                        'kh_email' => $row['kh_email'],
                        'kh_diachi' => $row['kh_diachi'],
                        'kh_quantri' => $row['kh_quantri'],
                        'kh_avt_tenfile' => $row['kh_avt_tenfile'],
                    );
                }
                ?>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 text-right mt-3">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Sửa đổi khách hàng</h1>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_hoten">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="kh_hoten" name="kh_hoten" placeholder="Tên khách hàng" value="<?= $dataKhachHang['kh_hoten'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_tendangnhap">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap" placeholder="Tên đăng nhập" value="<?= $dataKhachHang['kh_tendangnhap'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_matkhau">Mật khẩu</label>
                                    <input type="text" class="form-control" id="kh_matkhau" name="kh_matkhau" placeholder="Mật khẩu" value="<?= $dataKhachHang['kh_matkhau'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_gioitinh">Giới tinh</label>
                                    <?php if ($dataKhachHang['kh_gioitinh'] == 1) : ?>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh-nam" value="1" checked>
                                            <label class="form-check-label" for="kh_gioitinh-nam">
                                                Nam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh-nu" value="0">
                                            <label class="form-check-label" for="kh_gioitinh-nu">
                                                Nữ
                                            </label>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh-nam" value="1">
                                            <label class="form-check-label" for="kh_gioitinh-nam">
                                                Nam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh-nu" value="0" checked>
                                            <label class="form-check-label" for="kh_gioitinh-nu">
                                                Nữ
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_ngaysinh">Ngày sinh</label>
                                    <input type="date" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh" placeholder="Ngày sinh" value="<?= $dataKhachHang['kh_ngaysinh'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_sodienthoai">Số điện thoại</label>
                                    <input type="text" class="form-control" id="kh_sodienthoai" name="kh_sodienthoai" placeholder="Số điện thoại" value="<?= $dataKhachHang['kh_sodienthoai'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_email">Email</label>
                                    <input type="text" class="form-control" id="kh_email" name="kh_email" placeholder="Email" value="<?= $dataKhachHang['kh_email'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_diachi">Địa chỉ</label>
                                    <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" placeholder="Địa chỉ" value="<?= $dataKhachHang['kh_diachi'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_gioitinh">Quản trị</label>
                                    <?php if ($dataKhachHang['kh_quantri'] == 1) : ?>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri-1" value="1" checked>
                                            <label class="form-check-label" for="kh_quantri-1">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri-2" value="0">
                                            <label class="form-check-label" for="kh_quantri-2">
                                                User
                                            </label>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri-1" value="1">
                                            <label class="form-check-label" for="kh_quantri-1">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri-2" value="0" checked>
                                            <label class="form-check-label" for="kh_quantri-2">
                                                User
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_avt_tenfile">Tập tin ảnh</label>

                                    <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                                    <div class="preview-img-container col-sm-2">
                            <?php if(!file_exists('../../../assets/uploads/avatar/'.$dataKhachHang['kh_avt_tenfile'])||empty($dataKhachHang['kh_avt_tenfile'])) :?>
                                <img src="/shophoa.vn/assets/shared/img/avatar-default.jpg" id="preview-img" class=" img-fluid" />
                            <?php else:?>
                                <img src="/shophoa.vn/assets/uploads/avatar/<?=$dataKhachHang['kh_avt_tenfile']?>" id="preview-img" class=" img-fluid" />
                            <?php endif; ?>
                            </div>

                                    <!-- Input cho phép người dùng chọn FILE -->
                                    <input type="file" class="form-control" id="kh_avt_tenfile" name="kh_avt_tenfile">
                                </div>
                            </div>


                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_POST['btnsave'])) {
                    $kh_hoten = htmlentities($_POST['kh_hoten']);
                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                    $kh_matkhau = $_POST['kh_matkhau'];
                    $kh_gioitinh = $_POST['kh_gioitinh'];
                    $kh_ngaysinh = $_POST['kh_ngaysinh'];
                    $kh_sodienthoai = $_POST['kh_sodienthoai'];
                    $kh_email = $_POST['kh_email'];
                    $kh_diachi = $_POST['kh_diachi'];
                    $kh_quantri = isset($_POST['kh_quantri']) ? $_POST['kh_quantri'] : '';
                    
                    if (isset($_FILES['kh_avt_tenfile'])) {
                        $upload_dir = __DIR__ . "/../../../assets/uploads/";
                        $subdir = 'avatar/';
                        if ($_FILES['kh_avt_tenfile']['error'] > 0) {
                            $kh_avt_tenfile = $dataKhachHang['kh_avt_tenfile'];
                        } else {
                            $old_file = $upload_dir . $subdir . $dataKhachHang['kh_avt_tenfile'];
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                            $tentaptin = date('YmdHis') . '_' . $_FILES['kh_avt_tenfile']['name'];
                            $kh_avt_tenfile = $tentaptin;
                            move_uploaded_file($_FILES['kh_avt_tenfile']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                        }
                    } else {
                        $kh_avt_tenfile = $dataKhachHang['kh_avt_tenfile'];
                    }
                    // Câu lệnh UPDATE
                    $sql = "UPDATE `KhachHang` SET kh_hoten = '$kh_hoten', kh_tendangnhap='$kh_tendangnhap', kh_matkhau='$kh_matkhau',kh_gioitinh='$kh_gioitinh',kh_ngaysinh='$kh_ngaysinh',kh_sodienthoai='$kh_sodienthoai',kh_email='$kh_email',kh_diachi='$kh_diachi',kh_quantri='$kh_quantri',kh_avt_tenfile='$kh_avt_tenfile' WHERE kh_id='$kh_id' ;";
                    // print_r($sql); die;
                    //var_dump($sql);die;
                    mysqli_query($conn, $sql);
                    //Đóng kết nối
                    mysqli_close($conn);
                    echo '<script>location.href = "index.php";</script>';
                }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('#frmthemmoi').validate({
                // Phần logic
                rules: {
                    kh_hoten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    kh_tendangnhap: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    kh_matkhau: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    kh_diachi: {
                        required: true,
                    },
                    kh_sodienthoai: {
                        required: true,
                        minlength: 10,
                    },
                    kh_email: {
                        required: true,
                    },
                    kh_ngaysinh: {
                        required: true,
                    },
                },
                messages: {
                    kh_tendangnhap: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Tên đăng nhập quá ngắn, tối thiểu phải 3 ký tự',
                        maxlength: 'Tên đăng nhập quá dài, tối đa chỉ 50 ký tự.',
                    },
                    kh_hoten: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Tên đăng nhập quá ngắn, tối thiểu phải 3 ký tự',
                        maxlength: 'Tên đăng nhập quá dài, tối đa chỉ 50 ký tự.',
                    },
                    kh_matkhau: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Mật khẩu quá ngắn, tối thiểu phải 6 ký tự',
                        maxlength: 'Mật khẩu nhập quá dài, tối đa chỉ 50 ký tự.',
                    },
                    kh_diachi: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_sodienthoai: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Số điện thoại tối thiểu phải 10 ký tự',
                    },
                    kh_email: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_ngaysinh: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_quantri: {
                        required: 'Không được bỏ trống phần này',
                    },
                },
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
        const reader = new FileReader();
        const fileInput = document.getElementById("kh_avt_tenfile");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>