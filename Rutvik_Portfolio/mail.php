<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust if you downloaded PHPMailer manually

// Your SMTP credentials
$smtpHost = 'smtp.hostinger.com'; // or smtp.sendgrid.net, smtp.mailjet.com
$smtpUsername = 'contect@rutvikpatel.in';
// $smtpPassword = 'vllrezatjdqqycum';
$smtpPassword = 'Rkpatel#123@';
$toEmail = 'rutvik10.sd@gmail.com'; // your email

// Get form data
$name      = htmlspecialchars($_POST['user_name'] ?? '');
$email     = htmlspecialchars($_POST['user_email'] ?? '');
$age       = htmlspecialchars($_POST['user_age'] ?? '');
$bio       = htmlspecialchars($_POST['user_bio'] ?? '');
$job       = htmlspecialchars($_POST['user_job'] ?? '');
$interests = $_POST['user_interest'] ?? [];

$interests_str = is_array($interests) ? implode(', ', $interests) : $interests;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUsername;
    $mail->Password   = $smtpPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
//     $mail->Port       = 587;
//  $mail->Host = 'smtp.hostinger.com'; // Replace with your SMTP server
//         $mail->SMTPAuth = true;
//         $mail->Username = 'contect@rutvikpatel.in'; // Your email
//         $mail->Password = 'Rkpatel#123@';          // Your email password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;
        // $mail->Port = 587;
    // Recipients
    $mail->setFrom($smtpUsername, 'Website Form');
    $mail->addAddress($toEmail);

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission";
    $mail->Body    = "
        <h2>New Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Age:</strong> $age</p>
        <p><strong>Job:</strong> $job</p>
        <p><strong>Interests:</strong> $interests_str</p>
        <p><strong>About:</strong> $bio</p>
    ";

    $mail->send();
    echo "Message has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
