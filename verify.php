<?php
include('connection.php');
session_start();

    if(isset($_GET['token']))
    {
       $token=$_GET['token'] ;
       $verify_query="SELECT verify_token , verify_status FROM user WHERE verify_token='$token' LIMIT 1";
       $verify_query_run=mysqli_query($con, $verify_query);

       if(mysqli_num_rows($verify_query_run) >0)
        {
            $row=mysqli_fetch_array($verify_query_run);
            if($row['verify_status']=='0')
            {
                $clicked_token=$row['verify_token'];
                $update_query="UPDATE user SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1" ;
                $update_query_run=mysqli_query($con,$update_query);

                if($update_query_run){
                    $_SESSION['status']="Το email επιβεβαιώθηκε. Παρακαλώ κάνετε login";
                    header("Location:menu/login.php");
                    exit(0);
                }
                else{
                    $_SESSION['status']="Το email ΔΕΝ επιβεβαιώθηκε.";
                    header("Location:menu/login.php");
                    exit(0);
                }
            }
            else{
                $_SESSION['status']="Το email επιβεβαιώθηκε. Παρακαλώ κάντε login";
                header("Location:menu/login.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status']="Το token δεν υπάρχει";
            header("Location:menu/login.php");
        }
    }
    else
    {
        $_SESSION['status']="δεν επιβεβαιώθηκε το email";
        header("Location:menu/login.php");

    }

?>