<?php include('up.php'); ?>

<div id = container class="layout_padding-bottom"><br><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 ">
          <div class="img-box">
            <img src="images/slider-img.jpg" alt="">
          </div>
        </div>


<div class="col-md-8 ">
<br><br>
<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
<?php
// Εκτέλεση του query για την ανάκτηση των στοιχείων των ασθενών
$query = "SELECT name, email, id_user FROM user WHERE id_user = {$_SESSION['id_user']} and role != 'Doctor'";
$result = mysqli_query($con, $query);
$patient_id = $_SESSION['id_user'];

if ($result && mysqli_num_rows($result) > 0) {
	echo '<div class="w3-card-4" style="background-color: rgb(240,240,240);  text-align:center;">';
	echo "<h2 style='color:green;' >Your DATA</h2>";
    echo "<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr>
            <th>Όνομα</th>
            <th>Email</th>
            <th>Ενέργειες</th>
          </tr>";

    
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
                    <a href='under_constr.php'>
                        <button>Βιοχημικά</button>
                    </a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<br><br><h3 style='text-align:center; color: green; '>Είστε γιατρός και δέν υπάρχουν καταγεγραμμένα δεδομένα για εσάς.</h3><br><br>";
}
echo '</div>';
?>

</div></div>
	</div> 
</section>
</div></div>

<?php include('down.php'); ?>
