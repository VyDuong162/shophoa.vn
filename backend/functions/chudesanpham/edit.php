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
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                    include_once(__DIR__.'/../../../dbconnect.php');
                    $id=$_GET['idupdate'];
                    $sql="SELECT cd_id,cd_ten FROM chude WHERE cd_id=$id";
                    $result=mysqli_query($conn,$sql);
                    $dataChuDe = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $dataChuDe= array(
                            'cd_id' => $row['cd_id'],
                            'cd_ten' => $row['cd_ten']
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
                                <h1 id="frmtitle"class="h2 mb-0 text-gray-800 mb-3 shadow">Sửa đổi chủ đề</h1>
                            </div>
                        
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label for="cd_ten">Tên chủ đề</label>
                                <input type="text" class="form-control" id="cd_ten" name="cd_ten" placeholder="Tên chủ đề" value="<?=$dataChuDe['cd_ten']?>">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div> 
                <?php
                    if(isset($_POST['btnsave'])){
                        $cd_ten =$_POST['cd_ten'];
                        // Câu lệnh UPDATE
                        $sql = "UPDATE `chude` SET cd_ten = '$cd_ten' WHERE cd_id='$id' ;";
                        // print_r($sql); die;
                        //var_dump($sql);die;
                        mysqli_query($conn, $sql);
                        //Đóng kết nối
                        mysqli_close($conn);  
                        echo '<script>location.href = "index.php";</script>';    
                    } 
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('lh_mota');
    </script>
</body>
</html>