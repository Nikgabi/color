<?php
include('up.php');
?>

<div id = container class="layout_padding-bottom"><br>

<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">

<?php
// Εξασφαλίζουμε ότι έχουμε το patient_id από το URL
if (!isset($_GET['patient_id']) || empty($_GET['patient_id'])) {
    echo "<p style='color:red;'>Το ID του ασθενούς δεν παρέχεται.</p>";
    include('down.php');
    exit();
}

$patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);

// Ερώτημα για την ανάκτηση δεδομένων του χρήστη από το `medical_history`
$query = "SELECT * FROM medical_history WHERE id_istor = '$patient_id' ORDER BY id DESC"; // Ταξινόμηση κατά νεότερες καταχωρήσεις
$result = mysqli_query($con, $query);

// Έλεγχος αν υπάρχουν δεδομένα
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Ιστορικό Υγείας</h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Παθήσεις</th>
                    <th>Φάρμακα</th>
                    <th>Χειρουργικές Επεμβάσεις</th>
                    <th>Γυναικολογικό Ιστορικό</th>
                    <th>Υπέρταση</th>
                    <th>Διαβήτης</th>
                    <th>Στεφανιαία</th>
                    <th>Ψυχική Νόσος</th>
                    <th>ΧΑΠ</th>
                    <th>Νεφρική Ανεπάρκεια</th>
                    <th>Κάπνισμα</th>
                    <th>Αλκοόλ</th>
                    <th>Ναρκωτικά</th>
                </tr>
            </thead>
            <tbody>";
    
    // Εμφάνιση κάθε γραμμής δεδομένων
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['pathiseis']}</td>
                <td>{$row['farmaka']}</td>
                <td>{$row['xeirourg']}</td>
                <td>{$row['gynaikolo']}</td>
                <td>" . ($row['ypertasi'] ? 'Ναι' : 'Όχι') . "</td>
                <td>" . ($row['diaviti'] ? 'Ναι' : 'Όχι') . "</td>
                <td>" . ($row['stefani'] ? 'Ναι' : 'Όχι') . "</td>
                <td>" . ($row['pcixiki'] ? 'Ναι' : 'Όχι') . "</td>
                <td>" . ($row['anapneu'] ? 'Ναι' : 'Όχι') . "</td>
                <td>" . ($row['nefriki'] ? 'Ναι' : 'Όχι') . "</td>
                <td>{$row['smoking']}</td>
                <td>{$row['drink']}</td>
                <td>{$row['kataxr']}</td>
              </tr>";
    }
    echo "</tbody></table>";
    echo "</div>";
} else {
    echo "<p style='color:red;'>Δεν βρέθηκαν ιστορικά δεδομένα για τον χρήστη.</p>";
}
?>

</div>
</div>
	

<?php
include('down.php');
?>
