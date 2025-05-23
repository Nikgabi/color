<?php
include('connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token){
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
		$mail->Host = 'smtp-relay.gmail.com'; 
		$mail->Port = 587; 
		$mail->SMTPSecure = 'tls'; 
		$mail->SMTPAuth = false; // ΧΩΡΙΣ authentication!

        // Recipients
        $mail->setFrom('nikos.gavalakis@ygeiafirst.net', $get_name);
        $mail->addAddress($get_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password reset from ygeiafirst.net';
        $email_template = "
            <h2>Your password reset Link from ygeiafirst.net</h2>
            <h5>You receive this email to reset your password from ygeiafirst.net</h5>
            <br><br>
            <a href='https://ygeiafirst.net/menu/change_password.php?token=$token&email=$get_email'>click Me</a>
        ";
        $mail->Body = $email_template;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST['submitBtn3']))
{
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $token=md5(rand());

    $check_email="SELECT * FROM user WHERE email='$email' LIMIT 1";
    $check_email_run=mysqli_query($con,$check_email);

    if($check_email_run && mysqli_num_rows($check_email_run) >0)
    {
        $row=mysqli_fetch_array($check_email_run);
        
        $get_email=$row['email'];
        $get_name=$row['name'];

        $update_token="UPDATE user SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run=mysqli_query($con,$update_token);

        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status']="Στάλθηκε ένα mail με ένα password reset Link ";
            header("Location:menu/password_reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status']="Κάτι πήγε λάθος. #1 ";
            header("Location:menu/password_reset.php");
            exit(0);
        }

    }
    else
    {
        $_SESSION['status']="Το email που δηλώσατε δεν βρέθηκε ";
        header("Location:menu/password_reset.php");
        exit(0);
    }
}

if(isset($_POST['submitBtn4'])){
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['new_password']);
    $confirm_password=mysqli_real_escape_string($con,$_POST['confirm_password']);
    $token=mysqli_real_escape_string($con,$_POST['password_token']);


    if(!empty($token))
    {
        if(!empty($email) && !empty($password) && !empty($confirm_password))
        {
            $check_token="SELECT verify_token FROM user WHERE verify_token='$token' LIMIT 1";
            $check_token_run=mysqli_query($con,$check_token);

            if($check_token_run && mysqli_num_rows($check_token_run)> 0)
                {
                    if($password == $confirm_password)
                    {
                        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

						$update_password = "UPDATE user SET password='$hashed_password' WHERE verify_token='$token' LIMIT 1";
						$update_password_run = mysqli_query($con, $update_password);

                        if($update_password_run)
                        {
                            $new_token=md5(rand());
                            $update_token="UPDATE user SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1 ";
                            $update_token_run=mysqli_query($con,$update_token);

                            $_SESSION['status']="To Νέο Password άλλαξε επιτυχώς. Κάνετε login";
                            header("Location:menu/login.php");
                            exit(0); 
                        }
                        else
                        {
                            $_SESSION['status']="Αποτυχία αλλαγής password";
                            header("Location:menu/change_password.php?token=$token&email=$email");
                            exit(0); 
                        }
                    }
                    else{
                    $_SESSION['status']="Το νέο Password πρέπει να είναι ίδιο με την επιβεβαίωση";
                    header("Location:menu/change_password.php?token=$token&email=$email");
                    exit(0);
                }
            }
            else{
                $_SESSION['status']="Invaled token ";
                header("Location:menu/change_password.php?token=$token&email=$email");
                exit(0);
            }
        }
        else{
            $_SESSION['status']="Πρέπει να συμπληρωθούν όλα τα πεδία ";
            header("Location:menu/change_password.php?token=$token&email=$email");
            exit(0);
        }
    }
    else{
        $_SESSION['status']="Το token δεν βρέθηκε ";
        header("Location:menu/change_password.php");
        exit(0);
    }
}


?>