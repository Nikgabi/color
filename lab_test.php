<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Καταγραφή Βιοχημικών & Αιματολογικών Εξετάσεων</title>
    <style>
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form action="save_lab_tests.php" method="POST">
        <h2>Καταγραφή Εξετάσεων</h2>
        
        <label for="test_date">Ημερομηνία Εξέτασης:</label>
        <input type="date" name="test_date" required>

        <label for="glucose">Γλυκόζη (mg/dL):</label>
        <input type="number" step="0.1" name="glucose">

        <label for="cholesterol">Χοληστερόλη (mg/dL):</label>
        <input type="number" step="0.1" name="cholesterol">

        <label for="triglycerides">Τριγλυκερίδια (mg/dL):</label>
        <input type="number" step="0.1" name="triglycerides">

        <label for="hemoglobin">Αιμοσφαιρίνη (g/dL):</label>
        <input type="number" step="0.1" name="hemoglobin">

        <label for="hematocrit">Αιματοκρίτης (%):</label>
        <input type="number" step="0.1" name="hematocrit">

        <label for="white_blood_cells">Λευκά Αιμοσφαίρια (x10^3/μL):</label>
        <input type="number" step="0.1" name="white_blood_cells">

        <label for="platelets">Αιμοπετάλια (x10^3/μL):</label>
        <input type="number" step="0.1" name="platelets">

        <label for="creatinine">Κρεατινίνη (mg/dL):</label>
        <input type="number" step="0.1" name="creatinine">

        <label for="urea">Ουρία (mg/dL):</label>
        <input type="number" step="0.1" name="urea">

        <label for="ggt">ΓGT (U/L):</label>
        <input type="number" step="0.1" name="ggt">

        <label for="notes">Σημειώσεις:</label>
        <textarea name="notes" rows="4"></textarea>

        <button type="submit">Καταχώρηση</button>
    </form>
</body>
</html>
