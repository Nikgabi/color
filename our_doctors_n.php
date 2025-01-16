<?php include('up.php'); ?>

<?php

$quer="SELECT * FROM user WHERE role='Doctor' ";
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
        u.id_user = d.doctor_id ";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	echo "<div class='w3-card-4' style='background-color: rgb(240,240,240); text-align:center;'><br><br>
		<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr><th>Όνομα</th><th>Email</th><th>Ειδικότητα</th><th>Facebook</th><th>LinkedIn</th><th>Website</th><th>Doxy.me</th></tr>";
	while($data = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$data['name']."</td>";
		echo "<td>".$data['email']."</td>";
		echo "<td>".$data['eidikotita']."</td>";

		// Έλεγχος για κάθε link πριν δημιουργηθεί το κελί
		echo "<td>".(!empty($data['fb_site']) ? "<a href='".$data['fb_site']."' target='_blank'><button>Facebook</button></a>" : "")."</td>";
		echo "<td>".(!empty($data['linkin']) ? "<a href='".$data['linkin']."' target='_blank'><button>>LinkedIn</button></a>" : "")."</td>";
		echo "<td>".(!empty($data['site']) ? "<a href='".$data['site']."' target='_blank'><button>>Website</button></a>" : "")."</td>";
		echo "<td>".(!empty($data['doxy_site']) ? "<a href='".$data['doxy_site']."' target='_blank'><button>>Doxy.me</button></a>" : "")."</td>";
		echo "</tr>";
	}
    echo "</table>";
}else{
    echo "<p>Δεν βρέθηκαν δεδομένα.</p>";
}
}

// Κείμενο κάτω από τον πίνακα
echo "<p>Ο παραπάνω πίνακας περιλαμβάνει τα στοιχεία των γιατρών και τους σχετικούς συνδέσμους. Αν κάποιο πεδίο είναι κενό, δεν εμφανίζεται το αντίστοιχο link.</p>";
?>
