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
</head>

<body>
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- Nội dung trang web -->
    <div class="container py-3">
        <div class="row">
            <?php if (isset($_SESSION['kh_tendangnhap_logged'])) : ?>
                <?php
                $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];
                $sqlSelectKhachHang = " SELECT * FROM `khachhang` kh WHERE kh.kh_tendangnhap = '$kh_tendangnhap';";
                $resultSelectKhachHang = mysqli_query($conn, $sqlSelectKhachHang);
                $khachhangRow;
                while ($row = mysqli_fetch_array($resultSelectKhachHang, MYSQLI_ASSOC)) {
                    $khachhangRow = array(
                        'kh_id' => $row['kh_id'],
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_hoten' => $row['kh_hoten'],
                        'kh_ngaysinh' => date('d/m/Y', strtotime($row['kh_ngaysinh'])),
                        'kh_gioitinh' => $row['kh_gioitinh'],
                        'kh_email' => $row['kh_email'],
                        'kh_diachi' => $row['kh_diachi'],
                        'kh_sodienthoai' => $row['kh_sodienthoai'],
                        'kh_avt_tenfile' => $row['kh_avt_tenfile'],
                    );
                }
                ?>
                <div class="col-md-6 border">
                    <div class="p-2">
                        <h4 class="text-danger myfont text-center py-2">Thông tin cá nhân</h4>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <?php if (!empty($khachhangRow['kh_avt_tenfile']) && file_exists('../assets/uploads/avatar/' . $khachhangRow['kh_avt_tenfile'])) : ?>
                                    <img src="/shophoa.vn/assets/uploads/avatar/<?= $khachhangRow['kh_avt_tenfile'] ?>" alt="<?= $khachhangRow['kh_hoten'] ?>" class="img-avatar img-thumbnail">
                                <?php else : ?>
                                    <img src="/shophoa.vn/assets/shared/img/avatar-default.jpg" alt="<?= $khachhangRow['kh_hoten'] ?>" class="img-avatar img-thumbnail">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-8 my-auto">
                                <h1 class="text-center"><?= $khachhangRow['kh_hoten'] ?></h1>
                                <div class="row">
                                    <div class="col-sm-6"><strong>Ngày sinh : </strong></div>
                                    <div class="col-sm-6"><?= $khachhangRow['kh_ngaysinh'] ?></div>
                                    <div class="col-sm-6"><strong>Giới tính : </strong></div>
                                    <div class="col-sm-6">
                                        <?php
                                        if ($khachhangRow['kh_ngaysinh'])
                                            echo 'Nam';
                                        else
                                            echo 'Nu';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border">
                    <div class="p-2">
                        <h4 class="text-danger myfont text-center py-2">Sổ địa chỉ</h4>
                        <div class="row">
                            <div class="col-sm-4"><strong>Tên người nhận : </strong></div>
                            <div class="col-sm-8"><?= $khachhangRow['kh_hoten'] ?></div>
                            <div class="col-sm-4"><strong>Địa chỉ : </strong></div>
                            <div class="col-sm-8"><?= $khachhangRow['kh_diachi'] ?></div>
                            <div class="col-sm-4"><strong>Số điện thoại : </strong></div>
                            <div class="col-sm-8"><?= $khachhangRow['kh_sodienthoai'] ?></div>
                            <div class="col-sm-4"><strong>Email : </strong></div>
                            <div class="col-sm-8"><?= $khachhangRow['kh_email'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 border mt-3">
                    <h4 class="text-danger myfont text-center py-2">Đơn hàng gần đây</h4>
                    <?php
                    $sqlDonHang = "SELECT * FROM dondathang AS a WHERE a.khachhang_kh_id = {$_SESSION['kh_tendangnhap_id']} ORDER BY a.ddh_ngaylap DESC;";
                    $resultDonHang = mysqli_query($conn, $sqlDonHang);
                    $dataDonHang = [];
                    while ($row = mysqli_fetch_array($resultDonHang, MYSQLI_ASSOC)) {
                        $dataDonHang[] = array(
                            'ddh_id' => $row['ddh_id'],
                            'ddh_tongtien' => number_format($row['ddh_tongtien'], 0, ".", ","),
                            'ddh_ngaylap' => $row['ddh_ngaylap'],
                            'ddh_trangthai' => $row['ddh_trangthai'],
                        );
                    }
                    ?>
                    <?php if (count($dataDonHang) > 0) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">Đơn hàng</th>
                                    <th class="text-left">Ngày đặt</th>
                                    <th class="text-left">Sản phẩm</th>
                                    <th class="text-right">Tổng tiền</th>
                                    <th class="text-left">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDonHang as $dh) : ?>
                                    <tr>
                                        <td class="text-left"><?= $dh['ddh_id'] ?></td>
                                        <td class="text-left"><?= $dh['ddh_ngaylap'] ?></td>
                                        <td class="text-left">
                                            <?php
                                            $sqlAnh = "SELECT b.sp_avt_tenfile FROM	dondathang_has_sanpham AS a, sanpham AS b WHERE a.dondathang_ddh_id = {$dh['ddh_id']} AND a.sanpham_sp_id = b.sp_id;";
                                            $resultAnh = mysqli_query($conn, $sqlAnh);
                                            $dataAnh = [];
                                            while($row = mysqli_fetch_array($resultAnh, MYSQLI_ASSOC)){
                                                $dataAnh[] = array(
                                                    'sp_avt_tenfile' => $row['sp_avt_tenfile']
                                                );
                                            }
                                            ?>
                                            <?php foreach($dataAnh as $a): ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?=$a['sp_avt_tenfile']?>" alt="<?=$a['sp_avt_tenfile']?>" height="50px">
                                            <?php endforeach; ?>
                                        </td>
                                        <td class="text-right"><?= $dh['ddh_tongtien'] ?></td>
                                        <td class="text-left">
                                            <?php
                                            if ($dh['ddh_trangthai'])
                                                echo '<span class="badge badge-success">Đã giao</span>';
                                            else
                                                echo '<span class="badge badge-danger">Chờ</span>';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="text-center">Không có đơn hàng</p>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class="col-md-12">
                    <p>Bạn phải <a href="/shophoa.vn/backend/auth/login.php">đăng nhập</a> trước</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- End nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>