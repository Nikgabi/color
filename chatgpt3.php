<?php include('up.php'); ?>

<head>
    <title>ChatGPT Ιατρικές Ερωτήσεις</title>
</head>

<div id="container" class="layout_padding-bottom">
    <section class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="img-box">
                        <img src="images/chatgpt.jpg" alt="">
                    </div><br>
                    <div class="img-box">
                        <img src="images/chatgpt1.jpg" alt="">
                    </div><br>
                    
                </div>
                <div class="col-md-9">
                    <div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
                        <h2 style="font-weight: bold; text-align: center;">Ιατρική Ερώτηση προς το ChatGPT</h2>
						<?php   
						if (!isset($_SESSION['email'])) {
							echo '<h2 style="color: red">Πρέπει να έχετε κάνει πρώτα εγγραφή για αυτήν την σελίδα </h2>';
						}  else  { ?>
						
								<form name="gnomat" action="" method="POST" style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
									<div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
										<label for="er1" style="font-weight: bold;">Ερώτηση:</label>
										<textarea rows="3" cols="100" name="er1" style="width: 100%; max-width: 800px; padding: 8px;"></textarea>
									</div>

									<label for="er2" style="font-weight: bold;">Απάντηση</label>
									<textarea rows="5" cols="100" name="er2" style="width: 100%; max-width: 800px; padding: 8px;"><?php
										if (isset($_POST['submit']) && !empty($_POST['er1'])) {
											$question = htmlspecialchars($_POST['er1']);

											// Κλήση στο API του ChatGPT
											$api_url = "https://api.openai.com/v1/chat/completions";
											$api_key = ""; // Βάλε το δικό σου API key

											$data = [
												"model" => "gpt-4",
												"messages" => [
													["role" => "system", "content" => "Απαντάς μόνο σε ιατρικές ερωτήσεις."],
													["role" => "user", "content" => $question]
												],
												"temperature" => 0.7
											];

											$headers = [
												"Content-Type: application/json",
												"Authorization: Bearer " . $api_key
											];

											$ch = curl_init();
											curl_setopt($ch, CURLOPT_URL, $api_url);
											curl_setopt($ch, CURLOPT_POST, true);
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

											$response = curl_exec($ch);
											curl_close($ch);

											$response_data = json_decode($response, true);
											if (isset($response_data["choices"][0]["message"]["content"])) {
												echo htmlspecialchars($response_data["choices"][0]["message"]["content"]);
											} else {
												echo "Αυτή η υπηρεσία κοστίζει δυστυχώς. Η σελίδα θα λειτουργήσει κανονικά στην παρουσίαση της πτυχιακής .";
												echo "Δές ένα ποίημα του Καβάφη τώρα.
			— Τι περιμένουμε στην αγορά συναθροισμένοι;

			Είναι οι βάρβαροι να φθάσουν σήμερα.

			— Γιατί μέσα στην Σύγκλητο μια τέτοια απραξία;
			Τι κάθοντ’ οι Συγκλητικοί και δεν νομοθετούνε;

			Γιατί οι βάρβαροι θα φθάσουν σήμερα.
			Τι νόμους πια θα κάμουν οι Συγκλητικοί;
			Οι βάρβαροι σαν έλθουν θα νομοθετήσουν.


			—Γιατί ο αυτοκράτωρ μας τόσο πρωί σηκώθη,
			και κάθεται στης πόλεως την πιο μεγάλη πύλη
			στον θρόνο επάνω, επίσημος, φορώντας την κορώνα;

			Γιατί οι βάρβαροι θα φθάσουν σήμερα.
			Κι ο αυτοκράτωρ περιμένει να δεχθεί
			τον αρχηγό τους. Μάλιστα ετοίμασε
			για να τον δώσει μια περγαμηνή. Εκεί
			τον έγραψε τίτλους πολλούς κι ονόματα.


			— Γιατί οι δυο μας ύπατοι κ’ οι πραίτορες εβγήκαν
			σήμερα με τες κόκκινες, τες κεντημένες τόγες·
			γιατί βραχιόλια φόρεσαν με τόσους αμεθύστους,
			και δαχτυλίδια με λαμπρά, γυαλιστερά σμαράγδια·
			γιατί να πιάσουν σήμερα πολύτιμα μπαστούνια
			μ’ ασήμια και μαλάματα έκτακτα σκαλιγμένα;

			Γιατί οι βάρβαροι θα φθάσουν σήμερα·
			και τέτοια πράγματα θαμπώνουν τους βαρβάρους.


			—Γιατί κ’ οι άξιοι ρήτορες δεν έρχονται σαν πάντα
			να βγάλουνε τους λόγους τους, να πούνε τα δικά τους;

			Γιατί οι βάρβαροι θα φθάσουν σήμερα·
			κι αυτοί βαρυούντ’ ευφράδειες και δημηγορίες.

			— Γιατί ν’ αρχίσει μονομιάς αυτή η ανησυχία
			κ’ η σύγχυσις. (Τα πρόσωπα τι σοβαρά που εγίναν).
			Γιατί αδειάζουν γρήγορα οι δρόμοι κ’ η πλατέες,
			κι όλοι γυρνούν στα σπίτια τους πολύ συλλογισμένοι;

			Γιατί ενύχτωσε κ’ οι βάρβαροι δεν ήλθαν.
			Και μερικοί έφθασαν απ’ τα σύνορα,
			και είπανε πως βάρβαροι πια δεν υπάρχουν.

			__

			Και τώρα τι θα γένουμε χωρίς βαρβάρους.
			Οι άνθρωποι αυτοί ήσαν μια κάποια λύσις. 


			Κωνσταντίνος Καβάφης";
												
											}
										}
									?></textarea>

									<div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
										<input type="submit" name="submit" value="Ερώτηση" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
										<button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
											<a href="calculation.php" style="text-decoration: none; color: black;">Πίσω</a>
										</button>
									</div>
								</form> <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('down.php'); ?>
