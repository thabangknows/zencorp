<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library

$mail = new PHPMailer(true);


if(isset($_POST['send_mail_func'])){

echo('hello');

$name = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

    try {
    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output for troubleshooting
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com'; // Specify SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'in_devapps@outlook.com';
    $mail->Password = 'inhousedevelopment@makwa-it!';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; // Port to use

    //Recipients
    $mail->setFrom('in_devapps@outlook.com', 'Web User');
    $mail->addAddress('thabangknows@outlook.com', 'ZenCorp');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'New message from web';

    // Load and set the HTML template
    $mail->AddEmbeddedImage('bg.png', 'logo', 'logo.png'); // Attach your image with a CID

    $template = file_get_contents('email_template.html');
    
    $template = str_replace('{{name}}', $name, $template);
    $template = str_replace('{{email}}', $email, $template);
    $template = str_replace('{{phone}}', $phone, $template);
    $template = str_replace('{{message}}', $message, $template);

    $mail->Body = $template;
     // Attach images
  

        $mail->send();
//    echo 'Email sent successfully.';
        header('location: ../contact.php?msg=Email Sent Successfully!');
        exit();
        } catch (Exception $e) {
    echo 'Email delivery failed. Error: ' . $mail->ErrorInfo;
        header('location: ../contact.php?msg=Sorry, something went wrong,' . 4);
        exit();
    }


}




?>