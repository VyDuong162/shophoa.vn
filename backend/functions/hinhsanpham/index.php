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
    <title>Loại hoa sản phẩm</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/DataTables/css/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/fancybox/jquery.fancybox.min.css">
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
                $sql = <<<EOT
                SELECT *
                 FROM `hinhsanpham` hsp
                 JOIN `sanpham` sp ON sp.sp_id=hsp.sanpham_sp_id
EOT;
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $sp_tomtat = sprintf(
                        "Sản phẩm %s, giá: %s",
                        $row['sp_ten'],
                        number_format($row['sp_gia'], 0, ".", ",") . ' vnđ'
                    );
                    $data[] = array(
                        'hasp_id' => $row['hasp_id'],
                        'hsp_tenfile' => $row['hsp_tenfile'],
                        'sp_tomtat' => $sp_tomtat,
                    );
                }
                ?>
                <div class="row ">
                    <div class="col-md-12 text-right mt-3">
                        <a href="create.php"><button type="button" class="btn btn-primary">Thêm mới</button></a> <br><br>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh hình ảnh sản phẩm</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>Mã hình sản phẩm </th>
                                        <th>Hình sản phẩm</th>
                                        <th>sản phẩm</th>
                                        <th>Thực thi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $sanpham) : ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $sanpham['hasp_id'] ?></td>
                                            <td class="align-middle text-center">
                                                <?php if (!file_exists("../../../assets/uploads/img-product/".$sanpham['hsp_tenfile']) || empty($sanpham['hsp_tenfile'])) : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img/default.png" data-caption="[Ảnh mặc định] <?= $sanpham['sp_tomtat'] ?>">
                                                        <img src="/shophoa.vn/assets/shared/img/default.png" class="img-fluid" width="100px">
                                                    </a>
                                                <?php else : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/img-product/<?= $sanpham['hsp_tenfile'] ?>" data-caption="[<?= $sanpham['hasp_id'] ?>] <?= $sanpham['sp_tomtat'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/img-product/<?= $sanpham['hsp_tenfile'] ?>" class="img-fluid" width="100px" />
                                                    </a>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle text-center"><?= $sanpham['sp_tomtat'] ?></td>
                                            <td class="align-middle text-center">
                                                <a href="edit.php?hasp_id=<?= $sanpham['hasp_id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <button class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Xóa" data-hasp_id="<?= $sanpham['hasp_id'] ?>">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                        </tr>

                                    <?php endforeach ?>
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
                        title: "Bạn có chắc chắn muốn xóa?",
                        text: "Một khi đã xóa, không thể phục hồi....",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var hasp_id = $(this).data('hasp_id');
                            var url = "delete.php?hasp_id=" + hasp_id;
                            location.href = url;
                        } else {
                            swal("Cẩn thận hơn nhé!");
                        }
                    });

            });
        });
    </script>

</body>

</html>