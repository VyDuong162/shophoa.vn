<?php
if (session_id() === '') {
  session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Hoa | Liên hệ</title>
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>

</head>

<body>
  <div id="load">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!--      Phần header     -->
  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
  <!-- Drop Phần header     -->
  <div class="container my-3">
    <h3 class="myfont text-danger">Liên hệ với chúng tôi</h3>
    <div class="row">
      <div class="col-md-7 order-last order-sm-first">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3926.481517685543!2d105.5311542152584!3d10.222693471963998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1603456603045!5m2!1svi!2s" width="100%" height="330" frameborder="0" style="border:0;" aria-hidden="false" tabindex="0"></iframe>
      </div>

      <div class="col-md-5">
        <h4 class="myfont text-danger">Gửi thắc mắc</h4>
        <form method="post"> 
          <div class="form-group">
            <input type="text" class="form-control" name="title" id="title" placeholder="Tiêu đề">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" name="dienthoai" id="dienthoai" placeholder="Số điện thoại">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Nội dung"></textarea>
          </div>
          <div class="text-center">
            <button class="btn btn-add myfont text-danger" name="btnGoiLoiNhan">
              <h3><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi</h3>
            </button>
          </div>
          
        </form>
        <?php
            require_once __DIR__.'/../../vendor/autoload.php';
            // Sử dụng thư viện PHP Mailer
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            if (isset($_POST['btnGoiLoiNhan'])) {
              $email = $_POST['email'];
              $title = $_POST['title'];
              $messagekh = $_POST['message'];
              $mail = new PHPMailer(true);                               
              try {                             
                  $mail->isSMTP();                                               
                  $mail->Host = 'smtp.gmail.com';                        
                  $mail->SMTPAuth = true;                                 
                  $mail->Username = 'dttvyd19388@cusc.ctu.edu.vn';
                  $mail->Password = 'wciefbmqslcyhabw';                   
                  $mail->SMTPSecure = 'tls';                              
                  $mail->Port = 587;                                      
                  $mail->CharSet = "UTF-8";
                  $mail->SMTPOptions = array(
                      'ssl' => array(
                          'verify_peer' => false,
                          'verify_peer_name' => false,
                          'allow_self_signed' => true
                      )
                  );
                  $mail->setFrom('noreply@shophoa.com', 'Mail-ShopHoa');
                  $mail->addAddress('dttvyd19388@cusc.ctu.edu.vn');               
                  $mail->addReplyTo('noreply@shophoa.com');
                  $mail->isHTML(true);                                   
                  $mail->Subject = "[Có người liên hệ] - $title";         
                  $body = <<<EOT
                  <table border ="1" width="100%" class="responsive" cellpadding="5" cellspacing="0">
                      <tr> 
                          <th rowspan="2"  width="15%">
                               <img src="https://theme.hstatic.net/1000340764/1000483108/14/logo.png?v=18" width="100px" />
                          </th>
                          <th>Nội dung liên hệ</th>
                      </tr>
                      <tr>
                         
                          <td>
                              <i>Có người liên hệ cần giúp đỡ.</i> <br />
                              <b>Email của khách</b>: $email <br />
                              <b>Nội dung</b>: <br/>$messagekh
                          </td>
                      </tr>
                  </table>
    
EOT;
                  $mail->Body    = $body;
                  if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                  } else {
                    echo "Message sent!";
                  }
              } catch (Exception $e) {
                  echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
              }
             
            }
        ?>
      </div>
    </div>
  </div>
  <!-- Phần footer -->
  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  <!-- Drop Phần footer -->
  <!-- Liên kết js -->
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
  <!-- Liên kết js -->
</body>

</html>