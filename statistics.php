<?php include('up.php');?>

<head>
	<title>Στατιστικά</title>
</head>


  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 "><br>
          <div class="img-box">
            <img src="images/diagrama1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/diagrama2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/diagrama3.jpeg" alt="">
          </div><br>
		  
		  
        </div>
		<div class="col-md-10 ">

	<div class='flex justify-content-center' style='background-color: rgb(240,240,240); padding: 20px; text-align: center;'><br>
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;"><br>	
		  
		  
		   <h3 style="color:green;">Τα στατιστικά της βάσης δεδομένων μας : </h3>
		<?php 
		$mapping = [
			"user" => "ΧΡΗΣΤΕΣ",
			"doctors" => "ΣΤΟΙΧΕΙΑ ΓΙΑΤΡΩΝ",
			"aimo_data" => "ΕΞΕΤΑΣΕΙΣ ΑΙΜΑΤΟΣ",
			"aktino_data" => "ΑΠΕΙΚΟΝΙΣΤΙΚΕΣ ΕΞΕΤΑΣΕΙΣ",
			"bio_tests" => "ΒΙΟΧΗΜΙΚΕΣ ΕΞΕΤΑΣΕΙΣ",
			"depress_data" => "ΠΙΝΑΚΑΣ ΚΑΤΑΘΛΙΨΗΣ",
			"health_data" => "ΣΩΜΑΤΟΜΕΤΡΙΚΕΣ ΜΕΤΡΗΣΕΙΣ",
			"gnomat_data" => "ΓΝΩΜΑΤΕΥΣΕΙΣ ΕΙΔΙΚΩΝ",
			"kritiki_data" => "ΑΞΙΟΛΟΓΗΣΕΙΣ",
			"medical_history" => "ΙΣΤΟΡΙΚΟ ΑΣΘΕΝΩΝ",
			"ormon_data" => "ΜΙΚΡΟΒΙΟΛΟΓΙΚΕΣ ΕΞΕΤΑΣΕΙΣ",
			"pcyc_data" => "ΠΙΝΑΚΑΣ ΑΓΧΟΥΣ",
			"leipes_data" => "ΑΛΛΕΣ ΕΞΕΤΑΣΕΙΣ"
		];

		// Δημιουργία δυναμικής SQL για καταμέτρηση εγγραφών σε όλους τους πίνακες
		$query = "SELECT GROUP_CONCAT(
					CONCAT('SELECT \"', TABLE_NAME, '\" AS table_name, COUNT(*) AS total_records FROM ', TABLE_NAME)
				  SEPARATOR ' UNION ALL ') AS full_query
				  FROM information_schema.tables 
				  WHERE table_schema = 'gavalakis'";

		$query_run = mysqli_query($con, $query);

		if ($query_run && mysqli_num_rows($query_run) > 0) {
			$row = mysqli_fetch_assoc($query_run);
			$final_query = $row['full_query']; // Παίρνουμε τη δυναμική SQL

			// Εκτελούμε την τελική εντολή που μετράει τα records σε κάθε πίνακα
			$result = mysqli_query($con, $final_query);

			// Εμφάνιση αποτελεσμάτων με ελληνικά ονόματα
			while ($data = mysqli_fetch_assoc($result)) {
				$table_name = $data['table_name'];
				$translated_name = $mapping[$table_name] ?? $table_name; // Μετάφραση αν υπάρχει

				echo "<h6> " . $translated_name . " - Σύνολο εγγραφών: " . $data['total_records'] . "</h6>";
			}
		}
	?>
	<br>
		</div></div></div></div></div></section>


<?php include('down.php'); ?>	