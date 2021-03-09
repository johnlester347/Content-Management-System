<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
  <!-- Post Registration-->
  <?php
use phpmailer\phpmailer\phpmailer;

require 'admin/phpmailer/Exception.php';
require 'admin/phpmailer/PHPMailer.php';
require 'admin/phpmailer/SMTP.php';

require 'admin/phpmailer/vendor/autoload.php';


$mail = new PHPMailer(true);

$output = '';

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];


    try{
    $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = 'tekuy1433@gmail.com';
    $mail->Password = 'qfoiqodhnlrmaagi';// Gmail address Password
    
    $mail->setFrom('tekuy1433@gmail.com', 'Email'); // Gmail address which you used as SMTP server
    $mail->addAddress('tekuy1433@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
    // $mail->AddCustomHeader('X-Confirm-Reading-To: $email');

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body = "<h3>Name : $name <br>Email: $email <br>Message : $message</h3>";

    $mail->send();
      $output = '<div class="alert alert-success">
                  <h5>Thankyou! for contacting us, We\'ll get back to you soon!</h5>
                </div>';
    } catch (Exception $e) {
      $output = '<div class="alert alert-danger">
                  <h5>' . $e->getMessage() . '</h5>
                </div>';
    }
}
?>
      




    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                 <?php echo $output; ?>
                 <h1>Contact</h1>
                    <form  action="contact.php" method="POST" id="login-form" >
                       
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                        </div>

                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>

                         <div class="form-group">
                         <label for="message">Your Message</label>
                           <textarea class="form-control" name="message" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
