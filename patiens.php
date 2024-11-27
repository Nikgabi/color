<?php include('up.php'); ?>
<div id = container class="layout_padding-bottom"><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 ">
          <div class="img-box">
            <img src="images/treatment-side-img.jpg" alt="">
          </div>
        </div>
		<div class="col-md-9 ">
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
                    <a href='somatometrika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Σωματομετρικά</button>
                    </a>
                    <a href='istorika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Ιστορικό</button>
                    </a>
                    <a href='vioxhmika.php?patient_id=$patient_id'>
                        <button>Βιοχημικά</button>
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
