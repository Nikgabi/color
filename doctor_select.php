<?php
// Σύνδεση στη βάση δεδομένων
$con = mysqli_connect("localhost", "username", "password", "database_name");
if (!$con) {
    die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . mysqli_connect_error());
}

// Έλεγχος αν υπάρχει το query parameter "doctor"
if (isset($_GET['doctor']) && is_numeric($_GET['doctor'])) {
    $selected_user_id = intval($_GET['doctor']); // Μετατροπή σε ακέραιο για ασφάλεια

    // Εκτέλεση query για να πάρουμε τα δεδομένα του συγκεκριμένου γιατρού
    $query = "
        SELECT 
            u.email, 
            u.eidikotita, 
            d.fb_site, 
            d.linkid_site, 
            d.site, 
            d.doxy_site
        FROM 
            user u 
        INNER JOIN 
            doctors d 
        ON 
            u.id_user = d.doctor_id
        WHERE 
            u.id_user = '$selected_user_id'";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' style='width: 100%; text-align: center;'>";
        echo "<tr>
                <th>Email</th>
                <th>Ειδικότητα</th>
                <th>Facebook</th>
                <th>LinkedIn</th>
                <th>Ιστοσελίδα</th>
                <th>Doxy</th>
              </tr>";

        // Εμφάνιση του γιατρού σε μία γραμμή του πίνακα
        while ($row = mysqli_fetch_assoc($result)) {
            $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
            $eidikotita = htmlspecialchars($row['eidikotita'], ENT_QUOTES, 'UTF-8');
            $fb_site = htmlspecialchars($row['fb_site'], ENT_QUOTES, 'UTF-8');
            $linkid_site = htmlspecialchars($row['linkid_site'], ENT_QUOTES, 'UTF-8');
            $site = htmlspecialchars($row['site'], ENT_QUOTES, 'UTF-8');
            $doxy_site = htmlspecialchars($row['doxy_site'], ENT_QUOTES, 'UTF-8');

            echo "<tr>
                    <td>$email</td>
                    <td>$eidikotita</td>
                    <td><a href='$fb_site' target='_blank'><button>Facebook</button></a></td>
                    <td><a href='$linkid_site' target='_blank'><button>LinkedIn</button></a></td>
                    <td><a href='$site' target='_blank'><button>Ιστοσελίδα</button></a></td>
                    <td><a href='$doxy_site' target='_blank'><button>Doxy</button></a></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Ο γιατρός με user_id = $selected_user_id δεν βρέθηκε.</p>";
    }
} else {
    echo "<p>Παρακαλώ καθορίστε έναν έγκυρο γιατρό μέσω του URL (π.χ. ?doctor=45).</p>";
}

// Κλείσιμο σύνδεσης
mysqli_close($con);
?>
