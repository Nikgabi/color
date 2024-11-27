
<?php
if (isset($_POST['SubmitBtn'])) {
    $name =test_input( $_POST['name']);
    $email =test_input( $_POST['email']);
	$pass=$_POST['password'];
    $password =password_hash( $pass , PASSWORD_BCRYPT);
    $verify_token = md5(rand());
    $role =test_input( $_POST['role']);
	$speciality = $role == "visitor" ? NULL : $_POST['speciality'];}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} ?>


<?php
if (isset($_POST['submitBtn1'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password'];  // Δεν χρειάζεται escaping εδώ γιατί θα γίνει verify
        
        // Αναζήτηση χρήστη με το email
        $check_user = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $check_user_run = mysqli_query($con, $check_user);

        if (mysqli_num_rows($check_user_run) > 0) {
            $row = mysqli_fetch_array($check_user_run);

            // Έλεγχος αν το hash του κωδικού ταιριάζει με το κωδικό στη βάση
            if (password_verify($password, $row['password'])) {
                if ($row['verify_status'] == '1') {
                    $_SESSION['status'] = "Κάνατε πετυχημένη είσοδο";
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id_user'] = $row['id_user'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['speciality'] = $row['eidikotita'];
                    header("Location:index.php");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Ο λογαριασμός σας δεν είναι επαληθευμένος";
                    header("Location:login.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Λανθασμένος κωδικός πρόσβασης";
                header("Location:login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Το email δεν βρέθηκε";
            header("Location:login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Συμπληρώστε όλα τα πεδία";
        header("Location:login.php");
        exit(0);
    }
} ?php>
