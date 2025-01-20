<?php include('up.php'); ?>

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
    echo "<div class='w3-card-4' style='background-color: rgb(240,240,240); text-align:center;'><br><br>
		<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr>
			<th>Όνομα</th>
            <th>Email</th>
            <th>Ειδικότητα</th>
            <th>Facebook</th>
            <th>LinkedIn</th>
            <th>Ιστοσελίδα</th>
            <th>Doxy</th>
          </tr>";

    // Εμφάνιση των δεδομένων σε γραμμές του πίνακα
    while ($row = mysqli_fetch_assoc($result)) {
		$name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
        $eidikotita = htmlspecialchars($row['eidikotita'], ENT_QUOTES, 'UTF-8');
        $fb_site = htmlspecialchars($row['fb_site'], ENT_QUOTES, 'UTF-8');
        $linkin = htmlspecialchars($row['linkin'], ENT_QUOTES, 'UTF-8');
        $site = htmlspecialchars($row['site'], ENT_QUOTES, 'UTF-8');
        $doxy_site = htmlspecialchars($row['doxy_site'], ENT_QUOTES, 'UTF-8');

        echo "
			<tr>
				<td>$name</td>
                <td>$email</td>
                <td>$eidikotita</td>
                <td><a href='$fb_site' target='_blank'><button>Facebook</button></a></td>
                <td><a href='$linkin' target='_blank'><button>LinkedIn</button></a></td>
                <td><a href='$site' target='_blank'><button>Ιστοσελίδα</button></a></td>
                <td><a href='$doxy_site' target='_blank'><button>Doxy</button></a></td>
              </tr>";
    }

    echo "</table><br><br>";
	echo "  <h3 style='color: green;'><strong > Από τα άνωθεν Links: </strong></h3>
			<h4>Έχεις την δυνατότητα να στείλεις e-mail στον γιατρό σου.</h4>
			<h4>Μπορείς να δείς τις σελίδες του από τα κοινωνικά και επαγγελματικά του δίκτυα, εφόσον τις έχει καταχωρήσει.</h4>
			<h4>Επίσης μπορείς να τον καλέσεις σε τηλεδιάσκεψη από το Doxy μετά από προσυνεννόηση μαζί του.</h4>
			<h4>Ο ιστότοπος αυτός δεν έχει ευθύνη για τις ιατρικές πληροφορίες που αναζητάτε </h4>
			<h4>και είναι πληροφοριακού χαρακτήρα και μόνο.</h4>
			<h4><strong> Για ιατρική συμβουλή και θεραπεία απευθύνεστε στους ειδικούς γιατρούς που εμπιστεύεστε.</strong></h4><br></div>";
} else {
    echo "<p>Δεν βρέθηκαν γιατροί.</p>";
}}
?>

<?php include('down.php'); ?>
