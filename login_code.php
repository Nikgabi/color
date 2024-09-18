<?php
    session_start();
    include('connection.php');
    //include('authentication.php');

    if (isset($_POST['submitBtn1'])) {   
        if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            $check_user = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
            $check_user_run = mysqli_query($con, $check_user);
                
            if (mysqli_num_rows($check_user_run) > 0) {
                $row = mysqli_fetch_array($check_user_run);
                if ($row['verify_status'] == '1') {
                    /*$_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'nickname' => $row['name'],
                        'email' => $row['email'],
                        'password' => $row['password'],
                        'role' => $row['role'],
                        'eidikotita' => $row['eidikotita']
                    ];*/
                    $_SESSION['status'] = "Κάνατε πετυχημένη είσοδο";
                    $_SESSION['email']=$row['email'];
                    $_SESSION['id_user']=$row['id_user'];
					$_SESSION['role'] = $row['role'];
					$_SESSION['speciality'] = $row['eidikotita']; 
                    header("Location:index.php");
                    exit(0);    
                } else {
                    $_SESSION['status'] = "Πρέπει να επιβεβαιώσετε το mail σας για να κάνετε login";
                    header("Location:login.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Το email ή το password δεν είναι σωστά";
                header("Location:login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Όλα τα πεδία πρέπει να συμπληρωθούν";
            header("Location:login.php");
            exit(0);
        }
    }
?>
