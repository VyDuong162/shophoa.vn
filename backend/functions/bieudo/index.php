<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop hoa | Biểu đồ</title>
  <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
  <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css"/>
</head>
<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="row" style="padding-right: inherit;padding-left: inherit;">
                    <div class="col-6">
                        <h1 class="h3 text-gray-800 mt-3 mb-3" >Biểu đồ thống kê cửa hàng</h1>
                    </div>
                    <div class="col-6 mt-3 mb-3" style="text-align:end; position:relative; ">
                    <a href="#" class=" btn btn-sm btn-primary shadow-sm" ><i class="fa fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                </div>
                <!-- Block content -->
                <div class="container-fluid">
                        <div class="row ml-1 mr-1">
                             <!-- Biểu đồ thống kê loại hoa sản phẩm -->
                             <!-- Bar Chart -->
                            <div class="col-sm-6 col-lg-6 mt-3"  >
                                <div class="card shadow mb-4"  >
                                    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-bar">
                                            <canvas id="chartOfobjChartThongKeLoaiHoaSanPham" ></canvas>
                                        </div>
                                        <hr>
                                        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiHoaSanPham">Refresh dữ liệu</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Biểu đồ thống kê chủ đề sản phẩm -->
                             <!-- Bar Chart -->
                            <div class="col-sm-6 col-lg-6 mt-3" >
                                <div class="card shadow mb-4" >
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-pie">
                                            <canvas id="chartOfobjChartThongKeChuDeSanPham" ></canvas>
                                        </div>
                                        <hr>
                                        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeChuDeSanPham">Refresh dữ liệu</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Biểu đồ thống kê màu hoa sản phẩm -->
                             <!-- Bar Chart -->
                             <div class="col-sm-6 col-lg-6 mt-3" >
                                <div class="card shadow mb-4" >
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-pie">
                                            <canvas id="chartOfobjChartThongKeMauHoaSanPham" ></canvas>
                                        </div>
                                        <hr>
                                        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeMauHoaSanPham">Refresh dữ liệu</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Biểu đồ thống kê sản phẩm yêu thích -->
                            <!-- Pie Chart -->
                            <div class="col-sm-6 col-lg-6 mt-3"  >
                                <div class="card shadow mb-4"  >
                                    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="chartOfobjChartThongKeSanPhamYeuThich" ></canvas>
                                        </div>
                                        <hr>
                                        <div class="mt-2 text-center small">
                                            <span class="mr-2">
                                            <i class="fa fa-circle text-primary"></i> Bó Hoa Hồng Ecuador Only You
                                            </span>
                                            <span class="mr-2">
                                            <i class="fa fa-circle text-success"></i> Hộp Hoa Blooms Of Love
                                            </span>
                                            <span class="mr-2 text-center">
                                            <i class="fa fa-circle text-info"></i> Bó Hoa Cúc Tana Pure Joy
                                            </span>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeSanPhamYeuThich">Refresh dữ liệu</button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                <!-- End block content -->
          </main>  
      </div>
  </div>
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
  <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
  <script src="/shophoa.vn/assets/vendor/Chart.js/Chart.min.js"></script>
    <script>
         $(document).ready(function(){
             // ------------------ Vẽ biểu đồ thống kê Loại hoa sản phẩm -----------------
            var $objChartThongKeLoaiHoaSanPham;
            var $chartOfobjChartThongKeLoaiHoaSanPham = document.getElementById("chartOfobjChartThongKeLoaiHoaSanPham").getContext(
              '2d');
            function renderChartThongKeLoaiHoaSanPham() {
                $.ajax({
                url: '/shophoa.vn/backend/api/baocao-thongkesanpham-loaihoa.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                    myLabels.push((this.TenLoaiHoa));
                    myData.push(this.SoLuong);
                    });
                    myData.push(0);
                    if (typeof $objChartThongKeLoaiHoaSanPham !== "undefined") {
                        $objChartThongKeLoaiHoaSanPham.destroy();
                    }
                    $objChartThongKeLoaiHoaSanPham = new Chart($chartOfobjChartThongKeLoaiHoaSanPham, {
                    type: "bar",
                    data: {
                        labels: myLabels,
                        datasets: [{
                        data: myData,
                        borderColor: "#9ad0f5",
                        backgroundColor: "#9ad0f5",
                        borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                        display: false
                        },
                        title: {
                        display: true,
                        text: "Thống kê loại hoa sản phẩm"
                        },
                        responsive: true
                    }
                    });
                }
                });
            };
            $('#refreshThongKeLoaiHoaSanPham').click(function(event) {
                event.preventDefault();
                renderChartThongKeLoaiHoaSanPham();
            });
            // ------------------ Vẽ biểu đồ thống kê Chủ đề sản phẩm -----------------
            var $objChartThongKeChuDeSanPham;
            var $chartOfobjChartThongKeChuDeSanPham = document.getElementById("chartOfobjChartThongKeChuDeSanPham").getContext(
              '2d');
            function renderChartThongKeChuDeSanPham() {
                $.ajax({
                url: '/shophoa.vn/backend/api/baocao-thongkesanpham-chude.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                    myLabels.push((this.TenChuDe));
                    myData.push(this.SoLuong);
                    });
                    myData.push(0);
                    if (typeof $objChartThongKeChuDeSanPham !== "undefined") {
                        $objChartThongKeChuDeSanPham.destroy();
                    }
                    $objChartThongKeChuDeSanPham = new Chart($chartOfobjChartThongKeChuDeSanPham, {
                    type: "bar",
                    data: {
                        labels: myLabels,
                        datasets: [{
                        data: myData,
                        borderColor: "#007bff",
                        backgroundColor: "#007bff",
                        borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                        display: false
                        },
                        title: {
                        display: true,
                        text: "Thống kê chủ đề sản phẩm"
                        },
                        responsive: true
                    }
                    });
                }
                });
            };
            $('#refreshThongKeChuDeSanPham').click(function(event) {
                event.preventDefault();
                renderChartThongKeChuDeSanPham();
            });
             // ------------------ Vẽ biểu đồ thống kê sản phẩm yêu thích -----------------
             var $objChartThongKeSanPhamYeuThich;
            var $chartOfobjChartThongKeSanPhamYeuThich = document.getElementById("chartOfobjChartThongKeSanPhamYeuThich").getContext(
              '2d');
            function renderChartThongKeSanPhamYeuThich() {
                $.ajax({
                url: '/shophoa.vn/backend/api/baocao-thongkesanpham-yeuthich.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                    myLabels.push((this.TenSanPham));
                    myData.push(this.SoLuong);
                    });
                    myData.push(0);
                    if (typeof $objChartThongKeSanPhamYeuThich !== "undefined") {
                        $objChartThongKeSanPhamYeuThich.destroy();
                    }
                    $objChartThongKeSanPhamYeuThich = new Chart($chartOfobjChartThongKeSanPhamYeuThich, {
                    type: "pie",
                    data: {
                        labels: myLabels,
                        datasets: [{
                        data: myData,
                        borderColor: "#9ad0f5",
                        backgroundColor: ['#007bff', '#1cc88a', '#36b9cc'],
                        borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                        display: false
                        },
                        title: {
                        display: true,
                        text: "Thống kê sản phẩm yêu thích nhất"
                        },
                        responsive: true
                    }
                    });
                }
                });
            };
            $('#refreshThongKeSanPhamYeuThich').click(function(event) {
                event.preventDefault();
                renderChartThongKeSanPhamYeuThich();
            }); 
            // ------------------ Vẽ biểu đồ thống kê màu hoa sản phẩm -----------------
            var $objChartThongKeMauHoaSanPham;
            var $chartOfobjChartThongKeMauHoaSanPham = document.getElementById("chartOfobjChartThongKeMauHoaSanPham").getContext(
              '2d');
            function renderChartThongKeMauHoaSanPham() {
                $.ajax({
                url: '/shophoa.vn/backend/api/baocao-thongkesanpham-mauhoa.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                    myLabels.push((this.TenMauHoa));
                    myData.push(this.SoLuong);
                    });
                    myData.push(0);
                    if (typeof $objChartThongKeMauHoaSanPham !== "undefined") {
                        $objChartThongKeMauHoaSanPham.destroy();
                    }
                    $objChartThongKeMauHoaSanPham = new Chart($chartOfobjChartThongKeMauHoaSanPham, {
                    type: "bar",
                    data: {
                        labels: myLabels,
                        datasets: [{
                        data: myData,
                        borderColor:  ['#dc3545', '#fd7e14','#ffc107','#28a745','#007bff','#e83e8c','#6f42c1','#343a40','#fff'],
                        backgroundColor: ['#dc3545', '#fd7e14','#ffc107','#28a745','#007bff','#e83e8c','#6f42c1','#343a40','#fff'],
                        borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                        display: false
                        },
                        title: {
                        display: true,
                        text: "Thống kê màu hoa sản phẩm"
                        },
                        responsive: true
                    }
                    });
                }
                });
            };
            $('#refreshThongKeMauHoaSanPham').click(function(event) {
                event.preventDefault();
                renderChartThongKeMauHoaSanPham();
            });
            renderChartThongKeMauHoaSanPham();
            renderChartThongKeLoaiHoaSanPham();
            renderChartThongKeSanPhamYeuThich();
            renderChartThongKeChuDeSanPham();
        });  
    </script>
</body>
</html>