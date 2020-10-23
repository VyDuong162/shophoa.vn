<?php
if (session_id() === '') {
    session_start();
    include_once(__DIR__ . '/../../dbconnect.php');
}
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Đăng ký</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <style>
        h1 {
            background: url('../../assets/shared/img/dangky1.png');
            background-size: cover;
            color: white;
            text-shadow: black 1px 1px 10px;
        }
    </style>
</head>

<body>
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 shadow-lg my-md-5 my-sm-1 px-0" style="border-radius: 5px;">
                <h1 class="myfont text-center py-5" style="border-radius: 5px 5px 0 0;">Đăng ký tài khoản</h1>
                <form action="" method="post" id="frm_dang_ky" name="frm_dang_ky" enctype="multipart/form-data" class="px-5">
                    <fieldset class="mt-md-5 mt-sm-0">
                        <legend class="myfont text-danger mb-0">Phần thông tin cơ bản</legend>
                        <hr class="mt-0">
                        <div class="form-group">
                            <input type="text" name="ten" id="ten" class="form-control hoa-form-control" placeholder="Họ và tên ...">
                            <div class="valid-feedback"> Đã nhập.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <label for="ngaysinh" class="col-lg-3 col-sm-4 col-form-label pt-lg-3 pt-md-2">Ngày sinh: <span class="text-danger font-weight-bold">*</span></label>
                                    <input type="date" id="ngaysinh" name="ngaysinh" class="form-control hoa-form-control col-lg-8 col-sm-7">
                                    <div class="valid-feedback"> Đã nhập.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-lg-3 col-md-4 pt-lg-3 pt-md-2">Giới tính: <span class="text-danger font-weight-bold">*</span></legend>
                                        <div class="col-lg-9 col-md-8 pt-lg-3 pt-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="gioitinh" id="gioitinh_nam" class="form-check-input" value="1" checked>
                                                <label for="gioitinh_nam" class="form-check-label">Nam</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="gioitinh" id="gioitinh_nu" class="form-check-input" value="0">
                                                <label for="gioitinh_nu" class="form-check-label">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-end">
                            <input type="file" name="kh_avt_tenfile" id="kh_avt_tenfile" class="form-control hoa-form-control col-sm-10">
                            <div class="preview-img-container col-sm-2">
                                <img src="/shophoa.vn/assets/shared/img/avatar-default.jpg" id="preview-img" class=" img-fluid" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mt-md-5 mt-sm-0">
                        <legend class="myfont text-danger mb-0">Phần thông tin liên hệ</legend>
                        <hr class="mt-0">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <input type="mail" id="email" name="email" class="form-control hoa-form-control" placeholder="Địa chỉ email ...">
                                <div class="valid-feedback"> Đã nhập.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="tel" name="dienthoai" id="dienthoai" class="form-control hoa-form-control" placeholder="Số điện thoại ...">
                                <div class="valid-feedback"> Đã nhập.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" name="diachi" id="diachi" class="form-control hoa-form-control" placeholder="Địa chỉ ...">
                                <div class="valid-feedback"> Đã nhập.</div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mt-md-5 mt-sm-0">
                        <legend class="myfont text-danger mb-0">Phần tài khoản</legend>
                        <hr class="mt-0">
                        <div class="form-group">
                            <input type="text" name="tendangnhap" id="tendangnhap" class="form-control hoa-form-control" placeholder="Tên đăng nhập ...">
                            <div class="valid-feedback"> Đã nhập.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3" style="position: relative;">
                                <input type="password" name="matkhau" id="matkhau" class="form-control hoa-form-control" placeholder="Mật khẩu ...">
                                <div class="valid-feedback"> Đã nhập.</div>
                                <div class="show-password" id="show-password-matkhau" style="right: 13px;">
                                    <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" style="position: relative;">
                                <input type="password" name="nhaplaimatkhau" id="nhaplaimatkhau" class="form-control hoa-form-control" placeholder="Nhập lại mật khẩu ...">
                                <div class="valid-feedback"> Đã nhập.</div>
                                <div class="show-password" id="show-password-nhaplaimatkhau" style="right: 13px;">
                                    <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group text-center">
                        <button class="btn btn-outline-success my-btn-cir font-weight-bold" name="btn_dangky">Đăng ký</button>
                        <input type="reset" value="Nhập lại" class="btn btn-outline-danger my-btn-cir font-weight-bold">
                    </div>
                </form>
                <?php
                if (isset($_POST['btn_dangky'])) {
                    $errors = [];
                    $ten = htmlentities($_POST['ten']);
                    $ngaysinh = $_POST['ngaysinh'];
                    $gioitinh = $_POST['gioitinh'];
                    $email = empty($_POST['email']) ? '' : $_POST['email'];
                    $dienthoai = htmlentities($_POST['dienthoai']);
                    $diachi = htmlentities($_POST['diachi']);
                    $tendangnhap = htmlentities($_POST['tendangnhap']);
                    $matkhau = addslashes($_POST['matkhau']);
                    $nhaplaimatkhau = addslashes($_POST['nhaplaimatkhau']);
                    if (empty($ten)) {
                        $errors['ten'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $ten,
                            'mes' => 'Họ và tên không được bỏ trống',
                        );
                    } else {
                        if (strlen($ten) < 3) {
                            $errors['ten'][] = array(
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $ten,
                                'mes' => 'Bạn phải nhập họ tên tối thiểu 3 ký tự'
                            );
                        } else if (strlen($ten) > 50) {
                            $errors['ten'][] = array(
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $ten,
                                'mes' => 'Bạn chỉ được nhập họ tên tối đa 50 ký tự'
                            );
                        }
                    }
                    if (empty($ngaysinh)) {
                        $errors['ngaysinh'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $ngaysinh,
                            'mes' => 'Ngày sinh không được bỏ trống',
                        );
                    }
                    if (empty($dienthoai)) {
                        $errors['dienthoai'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $dienthoai,
                            'mes' => 'Số điện thoại không được bỏ trống',
                        );
                    } else {
                        if (!is_numeric($dienthoai)) {
                            $errors['dienthoai'][] = array(
                                'rule' => 'number',
                                'rule_value' => true,
                                'value' => $dienthoai,
                                'mes' => 'Bạn phải nhập đúng định dạng số điện thoại',
                            );
                        } else if (strlen($dienthoai) < 10) {
                            $errors['dienthoai'][] = array(
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $dienthoai,
                                'mes' => 'Số điện thoại phải có ít nhất 10 chữ số',
                            );
                        } else if (strlen($dienthoai) > 10) {
                            $errors['dienthoai'][] = array(
                                'rule' => 'maxlength',
                                'rule_value' => 3,
                                'value' => $dienthoai,
                                'mes' => 'Số điện thoại chỉ có tối đa 10 chữ số',
                            );
                        }
                    }
                    if (empty($diachi)) {
                        $errors['diachi'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $diachi,
                            'mes' => 'Địa chỉ không được bỏ trống',
                        );
                    }
                    if (empty($tendangnhap)) {
                        $errors['tendangnhap'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $tendangnhap,
                            'mes' => 'Tên đăng nhập không được bỏ trống',
                        );
                    } else {
                        if (strlen($tendangnhap) < 3) {
                            $errors['tendangnhap'][] = array(
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $tendangnhap,
                                'mes' => 'Tên đăng nhập phải có tối thiểu 3 ký tựg',
                            );
                        } else if (strlen($tendangnhap) > 50) {
                            $errors['tendangnhap'][] = array(
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $tendangnhap,
                                'mes' => 'Tên đăng nhập chỉ chứ tối đa 50 ký tự',
                            );
                        }
                    }
                    if (empty($matkhau)) {
                        $errors['matkhau'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $matkhau,
                            'mes' => 'Mật khẩu không được bỏ trống',
                        );
                    } else {
                        if (strlen($matkhau) < 3) {
                            $errors['matkhau'][] = array(
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $matkhau,
                                'mes' => 'Mật khẩu phải có tối thiểu 3 ký tự',
                            );
                        } else if (strlen($matkhau) > 50) {
                            $errors['matkhau'][] = array(
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $matkhau,
                                'mes' => 'Mật khẩu chỉ chứ tối đa 50 ký tự',
                            );
                        }
                    }
                    if (empty($nhaplaimatkhau)) {
                        $errors['nhaplaimatkhau'][] = array(
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $nhaplaimatkhau,
                            'mes' => 'Nhập lại mật khẩu không được bỏ trống',
                        );
                    } else {
                        if ($nhaplaimatkhau != $matkhau) {
                            $errors['nhaplaimatkhau'][] = array(
                                'rule' => 'equalTo',
                                'rule_value' => $matkhau,
                                'value' => $nhaplaimatkhau,
                                'mes' => 'Mật khẩu không khớp',
                            );
                        }
                    }
                    if (isset($_FILES['kh_avt_tenfile'])) {
                        $upload_dir = __DIR__ . "/../../assets/uploads/";
                        $subdir = 'avatar/';
                        if ($_FILES['kh_avt_tenfile']['error'] > 0) {
                            $kh_avt_tenfile = '';
                        } else {
                            $tentaptin = date('YmdHis') . '_' . $_FILES['kh_avt_tenfile']['name'];
                            $kh_avt_tenfile = $tentaptin;
                            move_uploaded_file($_FILES['kh_avt_tenfile']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                        }
                    } else {
                        $kh_avt_tenfile = '';
                    }
                }
                ?>
                <h1 class="py-5 m-0" style="border-radius: 0 0 5px 5px;"></h1>
            </div>
            <?php if (isset($_POST['btn_dangky']) && isset($errors) && count($errors) > 0) : ?>
                <div id="aler" class="alert alert-warning alert-dismissible fade show my-alert" role="alert">
                    <?php foreach ($errors as $fields) : ?>
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
            if (isset($_POST['btn_dangky']) && !(isset($errors) && count($errors) > 0)){
                $sqlDangky = "INSERT INTO khachhang (kh_hoten, kh_tendangnhap, kh_matkhau, kh_gioitinh, kh_ngaysinh, kh_sodienthoai, kh_email, kh_diachi, kh_avt_tenfile, kh_trangthai, kh_quantri) VALUES (N'$ten', '$tendangnhap', '$matkhau', $gioitinh, '$ngaysinh', '$dienthoai', '$email', '$diachi', '$kh_avt_tenfile', 1, 0)";
                mysqli_query($conn, $sqlDangky);
            }
            ?>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/shophoa.vn/assets/vendor/jquery-validation/localization/messages_vi.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#frm_dang_ky').validate({
                rules: {
                    ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    ngaysinh: {
                        required: true,
                    },
                    gioitinh: {
                        required: true,
                    },
                    dienthoai: {
                        required: true,
                        min: 0,
                        minlength: 10,
                        maxlength: 10,
                    },
                    diachi: {
                        required: true,
                    },
                    tendangnhap: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    matkhau: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    nhaplaimatkhau: {
                        required: true,
                        equalTo: "#matkhau"
                    },
                },
                messages: {
                    ten: {
                        required: "Bạn phải nhập họ tên",
                        minlength: "Bạn phải nhập họ tên tối thiểu 3 ký tự",
                        maxlength: "Bạn chỉ được nhập họ tên tối đa 50 ký tự",
                    },
                    ngaysinh: {
                        required: "Bạn phải nhập ngày sinh",
                    },
                    dienthoai: {
                        required: "Bạn phải nhập số điện thoại",
                        min: "Bạn phải nhập đúng định dạng số điện thoại",
                        minlength: "Số điện thoại phải có ít nhất 10 chữ số",
                        maxlength: "Số điện thoại chỉ có tối đa 10 chữ số",
                    },
                    diachi: {
                        required: "Bạn phải nhập địa chỉ",
                    },
                    tendangnhap: {
                        required: "Bạn phải nhập tên đăng nhập",
                        minlength: "Tên đăng nhập phải có tối thiểu 3 ký tự",
                        maxlength: "Tên đăng nhập chỉ chứ tối đa 50 ký tự",
                    },
                    matkhau: {
                        required: "Bạn phải tạo 1 mật khẩu",
                        minlength: "Mật khẩu của bạn quá ngắn tối thiểu phải có 3 ký tự",
                        maxlength: "Mật khẩu của bạn quá dài tối đa chỉ chứa 50 ký tự",
                    },
                    nhaplaimatkhau: {
                        required: "Bạn phải nhập vào đây",
                        equalTo: 'Mật khẩu không khớp'
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
            $('#show-password-matkhau').click(function() {
                var pass = document.getElementById('matkhau').type;
                if (pass == 'password') {
                    $('#show-password-matkhau .fa-eye-slash').removeClass('hide');
                    $('#show-password-matkhau .fa-eye').addClass('hide');
                    document.getElementById('matkhau').setAttribute('type', 'text');
                } else {
                    $('#show-password-matkhau .fa-eye').removeClass('hide');
                    $('#show-password-matkhau .fa-eye-slash').addClass('hide');
                    document.getElementById('matkhau').setAttribute('type', 'password');
                }
            });
            $('#show-password-nhaplaimatkhau').click(function() {
                var pass = document.getElementById('nhaplaimatkhau').type;
                if (pass == 'password') {
                    $('#show-password-nhaplaimatkhau .fa-eye-slash').removeClass('hide');
                    $('#show-password-nhaplaimatkhau .fa-eye').addClass('hide');
                    document.getElementById('nhaplaimatkhau').setAttribute('type', 'text');
                } else {
                    $('#show-password-nhaplaimatkhau .fa-eye').removeClass('hide');
                    $('#show-password-nhaplaimatkhau .fa-eye-slash').addClass('hide');
                    document.getElementById('nhaplaimatkhau').setAttribute('type', 'password');
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