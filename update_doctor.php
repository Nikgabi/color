<?php 
include('up.php');
if (!isset($_SESSION['id_user'])) {
    die("Σφάλμα: Δεν υπάρχει ενεργός χρήστης.");
}

$user = intval($_SESSION['id_user']); // ασφάλεια: μετατρέπουμε σε ακέραιο

// Προετοιμασία και εκτέλεση του query
$query = "UPDATE user SET consultant = '', sygkat = '' WHERE id_user = $user";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Σφάλμα στην προετοιμασία του query: " . mysqli_error($con));
}


if (!isset($_SESSION['id_user'])) {
    die("Σφάλμα: Δεν υπάρχει ενεργός χρήστης.");
}


// Εκτέλεση
if (!mysqli_stmt_execute($stmt)) {
    die("❌ Σφάλμα στην εκτέλεση του query: " . mysqli_stmt_error($stmt));
}


if (mysqli_stmt_execute($stmt)) {
	echo "Redirecting...<br>";
	var_dump(headers_sent()); // TRUE αν έχουν σταλεί headers = ERROR
	flush(); // αναγκάζει εμφάνιση της γραμμής
	echo "<script>window.location.href='https://ygeiafirst.net/menu/choose_doctor.php';</script>";
    //header("Location: https://ygeiafirst.net/menu/choose_doctor.php");
    exit();
} else {
    echo "Σφάλμα στην εκτέλεση του query: " . mysqli_stmt_error($stmt);
}
?>




