

<?php 
	session_start();
	include ('connection.php');
	if (!isset($_SESSION['id_user'])) {
    die("Σφάλμα: Δεν υπάρχει ενεργός χρήστης.");
	}

	$user = $_SESSION['id_user'];

	// Εκτέλεση του query με έλεγχο σφαλμάτων
	$query = "UPDATE user SET consultant='',sygkat='' WHERE id_user= ?";
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, "i", $user);

	if (mysqli_stmt_execute($stmt)) {
		header("Location: choose_doctor.php");
		exit();
	} else {
		echo "Σφάλμα στην εκτέλεση του query.";
	}


?>



