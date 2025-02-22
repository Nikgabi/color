<?php
include('up.php');
?>

<div id = container style="text-align:center;" class="layout_padding-bottom"><br>

<!--<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">-->

<?php
// Εξασφαλίζουμε ότι έχουμε το patient_id από το URL
if (!isset($_GET['patient_id']) || empty($_GET['patient_id'])) {
    echo "<p style='color:red;'>Το ID του ασθενούς δεν παρέχεται.</p>";
    include('down.php');
    exit();
}

$patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);

$query = "SELECT t.date, t.time, u.name AS doctor_name 
          FROM teleconference t 
          INNER JOIN user u ON t.consultant = u.id_user 
          WHERE t.id_user = '$patient_id'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Τηλεδιασκέψεις</h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Ιατρός</th>
                    <th>Ημέρα</th>
                    <th>Ώρα</th>
                <tr>
            </thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['doctor_name']}</td>
                <td>{$row['date']}</td>
                <td>{$row['time']}</td>
              </tr>";
    }
    echo "</tbody></table><br>";

	if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor'){
		echo '<button style="background-color: rgb(162,235,182) ;"><a href="patiens.php">
					  Πίσω
					</a></button><br><br>';
	} else {
	echo '<button style="background-color: rgb(162,235,182) ;"><a href="my_data.php">
					  Πίσω
	</a></button><br><br>';}
    echo "</div>";
} else {
    echo "<p style='color:red;'>Δεν βρέθηκαν ιστορικά δεδομένα για τον χρήστη.</p>";
	if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor'){
		echo '<button style="background-color: rgb(162,235,182) ;"><a href="patiens.php">
					  Πίσω
					</a></button><br><br>';
	} else {
	echo '<button style="background-color: rgb(162,235,182) ;"><a href="my_data.php">
					  Πίσω
	</a></button><br><br>';}
}


?>

</div>
</div>
	

<?php
include('down.php');
?>
