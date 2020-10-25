<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
$mh_id = $_GET['mh_id'];
$sqlMauHoa = "SELECT mh_ten FROM mauhoa WHERE mh_id = {$mh_id}";
$resultMauHoa = mysqli_query($conn, $sqlMauHoa);
while ($rowMAuHoa = mysqli_fetch_array($resultMauHoa, MYSQLI_ASSOC)) {
    $mauHoa = $rowMAuHoa['mh_ten'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | San phẩm màu hoa <?= $mauHoa ?></title>
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
                $sqlSanPham = "SELECT * FROM sanpham AS a JOIN sanpham_has_mauhoa AS b ON a.sp_id = b.sanpham_sp_id WHERE b.mauhoa_mh_id = {$mh_id};";
                $resultSanPham = mysqli_query($conn, $sqlSanPham);
                $dataSanPham = [];
                while ($row = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $dataSanPham[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => number_format($row['sp_gia'], 0, ".", ","),
                        'sp_giacu' => ($row['sp_giacu'] > 0) ? number_format($row['sp_giacu'], 0, ".", ",") : '',
                        'sp_yeuthich' => $row['sp_yeuthich'],
                        'sp_mota_ngan' => $row['sp_mota_ngan'],
                        'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                        'sp_ngaycapnhat' => date('d/m/Y', strtotime($row['sp_ngaycapnhat'])),
                        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
                    );
                }
                ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách sản phẩm thuộc màu hoa <?= $mauHoa ?></h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Giá cũ</th>
                                        <th>Yêu thích</th>
                                        <th width="20%">Mô tả ngắn</th>
                                        <th width="20%">Mô tả chi tiết</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Ảnh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($dataSanPham as $sp) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $i++; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_ten']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_gia']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_giacu']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_yeuthich']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_mota_ngan']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_mota_chitiet']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_ngaycapnhat']; ?></td>
                                            <td class="text-center align-middle">
                                                <?php if (!file_exists("../../../assets/uploads/img-product/" . $sp['sp_avt_tenfile']) || empty($sp['sp_avt_tenfile'])) : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img/default.png" data-caption="[Ảnh mặc định] <?= $sp['sp_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/shared/img/default.png" class="img-fluid" width="100px">
                                                    </a>
                                                <?php else : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" data-caption="[<?= $sp['hasp_id'] ?>] <?= $sp['sp_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" class="img-fluid" width="100px" />
                                                    </a>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/shophoa.vn/backend/functions/sanpham/edit.php?sp_id=<?= $sp['sp_id'] ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip" data-placement="top" title="Xóa" data-sanpham_sp_id="<?= $sp['sp_id'] ?>" data-mauhoa_mh_id="<?= $mh_id ?>">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
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
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
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
                        var sanpham_sp_id = $(this).data('sanpham_sp_id');
                        var mauhoa_mh_id = $(this).data('mauhoa_mh_id');
                        var url = 'delete2.php?mauhoa_mh_id=' + mauhoa_mh_id + '&sanpham_sp_id=' + sanpham_sp_id;
                        location.href = url;
                    } else {
                        swal("Hủy xóa thành công!");
                    }
                });
        });
    </script>
</body>

</html>