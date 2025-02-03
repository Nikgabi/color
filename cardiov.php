<?php include('up.php'); ?>
<?php
function calculateRisk($age, $totalCholesterol, $hdlCholesterol, $systolicBP, $treatedBP, $smoker, $gender) {
    // Υπολογισμός των φυσικών λογαρίθμων
    $lnAge = log($age);
    $lnTotalCholesterol = log($totalCholesterol);
    $lnHDLCholesterol = log($hdlCholesterol);
    $lnSystolicBP = log($systolicBP);
    
    if ($gender == 'male') {
        $LMen = (52.00961 * $lnAge) + (20.014077 * $lnTotalCholesterol) + (-0.905964 * $lnHDLCholesterol) + 
                (1.305784 * $lnSystolicBP) + (0.241549 * $treatedBP) + (12.096316 * $smoker) + 
                (-4.605038 * $lnAge * $lnTotalCholesterol) + (-2.84367* $lnAge * $smoker) + (-2.93323 * $lnAge * $lnAge) - 172.300168;
        
        $PMen = 1 - pow(0.9402 , exp($LMen));
        return round($PMen,4);
    } else {
        $LWomen = (31.764001* $lnAge) + (22.465206 * $lnTotalCholesterol) + (-1.187731 * $lnHDLCholesterol) + 
                  (2.552905 * $lnSystolicBP) + (0.420251 * $treatedBP) + (13.07543 * $smoker) + 
                  (-5.060998 * $lnAge * $lnTotalCholesterol) + (-2.996945 * $lnAge * $smoker) - 146.5933061;
        
        $PWomen = 1 - pow(0.98767 , exp($LWomen));
        return round($PWomen,4);
    }
}
function risk_general($age , $gender){
	if ($age <=34 ) {
		$ind=0;}
	elseif ($age<=39) {
		$ind=1;}
	elseif ($age<=44) {
		$ind=2;}
	elseif ($age<=49) {
		$ind=3;}
	elseif ($age<=54) {
		$ind=4;}
	elseif ($age<=59) {
		$ind=5;}
	elseif ($age<=64) {
		$ind=6;}
	elseif ($age<=69) {
		$ind=7;}
	elseif ($age<=74) {
		$ind=8;}
	else {
		$ind=9;}
	
	if($gender == 'male') {
		$pinakas=[1,4,4,8,10,13,20,22,25,'Δεν υπάρχουν δεδομένα'];
		return $pinakas[$ind];
	} else {
		$pinakas=['<1','<1',1,2,3,7,8,8,11,'Δεν υπάρχουν δεδομένα'];
		return $pinakas[$ind];
	}
} 

$age = $_POST['age'];
$totalCholesterol = $_POST['tot_chol'];
$hdlCholesterol = $_POST['hdl_chol'];
$systolicBP = $_POST['sbp'];
$treatedBP = $_POST['er1']; // 1 αν λαμβάνει αγωγή, 0 αν όχι
$smoker = $_POST['er2']; // 1 αν καπνίζει, 0 αν όχι
$gender = $_POST['er3'];

$risk = calculateRisk($age, $totalCholesterol, $hdlCholesterol, $systolicBP, $treatedBP, $smoker, $gender);
$risk_2=risk_general($age,$gender); ?>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          
		  <div class="img-box">
            <img src="images/mi_3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/mi_4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/mi_5.jpeg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<h2>Framingham Risk Score για τον κίνδυνο εμφράγματος για μιά 10ετία</h2>
		<h3 style="color: green">Αφορά άτομα 30 έως 74 ετών χωρίς ιστορικό στηθάγχης ή εμφράγματος και χωρίς διαβήτη</h3><br>
<p>Σύμφωνα με τα δεδομένα σας ο κίνδυνος καρδιακού εμφράγματος ή θανάτου για τα επόμενα 10 χρόνια είναι:  <?php echo ($risk * 100);?> %</p><br>
<p> Ο γενικός κίνδυνος για άτομα ίδιας ηλικίας και φύλου για τα επόμενα 10 χρόνια είναι:  <?php echo ($risk_2) ;?> %</p><br>
<p>Ενημερώστε τον καρδιολόγο σας ή τον γιατρό σας για τυχόν λήψη προληπτικής αγωγής</p><br>
<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">Πίσω</a></button><br><br>
</div></div>

<?php include('down.php'); ?>
