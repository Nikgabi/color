<?php include('../up.php'); ?>


    <title>Προσθήκη Χρήστη</title>
    
<body>
<div class="container">
	<div class="row"><br><br><br>
        <div class="col-md-2 "><br><br>
          <div class="img-box"><br><br><br>
            <img src="<?php echo BASE_URL; ?>images/100.jpg" alt="">
          </div>
        </div>
	
		<div class="col-md-10" style="text-align:center;"><br><br>
			<div class="w3-card-4" style="width:80%; background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px; margin: auto; display: block;">
			<h2>Προσθήκη Πληροφοριών Γιατρού</h2> <h4> Δώστε τις απαραίτητες πληροφορίες</h4>
			<p style="color: green;">Εάν δεν συμπληρώσετε πεδίο βάλτε NO DATA</p><br>
			<label for="Name">Ονοματεπώνυμο :</label>
			<input type="text" id="Name" placeholder="Όνομα & Επώνυμο" size="50" required><br>
			<label for="Site">WWW_Site_url :</label>
			<input type="text" id="Site" placeholder="π.χ https://gavalakis.eu" size="50" required><br>
			<label for="Site">Facebook business Link :</label>
			<input type="text" id="Facebook" placeholder="π.χ https://www.facebook.com/nikos.gavalakis/" size="50" required><br>
			<label for="Site">Linkedin Link :</label>
			<input type="text" id="Linkedin" placeholder="π.χ https://www.linkedin.com/in/gavalakis/" size="50" required><br>
			<label for="Site">Doxy room :</label>
			<input type="text" id="Doxy" placeholder="p.x Doxy.me/nikgabi" size="50" required><br>
			<label for="Site">Calendar link :</label>
			<input type="text" id="Calendar" placeholder="π.χ https://calendar.app.google/ogLR2ubS3hy4CQwY9" size="50" required><br>
			<label for="Site">Photo Link σε Cloud shared :</label>
			<input type="text" id="Photo" placeholder="Link από Dropbox , Google Drive , Onedrive shared" size="50" required><br>
			<label for="Site">Βιογραφικό Link σε Cloud shared :</label>
			<input type="text" id="Bio" placeholder="Link από Dropbox , Google Drive , Onedrive shared" size="50" required><br><br>
			<button style="color: green;" onclick="submitData()">Αποθήκευση</button>
			
			<p id="message"></p>

    <script>
				function submitData() {
			let name = document.getElementById("Name").value;
			let site = document.getElementById("Site").value;
			let facebook = document.getElementById("Facebook").value;
			let linkedin = document.getElementById("Linkedin").value;
			let doxy = document.getElementById("Doxy").value;
			let calendar = document.getElementById("Calendar").value;
			let photo = document.getElementById("Photo").value;
			let bio = document.getElementById("Bio").value;

			if (!name || !site || !facebook || !linkedin || !doxy || !calendar || !photo || !bio) {
				document.getElementById("message").innerText = "Συμπληρώστε όλα τα πεδία!";
				return;
			}

			let data = { Name: name, Site: site, Facebook: facebook, Linkedin: linkedin, Doxy: doxy, Calendar: calendar ,Photo: photo, Bio: bio};

			// Στέλνουμε τα δεδομένα (χωρίς να περιμένουμε απάντηση)
			fetch("https://script.google.com/macros/s/AKfycbw5BMtiz4DhEFDJSdTrUJGNe3a3EMfBLhWQyJyDnJ7XkBRcKY--IQClQqSku4UJC001/exec", {
				method: "POST",
				mode: "no-cors",
				headers: { "Content-Type": "application/json" },
				body: JSON.stringify(data)
			})
			.then(() => {
				document.getElementById("message").innerText = "Τα δεδομένα στάλθηκαν! Επιβεβαιώνουμε...";
				
				// Περιμένουμε 2 δευτερόλεπτα και μετά ελέγχουμε αν τα δεδομένα καταχωρήθηκαν
				setTimeout(checkIfSaved, 2000);
			})
			.catch(error => {
				document.getElementById("message").innerText = "Σφάλμα κατά την αποστολή!";
				console.error("Σφάλμα:", error);
			});
		}

		// ✅ Δεύτερο fetch για να δούμε αν τα δεδομένα υπάρχουν στο Google Sheets
		function checkIfSaved() {
			fetch("https://script.google.com/macros/s/AKfycbw5BMtiz4DhEFDJSdTrUJGNe3a3EMfBLhWQyJyDnJ7XkBRcKY--IQClQqSku4UJC001/exec")
			.then(response => response.json())
			.then(data => {
				console.log("Τρέχοντα δεδομένα:", data);

				// Ελέγχουμε αν το όνομα που στείλαμε υπάρχει στη λίστα
				let latestEntry = data[data.length - 1]; // Παίρνουμε την τελευταία εγγραφή
				if (latestEntry && latestEntry.Name === document.getElementById("Name").value) {
					document.getElementById("message").innerText = "✅ Τα δεδομένα αποθηκεύτηκαν επιτυχώς!";
				} else {
					document.getElementById("message").innerText = "⚠ Τα δεδομένα μπορεί να μην αποθηκεύτηκαν!";
				}

				// Καθαρίζουμε τα πεδία
				document.getElementById("Name").value = "";
				document.getElementById("Site").value = "";
				document.getElementById("Facebook").value = "";
				document.getElementById("Linkedin").value = "";
				document.getElementById("Doxy").value = "";
				document.getElementById("Calendar").value = "";
				document.getElementById("Photo").value = "";
				document.getElementById("Bio").value = "";
			})
			.catch(error => {
				document.getElementById("message").innerText = "⚠ Σφάλμα κατά την επιβεβαίωση!";
				console.error("Σφάλμα:", error);
			});
		}
	</script>
	</div>
	</div></div></div>
    <br>
    

</body>
<?php include('../down.php'); ?>
