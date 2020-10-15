<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="container-fluid my-background">
        <!-- form đăng nhập -->
        <form action="" method="post" name="frmDangNhap" id="frmDangNhap">
            <div class="card-group">
                <!-- Ảnh trang trí -->
                <div class="card" id="img-dangnhap">
                    <div class="card-img h-100">
                        <img src="/shophoa.vn/assets/backend/img/img-login.jpg" height="100%" width="100%" alt="">
                    </div>
                </div>
                <!-- End ảnh trang trí -->
                <!-- Phần đăng nhập -->
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center myfont">
                            Đăng nhập
                        </h1>
                        <!-- Nhập tên đăng nhập -->
                        <div class="form-group">
                            <input type="text" name="ten_dang_nhap" id="ten_dang_nhap" class="form-control hoa-form-control" placeholder="Tên đăng nhập..." />
                            <div class="valid-feedback">
                                Đã nhập.
                            </div>
                        </div>
                        <!-- End nhập tên đăng nhập -->
                        <!-- Nhập mật khẩu -->
                        <div class="form-group" style="position: relative;">
                            <input type="password" name="mat_khau" id="mat_khau" class="form-control hoa-form-control" placeholder="Mật khẩu..." />
                            <div class="valid-feedback">
                                Đã nhập.
                            </div>
                            <div class="show-password" id="show-password">
                                <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- End nhập mật khẩu -->
                        <!-- Button đăng nhập -->
                        <div class="form-group text-center">
                            <button name="btn_dang_nhap" id="btn_dang_nhap" class="btn btn-success w-100 my-btn-cir">Đăng nhập</button>
                        </div>
                        <h5 class="text-center myfont">hoặc</h5>
                        <div class="form-group text-center">
                            <button name="btn_facebook" id="btn_facebook" class="btn btn-outline-primary mb-2 w-100 my-btn-cir font-weight-bold">
                                Facebook
                            </button>
                            <button name="btn_google" id="btn_google" class="btn btn-outline-danger mb-2 w-100 my-btn-cir font-weight-bold">
                                Google
                            </button>
                        </div>
                        <!-- End button đăng nhập -->
                        <hr>
                        <!-- Phần thông tin thêm -->
                        <div class="text-center">
                            <a href="#" class="small">Quên mật khẩu?</a>
                        </div>
                        <div class="text-center">
                            <a href="/templatedoan/template-index/dangky.php" class="small">Đăng ký tài khoản</a>
                        </div>
                        <hr>
                        <div class="text-center small">
                            <a href="/shophoa.vn/frontend/index.php">Trang chủ</a> | <a href="/shophoa.vn/frontend/pages/gioithieu.php">Giới thiệu</a> | <a href="/shophoa.vn/frontend/pages/lienhe.php">Liên hệ</a>
                        </div>
                        <!-- End phần thông tin thêm -->
                    </div>
                </div>
                <!-- End phần đăng nhập -->
            </div>
        </form>
        <!-- End form đăng nhập -->
        <!-- Kiểm tra logic phần backend -->
        <?php
        if (isset($_POST['btn_dang_nhap'])) {
            $ten_dang_nhap = $_POST['ten_dang_nhap'];
            $mat_khau = addslashes($_POST['mat_khau']);
            $erorrs = [];
            if (empty($ten_dang_nhap)) {
                $erorrs['ten_dang_nhap'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $ten_dang_nhap,
                    'mes' => 'Tên đăng nhập không được bỏ trống',
                ];
            } else {
                if (strlen($ten_dang_nhap) < 3) {
                    $erorrs['ten_dang_nhap'][] = [
                        'rule' => 'minlength',
                        'rule_value' => 3,
                        'value' => $ten_dang_nhap,
                        'mes' => 'Tên đăng quá ngắn, phải có ít nhất 3 ký tự',
                    ];
                }
                if (strlen($ten_dang_nhap) > 50) {
                    $erorrs['ten_dang_nhap'][] = [
                        'rule' => 'maxlength',
                        'rule_value' => 3,
                        'value' => $ten_dang_nhap,
                        'mes' => 'Tên đăng nhập quá dài, chỉ được tối đa 50 ký tự',
                    ];
                }
            }
            if (empty($mat_khau)) {
                $erorrs['mat_khau'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $mat_khau,
                    'mes' => 'Mật khẩu không được bỏ trống',
                ];
            }
        }
        ?>
        <!-- End kiểm tra logic phần backend -->
        <?php if (isset($_POST['btn_dang_nhap']) && isset($erorrs) && count($erorrs) > 0) : ?>
            <div id="aler" class="alert alert-warning alert-dismissible fade show my-alert" role="alert">
                <?php foreach ($erorrs as $fields) : ?>
                    <?php foreach ($fields as $mes) : ?>
                        <strong>Lỗi</strong>: <?= $mes['mes'] ?><br>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php
        if (isset($_POST['btn_dang_nhap']) && (!isset($erorrs) || count($erorrs) == 0)) {
            include_once(__DIR__ . '/../../dbconnect.php');
            $sqlSelect = " SELECT * FROM khachhang kh WHERE kh.kh_tendangnhap = '$ten_dang_nhap' AND kh.kh_matkhau = '$mat_khau';";
            $result = mysqli_query($conn, $sqlSelect);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['kh_tendangnhap_logged'] = $ten_dang_nhap;
                $_SESSION['kh_tendangnhap_name'] = $data['kh_hoten'];
                $_SESSION['kh_tendangnhap_quantri'] = $data['kh_quantri'];
                if ($_SESSION['kh_tendangnhap_quantri'])
                    echo '<script>location.href = "/shophoa.vn/backend/dashboard.php";</script>';
                else
                    echo '<script>location.href = "/shophoa.vn/frontend/index.php";</script>';
            } else {
        ?>
                <div id="aler" class="alert alert-danger alert-dismissible fade show my-alert" role="alert">
                    <strong>Đăng nhập thất bại</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            // Kiểm tra logic phần frontend
            $('#frmDangNhap').validate({
                // Phần logic
                rules: {
                    ten_dang_nhap: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    mat_khau: {
                        required: true,
                    },
                },
                // Phần thông báo
                messages: {
                    ten_dang_nhap: {
                        required: "Nhập tên đăng nhập",
                        minlenght: "Tên đăng nhập phải có ít nhất 3 ký tự",
                        maxlenght: "Tên đăng nhập chỉ có tối đa 50 ký tự",
                    },
                    mat_khau: {
                        required: "Nhập mật khẩu",
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
            // End kiểm tra logic phần frontend
            // Chức năng ẩn hiện password
            $('#show-password').click(function() {
                var pass = document.getElementById('mat_khau').type;
                if (pass == 'password') {
                    $('#show-password .fa-eye-slash').removeClass('hide');
                    $('#show-password .fa-eye').addClass('hide');
                    document.getElementById('mat_khau').setAttribute('type', 'text');
                } else {
                    $('#show-password .fa-eye').removeClass('hide');
                    $('#show-password .fa-eye-slash').addClass('hide');
                    document.getElementById('mat_khau').setAttribute('type', 'password');
                }
            });
            // End chức năng ẩn hiện password
        });
    </script>

</body>

</html>