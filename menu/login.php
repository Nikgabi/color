<?php include('../up.php'); ?>

<head>
	<title>Login Page</title>
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

		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<?php
			if(isset($_SESSION['status'])){
				?>
			<h3 style="color:red"><?= $_SESSION['status']; ?></h3>';
			<?php 
				unset($_SESSION['status']);	
			}
		?>	
		<form name="login_form"  action="<?php echo BASE_URL; ?>login_code.php" method="POST" >
			<label ><h2 style="font-weight: bold ;">Είσοδος</h2></label>
			<label for="email" class="w3-row">E-mail</label>
			<input  type="text" name="email" placeholder="Δώστε email" size="30"><br>
			<label  for="password">Κωδικός πρόσβασης</label>
			<input  type="password" name="password" placeholder="Δώστε password"><br>
			<button id="submitBtn1" class="w3-btn " type="submit" value="Είσοδος" name="submitBtn1" style="background-color: rgb(162,235,182) ;" >Είσοδος</button><br>
			<a style="color:blue;" href="<?php echo BASE_URL; ?>menu/password_reset.php">Forgot Password ?</a><br>
			<p>Δεν πήρες το mail επιβεβαίωσης ?</p><a style="color:red;" href="<?php echo BASE_URL; ?>menu/resend_mail.php">Resent verification mail</a>	
		</form>
		</div>
		</div>
		</div>
	</div> 
</section>
</div>

<?php include('../down.php'); ?>