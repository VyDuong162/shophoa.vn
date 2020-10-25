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
    <?php include_once(__DIR__.'/../../layouts/styles.php');?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css"/> 
</head>
<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
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
                    $sql="SELECT mh_id,mh_ten FROM mauhoa";
                    $result=mysqli_query($conn,$sql);
                    $dataMauHoa = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $dataMauHoa[] = array(
                            'mh_id' => $row['mh_id'],
                            'mh_ten' => $row['mh_ten']
                        );
                    }
                ?>
                <div class="container-fluid"> 
                    <div class="row ">
                        <div class="col-md-12 text-right mt-3">
                             <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle"class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm mới màu hoa</h1>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label for="mh_ten">Tên màu hoa</label>
                                <input type="text" class="form-control" id="mh_ten" name="mh_ten" placeholder="Tên màu hoa" value="">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div> 
                <?php
                    if(isset($_POST['btnsave'])&&!empty($_POST['mh_ten'])){
                        $mh_ten =$_POST['mh_ten'];
                        // INSERT
                        $sql = "INSERT INTO `mauhoa` (mh_ten) VALUES ('$mh_ten');";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);  
                        echo '<script>location.href = "index.php";</script>'; 
                    }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
    <script>
        $('#btnsave').click(function() {
            var mh_ten = document.getElementById("mh_ten").value;
            if(mh_ten==null || mh_ten==""){
                alert('Chưa nhập dữ liệu!');
            }
        });
    </script>
</body>
</html>