<?php
session_start();
require 'login/db.php'; // connessione al database

// ottenere i dati della pagina dal database
function get_page_data($page) {
    global $conn; // Usa la connessione al database dal file db.php

    // Prepara la query SQL per recuperare i dati della pagina
    $stmt = $conn->prepare("SELECT * FROM pages WHERE page_name = ?");
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se ci sono risultati, ritorna i dati della pagina
        return $result->fetch_assoc();
    } else {
        // Se la pagina non è trovata, restituisci un messaggio di errore
        return [
            'title' => 'Pagina non trovata',
            'primo' => 'Spiacenti, la pagina che stai cercando non esiste.',
        ];
    }
}

// Imposta la pagina
$page = isset($_GET['page']) ? $_GET['page'] : 'aboutme';

// Ottieni i dati della pagina dal database
$page_data = get_page_data($page);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <link href="style/main.css" rel="stylesheet" type="text/css">
    <link href="style/menu.css" rel="stylesheet" type="text/css">
    <link href="style/form.css" rel="stylesheet" type="text/css">
    <link href="style/footer.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>AboutMe</title>
    <style>
        .sfondo {
            background: url(img/sfondo.jpg) no-repeat center center/cover;
            height: 400px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .testo {
            font-size: 20px;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<header>
    <?php require 'menu.php'; ?>
</header>

<section class="sfondo">
    <div class="testo">
        <h1>Benvenuto!</h1>
        <p><?php echo htmlspecialchars($page_data['paragrafo']); ?></p>
    </div>
</section>

<div class="profilo">
    <h2>CHI SONO</h2>
</div>

<div class="container">
    <!-- Primo progetto -->
    <div class="project">
        <img src="img/grap.jpg" alt="portfolio">
        <h3>ABOUT ME</h3>
        <p><?php echo htmlspecialchars($page_data['conten1']); ?></p>
    </div>
    
    <!-- Secondo progetto -->
    <div class="project">
        <img src="img/webdesigner.jpg" alt="portfolio">
        <h3>ABOUT ME</h3>
        <p><?php echo htmlspecialchars($page_data['contenuto']); ?></p>
    </div>
    
    <!-- Terzo progetto -->
    <div class="project">
        <img src="img/hobbi1.jpg" alt="hobbi">
        <h3>HOBBIE</h3>
        <p><?php echo htmlspecialchars($page_data['hobbi1']); ?></p>
    </div>

    <!-- Quarto progetto -->
    <div class="project">
        <img src="img/hobbi2.jpg" alt="portfolio">
        <h3>HOBBIE</h3>
        <p><?php echo htmlspecialchars($page_data['hobbi2']); ?></p>
    </div>
</div>

<?php include 'form.php'; ?>

<hr>
<?php require 'footer.php'; ?>

</body>
</html>
