<?php include('up.php'); ?>

<head>
	<title>Testimonials</title>
	<link rel="stylesheet" href="styles.css"> <!-- Σύνδεση με το CSS αρχείο -->
</head>

<body>
<!-- Testimonials Section -->
<section class="testimonials_section layout_padding layout_padding-bottom">
	<div class="container">
		<h1>Testimonials</h1>
		<p>Προσθέστε τη δική σας γνώμη παρακάτω:</p>
		
		<!-- Φόρμα για προσθήκη γνώμης -->
		<form action="submit_testimonial.php" method="POST" class="testimonial-form">
			<label for="name">Όνομα:</label>
			<input type="text" id="name" name="name" placeholder="Το όνομά σας" required>

			<label for="opinion">Η γνώμη σας:</label>
			<textarea id="opinion" name="opinion" placeholder="Γράψτε τη γνώμη σας εδώ..." rows="4" required></textarea>
			
			<button type="submit">Υποβολή</button>
		</form>

		<hr>

		<!-- Εμφάνιση όλων των γνώμεων -->
		<div class="testimonials-container">
			<?php
			// Παράδειγμα δεδομένων (μπορεί να αντικατασταθεί με βάση δεδομένων)
			$testimonials = [
				[
					'name' => 'Σάββας Παπαγρηγοριάδης',
					'opinion' => 'Εξαιρετική εμπειρία! Θα το πρότεινα ανεπιφύλακτα.'
				],
				[
					'name' => 'Νίκος Γαβαλάκης',
					'opinion' => 'Πολύ καλή εξυπηρέτηση και άμεση ανταπόκριση.'
				],
				[
					'name' => 'Θεοφανώ Παναγέα',
					'opinion' => 'Μου άρεσε ιδιαίτερα η φιλική ατμόσφαιρα.'
				]
			];

			// Εμφάνιση γνώμεων
			foreach ($testimonials as $testimonial) {
				echo '<div class="testimonial">';
				echo '<h2>"' . htmlspecialchars($testimonial['name']) . '"</h2>';
				echo '<p>' . htmlspecialchars($testimonial['opinion']) . '</p>';
				echo '</div>';
			}
			?>
		</div>
	</div>
</section>

<?php include('down.php'); ?>
</body>
