<?php include('up.php'); ?>
<head>
	<style>
    .form-container {
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
    }
    .form-container label {
        font-weight: bold;
    }
    .form-container input {
        padding: 5px;
        font-size: 16px;
    }
    input[type="time"]::-webkit-datetime-edit-seconds-field,
    input[type="time"]::-webkit-datetime-edit-millisecond-field {
        display: none;
    }
</style>
	
</head>

<?php
$iatros= $_SESSION['consultant'];
$quer="SELECT * FROM user WHERE id_user=$iatros ";
$res = mysqli_query($con, $quer);
$row = mysqli_fetch_assoc($res);
if($row){	
    // Εκτέλεση query για να πάρουμε τα δεδομένα από τους δύο πίνακες
    $query = "
        SELECT 
            u.name,
            u.email,
			d.img,
            u.eidikotita, 
            d.fb_site, 
            d.linkin, 
            d.site, 
            d.doxy_site
        FROM 
            user u 
        INNER JOIN 
            doctors d 
        ON 
            u.id_user = d.doctor_id
        WHERE
            u.id_user = $iatros";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<div class='d-flex justify-content-center' style='background-color: rgb(240,240,240); padding: 20px;'>
        <br><br>
        <table class='table table-bordered text-center' style='width: 70%; margin: auto;'>
        <tr>
            <th>Όνομα</th>
            <th>Email</th>
            <th>Φωτο</th>
            <th>Ειδικότητα</th>
            <th>Facebook</th>
            <th>LinkedIn</th>
            <th>Ιστοσελίδα</th>
            <th>Τηλεδιάσκεψη</th>
        </tr>";

			while ($data = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . htmlspecialchars($data['name']) . "</td>";
				echo "<td>" . htmlspecialchars($data['email']) . "</td>";
				echo "<td style='width: 200px;'>
						  <img src='" . $data['img'] . "' style='width: 75%;'>
					  </td>";
				echo "<td>" . htmlspecialchars($data['eidikotita']) . "</td>";

				echo "<td>" . (!empty($data['fb_site']) ? "<a href='" . htmlspecialchars($data['fb_site']) . "' target='_blank'><button>Facebook</button></a>" : "-") . "</td>";
				echo "<td>" . (!empty($data['linkin']) ? "<a href='" . htmlspecialchars($data['linkin']) . "' target='_blank'><button>LinkedIn</button></a>" : "-") . "</td>";
				echo "<td>" . (!empty($data['site']) ? "<a href='" . htmlspecialchars($data['site']) . "' target='_blank'><button>Website</button></a>" : "-") . "</td>";
				echo "<td>" . (!empty($data['doxy_site']) ? "<a href='" . htmlspecialchars($data['doxy_site']) . "' target='_blank'><button>Doxy</button></a>" : "-") . "</td>";

				echo "</tr>";
			}
			echo "</table></div>";

        

        
		echo "  <div class='w3-card' style='background-color: rgb(240,240,240); text-align:center; width: 70%; margin: auto;'>
				
			<h4>Έχεις την δυνατότητα να στείλεις e-mail στον γιατρό σου ή
			</h4><br>
			<form name='doxy' action='' method='POST' class='form-container'>
			<div style='display: flex; gap: 20px; flex-direction: row;'>
		
			<h4 style='color:green' ><label> τηλεδιάσκεψη την:</label>
			<label for='meet'>Ημερομηνία</label>
			<input type='date' name='meet'>
			<label for='last'>Ώρα</label>
			<input type='time' name='last' step='3600'>
			<button style='color:blue' type='submit'>Υποβολή</button></h4>
			</form>
			
			</div><br>
			<h3 style='color:green'>Αν θέλεις να αλλάξεις γιατρό <button><a href='update_doctor.php'>Click εδώ</a></button> </h3></div><br>
			
			<div class='w3-card' style='background-color: rgb(240,240,240); text-align:center; width: 70%; margin: auto;'>
			<h4>Ο ιστότοπος αυτός δεν έχει ευθύνη για τις ιατρικές πληροφορίες που αναζητάτε.</h4>
			<h4><strong> Για ιατρική συμβουλή και θεραπεία απευθύνεστε στους ειδικούς γιατρούς που εμπιστεύεστε.</strong></h4>
			</div>
			<br><br><br>";
			
			
			$user_id = $_SESSION['id_user'];

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$date = $_POST['meet'];
				$time = $_POST['last'];

				// Μετατροπή ημερομηνίας σε αντικείμενο DateTime
				$dateObject = new DateTime($date);
				$now = new DateTime();
				
				// Προσθήκη 2 ημερών στην τρέχουσα ημερομηνία
				$now->modify('+2 days');

				if ($dateObject >= $now) {
					// Εισαγωγή στο πίνακα τηλεδιασκέψεων
					$query = "INSERT INTO teleconference (id_user, consultant, date, time) VALUES (?, ?, ?, ?)";
					$stmt = mysqli_prepare($con, $query);
					mysqli_stmt_bind_param($stmt, 'iiss', $user_id, $iatros, $date, $time);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);

					// Εμφάνιση pop-up με το μήνυμα
					echo "<script type='text/javascript'>alert('Η τηλεδιάσκεψη έχει κλείσει! Εάν υπάρχει πρόβλημα θα ενημερωθείτε με email από τον γιατρό σας');</script>";
				} else {            
					echo "<script type='text/javascript'>
						alert('Η τηλεδιάσκεψη πρέπει να κλεισθεί τουλάχιστον 2 μέρες πριν!');
					</script>";
				}
			}
			} else {
				echo "<p>No data found.</p>";
			}
		} else {
			echo "<p>User not found.</p>";
	}

?>
<?php include('down.php'); ?>
