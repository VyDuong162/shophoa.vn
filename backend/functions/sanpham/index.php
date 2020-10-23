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
    <style>
        ul{
            list-style-type: none;
        }
    </style>
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
                $sqlSanPham = "SELECT * FROM sanpham AS a LEFT JOIN khuyenmai AS b ON a.km = b.km_id;";
                $resultSanPham = mysqli_query($conn, $sqlSanPham);
                $dataSanPham = [];
                while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    if (!empty($rowSanPham['km_ten'])) {
                        $km_tomtat = sprintf("%s (%s-%s)", $rowSanPham['km_ten'], date('d/m/Y', strtotime($rowSanPham['km_tungay'])), date('d/m/Y', strtotime($rowSanPham['km_denngay'])));
                    }
                    $sqlLoaiHoa = "SELECT a.lh_ten FROM loaihoa AS a, sanpham_has_loaihoa AS b WHERE a.lh_id = b.loaihoa_lh_id AND b.sanpham_sp_id = {$rowSanPham['sp_id']};";
                    $resultLoaiHoa = mysqli_query($conn, $sqlLoaiHoa);
                    $loaiHoa = '<ul> ';
                    while($rowLoaiHoa = mysqli_fetch_array($resultLoaiHoa, MYSQLI_ASSOC)){
                        $loaiHoa .= '<li>'.$rowLoaiHoa['lh_ten'].'</li>';
                    }
                    $loaiHoa .= '</ul>';
                    $sqlMauHoa = "SELECT a.mh_ten FROM mauhoa AS a, sanpham_has_mauhoa AS b WHERE a.mh_id = b.mauhoa_mh_id AND b.sanpham_sp_id = {$rowSanPham['sp_id']};";
                    $resultMauHoa = mysqli_query($conn, $sqlMauHoa);
                    $mauHoa = '<ul> ';
                    while($rowMauHoa = mysqli_fetch_array($resultMauHoa, MYSQLI_ASSOC)){
                        $mauHoa .= '<li>'.$rowMauHoa['mh_ten'].'</li>';
                    }
                    $mauHoa .= '</ul>';
                    $sqlChuDe = "SELECT a.cd_ten FROM chude AS a, sanpham_has_chude AS b WHERE a.cd_id = b.chude_cd_id AND b.sanpham_sp_id = {$rowSanPham['sp_id']};";
                    $resultChuDe = mysqli_query($conn, $sqlChuDe);
                    $ChuDe = '<ul> ';
                    while($rowChuDe = mysqli_fetch_array($resultChuDe, MYSQLI_ASSOC)){
                        $ChuDe .= '<li>'.$rowChuDe['cd_ten'].'</li>';
                    }
                    $ChuDe .= '</ul>';
                    $dataSanPham[] = array(
                        'sp_id' => $rowSanPham['sp_id'],
                        'sp_ten' => $rowSanPham['sp_ten'],
                        'sp_gia' => number_format($rowSanPham['sp_gia'], 0, ".", ","),
                        'sp_giacu' => ($rowSanPham['sp_giacu'] > 0) ? number_format($rowSanPham['sp_giacu'], 0, ".", ",") : '',
                        'sp_yeuthich' => $rowSanPham['sp_yeuthich'],
                        'sp_mota_ngan' => $rowSanPham['sp_mota_ngan'],
                        'sp_mota_chitiet' => $rowSanPham['sp_mota_chitiet'],
                        'sp_ngaycapnhat' => date('d/m/Y', strtotime($rowSanPham['sp_ngaycapnhat'])),
                        'sp_avt_tenfile' => $rowSanPham['sp_avt_tenfile'],
                        'km_tomtat' => $km_tomtat,
                        'loaiHoa' => $loaiHoa,
                        'mauHoa' => $mauHoa,
                        'chuDe' => $ChuDe,
                    );
                }
                ?>
                <div class="row">
                    <div class="col-md-12 text-right mt-3">
                        <a href="create.php"><button type="button" class="btn btn-primary">Thêm mới</button></a> <br><br>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách sản phẩm</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered ">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Giá cũ</th>
                                        <th>Yêu thích</th>
                                        <th>Loại hoa</th>
                                        <th>Màu hoa</th>
                                        <th>Chủ đề hoa</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Khuyến mãi</th>
                                        <th>Ảnh</th>
                                        <th>Thực thi</th>
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
                                            <td class="text-center align-middle"><?= $sp['loaiHoa']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['mauHoa']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['chuDe']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['sp_ngaycapnhat']; ?></td>
                                            <td class="text-center align-middle"><?= $sp['km_tomtat']; ?></td>
                                            <td class="text-center align-middle">
                                                <?php if (!file_exists("../../../assets/uploads/img-product/" . $sp['sp_avt_tenfile']) || empty($sp['sp_avt_tenfile'])) : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img/default.png" data-caption="[Ảnh mặc định] <?= $sp['sp_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/shared/img/default.png" class="img-fluid" width="100px">
                                                    </a>
                                                <?php else : ?>
                                                    <a data-fancybox="gallery" href="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" data-caption="<?= $sp['sp_ten'] ?>">
                                                        <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" class="img-fluid" width="100px" />
                                                    </a>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="edit.php?sp_id=<?= $sanpham['sp_id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <button class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Xóa" data-sp_id="<?= $sanpham['sp_id'] ?>">
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
                }
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
                            var lh_id = $(this).data('idxoa');
                            var url = 'delete.php?idxoa=' + lh_id;
                            location.href = url;
                        } else {
                            swal("Hủy xóa thành công!");
                        }
                    });
            });
        });
    </script>
    <script>
        $(document).ready(function(e) {
            <?php foreach ($dataLoaiHoa as $lhid) : ?>
                if (<?= $lhid['lh_id'] ?> % 2 != 0) {
                    $('table tr:odd').addClass('odd');
                }
            <?php endforeach; ?>
        });
    </script>
</body>

</html>