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
    <title>Loại hoa sản phẩm</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/DataTables/css/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/fancybox/jquery.fancybox.min.css">
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
                $sql = " SELECT * FROM `khachhang` ";
                $result = mysqli_query($conn, $sql);
                $dataKhachHang = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataKhachHang[] = array(
                        'kh_id' => $row['kh_id'],
                        'kh_hoten' => $row['kh_hoten'],
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_matkhau' => $row['kh_matkhau'],
                        'kh_gioitinh' => ($row['kh_gioitinh']==1)?'Nam':'Nữ',
                        'kh_ngaysinh' => date('d/m/Y',strtotime($row['kh_ngaysinh'])),
                        'kh_sodienthoai' => $row['kh_sodienthoai'],
                        'kh_email' => $row['kh_email'],
                        'kh_diachi' => $row['kh_diachi'],
                        'kh_avt_tenfile' => $row['kh_avt_tenfile'],
                        'kh_quantri' => $row['kh_quantri'],
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
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách khách hàng</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th class="align-middle text-center">Mã khách hàng</th>
                                        <th class="align-middle text-center">Tên khách hàng</th>
                                        <th class="align-middle text-center">Tên đăng nhập</th>
                                        <th class="align-middle text-center">Mật khẩu</th>
                                        <th class="align-middle text-center">Giới tính</th>
                                        <th class="align-middle text-center">Ngày sinh</th>
                                        <th class="align-middle text-center">Số điện thoại</th>
                                        <th class="align-middle text-center">Email</th>
                                        <th class="align-middle text-center">Địa chỉ</th>
                                        <th class="align-middle text-center">Ảnh đại diện</th>
                                        <th class="align-middle text-center">Quyền</th>
                                        <th class="align-middle text-center">Thực thi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataKhachHang as $khachhang) : ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $khachhang['kh_id'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_hoten'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_tendangnhap'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_matkhau'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_gioitinh'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_ngaysinh'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_sodienthoai'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_email'] ?></td>
                                            <td class="align-middle text-center"><?= $khachhang['kh_diachi'] ?></td>
                                            <td class="align-middle text-center">
                                                <?php if (!file_exists("../../../assets/uploads/avatar/".$khachhang['kh_avt_tenfile']) || empty($khachhang['kh_avt_tenfile'])) : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img/avatar-default.jpg">
                                                        <img src="/shophoa.vn/assets/shared/img/avatar-default.jpg" class="img-fluid" width="100px">
                                                    </a>
                                                <?php else : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/avatar/<?= $khachhang['kh_avt_tenfile'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/avatar/<?= $khachhang['kh_avt_tenfile'] ?>" class="img-fluid" width="100px" />
                                                    </a>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php if($khachhang['kh_quantri']): ?>
                                                    <span class="badge badge-primary">admin</span>
                                                <?php else:?>
                                                    <span class="badge badge-secondary">user</span>
                                                <?php endif;?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="edit.php?kh_id=<?= $khachhang['kh_id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btnDelete" data-idxoa=<?php echo $khachhang['kh_id']; ?> data-toggle="tooltip" data-placement="top" title="xóa">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                        </tr>
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
    <script src="/shophoa.vn/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script>
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
                            var kh_id = $(this).data('idxoa');
                            var url = 'delete.php?idxoa=' + kh_id;
                            location.href = url;
                        } else {
                            swal("Hủy xóa thành công!");
                        }
                    });
            });
        });
    </script>
</body>

</html>