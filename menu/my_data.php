<?php include('../up.php'); ?>

<div id = container class="layout_padding-bottom"><br><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/slider-img.jpg" alt="">
          </div>
        </div>


<div class="col-md-7 " style="text-align:center;">

<!--<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">-->
<?php
// Εκτέλεση του query για την ανάκτηση των στοιχείων των ασθενών
$query = "SELECT name, email, id_user FROM user WHERE id_user = {$_SESSION['id_user']} and role != 'Doctor'";
$result = mysqli_query($con, $query);
$patient_id = $_SESSION['id_user'];

if ($result && mysqli_num_rows($result) > 0) {
	//echo '<div class="w3-card-4" style="background-color: rgb(240,240,240);  text-align:center;">';
	echo "<h2 style='color:green;' >Your DATA</h2>";
    echo "<table border='2' style='width: 100%; text-align: center;'>";
    echo "<tr>
            <th>Όνομα</th>
            
            <th>Ενέργειες</th>
          </tr>";

    
    while ($row = mysqli_fetch_assoc($result)) {
        $patient_id = $row['id_user'];
        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');

        echo "<tr>
                <td>$name</td>
                
                <td>
					<a href='" . BASE_URL . "h_istory/istorika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Ιστορικό</button>
                    </a>
                    <a href='" . BASE_URL . "h_istory/somatometrika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Σωματομετρικά</button>
                    </a>
                    
                    <a href='" . BASE_URL . "h_istory/bioximika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Βιοχημικά</button>
                    </a>
					<a href='" . BASE_URL . "h_istory/teleconfer.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Τηλεδιασκέψεις</button>
                    </a>
					
					
                </td>
              </tr>
			  <tr>
                <td></td>
                
                <td>
					
					<a href='" . BASE_URL . "h_istory/aimatologika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Αιματολογικά</button>
                    </a>
					<a href='" . BASE_URL . "h_istory/ormon_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Μικροβιολογικές κ.α. εξετ. </button>
                    </a>
					<a href='" . BASE_URL . "h_istory/aktinologika.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Απεικονιστικά</button>
                    </a>
					
					
                </td>
              </tr>
			  <tr>
                <td></td>
                
                <td>
					
					<a href='" . BASE_URL . "h_istory/loipes_exet_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Λοιπές εξετάσεις</button>
                    </a>
					<a href='" . BASE_URL . "h_istory/gnomat_res.php?patient_id=$patient_id'>
                        <button style='margin-right: 5px;'>Γνωματεύσεις</button>
                    </a>
					<a href='" . BASE_URL . "h_istory/stress.php?patient_id=$patient_id'>
                        <button>Stress</button>
                    </a>
					<a href='" . BASE_URL . "h_istory/depress.php?patient_id=$patient_id'>
                        <button>Κατάθλιψη</button>
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

<?php include('../down.php'); ?>
