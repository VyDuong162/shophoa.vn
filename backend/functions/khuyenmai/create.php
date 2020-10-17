<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khuyến mãi</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php');?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css"/> 
    <link rel="stylesheet" href="\shophoa.vn\assets\vendor\DataTables\DataTables\css\dataTables.bootstrap4.min.css">
</head>
<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Thêm khuyến mãi</h1>
                <?php
                    include_once(__DIR__.'/../../../dbconnect.php');
                    $sql="SELECT km_id,km_ten,km_noidung,km_tungay,km_denngay,km_anh FROM khuyenmai";
                    $result=mysqli_query($conn,$sql);
                    $dataKhuyenMai = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $dataKhuyenMai[] = array(
                            'km_id' => $row['km_id'],
                            'km_ten' => $row['km_ten'],
                            'km_noidung' => $row['km_noidung'],
                            'km_tungay' => $row['km_tungay'],
                            'km_denngay' => $row['km_denngay'],
                            'km_anh' => $row['km_anh']
                        );
                    }
                ?>
                 <a href="create.php"><button type="button" class="btn btn-primary">Thêm mới</button></a> <br><br>
                <table id="tblDanhSach" class="table mx-auto table-bordered ">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>Mã khuyến mãi</th>
                            <th>Tên khuyến mãi</th>
                            <th>Nội dung</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Ảnh khuyến mãi</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataKhuyenMai as $km) : ?>
                            <tr>
                                <td><?= $km['km_id']; ?></td>
                                <td><?= $km['km_ten']; ?></td>
                                <td><?= $km['km_noidung']; ?></td>
                                <td><?= $km['km_tungay']; ?></td>
                                <td><?= $km['km_denngay']; ?></td>
                                <td><?= $km['km_anh']; ?></td>
                                <td><a href="edit.php?idupdate=<?php echo $km['km_id']; ?>" class=" btn btn-success"> SỬA</a>
                                    <button class="btn btn-danger btnDelete" data-idxoa=<?php echo $km['km_id']; ?>>XÓA</button>
                                </td>   
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
    <script src="/shophoa.vn/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblDanhSach').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
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
                            var sp_ma = $(this).data('idxoa');
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