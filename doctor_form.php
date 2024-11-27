<?php include('up.php'); ?>
<head>
	<title>Doctor`s Form</title>
</head>

<?php
// Επεξεργασία φόρμας όταν υποβληθεί
if (isset($_POST['SubmitBtn'])) {

    // Λήψη δεδομένων από τη φόρμα
    $doctor_id = $_SESSION['id_user'];
    $fb_site = $_POST['fb_site'];
    $linkin = $_POST['linkin'];
    $site = $_POST['site'];
    $doxy_site = $_POST['doxy_site'];

    // Εντολή SQL για εισαγωγή δεδομένων
    $sql = "INSERT INTO doctors (doctor_id, fb_site, linkin, site, doxy_site)
            VALUES ('$doctor_id', '$fb_site', '$linkin', '$site', '$doxy_site')";
	$sql_run = mysqli_query($con, $sql);
    // Εκτέλεση της εντολής
    if ($sql_run) {
        $message = "Τα δεδομένα εισήχθησαν επιτυχώς!";
    } else {
        $message = "Σφάλμα: " . $sql . "<br>" . $conn->error;
    }

}
?>
<div id = container class="layout_padding-bottom"><br>
<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">

    <h1>Εισαγωγή Στοιχείων Βιογραφικού Ιατρού</h1>

    <!-- Εμφάνιση μηνύματος αν υπάρχει -->
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <!--  <label for="doctor_id">ID Ιατρού:</label>
        <input type="text" id="doctor_id" name="doctor_id" required><br><br> -->

        <label for="fb_site">Facebook URL:</label>
        <input type="url" id="fb_site" name="fb_site" size="50"><br>

        <label for="linkin">LinkedIn URL:</label>
        <input type="url" id="linkin" name="linkin" size="50"><br>

        <label for="site">Ιστότοπος:</label>
        <input type="url" id="site" name="site" size="50"><br>

        <label for="doxy_site">Doxy.me:</label>
        <input type="url" id="doxy_site" name="doxy_site" size="50"><br>

        <button name="SubmitBtn" type="submit">Υποβολή</button><br>
    </form>
</div>
</div>


<?php include('down.php'); ?>
