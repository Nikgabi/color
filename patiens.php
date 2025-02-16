<?php include('up.php'); ?>
<div id = container class="layout_padding-bottom"><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/treatment-side-img.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">

<?php
// Εκτέλεση του query για την ανάκτηση των στοιχείων των ασθενών
$query = "SELECT name, email, id_user FROM user WHERE consultant = {$_SESSION['id_user']}";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr>
            <th>Όνομα</th>
            <th>Email</th>
            <th>Ενέργειες</th>
          </tr>";

    // Δημιουργία γραμμών για κάθε ασθενή
    while ($row = mysqli_fetch_assoc($result)) {
        $patient_id = $row['id_user'];
        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');

        echo "<tr>
                <td>$name</td>
                <td>$email</td>
                <td>
                    <a href='istorika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Ιστορικό</button>
                    </a>
                    <a href='somatometrika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Σωματομετρικά</button>
                    </a>
                    
                    <a href='bioximika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px';>Βιοχημικά</button>
                    </a>
					<a href='aimatologika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Αιματολογικά</button>
                    </a>
					<a href='ormon_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Μικροβιολογικές κ.α. εξετ.</button>
                    </a>
					<a href='aktinologika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Απεικονιστικά</button>
                    </a>
					<a href='loipes_exet_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Λοιπές εξετάσεις</button>
                    </a>
					<a href='gnomat_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Γνωματεύσεις</button>
                    </a>
					<a href='stress.php?patient_id=$patient_id'>
                        <button>Stress</button>
                    </a>
					<a href='depress.php?patient_id=$patient_id'>
                        <button>Κατάθλιψη</button>
                    </a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>Δεν βρέθηκαν ασθενείς που έχουν εκχωρηθεί σε εσάς.</p>";
}
?>

</div>
			</div>
	</div> 
</section>
</div>

<?php include('down.php'); ?>
