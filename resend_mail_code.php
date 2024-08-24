<?php
    include('connection.php');
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    function resend_email_verify($name,$email,$verify_token){
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
        $mail->Subject = 'Resend Email Verification from ygeiafirst.net';
        $email_template = "
            <h2>Resent mail verification from ygeiafirst.net</h2>
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

    if(isset($_POST['submitBtn2'])){
        if(!empty(trim($_POST['email']))){
            $email=mysqli_real_escape_string($con,$_POST['email']);
            $check_email_query="SELECT * FROM user WHERE email='$email' LIMIT 1";
            $check_email_query_run=mysqli_query($con, $check_email_query);
            
                if($check_email_query_run && mysqli_num_rows($check_email_query_run) > 0){
                    $row=mysqli_fetch_array($check_email_query_run);
                    if($row['verify_status']=='0'){
                    $name=$row['name'];
                    $email=$row['email'];
                    $verify_token=$row['verify_token'];

                    resend_email_verify($name,$email,$verify_token);
                    $_SESSION['status']="Tο verification email Link σας έχει σταλεί στο email σας";
                    header("Location:login.php");
                    exit(0);

                    }
                    else{
                        $_SESSION['status']="Tο email σας είναι ήδη επιβεβαιωμένο. Παρακαλώ κάνετε είσοδο";
                        header("Location:login.php");
                        exit(0);
                    }
                }
                
            
            else{
                $_SESSION['status']="Δεν έχετε κάνει εγγραφή με αυτό το mail. Παρακαλώ κάνετε εγγραφή τώρα";
                header("Location:register.php");
                exit(0);
            }
            
         }
    else{
            $_SESSION['status']="Παρακαλώ συμπληρώστε το email σας";
            header("Location:resend_mail.php");
            exit(0);
        }
        }
    
    



?>
