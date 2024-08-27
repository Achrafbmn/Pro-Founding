<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact-us</title>
</head>
<body class="contac-us-php" style="background-color: blue; font-size:xx-large; text-align: center;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin-top: 7cm;color:darkgoldenrod">
        
<?php
require '../vendor/autoload.php'; // Ensure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['first-name']);
    $l_name = htmlspecialchars($_POST['last-name']);
    $email = htmlspecialchars($_POST['email']);
    $company = htmlspecialchars($_POST['company']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = '7a063b001@smtp-brevo.com'; // Your SMTP username
        $mail->Password = '2SWAKw5HU7mQ8YXV'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, "$name $l_name");
        $mail->addAddress('achrafbourraman180@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> $name $l_name</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";
        $mail->AltBody = "
            Name: $name $l_name\n
            Company: $company\n
            Phone: $phone\n
            Email: $email\n
            Message:\n$message
        ";

        $mail->send();
        echo 'Email successfully sent';
    } catch (Exception $e) {
        echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request";
}
?>

</body>
</html>