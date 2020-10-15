<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include_once(__DIR__ . '/style.php');
    ?>
    <link rel="stylesheet" href="/templatedoan/template-index/stylelinh.css">

</head>
<body>
      <!--      Phần header     -->
      <?php
            include_once(__DIR__ . '/../layout/navbar.php');
        ?>
    <!-- Drop Phần header     -->
<section id="contact">
  <div class="container">
    <div class="well well-sm">
      <h3><strong>Liên hệ với chúng tôi</strong></h3>
    </div>
	
	<div class="row">
	  <div class="col-md-7">
        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3736489.7218514383!2d90.21589792292741!3d23.857125486636733!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1506502314230" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
          
      <div class="col-md-5">
          <h4><strong>Gửi thắc mắc</strong></h4>
        <form>
          <div class="form-group">
            <input type="text" class="form-control" name="" value="" placeholder="Tên khách hàng">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="" value="" placeholder="E-mail">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" name="" value="" placeholder="Số điện thoại">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="" rows="3" placeholder="Nội dung"></textarea>
          </div>
          <button class="btn btn-default" type="submit" name="button">
              <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
<!--      Phần footer     -->
<?php
    include_once(__DIR__ . '/../layout/footer.php');
    ?>
    <!-- Drop Phần footer     -->
    <!-- Liên kết js -->
    <?php
    include_once(__DIR__ . '/script.php');
    ?>
    <!-- Liên kết js -->
</body>
</html>
  