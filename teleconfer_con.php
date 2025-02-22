<?php
include('up.php');
?>

<div id = container style="text-align:center;" class="layout_padding-bottom"><br>

<!--<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">-->

<?php
// Εξασφαλίζουμε ότι έχουμε το patient_id από το URL
if (!isset($_GET['consultant']) || empty($_GET['consultant'])) {
    echo "<p style='color:red;'>Το ID του γιατρού δεν παρέχεται.</p>";
    include('down.php');
    exit();
}

$consultant = mysqli_real_escape_string($con, $_GET['consultant']);

$query = "SELECT t.date, t.time,t.id_user ,t.consultant, u.name AS visitor_name 
          FROM teleconference t 
          INNER JOIN user u ON t.id_user = u.id_user 
          WHERE t.consultant = '$consultant'
		  AND t.date > NOW()
		  ORDER BY t.date ASC";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Προσεχείς Τηλεδιασκέψεις σου στο Doxy.me </h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Ασθενής - επισκέπτης</th>
                    <th>Ημέρα</th>
                    <th>Ώρα</th>
                <tr>
            </thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['visitor_name']}</td>
                <td>{$row['date']}</td>
                <td>{$row['time']}</td>
              </tr>";
    }
    echo "</tbody></table><br>";

	
    echo "</div>";
} else {
    echo "<p style='color:red;'>Δεν βρέθηκαν τηλεδιασκέψεις για τον χρήστη.</p>";
	
}


?>

</div>
</div>
	

<?php
include('down.php');
?>
