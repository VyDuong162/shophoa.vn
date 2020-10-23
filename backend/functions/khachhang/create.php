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
    <title>Khách hàng</title>
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
                $sql = " SELECT * FROM `khachhang` ";
                $result = mysqli_query($conn, $sql);
                $dataKhachHang = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataKhachHang[] = array(
                        'kh_id' => $row['kh_id'],
                        'kh_hoten' => $row['kh_hoten'],
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_matkhau' => $row['kh_matkhau'],
                        'kh_gioitinh' => $row['kh_gioitinh'],
                        'kh_ngaysinh' => $row['kh_ngaysinh'],
                        'kh_sodienthoai' => $row['kh_sodienthoai'],
                        'kh_email' => $row['kh_email'],
                        'kh_diachi' => $row['kh_diachi'],
                        'kh_diachi' => $row['kh_trangthai'],
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
                                <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm mới khách hàng</h1>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_hoten">Họ tên khách hàng</label>
                                    <input type="text" class="form-control" id="kh_hoten" name="kh_hoten" placeholder="Họ tên khách hàng" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_tendangnhap">Tên đâng nhập </label>
                                    <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap" placeholder="Tên đăng nhập" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_matkhau">Mật khẩu</label>
                                    <input type="text" class="form-control" id="kh_matkhau" name="kh_matkhau" placeholder="Mật khẩu" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_gioitinh">Giới tính</label>
                                    <input type="text" class="form-control" id="kh_gioitinh" name="kh_gioitinh" placeholder="Giới tính" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_ngaysinh">Ngày sinh</label>
                                    <input type="text" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh" placeholder="Ngày sinh" value="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_sodienthoai">Số điện thoại</label>
                                    <input type="text" class="form-control" id="kh_sodienthoai" name="kh_sodienthoai" placeholder="Số điện thoại" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_email">Email</label>
                                    <input type="text" class="form-control" id="kh_email" name="kh_email" placeholder="Email" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_diachi">Địa chỉ khách hàng</label>
                                    <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" placeholder="Địa chỉ" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_trangthai">Trạng thai</label>
                                    <input type="text" class="form-control" id="kh_trangthai" name="kh_trangthai" placeholder="Địa chỉ" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kh_avt_tenfile"> Ảnh đại diện</label>
                                    <div class="preview-img-container">
                                        <img src="../../../assets/shared/img/default.png" id="preview-img" width="200px" />
                                    </div>
                                    <input type="file" class="form-control" id="kh_avt_tenfile" name="kh_avt_tenfile">
                                </div>
                            </div>


                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                    
                    <?php
                    if (isset($_POST['btnsave'])) {
                        $ten = $_POST['kh_hoten'];
                        $tendangnhap = $_POST['kh_tendangnhap'];
                        $matkhau = $_POST['kh_matkhau'];
                        $gioitinh = $_POST['kh_gioitinh'];
                        $ngaysinh = $_POST['kh_ngaysinh'];
                        $sodienthoai = $_POST['kh_sodienthoai'];
                        $email = $_POST['kh_email'];
                        $diachi = $_POST['kh_diachi'];
                        $trangthai = $_POST['kh_trangthai'];
                        //$kh_id=$_POST['kh_id'];
                        
                        $sql = "INSERT INTO `khachhang` (`kh_hoten`, `kh_tendangnhap`, `kh_matkhau`,`kh_gioitinh`,`kh_ngaysinh`, `kh_sodienthoai`, `kh_email`, `kh_diachi`, `kh_trangthai`) VALUES ('$ten','$tendangnhap','$matkhau',$gioitinh' ,'$ngaysinh', '$sodienthoai','$email', '$diachi','$trangthai');";
                        
                        mysqli_query($conn, $sql);
                        //var_dump($sql);
                        die;
                        mysqli_close($conn);
                        echo "<script>location.href = 'index.php';</script>";
                    }
                    ?>
                </div>
        </div>
       
        </main>
    </div>
    
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
   
</body>

</html>