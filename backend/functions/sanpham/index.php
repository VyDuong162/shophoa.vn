<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHoa</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php
        include_once(__DIR__ . '/../../layouts/styles.php');
    ?>
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body >
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>

    <!-- end header -->

    <div class="container-fluid">
        <div class="row">

            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div class="text-justify pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="text-justify">Danh sách sản phẩm</h1>
                </div>

                <!-- Block content -->


                <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
                <a href="create.php" class="btn btn-primary ">
                    Thêm mới sản phẩm
                </a>
                <table id="tbl" class="table table-striped table-hover  table-responsive-sm ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã hoa</th>
                            <th>Tên hoa</th>
                            <th>Loại hoa</th>
                            <th>Giá hoa</th>
                            <th>Nhà sản xuất</th>
                            <th>Khuyến mãi</th>
                            <th>Ngày cập nhật</th>
                            <th>Thực thi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã 001</td>
                            <td>Hoa hồng trắng </td>
                            <td>Hoa hồng</td>
                            <td>50.000</td>
                            <td>Vườn hoa Đà Lạt</td>
                            <td>1</td>
                            <td>29-10-2020</td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                </a>
                                <a href="#" class="btn btn-warning btnDelete" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End block content -->
            </main>
        </div>
    </div>
    <!--     Phần content         -->

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- DataTable JS -->
    <script src="/shophoa.vn/assets/vendor/jquery/jquery.js"></script>
    <script src="/shophoa.vn/assets/vendor/popper/popper.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/shophoa.vn/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="/shophoa.vn/assets/vendor/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            // Yêu cầu DataTable quản lý datatable #tblDanhSach
            $('#tblDanhSach').DataTable({
                dom: 'Bft',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });

            // Cảnh báo khi xóa
            // 1. Đăng ký sự kiện click cho các phần tử (element) đang áp dụng class .btnDelete
            $('.btnDelete').click(function() {
                // Click hanlder
                // 2. Sử dụng thư viện SweetAlert để hiện cảnh báo khi bấm nút xóa
                swal({
                        title: "Bạn có chắc chắn muốn xóa?",
                        text: "Một khi đã xóa, không thể phục hồi....",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { // Nếu đồng ý xóa

                            // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'dh_ma'
                            // var dh_ma = $(this).attr('data-dh_ma');
                            var dh_ma = $(this).data('dh_ma');
                            var url = "delete.php?dh_ma=" + dh_ma;

                            // Điều hướng qua trang xóa với REQUEST GET, có tham số dh_ma=...
                            location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Cẩn thận hơn nhé!");
                        }
                    });

            });
            var table = $('#tbl').DataTable({
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
                // Click hanlder
                // 2. Sử dụng thư viện SweetAlert để hiện cảnh báo khi bấm nút xóa
                swal({
                        title: "Bạn có chắc chắn muốn xóa?",
                        text: "Một khi đã xóa, không thể phục hồi....",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { // Nếu đồng ý xóa
                            // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'dh_ma'
                            // var dh_ma = $(this).attr('data-dh_ma');
                            var dh_ma = $(this).data('dh_ma');
                            var url = "delete.php?dh_ma=" + dh_ma;
                            // Điều hướng qua trang xóa với REQUEST GET, có tham số dh_ma=...
                           // location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Cẩn thận hơn nhé!");
                        }
                    });
            });
        });
    </script>

</body>

</html>