<?php
include('connection.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php'; */

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/*
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
            <h2>You have registered at ygeiafirst.net</h2>
            <h5>Confirm your email to log in by clicking on the link below</h5>
            <br><br>
            <a href='https://ygeiafirst.net/verify.php?token=$verify_token'>click Me</a>
        ";
        $mail->Body = $email_template;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} */

if (isset($_POST['SubmitBtn'])) {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $pass = $_POST['password'];
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $verify_token = md5(rand());
    $role = test_input($_POST['role']);
    $speciality = $role == "visitor" ? "NULL" : "'$speciality'";

    $check_email_query = "SELECT email FROM user WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if ($check_email_query_run) {
        if (mysqli_num_rows($check_email_query_run) > 0) {
            $_SESSION['status'] = "Το email που δώσατε ήδη υπάρχει";
            header('Location: register.php');
        } else {
            $query = "INSERT INTO user(name,email,password,verify_token,role,eidikotita) VALUES('$name','$email','$password','$verify_token','$role','$speciality')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
              //  $_SESSION['id_user'] = mysqli_insert_id($con);
               // sendmail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Η εγγραφή σας έγινε. Για να ολοκληρωθεί επιβεβαιώστε το email σας ακολουθώντας τον σύνδεσμο που θα σας σταλθεί μέσα στις επόμενες 48 ώρες";
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
