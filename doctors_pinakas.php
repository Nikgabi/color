<?php include('up.php'); ?>

<?php

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
        u.id_user = d.doctor_id";

$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='width: 100%; text-align: center;'>";
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

        echo "<tr>
				<td>$name</td>
                <td>$email</td>
                <td>$eidikotita</td>
                <td><a href='$fb_site' target='_blank'><button>Facebook</button></a></td>
                <td><a href='$linkin' target='_blank'><button>LinkedIn</button></a></td>
                <td><a href='$site' target='_blank'><button>Ιστοσελίδα</button></a></td>
                <td><a href='$doxy_site' target='_blank'><button>Doxy</button></a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>Δεν βρέθηκαν γιατροί.</p>";
}
?>

<?php include('down.php'); ?>
