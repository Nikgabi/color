<?php
include('connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function sendmail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nikosgavalakis@gmail.com';
        $mail->Password   = 'lnvw homr aify hrbk';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('nikosgavalakis@gmail.com', $name);
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from ygeiafirst.net';
        $email_template = "
            <h2>You have registered to ygeiafirst.net</h2>
            <h5>You must click the Link below</h5>
            <br><br>
            <a href='https://ygeiafirst.net/verify.php?token=$verify_token'>click Me</a>
        ";
        $mail->Body = $email_template;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['SubmitBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());
    $role = $_POST['role'];
    $speciality = $role == "visitor" ? NULL : $_POST['speciality'];

    $check_email_query = "SELECT email FROM user WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    // Check if the query ran successfully
    if ($check_email_query_run) {
        if (mysqli_num_rows($check_email_query_run) > 0) {
            $_SESSION['status'] = "Το email που δώσατε ήδη υπάρχει";
            header('Location: register.php');
        } else {
            $query = "INSERT INTO user(name,email,password,verify_token,role,eidikotita) VALUES('$name','$email','$password','$verify_token','$role','$speciality')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                sendmail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Η εγγραφή σας έγινε. Για να ολοκληρωθεί επιβεβαιώστε το email σας ακολουθώντας τον σύνδεσμο που σας στάλθηκε";
                header('Location: login.php');
            } else {
                $_SESSION['status'] = "Η εγγραφή σας απέτυχε. Ξαναδοκιμάστε";
                header('Location: register.php');
            }
        }
    } else {
        $_SESSION['status'] = "Κάτι πήγε στραβά κατά τον έλεγχο του email.";
        header('Location: register.php');
    }
} else {
    echo '<p>Κάτι πήγε στραβά!!</p>';
}
?>
