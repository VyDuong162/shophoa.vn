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
    <title>Đơn đặt hàng</title>
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
                    include_once(__DIR__.'/../../../dbconnect.php');
                    //khách hàng
                    $sqlKhachHang = "select * from `khachhang`";
                    $resultKhachHang = mysqli_query($conn, $sqlKhachHang);
                    $dataKhachHang = [];
                    while ($rowKhachHang = mysqli_fetch_array($resultKhachHang, MYSQLI_ASSOC)) {
                        $kh_tomtat = sprintf(
                            "Họ tên %s, số điện thoại: %s",
                            $rowKhachHang['kh_hoten'],
                            $rowKhachHang['kh_sodienthoai']
                        );
                        $dataKhachHang[] = array(
                            'kh_tendangnhap' => $rowKhachHang['kh_tendangnhap'],
                            'kh_tomtat' => $kh_tomtat,
                        );
                    }
                    //hình thuc thanh toán
                    $sqlHinhThucThanhToan = "select * from `hinhthucthanhtoan`";
                    $resultHinhThucThanhToan = mysqli_query($conn, $sqlHinhThucThanhToan);
                    $dataHinhThucThanhToan = [];
                    while ($rowHinhThucThanhToan = mysqli_fetch_array($resultHinhThucThanhToan, MYSQLI_ASSOC)) {
                        $dataHinhThucThanhToan[] = array(
                            'httt_id' => $rowHinhThucThanhToan['httt_id'],
                            'httt_ten' => $rowHinhThucThanhToan['httt_ten'],
                        );
                    }
                    $sqlSanPham = "select * from `sanpham`";
                    $resultSanPham = mysqli_query($conn, $sqlSanPham);
                    $dataSanPham = [];
                    while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                        $dataSanPham[] = array(
                            'sp_id' => $rowSanPham['sp_id'],
                            'sp_gia' => $rowSanPham['sp_gia'],
                            'sp_ten' => $rowSanPham['sp_ten'],
                        );
                    }
                    ?>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 text-right mt-3">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmdondathang" id="frmdondathang" method="post" action="" enctype="multipart/form-data">
                                <div class="form-row text-center">
                                    <div class="col">
                                        <h1 id="frmtitle" class="h3 mb-0 text-gray-800 mb-3 shadow">Thêm đơn đặt hàng</h1>
                                    </div> 
                                </div>
                                <fieldset id="dondathang_container">
                                    <legend>Thông tin đơn hàng</legend>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Khách hàng</label>
                                                <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                                    <option value="">Vui lòng chọn Khách hàng</option>
                                                    <?php foreach ($dataKhachHang as $khachhang) : ?>
                                                        <option value="<?= $khachhang['kh_tendangnhap'] ?>"><?= $khachhang['kh_tomtat'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ngày lập</label>
                                                <input type="date" name="ddh_ngaylap" id="ddh_ngaylap" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ngày giao</label>
                                                <input type="date" name="ddh_ngaygiao" id="ddh_ngaygiao" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Nơi giao</label>
                                                <input type="text" name="ddh_diachi" id="ddh_diachi" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Trạng thái thanh toán</label><br />
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Hình thức thanh toán</label>
                                                <select name="httt_id" id="httt_id" class="form-control">
                                                <option value="">Vui lòng chọn Hình thức thanh toán</option>
                                                    <?php foreach ($dataHinhThucThanhToan as $httt) : ?>
                                                        <option value="<?= $httt['httt_id'] ?>"><?= $httt['httt_ten'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset id="chiTietDonHangContainer">
                                    <legend>Thông tin chi tiết đơn hàng</legend>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="sp_id">Sản phẩm</label>
                                                <select class="form-control" id="sp_id" name="sp_id">
                                                    <option value="">Vui lòng chọn Sản phẩm</option>
                                                    <?php foreach ($dataSanPham as $sanpham) : ?>
                                                        <option value="<?= $sanpham['sp_id'] ?>" data-sp_gia="<?= $sanpham['sp_gia'] ?>"><?= $sanpham['sp_ten'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Số lượng</label>
                                                <input type="text" name="soluong" id="soluong" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Xử lý</label><br />
                                                <button type="button" id="btnThemSanPham" class="btn btn-secondary">Thêm vào đơn hàng</button>
                                            </div>
                                        </div>
                                    </div>                               
                                    <table id="tblChiTietDonHang" class="table table-bordered">
                                        <thead class="text-center align-middle" >
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </thead>
                                        <tbody>
            
                                        </tbody>
                                    </table>
                                </fieldset> 
                                <div class="col-md-12 text-center mb-5">
                                    <button class="btn btn-success text-center" name="btnsave">Lưu dữ liệu</button>
                                    <a href="index.php" class="btn btn-outline-secondary text-center" name="btnBack" id="btnBack">Quay về</a>
                                </div>
                                
                        </form>
                </div>
                    <?php
                    if (isset($_POST['btnsave'])) {
                        $kh_tendangnhap = $_POST['kh_tendangnhap'];
                        $ddh_ngaylap = $_POST['ddh_ngaylap'];
                        $ddh_ngaygiao = $_POST['ddh_ngaygiao'];
                        $ddh_diachi = $_POST['ddh_diachi'];
                        $ddh_trangthai = $_POST['ddh_trangthai'];
                        $httt_id = $_POST['httt_id'];

                        $arr_sp_id = $_POST['sp_id'];                   
                        $arr_sp_ddh_soluong = $_POST['sp_ddh_soluong'];   
                        $arr_sp_ddh_dongia = $_POST['sp_ddh_dongia'];     
                        //INSERT
                        $sqlDonHang = "INSERT INTO `dondathang` (`ddh_ngaylap`, `ddh_ngaygiao`, `ddh_diachi`, `dDh_trangthai`, `httt_id`, `kh_tendangnhap`) VALUES ('$ddh_ngaylap', '$ddh_ngaygiao', N'$ddh_diachi', '$ddh_trangthai', '$httt_id', '$kh_tendangnhap')";
                        mysqli_query($conn, $sqlDonHang);
                        $dh_id = $conn->insert_id;
                        
                        for($i = 0; $i < count($arr_sp_id); $i++) {
                           
                            $sp_id = $arr_sp_id[$i];
                            $sp_dh_soluong = $arr_sp_ddh_soluong[$i];
                            $sp_dh_dongia = $arr_sp_ddh_dongia[$i];
                            
                            $sqlInsertSanPhamDonDatHang = "INSERT INTO `dondathang_has_sanpham` (`sanpham_sp_id`,`dondathang_ddh_id` , `sp_dh_soluong`, `sp_dh_dongia`) VALUES ($sp_id, $dh_id, $sp_dh_soluong, $sp_dh_dongia)";
                            
                            mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
                        }
                        echo '<script>location.href = "index.php";</script>';
                    }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script>
       $tongtien=0;
        $('#btnThemSanPham').click(function() {
            
            var sp_id = $('#sp_id').val();
            var sp_gia = $('#sp_id option:selected').data('sp_gia');
            var sp_ten = $('#sp_id option:selected').text();
            var soluong = $('#soluong').val();
            var thanhtien = (soluong * sp_gia);
            var htmlTemplate = '<tr class="text-center align-middle">'; 
            htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_id[]" value="' + sp_id + '"/></td>';
            htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
            htmlTemplate += '<td>' +sp_gia+ '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
            htmlTemplate += '<td>'+thanhtien+'</td>';
            htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
            htmlTemplate += '</tr>';
            // Thêm vào TABLE BODY
            $('#tblChiTietDonHang tbody').append(htmlTemplate);
            // Clear
            $('#sp_id').val('');
            $('#soluong').val('');
        });
        // Đăng ký sự kiện cho tất cả các nút XÓA có sử dụng class .btn-delete-row
        $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
            $(this).parent().parent()[0].remove();
        });
        $('#btnThemSanPham').click(function(){
            
        });
    </script>

</body>

</html>