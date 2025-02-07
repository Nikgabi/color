<?php include('up.php');
// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$glu = $ouria = $krea = $ouriko = $cholist = $hdl = $trigl =$al_f = $sgot =$sgpt=$ggt=null;
$choler = $choler1 =$ka = $na = $cl = $ca = $mgn  =$na_cor=$ca_cor=  null;
$leuk = $crp = $alboum = $psa = $cpk = $amyl =$amyl1 =$glu_hb = null;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data ;
}

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $glu = test_input($_POST['glu']);
    $ouria = test_input($_POST['ouria']);
    $krea = test_input($_POST['krea']);
    $ouriko = test_input($_POST['ouriko']);
    $cholist = test_input($_POST['cholist']);
	$hdl=test_input($_POST['hdl']);
	$trigl=test_input($_POST['trigl']);
	$al_f=test_input($_POST['al_f']);
	$sgot=test_input($_POST['sgot']);
	$sgpt=test_input($_POST['sgpt']);
	$ggt=test_input($_POST['ggt']);
	$choler=test_input($_POST['choler']);
	$choler1=$_POST['choler1'];
	$ka=test_input($_POST['ka']);
	$na=test_input($_POST['na']);
	$cl=test_input($_POST['cl']);
	$ca=test_input($_POST['ca']);
	$mgn=test_input($_POST['mgn']);
	$glu_hb=test_input($_POST['glu_hb']);
	$leuk=test_input($_POST['leuk']);
	$alboum=test_input($_POST['alboum']);
	$amyl=test_input($_POST['amyl']);
	$amyl1=test_input($_POST['amyl1']);
	$crp=test_input($_POST['crp']);
	$psa=test_input($_POST['psa']);
	$cpk=test_input($_POST['cpk']);
	
	$biox_id= $_SESSION['id_user'];

    // Υπολογισμός osmolality , LDL holest , Sodium correction , Ca correct.
    if($na<>null && $glu<>null && $ouria<>null){
		$osmo = 2* $na +($ouria/2.8)  + ($glu / 18);
		 } 
	if($cholist<>null && $hdl<>null && $trigl<>null){
		$ldl = $cholist - $hdl - ($trigl/5) ;
		 }
	if($na<>null && $glu<>null && $glu>200){
		$na_cor=$na+0.024*($glu-100);
		 }
	if($ca<>null && $alboum<>null && $alboum< 4){
		$ca_cor=$ca + 0.8*(4-$alboum) ;
		}

    
	
	

    // Αποθήκευση δεδομένων στη βάση δεδομένων
    $query = "INSERT INTO bio_tests (biox_id,glu, ouria, krea, ouriko, cholist, hdl, trigl,al_f, sgot, sgpt, ggt , choler ,choler1, ka , na, cl, ca, mgn, leuk, alboum ,glu_hb, amyl,amyl1, crp ,  psa , cpk ) 
              VALUES ('$biox_id','$glu', '$ouria', '$krea', '$ouriko', '$cholist', '$hdl', '$trigl','$al_f', '$sgot', '$sgpt', '$ggt' , '$choler' ,'$choler1' , '$ka' , '$na','$cl','$ca','$mgn','$leuk','$alboum','$glu_hb','$amyl','$amyl1','$crp','$psa','$cpk')";
$query_run = mysqli_query($con, $query);}
	

?>

<head>
	<title>Αποτελέσματα βιοχημικών υπολογισμών</title>
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/106.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
			<?php if (isset($_POST['submit'])): ?>
				<h3 style="color: red">Οι βιοχημικές εξετάσεις σας αποθηκεύτηκαν</h3>
				<h3 style="color: green">Επιπλέον υπολογίσθηκαν οι κάτωθι τιμές</h3><br>
		
				
				<?php if (!is_null($osmo)) { ?>
					<p><strong>Οσμωτικότητα:</strong> <?php echo number_format($osmo, 0); ?> mOsm/L</p>
					<br>
				<?php } ?>

				<?php if (!is_null($ldl)) { ?>
					<p><strong>LDL Χοληστερόλη:</strong> <?php echo number_format($ldl, 1); ?> mg/dl</p><br>
				<?php } ?>

				<?php if (!is_null($na_cor)) { ?>
					<p><strong>Διορθωμένο Na επί υπεργυκαιμίας:</strong> <?php echo number_format($na_cor, 1); ?>mEq/l</p>
					<br>
				<?php } ?>

				<?php if (!is_null($ca_cor)) { ?>
					<p><strong>Διορθωμένο Ασβέστιο επί χαμηλού/υψηλού λευκώματος:</strong> <?php echo number_format($ca_cor, 2); ?> mg/dl</p>
				<?php } ?>
				
				
				
				
				
			<?php endif; ?>
		<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
					  Υπολογισμοί
					</a></button><br>
					<p style="color: red">Μπορείτε σε επόμενο χρόνο να εισάγετε νέα αποτελέσματα εξετάσεών σας</p><br>
			</div>
			</div> 
		  </div>
	</div> 
	</section>
	</div>
  
  <?php include('down.php'); ?>	