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
    <title>Thêm khuyến mãi</title>
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
                $sql = "SELECT km_id,km_ten,km_noidung,km_tungay,km_denngay,km_anh FROM khuyenmai";
                $result = mysqli_query($conn, $sql);
                $dataKhuyenMai = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataKhuyenMai[] = array(
                        'km_id' => $row['km_id'],
                        'km_ten' => $row['km_ten'],
                        'km_noidung' => $row['km_noidung'],
                        'km_tungay' => date('d/m/Y', strtotime($row['km_tungay'])),
                        'km_denngay' => date('d/m/Y', strtotime($row['km_denngay'])),
                        'km_anh' => $row['km_anh']
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
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách khuyến mãi</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>Mã khuyến mãi</th>
                                        <th>Tên khuyến mãi</th>
                                        <th width="30%">Nội dung</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th width="20%">Ảnh khuyến mãi</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataKhuyenMai as $km) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $km['km_id'] ?></td>
                                            <td class="text-center align-middle"><?= $km['km_ten'] ?></td>
                                            <td class="align-middle"><?= $km['km_noidung']; ?></td>
                                            <td class="text-center align-middle"><?= $km['km_tungay'] ?></td>
                                            <td class="text-center align-middle"><?= $km['km_denngay'] ?></td>
                                            <td class="text-center align-middle">
                                                <?php if (empty($km['km_anh']) || !file_exists('../../../assets/uploads/img-km/' . $km['km_anh'])) : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/img-km/default-image.jpg" data-caption="<?= $km['km_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/img-km/default-image.jpg" class="img-fluid" />
                                                    </a>
                                                <?php else : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/img-km/<?= $km['km_anh'] ?>" data-caption="<?= $km['km_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/img-km/<?= $km['km_anh'] ?>" class="img-fluid" />
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="edit.php?idupdate=<?php echo $km['km_id']; ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="sửa">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btnDelete" data-idxoa=<?php echo $km['km_id']; ?> data-toggle="tooltip" data-placement="top" title="xóa">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
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
                            var km_id = $(this).data('idxoa');
                            var url = 'delete.php?idxoa=' + km_id;
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