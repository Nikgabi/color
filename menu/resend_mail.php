<?php include('../up.php'); ?>
<head>
	<title>Resend Mail Form</title>
</head>

<div id = container class="layout_padding-bottom"><br><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/slider-img.jpg" alt="">
          </div>
        </div>
		<div class="col-md-7 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240);">
		<?php
			if(isset($_SESSION['status'])){
				?>
			<h3 style="color:red"><?= $_SESSION['status']; ?></h3>';
			<?php 
				unset($_SESSION['status']);	
			}
		?>	

		<form name="resend_mail_form"  action="<?php echo BASE_URL; ?>resend_mail_code.php" method="POST" ><br>
			<label ><h2 style="font-weight: bold ;">Πληκτρολόγησε το mail σου</h2></label><br>
			<label for="email" class="w3-row">E-mail</label><br>
			<input  type="text" name="email" placeholder="Δώστε email" size="30"><br><br>
			
			
			
			<button id="submitBtn2" class="w3-btn " type="submit" value="resend" name="submitBtn2" style="background-color: rgb(162,235,182) ;" >Resend mail</button><br><br>
			
			
		</form>
		</div>
		</div>
	</div>
	</div>
</section>
</div>

<?php include('../down.php'); ?>