<?php include('../up.php'); ?>
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
	$metabl = "";
	
	$mapping = [
    "height" => "Ύψος",
	"weight" => "Βάρος",
    "age" => "Ηλικία",
    "bmi" => "Δείκτης μάζας",
	"bmr" => "Βασκός μεταβολισμός",
	"rfm" => "Ποσοστό λίπους",
	"co" => "Καρδιακή παροχή",
    "map" => "Αρτηριακή πίεση",
    "apost" => "6 λεπτά περπάτημα",
	"expect" => "Ποσοστό στα 6 λεπτά"
	];

	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
		$metabl = test_input($_POST['er1']);
		$selected_variable = $metabl; // Παράδειγμα επιλογής μεταβλητής
		$translated_variable = $mapping[$selected_variable] ?? $selected_variable; // Αντιστοίχιση

		// Υπολογισμός γενικού μέσου όρου
		$stmt = $con->prepare("SELECT AVG($metabl) as avg_value FROM health_data");
		$stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
		$avg_all = $result['avg_value'];
		

		if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'visitor') {
			$user_id = $_SESSION['id_user'];

			$stmt1 = $con->prepare("SELECT AVG(NULLIF($metabl, '')) as avg_value FROM health_data WHERE user_id=?");
			$stmt1->bind_param("i", $user_id);
			$stmt1->execute();
			$result1 = $stmt1->get_result()->fetch_assoc();
			$avg_user = $result1['avg_value'];
			
			$stmt2 = $con->prepare("SELECT NULLIF($metabl, '') as metabliti , DATE(created_at) as date FROM health_data WHERE user_id=?");
			$stmt2-> bind_param("i", $user_id);
			$stmt2-> execute();
			$result2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
			//min max 5last
			$stmtMinMax = $con->prepare("SELECT MIN(NULLIF($metabl, '')) as min_val, MAX(NULLIF($metabl, '')) as max_val 
								 FROM health_data WHERE user_id=?");
			$stmtMinMax->bind_param("i", $user_id);
			$stmtMinMax->execute();
			$minMax = $stmtMinMax->get_result()->fetch_assoc();
			// 2. Λήψη των 5 τελευταίων τιμών για το διάγραμμα
			$stmtLast5 = $con->prepare("SELECT NULLIF($metabl, '') as metabliti, DATE_FORMAT(created_at, '%d-%m') as date 
										FROM health_data WHERE user_id=? 
										ORDER BY created_at DESC LIMIT 5");
			$stmtLast5->bind_param("i", $user_id);
			$stmtLast5->execute();
			$result2 = array_reverse($stmtLast5->get_result()->fetch_all(MYSQLI_ASSOC)); // Reverse για σωστή σειρά

			// Μετατροπή σε JSON για χρήση στη JavaScript
			$min_val = $minMax['min_val'] ?? 0;
			$max_val = $minMax['max_val'] ?? 0;
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
				$query2 = "SELECT AVG(NULLIF($metabl, '')) as avg_value FROM health_data WHERE user_id IN ($placeholders)";
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
	<title>Σωματομετρικά διαγράμματα</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/diagrama1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/diagrama2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/diagrama3.jpeg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
                
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;">Σωματομετρικά διαγράμματα</h2>
    <form name="loipes" action="" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        
        <div style="display: flex; flex-direction: row; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
            <label for="er1" style="font-weight: bold;">Επιλογή μεταβλητής:</label>
            <select name="er1" required style="width: 100%; padding: 8px; height: 200px; overflow: auto;" >
                <option value="" selected>Επιλέξτε...</option>
                <option value="height">Ύψος</option>  
                <option value="weight">Βάρος</option>
                <option value="age">Ηλικία</option>
                <option value="bmi">Δείκτης μάζας σώματος</option>
                <option value="bmr">Βασικός μεταβολισμός</option>
                <option value="rfm">Σχετικό ποσοστό λίπους</option>               
                <option value="co">Καρδιακή παροχή</option>
                <option value="map">Μέση αρτηριακή πίεση</option>
                <option value="apost">6 λεπτά περπάτημα</option>
				<option value="expect">Ποσοστό για 6 λεπτά επί προβλεπόμενης</option>
            </select>
			<input type="submit" name="submit" value="Σχεδίαση διαγράμματος" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="<?php echo BASE_URL; ?>menu/charts.php" style="text-decoration: none; color: black;">Πίσω</a>
            </button> 
        </div>
				<!-- Google Charts -->
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Κατηγορία', '<?php echo $translated_variable; ?>', { role: 'style' }],
						<?php if (!isset($_SESSION['id_user'])): ?>
							['Μέσος Όρος Όλων', <?php echo $avg_all; ?>, 'blue'],
							
						<?php endif; ?>
					]);

					var options = {
						title: '<?php echo $translated_variable; ?>',
						chartArea: {width: '50%'},
						vAxis: {
							title: '<?php echo $translated_variable; ?>',
							minValue: 0
						},
						hAxis: {
							title: 'Κατηγορία'
						},
						bars: 'vertical',
						colors: ['blue', 'green', 'red']
					};

					var chart = new google.visualization.ColumnChart(document.getElementById('chart1'));
					chart.draw(data, options);
				}
			</script>	
				
				
				
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Κατηγορία', '<?php echo $translated_variable; ?>', { role: 'style' }],
						<?php if ($_SESSION['role'] == 'visitor'): ?>
							['Μέσος Όρος Όλων', <?php echo $avg_all; ?>, 'blue'],
							['Μέσος Όρος Χρήστη', <?php echo $avg_user; ?>, 'green']
						<?php elseif ($_SESSION['role'] == 'Doctor'): ?>
							['Μέσος Όρος Όλων', <?php echo $avg_all; ?>, 'blue'],
							['Μέσος Όρος Ασθενών σου', <?php echo $avg_patients; ?>, 'red']
						<?php endif; ?>
					]);

					var options = {
						title: '<?php echo $translated_variable; ?>',
						chartArea: {width: '50%'},
						vAxis: {
							title: '<?php echo $translated_variable; ?>',
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
			
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Ημερομηνία');
				data.addColumn('number', 'Μεταβλητή');
				data.addColumn({type: 'string', role: 'annotation'}); // Προσθήκη annotation

				var result1 = <?php echo json_encode($result2); ?>;
				var min_val = <?php echo json_encode($min_val); ?>;
				var max_val = <?php echo json_encode($max_val); ?>;

				var chartData = [['Ημερομηνία', 'Τιμή', { role: 'annotation' }]];

				if (Array.isArray(result1)) {
					result1.forEach(function(row) {
						if (row.date && row.metabliti !== null) {
							let value = parseFloat(row.metabliti) || 0;
							let annotation = '';
							if (value === min_val) annotation = 'Min';
							if (value === max_val) annotation = 'Max';
							chartData.push([row.date, value, annotation]);
						}
					});
				}

				if (chartData.length === 1) {
					console.error("No valid data to display");
					return;
				}

				data.addRows(chartData.slice(1));

				var options = {
					title: 'Μεταβολή τιμής μεταβλητής (5 τελευταίες)',
					curveType: 'function',
					legend: { position: 'bottom' },
					hAxis: { title: 'Ημερομηνία' },
					vAxis: { title: 'Τιμή' },
					annotations: { alwaysOutside: true }
				};

				var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
				chart.draw(data, options);
			}
		</script>


	
        <?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'visitor'):?>
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
          <div id="curve_chart" style="width: 400px; height: 300px;"></div>
		  <div id="chart" style="width: 400px; height: 300px;"></div>                                    
        </div>
	<?php endif; ?>	
	<?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'Doctor'):?>
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
		  <div id="chart" style="width: 400px; height: 300px;"></div>                                    
        </div>
	<?php endif; ?>	
	<?php if (!isset($_SESSION['id_user'])): ?>
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
		  <div id="chart1" style="width: 400px; height: 300px;"></div>                                    
        </div>
	<?php endif; ?></div>
    </form>
	
</div>

			</form>
			</div>
			</div>
			</div>	
				
					
					
					
	
               
            
        </div>
    </div>
</section>


<?php include('../down.php'); ?>