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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>print</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <!-- Paper CSS -->
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/paper-css/paper.css" type="text/css" />
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link href="/shophoa.vn/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
    <!-- Định khổ giấy: A5, A4 or A3 -->
    <style>
        @page {
            size: A4
        }
    </style>

</head>

<body class="text-center A4">
         <!-- Phần loading trang web -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                // 2. Query
                //here doc
                $ddh_id = $_GET['ddh_id'];
                 $sqlSelectDonDatHang = <<<EOT
                 Select ddh.ddh_id,kh.kh_hoten,ddh.ddh_diachi,ddh.ddh_tongtien,ddh.ddh_ngaylap,ddh.ddh_ngaygiao,ddh.ddh_trangthai,httt.httt_ten,kh.kh_sodienthoai 
                 FROM `dondathang` ddh
                 JOIN `dondathang_has_sanpham` ddhsp ON ddh.ddh_id = ddhsp.dondathang_ddh_id
                 JOIN `khachhang` kh ON ddh.khachhang_kh_id=kh.kh_id
                 JOIN `hinhthucthanhtoan` httt ON ddh.hinhthucthantoan_httt_id=httt.httt_id
                 WHERE ddh.ddh_id= $ddh_id
                 GROUP BY ddh.ddh_id, ddh.ddh_ngaylap, ddh.ddh_ngaygiao, ddh.ddh_diachi, ddh.ddh_trangthai, httt.httt_ten, kh.kh_hoten, kh.kh_sodienthoai
EOT;

                    //3. Yêu cầu PHP thực thi query
                    //4. tạo mảng chứa dữ liệu
                $resultSelectDonDatHang = mysqli_query($conn, $sqlSelectDonDatHang);
                $dataDonDatHang;
                while ($row = mysqli_fetch_array($resultSelectDonDatHang, MYSQLI_ASSOC)) {
                $dataDonDatHang = array(
                'ddh_id' => $row['ddh_id'],
                'ddh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['ddh_ngaylap'])),
                'ddh_ngaygiao' => empty($row['ddh_ngaygiao']) ? '' : date('d/m/Y H:i:s', strtotime($row['ddh_ngaygiao'])),
                'ddh_diachi' => $row['ddh_diachi'],
                'ddh_trangthai' => $row['ddh_trangthai'],
                'httt_ten' => $row['httt_ten'],
                'kh_hoten' => $row['kh_hoten'],
                'kh_sodienthoai' => $row['kh_sodienthoai'],
                'ddh_tongtien' =>number_format($row['ddh_tongtien'], 3, ".", ",") . ' vnđ'
            );
        }
                $sqlSelectSanPham = <<<EOT
                SELECT 
                sp.sp_id, sp.sp_ten, ddhsp.sp_ctdh_dongia, ddhsp.sp_ctdh_soluong
            FROM `dondathang_has_sanpham` ddhsp
            JOIN `sanpham` sp ON ddhsp.sanpham_sp_id=sp.sp_id
            WHERE ddhsp.dondathang_ddh_id= $ddh_id
EOT;
        // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
                $resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);
                $dataSanPham = [];
                while ($row = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
                    $dataSanPham[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_ctdh_dongia' => $row['sp_ctdh_dongia'],
                        'sp_ctdh_soluong' => $row['sp_ctdh_soluong']
                    );
                }
                $dataDonDatHang['danhsachsanpham'] = $dataSanPham;
                ?>
                <section class="sheet padding-10mm">
                    <!-- Thông tin Cửa hàng -->
                    <table border="0" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="center"><img src="/shophoa.vn/assets/shared/img/logo.jpg" width="100px" height="100px" /></td>
                                <td align="center">
                                    <b style="font-size: 2em;">Shop hoa - Đồng hành cùng bạn</b><br />
                                    <small>Cung cấp các loại hoa tươi và các sản phẩm hoa</small><br />
                                    <small>Mang đến bạn những sản phẩm hoa tươi yêu thương và thân thiết</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Thông tin đơn hàng -->
                    <p><i><u>Thông tin Đơn hàng</u></i></p>
                    <table border="0" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="30%">Khách hàng:</td>
                                <td><b><?= $dataDonDatHang['kh_hoten'] ?>
                                        (<?= $dataDonDatHang['kh_sodienthoai'] ?>)</b></td>
                            </tr>
                            <tr>
                                <td>Ngày lập:</td>
                                <td><b><?= $dataDonDatHang['ddh_ngaylap'] ?></b></td>
                            </tr>
                            <tr>
                                <td>Hình thức thanh toán:</td>
                                <td><b><?= $dataDonDatHang['httt_ten'] ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Thông tin sản phẩm -->
                    <p><i><u>Chi tiết đơn hàng</u></i></p>
                    <table border="1" width="100%" cellspacing="0" cellpadding="5">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1; ?>
                            <?php foreach($dataDonDatHang['danhsachsanpham'] as $sanpham): ?>
                            <tr>
                                <td align="center"><?= $stt; ?></td>
                                <td align="center"><?= $sanpham['sp_ten'] ?></td>
                                <td align="right"><?= $sanpham['sp_ctdh_soluong']?></td>
                                <td align="right"><?= number_format($sanpham['sp_ctdh_dongia'], 3, ".", ",") . ' vnđ' ?></td>
                                <td align="right"><?= number_format($sanpham['sp_ctdh_soluong'] * $sanpham['sp_ctdh_dongia'] , 3, ".", ",") . ' vnđ' ?></td>
                            </tr>
                            <?php $stt++; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right"><b>Tổng thành tiền</b></td>
                                <td align="right"><b><?= $dataDonDatHang['ddh_tongtien'] ?></b></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Thông tin Footer -->
                    <br />
                    <table border="0" width="100%">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <small>Xin cám ơn Quý khách đã ủng hộ Cửa hàng, Chúc Quý khách An Khang, Thịnh Vượng!</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
        <!-- End block content -->

</body>

</html>
