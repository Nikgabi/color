<?php include('up.php'); ?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
	$avg_all = 0;
	$avg_user = 0;
	$avg_patients = 0;
	$scor_depress = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
		

		// Υπολογισμός γενικού μέσου όρου
		$stmt = $con->prepare("SELECT AVG(scor_depress) as avg_value FROM depress_data");
		$stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
		$avg_all = $result['avg_value'];

		if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'visitor') {
			$depress_id = $_SESSION['id_user'];

			$stmt1 = $con->prepare("SELECT AVG(scor_depress) as avg_value FROM depress_data WHERE depress_id=?");
			$stmt1->bind_param("i", $depress_id);
			$stmt1->execute();
			$result1 = $stmt1->get_result()->fetch_assoc();
			$avg_user = $result1['avg_value'];
		} elseif (isset($_SESSION['id_user']) && $_SESSION['role'] == 'Doctor') {
			$doctor_id = $_SESSION['id_user'];
			$query = "SELECT id_user FROM user WHERE consultant = ?";
			$stmt3 = $con->prepare($query);
			$stmt3->bind_param("i", $doctor_id);
			$stmt3->execute();
			$result3 = $stmt3->get_result();

			$patient_ids = [];
			while ($row = $result3->fetch_assoc()) {
				$patient_ids[] = $row['id_user'];
			}

			if (!empty($patient_ids)) {
				$placeholders = implode(',', array_fill(0, count($patient_ids), '?'));
				$query2 = "SELECT AVG(scor_depress) as avg_value FROM depress_data WHERE depress_id IN ($placeholders)";
				$stmt4 = $con->prepare($query2);
				$stmt4->bind_param(str_repeat("i", count($patient_ids)), ...$patient_ids);
				$stmt4->execute();
				$result4 = $stmt4->get_result()->fetch_assoc();
				$avg_patients = $result4['avg_value'];
			}
		}
	}
?>

<head>
	<title>"Σκόρ" κατάθλιψης</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
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
		
                    
                
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;"> Διάγραμμα "σκόρ" κατάθλιψης</h2>
    <form name="loipes" action="" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        
        <div style="display: flex; flex-direction: row; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
            
			<input type="submit" name="submit" value="Σχεδίαση διαγράμματος" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="charts.php" style="text-decoration: none; color: black;">Πίσω</a>
            </button> 
        </div>
				<!-- Google Charts -->
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Κατηγορία', '<?php echo $scor_depress; ?>', { role: 'style' }],
						<?php if ($_SESSION['role'] == 'visitor'): ?>
							['Μέσος Όρος Όλων', <?php echo $avg_all; ?>, 'blue'],
							['Μέσος Όρος Χρήστη', <?php echo $avg_user; ?>, 'green']
						<?php elseif ($_SESSION['role'] == 'Doctor'): ?>
							['Μέσος Όρος Όλων', <?php echo $avg_all; ?>, 'blue'],
							['Μέσος Όρος Ασθενών σου', <?php echo $avg_patients; ?>, 'red']
						<?php endif; ?>
					]);

					var options = {
						title: '<?php echo $scor_depress; ?>',
						chartArea: {width: '50%'},
						vAxis: {
							title: '<?php echo $scor_depress; ?>',
							minValue: 0
						},
						hAxis: {
							title: 'Κατηγορία'
						},
						bars: 'vertical',
						colors: ['blue', 'green', 'red']
					};

					var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
					chart.draw(data, options);
				}
			</script>


	
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
                                              
        </div>
		<div id="chart" style="width: 400px; height: 300px;"></div>
    </form>
	
</div>

			</form>
			</div>
			</div>
			</div>	
				
					
					
					
	
               
            
        </div>
    </div>
</section>


<?php include('down.php'); ?>