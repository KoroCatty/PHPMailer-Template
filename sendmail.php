<!-- https://github.com/PHPMailer/PHPMailer?tab=readme-ov-file -->
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// contact.php で send ボタンが押されたら、このファイルに POST される
if (isset($_POST['submitContact'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'myaddress@gmail.com';                     //SMTP username
    $mail->Password   = 'secret';                             //SMTP password


    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('myaddress@gmail.com', 'K-DEV');
    $mail->addAddress('myaddress@gmail.com');     //Add a recipient

    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<h2>Hello, got got a new mail</h2>
    <p>Full Name: ' . $fullname . '</p>
    <p>Email: ' . $email . '</p>
    <p>Subject: ' . $subject . '</p>
    <p>Message: ' . $message . '</p>
    ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
      $_SESSION['status'] = "Thanks for contacting us. We will get back to you shortly."; // セッションメッセージを設定
      header('Location: ' . $_SERVER['HTTP_REFERER']); // ユーザーを元のページにリダイレクト
      exit(); // リダイレクト後にスクリプトが実行されないように終了
      
    } else {
      $_SESSION['status'] = "Message could not be sent.送信不可。 😅Mailer Error: {$mail->ErrorInfo}"; // Set a session message
      header('Location: index.php');
    }
  } catch (Exception $e) {
    echo "Message could not be sent😅 Mailer Error: {$mail->ErrorInfo}";
  }
} else {
  header('Location: index.php');
  exit(0);
}
