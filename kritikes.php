<?php
include('up.php');
?>
<div id = container class="layout_padding-bottom"><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/treatment-side-img.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
<?php
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$query="SELECT * FROM kritiki_data WHERE mail= '$email' ";
$query_run = mysqli_query($con,$query);
	
if ($query_run && mysqli_num_rows($query_run)>0) {
	$query1='SELECT * FROM kritiki_data ';
	$query1_run = mysqli_query($con,$query1);
	if($query1_run && mysqli_num_rows($query1_run)>0){
		echo "<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr>
            <th>Ημερομηνία</th>
            <th>Email</th>
            <th>Κριτική</th>
          </tr>";

    // Δημιουργία γραμμών για κάθε ασθενή
    while ($row = mysqli_fetch_assoc($query1_run)) {
        
        $email = htmlspecialchars($row['mail'], ENT_QUOTES, 'UTF-8');
		$kritiki = htmlspecialchars($row['kritiki'], ENT_QUOTES, 'UTF-8');
		echo "<h2 style='color:green;'>Οι κριτικές σας για το YgeiaFirst</h2><br>";
        echo "<tr>
                <td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>
                <td>$email</td>
                <td>$kritiki</td>
				</td>
              </tr>";
	}
	echo "</table><br>";
	echo "<button style='background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>";
    echo  '<a href="index.php" style="text-decoration: none; color: black;">Home</a>';
    echo   '</button><br><br>';
	
	echo "<p style='color:green;'>Είμαστε ανοικτοί στις απόψεις και κατά της λογοκρισίας.</p>";
	echo "<p style='color:red;'>Οι βλάστημες και απρεπείς κριτικές όμως θα διαγράφονται.</p>";
}else{
	echo "<p>Πρέπει να έχετε γράψει κριτική για να τις δείτε όλες.</p>";
	
}


}

?>
</div>
			</div>
	</div> 
</section>
</div>

<?php
include('down.php');
?>