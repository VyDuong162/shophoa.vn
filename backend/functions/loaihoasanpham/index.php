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
    <!-- Phần loading trang web -->
    <div id="load">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                    include_once(__DIR__.'/../../../dbconnect.php');
                    $sql="SELECT lh_id,lh_ten,lh_mota FROM loaihoa";
                    $result=mysqli_query($conn,$sql);
                    $dataLoaiHoa = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $dataLoaiHoa[] = array(
                            'lh_id' => $row['lh_id'],
                            'lh_ten' => $row['lh_ten'],
                            'lh_mota' => $row['lh_mota']
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
                            <h1 class="h2 text-gray-800 text-center m-0 font-weight-bold text-primary">Danh sách loại hoa</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tblDanhSach" class="table mx-auto table-bordered ">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>Mã loại hoa</th>
                                        <th>tên loại hoa</th>
                                        <th>Mô tả loại hoa</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataLoaiHoa as $lh) : ?>
                                        <tr>
                                            <td><?= $lh['lh_id']; ?></td>
                                            <td><?= $lh['lh_ten']; ?></td>
                                            <td><?= $lh['lh_mota'];?></td>
                                            <td class="text-center">
                                                <a href="edit.php?idupdate=<?php echo $lh['lh_id']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="sửa">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btnDelete" data-idxoa=<?php echo $lh['lh_id']; ?> data-toggle="tooltip" data-placement="top" title="xóa">
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
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
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
</body>
</html>