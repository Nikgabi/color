<?php include('up.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$Hb = $Htc = $eryth = $leuk = $oudet = $lemfo = $mono=$ios=$bas=$plt=null;
$Fe = $ferit = $b12 = $filiko = $pt = $pt1 = $inr=$ptt=$ino=null;
$MCV = $MCH = $MCHC = $oud_no = $lemfo_no = $mono_no = $bas_no=$ios_no=null;


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $Hb = test_input($_POST['Hb']);
    $Htc = test_input($_POST['Htc']);
    $eryth =test_input($_POST['eryth']);
    $leuk = test_input($_POST['leuk']);
    $oudet =test_input($_POST['oudet']);
	$lemfo=test_input($_POST['lemfo']);
	$mono=test_input($_POST['mono']);
	$ios=test_input($_POST['ios']);
	$bas=test_input($_POST['bas']);
	$plt=test_input($_POST['plt']);
	$Fe=test_input($_POST['Fe']);
	$ferit=test_input($_POST['ferit']);
	$b12=test_input($_POST['b12']);
	$filiko=test_input($_POST['filiko']);
	$pt=test_input($_POST['pt']);
	$pt1=test_input($_POST['pt1']);
	$inr=test_input($_POST['inr']);
	$ptt=test_input($_POST['ptt']);
	$ino=test_input($_POST['ino']);
	
	$user_id= $_SESSION['id_user'];

    // Υπολογισμός MCV , MCHC , MCH
	if($Htc<>null && $Hb<>null && $eryth<>null){
		$MCV = $Htc * 10 / $eryth; 
		$MCH = $Hb * 10 / $eryth;
		$MCHC = $Hb * 100 / $Htc;
		}
	// Υπολογισμός απόλυτων αριθμών
	if($leuk<>null && $oudet<>null ){
		$oud_no =$leuk*$oudet*10 ; 
		}
	if($leuk<>null && $lemfo<>null ){
		$lemfo_no =$leuk*$lemfo*10 ; 
		}
	if($leuk<>null && $mono<>null ){
		$mono_no =$leuk*$mono*10 ; 
		}
	if($leuk<>null && $ios<>null ){
		$ios_no =$leuk*$ios*10 ; 
		}
	if($leuk<>null && $bas<>null ){
		$bas_no =$leuk*$bas*10 ; 
		}

    // Αποθήκευση δεδομένων στη βάση δεδομένων
    $query = "INSERT INTO aimo_data (user_id,Hb, Htc, eryth, leuk, oudet, lemfo, mono, ios, bas, plt , Fe , ferit , b12, filiko, pt, pt1, inr, ptt, ino ) 
              VALUES ('$user_id','$Hb', '$Htc', '$eryth', '$leuk', '$oudet', '$lemfo', '$mono', '$ios', '$bas', '$plt' , '$Fe' , '$ferit' , '$b12','$filiko','$pt','$pt1','$inr','$ptt','$ino')";
$query_run = mysqli_query($con, $query);}
	

?>

<head>
	<title>Αιματολογικά και υπολογισμοί</title>
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/aima.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
			<?php if (isset($_POST['submit'])): ?>
				<h3 style="color: red">Οι αιματολογικές εξετάσεις σας αποθηκεύτηκαν</h3>
				<h3 style="color: green">Επιπλέον υπολογίσθηκαν οι κάτωθι τιμές</h3><br>
				
				<?php if (!is_null($MCV)) { ?>
					<p><strong>MCV (Μέσος όγκος ερυθρών αιμοσφ.):</strong> <?php echo number_format($MCV, 1); ?> fL</p>
					<p>Φυσιολογικές τιμές 80-100.</p><br>
				<?php } ?>

				<?php if (!is_null($MCH)) { ?>
					<p><strong>MCH (Μέση περιεκτικότητα αιμοσφ.):</strong> <?php echo number_format($MCH, 1); ?> pg</p>
					<p>Φυσιολογικές τιμές 27-32.</p><br>
				<?php } ?>

				<?php if (!is_null($MCHC)) { ?>
					<p><strong>MCHC (Μέση πυκνότητα αιμοσφ.):</strong> <?php echo number_format($MCHC, 1); ?>%</p>
					<p>Φυσιολογικές τιμές 31.5%-35.5%.</p><br>
				<?php } ?>

				<?php if (!is_null($oud_no)) { ?>
					<p><strong>Πολυμορφοπύρηνα:</strong> <?php echo number_format($oud_no, 0); ?> /μL</p>
				<?php } ?>

				<?php if (!is_null($lemfo_no)) { ?>
					<p><strong>Λεμφοκύτταρα:</strong> <?php echo number_format($lemfo_no, 0); ?> /μL</p>
				<?php } ?>

				<?php if (!is_null($mono_no)) { ?>
					<p><strong>Μονοκύτταρα:</strong> <?php echo number_format($mono_no, 0); ?> /μL</p>
				<?php } ?>

				<?php if (!is_null($bas_no)) { ?>
					<p><strong>Βασεόφιλα:</strong> <?php echo number_format($bas_no, 0); ?> /μL</p>
				<?php } ?>

				<?php if (!is_null($ios_no)) { ?>
					<p><strong>Ηωσινόφιλα:</strong> <?php echo number_format($ios_no, 0); ?> /μL</p><br>
				<?php } ?>

				
				
				
				
			<?php endif; ?>
		<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
					  Υπολογισμοί
					</a></button><br>
					<p style="color: red">Μπορείτε σε επόμενο χρόνο να εισάγετε νέα αποτελέσματα εξετάσεών σας</p><br><br>
			</div>
			</div> 
		  </div>
	</div> 
	</section>
	</div>
  
  <?php 
  echo "Reached down.php";
  include('down.php'); ?>	