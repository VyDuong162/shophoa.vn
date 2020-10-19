<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Thanh toán</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- Phần nội dung trang web -->
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!isset($_SESSION['kh_tendangnhap_logged']) || empty($_SESSION['kh_tendangnhap_logged'])) {
                    echo '<h3 class="text-center">Vui lòng Đăng nhập trước khi Thanh toán! <a href="/shophoa.vn/backend/auth/login.php">Click vào đây để đến trang Đăng nhập</a></h3>';
                } else {
                    if (!isset($_SESSION['giohangdata']) || empty($_SESSION['giohangdata'])) {
                        echo '<h3 class="text-center">Giỏ hàng rỗng. Vui lòng chọn Sản phẩm trước khi Thanh toán!</h3>';
                    } else {
                        $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];
                        $sqlSelectKhachHang = " SELECT * FROM `khachhang` kh WHERE kh.kh_tendangnhap = '$kh_tendangnhap';";
                        $resultSelectKhachHang = mysqli_query($conn, $sqlSelectKhachHang);
                        $khachhangRow;
                        while ($row = mysqli_fetch_array($resultSelectKhachHang, MYSQLI_ASSOC)) {
                            $khachhangRow = array(
                                'kh_id' => $row['kh_id'],
                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                'kh_hoten' => $row['kh_hoten'],
                                'kh_email' => $row['kh_email'],
                                'kh_diachi' => $row['kh_diachi'],
                                'kh_sodienthoai' => $row['kh_sodienthoai'],
                            );
                        }
                        $sqlHTTT = "SELECT * FROM hinhthucthantoan;";
                        $resultHTTT = mysqli_query($conn, $sqlHTTT);
                        $dataHTTT = [];
                        while ($row = mysqli_fetch_array($resultHTTT, MYSQLI_ASSOC)) {
                            $dataHTTT[] = array(
                                'httt_id' => $row['httt_id'],
                                'httt_ten' => $row['httt_ten'],
                            );
                        }
                ?>
                        <form action="" method="post" name="frmThanhToan" id="frmThanhToan">
                            <div class="form-group row">
                                <label for="kh_hoten" class="col-sm-2 col-form-label">Tên người nhận</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kh_hoten" id="kh_hoten" value="<?= $khachhangRow['kh_hoten'] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kh_diachi" class="col-sm-2 col-form-label">Địa chỉ nhận</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kh_diachi" id="kh_diachi" value="<?= $khachhangRow['kh_diachi'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="httt_id" class="col-sm-2 col-form-label">Thanh toán</label>
                                <div class="col-sm-10">
                                    <select name="httt_id" id="httt_id" class="form-control">
                                        <?php foreach ($dataHTTT as $httt) : ?>
                                            <option value="<?= $httt['httt_id'] ?>"><?= $httt['httt_ten'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kh_diachi" class="col-sm-2 col-form-label">Ngày giao</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="ddh_ngaygiao" id="ddh_ngaygiao" min="<?= date('Y-m-d', strtotime(' + 1 days')) ?>" value="<?= date('Y-m-d', strtotime(' + 1 days')) ?>">
                                </div>
                            </div>
                            <?php
                            $giohangdata = $_SESSION['giohangdata'];
                            ?>
                            <table class="table table-striped table-hover table-responsive-sm table-sm" id="tbl">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            STT
                                        </th>
                                        <th class="text-center">
                                            Tên sản phẩm
                                        </th>
                                        <th class="text-center">
                                            Giá
                                        </th>
                                        <th class="text-center">
                                            Số lượng
                                        </th>
                                        <th class="text-center">
                                            Thành tiền
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    $tongtien = 0;
                                    ?>

                                    <?php foreach ($giohangdata as $sanpham) : ?>
                                        <?php $tongtien += $sanpham['thanhtien']; ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <?= $stt++ ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= $sanpham['sp_ten'] ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= number_format($sanpham['sp_gia'], 0, ".", ",") ?> VNĐ
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= $sanpham['soluong'] ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= number_format($sanpham['thanhtien'], 0, ".", ",") ?> VNĐ
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right font-weight-bold">Tổng tiền</td>
                                        <td class="text-right"><?= number_format($tongtien, 0, ".", ",") ?> VNĐ</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="khachhang_kh_id" id="khachhang_kh_id" value="<?= $khachhangRow['kh_id'] ?>">
                            <input type="hidden" name="ddh_tongtien" id="ddh_tongtien" value="<?= $tongtien ?>">
                            <div class="text-center">
                                <button name="mua" class="btn myfont text-danger btn-add">Thanh toán</button>
                            </div>
                        </form>
                <?php
                    }
                }
                if (isset($_POST['mua'])) {
                    $ddh_diachi = empty($_POST['kh_diachi']) ? $khachhangRow['kh_diachi'] : $_POST['kh_diachi'];
                    $ddh_tongtien = $_POST['ddh_tongtien'];
                    $ddh_ngaylap = date('Y-m-d');
                    $ddh_ngaygiao = $_POST['ddh_ngaygiao'];
                    $ddh_trangthai = 0;
                    $hinhthucthantoan_httt_id = $_POST['httt_id'];
                    $khachhang_kh_id = $_POST['khachhang_kh_id'];
                    $sqlInsertDonHang = "INSERT INTO dondathang (ddh_diachi, ddh_tongtien, ddh_ngaylap, ddh_ngaygiao, ddh_trangthai, hinhthucthantoan_httt_id, khachhang_kh_id) VALUES (N'$ddh_diachi', $ddh_tongtien, '$ddh_ngaylap', '$ddh_ngaygiao', $ddh_trangthai, $hinhthucthantoan_httt_id, $khachhang_kh_id);";
                    mysqli_query($conn, $sqlInsertDonHang);
                    $dondathang_ddh_id = $conn->insert_id;
                    foreach ($giohangdata as $item) {
                        $sanpham_sp_id = $item['sp_id'];
                        $sp_ctdh_soluong = $item['soluong'];
                        $sp_ctdh_dongia = $item['thanhtien'];
                        $sqlInsertSanPhamDonDatHang = "INSERT INTO dondathang_has_sanpham (dondathang_ddh_id, sanpham_sp_id, sp_ctdh_dongia, sp_ctdh_soluong) VALUES ($dondathang_ddh_id, $sanpham_sp_id, $sp_ctdh_dongia, $sp_ctdh_soluong);";
                        mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
                    }
                    unset($_SESSION['giohangdata']);
                    echo '<script>location.href = "/shophoa.vn/frontend/thanhtoan/card.php";</script>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>