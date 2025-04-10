<?php 
include('up.php');
if (!isset($_SESSION['id_user'])) {
    die("❌ Σφάλμα: Δεν υπάρχει ενεργός χρήστης.");
}

$user = intval($_SESSION['id_user']);

// Φτιάχνουμε το query με απλό string (χωρίς bind)
$query = "UPDATE user SET consultant = '', sygkat = '' WHERE id_user = $user";

// Debug: εμφάνιση του query (προσωρινά)
echo "<p>Query που θα εκτελεστεί: <code>$query</code></p>";

// Εκτέλεση του query
$result = mysqli_query($con, $query);

if (!$result) {
    // Αν αποτύχει
    die("❌ Σφάλμα στην εκτέλεση του query: " . mysqli_error($con));
} else {
    echo "✅ Το query εκτελέστηκε επιτυχώς.";
    // Κάνε redirect (αν θέλεις) — προσωρινά το αφήνω σχολιασμένο
    header("Location: https://ygeiafirst.net/menu/choose_doctor.php");
    exit();
}

?>




