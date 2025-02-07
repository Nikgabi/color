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
        echo "<div class='w3-card-4' style='background-color: rgb(240,240,240); text-align:center;'><br><br>
            <table border='1' style='width: 100%; text-align: center;'>";
        echo "<tr>
                <th>Όνομα</th>
                <th>Email</th>
				<th>Φωτο</th>
                <th>Ειδικότητα</th>
                <th>Facebook</th>
                <th>LinkedIn</th>
                <th>Ιστοσελίδα</th>
                <th>Doxy</th>
            </tr>";

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($data['name']) . "</td>";
            echo "<td>" . htmlspecialchars($data['email']) . "</td>";
			echo "<td style='width: 200px;'>
					  <img src='" . $data['img'] . "' style='width: 75%;'>
					
				  </td>";
            echo "<td>" . htmlspecialchars($data['eidikotita']) . "</td>";

            // Εμφάνιση μόνο αν δεν είναι κενά
            echo "<td>" . (!empty($data['fb_site']) ? "<a href='" . htmlspecialchars($data['fb_site']) . "' target='_blank'><button>Facebook</button></a>" : "-") . "</td>";
            echo "<td>" . (!empty($data['linkin']) ? "<a href='" . htmlspecialchars($data['linkin']) . "' target='_blank'><button>LinkedIn</button></a>" : "-") . "</td>";
            echo "<td>" . (!empty($data['site']) ? "<a href='" . htmlspecialchars($data['site']) . "' target='_blank'><button>Website</button></a>" : "-") . "</td>";
            echo "<td>" . (!empty($data['doxy_site']) ? "<a href='" . htmlspecialchars($data['doxy_site']) . "' target='_blank'><button>Doxy</button></a>" : "-") . "</td>";

            echo "</tr>";
        }

        echo "</table>";
		echo "  <h3 style='color: green;'><strong > Από τα άνωθεν Links: </strong></h3>
			<h4>Έχεις την δυνατότητα να στείλεις e-mail στον γιατρό σου.</h4>
			<h4>Μπορείς να δείς τις σελίδες του από τα κοινωνικά και επαγγελματικά του δίκτυα, εφόσον τις έχει καταχωρήσει.</h4>
			<h4>Επίσης μπορείς να τον καλέσεις σε τηλεδιάσκεψη από το Doxy μετά από προσυνεννόηση μαζί του.</h4>
			<h4>Ο ιστότοπος αυτός δεν έχει ευθύνη για τις ιατρικές πληροφορίες που αναζητάτε </h4>
			<h4>και είναι πληροφοριακού χαρακτήρα και μόνο.</h4>
			<h4><strong> Για ιατρική συμβουλή και θεραπεία απευθύνεστε στους ειδικούς γιατρούς που εμπιστεύεστε.</strong></h4><br></div>";
    } else {
        echo "<p>No data found.</p>";
    }
} else {
    echo "<p>User not found.</p>";
}
?>
<?php include('down.php'); ?>
