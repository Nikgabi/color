<?php include('up.php'); ?>

<head>
	<title>Password Reset</title>
</head>

<div id = container class="layout_padding-bottom"><br><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5 ">
          <div class="img-box">
            <img src="images/slider-img.jpg" alt="">
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
		<form name="reset_form"  action="password_reset_code.php" method="POST" ><br>
			<label ><h2 style="font-weight: bold ;">Reset Password</h2></label><br>
			<label for="email" class="w3-row">E-mail</label><br>
			<input  type="text" name="email" placeholder="Δώστε email" size="30"><br><br>
			
			<button id="submitBtn3" class="w3-btn " type="submit" value="Είσοδος" name="submitBtn3" style="background-color: rgb(162,235,182) ;" >Send Password reset Link</button><br><br>
			
			<br><br>	
		</form>
		</div>
		</div>
		</div>
	</div> 
</section>
</div>

<?php include('down.php'); ?>