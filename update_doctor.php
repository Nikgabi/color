<?php 
include('up.php');
if (!isset($_SESSION['id_user'])) {
    die("Σφάλμα: Δεν υπάρχει ενεργός χρήστης.");
}

$user = intval($_SESSION['id_user']); // ασφάλεια: μετατρέπουμε σε ακέραιο

// Προετοιμασία και εκτέλεση του query
$query = "UPDATE user SET consultant = '', sygkat = '' WHERE id_user = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Σφάλμα στην προετοιμασία του query: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $user);

if (mysqli_stmt_execute($stmt)) {
    header("Location: https://ygeiafirst.net/menu/choose_doctor.php");
    exit();
} else {
    echo "Σφάλμα στην εκτέλεση του query: " . mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>




