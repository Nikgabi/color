<?php 
session_start();
include ('connection.php');

$user = intval($_SESSION['id_user']);

// Φτιάχνουμε το query με απλό string (χωρίς bind)
$query = "UPDATE user SET consultant = NULL, sygkat = NULL WHERE id_user = $user";


// Debug: εμφάνιση του query (προσωρινά)
echo "<p>Query που θα εκτελεστεί: <code>$query</code></p>";

// Εκτέλεση του query
$result = mysqli_query($con, $query);

if (!$result) {
    // Αν αποτύχει
    die("❌ Σφάλμα στην εκτέλεση του query: " . mysqli_error($con));
} else {
    header("Location: https://ygeiafirst.net/menu/choose_doctor.php");
    exit();
}
?>




