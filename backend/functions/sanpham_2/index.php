
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
    <?php include_once(__DIR__.'/../../layouts/styles.php');?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css"/> 
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/DataTables/css/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css" type="text/css">
</head>
<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php
                $sql = <<<EOT
                     SELECT sp.*
                     ,lh_ten
                     ,cd.cd_ten
                     ,mh.mh_ten
                     ,km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
                     FROM `sanpham` sp
                     JOIN `sanpham_has_loaihoa` sphl on sp.sp_id = sphl.sanpham_sp_id
                     JOIN `loaihoa` lh on sphl.loaihoa_lh_id = lh.lh_id
                     JOIN `sanpham_has_mauhoa` spmh on sp.sp_id = spmh.sanpham_sp_id
                     JOIN `mauhoa` mh on spmh.mauhoa_mh_id = mh.mh_id
                     JOIN `sanpham_has_chude` sphcd ON sp.sp_id = sphcd.sanpham_sp_id
                     JOIN `chude` cd ON cd.cd_id = sphcd.chude_cd_id
                     LEFT JOIN `khuyenmai` km ON sp.km=km.km_id
                     ORDER BY sp.sp_id DESC
EOT;
                $data = [];
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    $km_ten = $row['km_ten'];
                    if (!empty($km_ten)) {
                        $km_tomtat = sprintf(
                            "Khuyến mãi: %s, Nội dung: %s, Từ ngày %s đến %s",
                            $row['km_ten'],
                            $row['km_noidung'],
                            date('d/m/y', strtotime($row['km_tungay'])),
                            date('d/m/y', strtotime($row['km_tungay']))
                        );
                    }
                    $data[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'lh_ten' => $row['lh_ten'],
                        'mh_ten' => $row['mh_ten'],
                        'cd_ten' => $row['cd_ten'],
                        'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                        'km_tomtat' => $km_tomtat,
                        'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
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
                            <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách sản phẩm</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered ">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                    <th class="align-middle text-center">Mã hoa</th>
                                    <th class="align-middle text-center">Tên hoa</th>
                                    <th class="align-middle text-center">Loại hoa</th>
                                    <th class="align-middle text-center">Chủ đề</th>
                                    <th class="align-middle text-center">Màu hoa</th>
                                    <th class="align-middle text-center">Giá hoa</th>
                                    <th class="align-middle text-center">Khuyến mãi</th>
                                    <th class="align-middle text-center">Ngày cập nhật</th>
                                    <th class="align-middle text-center">Thực thi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $sanpham) : ?>
                                    <tr>
                                        <td class="align-middle text-center"><?= $sanpham['sp_id'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['sp_ten'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['lh_ten'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['cd_ten'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['mh_ten'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['sp_gia'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['km_tomtat'] ?></td>
                                        <td class="align-middle text-center"><?= $sanpham['sp_ngaycapnhat'] ?></td>
                                        <td class="align-middle text-center">
                                            <a href="edit.php?sp_id=<?= $sanpham['sp_id'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Sửa">
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
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
    <script src="/shophoa.vn/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>
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
        $(document).ready(function(e){
            <?php foreach ($dataLoaiHoa as $lhid) : ?>
                if (<?= $lhid['lh_id']?>%2!=0) {
                    $('table tr:odd').addClass('odd');
                }
            <?php endforeach;?>
        });
    </script>
</body>
</html>