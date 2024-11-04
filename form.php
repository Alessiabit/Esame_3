<?php
// Connessione al database
include 'login/db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera e valida i dati inviati dal form
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $messaggio = trim($_POST['messaggio']);

    // Verifica che i campi siano validi
    if (empty($nome) || !preg_match("/^[a-zA-Z\s]+$/", $nome)) {
        echo "Il nome deve contenere solo lettere e spazi.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Inserisci un indirizzo email valido.";
    } elseif (empty($telefono) || !preg_match("/^\d{10}$/", $telefono)) {
        echo "Il numero di telefono deve essere composto da 10 cifre.";
    } elseif (empty($messaggio) || strlen($messaggio) < 10) {
        echo "Il messaggio deve contenere almeno 10 caratteri.";
    } else {
        
        $query = "INSERT INTO utenti (nome, email, telefono, messaggio) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $nome, $email, $telefono, $messaggio);

        if ($stmt->execute()) {
            echo "Dati inviati con successo!";
        } else {
            echo "Errore nell'invio dei dati: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/form.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <form class="form" method="post" action="form.php" onsubmit="return validateForm()">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required pattern="[a-zA-Z\s]+" title="Inserisci solo lettere e spazi.">


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefono">Telefono:</label>
            <input type="tel" id="telefono" name="telefono" required pattern="\d{10}" title="Inserisci un numero di telefono valido di 10 cifre.">

            <label for="messaggio">Messaggio:</label>
            <textarea id="messaggio" name="messaggio" required minlength="10" title="Il messaggio deve contenere almeno 10 caratteri."></textarea>
            
            <input type="submit" value="Invia">
        </form>
    </div>
    <script>
function validateForm() {
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;
    const messaggio = document.getElementById('messaggio').value;

    const nomePattern = /^[a-zA-Z\s]+$/;
    const telefonoPattern = /^\d{10}$/;

    if (!nomePattern.test(nome)) {
        alert("Il nome deve contenere solo lettere e spazi.");
        return false;
    }
    if (!telefonoPattern.test(telefono)) {
        alert("Il numero di telefono deve essere composto da 10 cifre.");
        return false;
    }
    if (messaggio.length < 10) {
        alert("Il messaggio deve contenere almeno 10 caratteri.");
        return false;
    }

    return true;
}
</script>
    <?php
    if (!empty($success)) {
        echo "<p class='success'>$success</p>";
    }
    ?>
</body>
</html>
