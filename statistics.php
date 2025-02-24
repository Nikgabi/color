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
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">	
		  
		  
		   <h3 style="color:green;">Τα στατιστικά της βάσης δεδομένων μας : </h3>
		<?php 
		

		$query3 = "SELECT COUNT(*) AS active_connections FROM information_schema.processlist";
		$result3 = mysqli_query($con, $query3);
		$row3 = mysqli_fetch_assoc($result3);
		$active_connections = $row3['active_connections'];

		
		
		$total=$doctors=$visitors=$totals=null;
		$query1 ="SELECT 
			COUNT(*) AS total_records,
			COUNT(CASE WHEN role = 'Doctor' THEN 1 END) AS matching_records
			FROM user ";
		$query1_run = mysqli_query($con,$query1);
			
		if ($query1_run && mysqli_num_rows($query1_run)>0) {
			$row = mysqli_fetch_assoc($query1_run);
			$total = $row['total_records'];
			$doctors = $row['matching_records'];
			$visitors = $total - $doctors;
		}
		
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
			"leipes_data" => "ΑΛΛΕΣ ΕΞΕΤΑΣΕΙΣ",
			"teleconference" => "ΤΗΛΕΣΥΝΕΔΡΙΑΣΕΙΣ"
		];
		// Ρύθμιση του group_concat_max_len πριν εκτελέσουμε το query
		mysqli_query($con, "SET SESSION group_concat_max_len = 100000");
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
		echo "<h6> ΓΙΑΤΡΟΙ: " . $doctors . ", ΕΠΙΣΚΕΠΤΕΣ :" . $visitors . "</h6>" ;
		
	?>
		<p> Ενεργές συνδέσεις στον ιστότοπο: <b><?php echo $active_connections; ?></b></p>
		
	<br>
		</div></div></div></div></div></section>


<?php include('down.php'); ?>	