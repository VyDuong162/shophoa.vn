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
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sql = <<<EOT
SELECT ddh.ddh_id,kh.kh_hoten,ddh.ddh_diachi,ddh.ddh_tongtien,ddh.ddh_ngaylap,ddh.ddh_ngaygiao,ddh.ddh_trangthai,httt.httt_ten,kh.kh_sodienthoai 
FROM `dondathang` ddh
JOIN `hinhthucthanhtoan` httt ON ddh.hinhthucthantoan_httt_id=httt.httt_id
JOIN `khachhang` kh ON ddh.khachhang_kh_id=kh.kh_id
GROUP BY ddh.ddh_id, ddh.ddh_ngaylap, ddh.ddh_ngaygiao, ddh.ddh_diachi, ddh.ddh_trangthai, httt.httt_ten, kh.kh_hoten, kh.kh_sodienthoai
EOT;
                $result = mysqli_query($conn, $sql);
                $dataDonDatHang = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataDonDatHang[] = array(
                        'ddh_id' => $row['ddh_id'],
                        'kh_hoten' => $row['kh_hoten'],
                        'kh_dienthoai' => $row['kh_sodienthoai'],
                        'ddh_diachi' => $row['ddh_diachi'],
                        'httt_ten' => $row['httt_ten'],
                        'ddh_tongtien' => number_format($row['ddh_tongtien'], 0, ".", ","),
                        'ddh_ngaylap' => date('d/m/Y', strtotime($row['ddh_ngaylap'])),
                        'ddh_ngaygiao' => empty($row['ddh_ngaygiao']) ? '' : date('d/m/Y', strtotime($row['ddh_ngaygiao'])),
                        'ddh_trangthai' => $row['ddh_trangthai']
                    );
                }
                ?>

                <div class="row ">
                    <div class="col-md-12 mt-3">
                        <a href="create.php"><button type="button" class="btn btn-primary">Thêm mới</button></a> <br><br>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách đơn đặt hàng</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="tblDanhSach" class="table mx-auto table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>Mã Đơn đặt hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Ngày lập</th>
                                        <th>Ngày giao</th>
                                        <th>Nơi giao</th>
                                        <th>Hình thức thanh toán</th>
                                        <th>Tổng thành tiền</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th width="100px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataDonDatHang as $ddh) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $ddh['ddh_id'] ?></td>
                                            <td class="text-center align-middle"><b><?= $ddh['kh_hoten'] ?></b><br />(<?= $ddh['kh_dienthoai'] ?>)</td>
                                            <td class="text-center align-middle"><?= $ddh['ddh_ngaylap'] ?></td>
                                            <td class="text-center align-middle"><?= $ddh['ddh_ngaygiao'] ?></td>
                                            <td class="align-middle"><?= $ddh['ddh_diachi'] ?></td>
                                            <td class="align-middle"><span class="badge badge-primary"><?= $ddh['httt_ten'] ?></span></td>
                                            <td class="text-right align-middle"><?= $ddh['ddh_tongtien'] ?></td>
                                            <td class="align-middle">
                                                <?php if ($ddh['ddh_trangthai'] == 0) : ?>
                                                    <span class="badge badge-danger">Chưa xử lý</span>
                                                <?php else : ?>
                                                    <span class="badge badge-success">Đã giao hàng</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                                <?php if ($ddh['ddh_trangthai'] == 0) : ?>
                                                    <!-- Nút sửa -->
                                                    <a href="edit.php?idupdate=<?php echo $ddh['ddh_id']; ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="sửa">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    <!-- Nút xóa -->
                                                    <a href="#" class="btn btn-danger btnDelete" data-idxoa=<?php echo $ddh['ddh_id']; ?> data-toggle="tooltip" data-placement="top" title="xóa">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                <?php else : ?>
                                                    <!-- Nút in -->
                                                    <a href="print.php?ddh_id=<?= $ddh['ddh_id'] ?>" class="btn btn-success">
                                                        In
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function() {
            $('#tblDanhSach').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    },
                    buttons: {
                        "copy": "Sao chép",
                        "excel": "Xuất ra file Excel",
                        "pdf": "Xuất ra file PDF",
                    }
                },
                "lengthMenu": [
                    [10, 15, 20, 25, 50, 100, -1],
                    [10, 15, 20, 25, 50, 100, "Tất cả"]
                ]
            });
        });
        $('.btnDelete').click(function() {
            swal({
                    title: "Bạn có chắn chắn xóa không?",
                    text: "Không thể phục hồi dữ liệu khi xóa!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var ddh_id = $(this).data('idxoa');
                        var url = 'delete.php?idxoa=' + ddh_id;
                        location.href = url;
                    } else {
                        swal("Hủy xóa thành công!");
                    }
                });
        });
    </script>
</body>

</html>