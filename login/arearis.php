<?php
session_start();
require 'db.php';

// Verifica se l'utente è autenticato
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Recupero dati dalla tabella `utenti`
$usersStmt = $conn->query("SELECT * FROM utenti");
$users = $usersStmt->fetch_all(MYSQLI_ASSOC);

// Recupero dati dalla tabella `pages`
$pagesStmt = $conn->query("SELECT * FROM pages");
$pages = $pagesStmt->fetch_all(MYSQLI_ASSOC);

// Recupero dati dalla tabella `projects`
$projectsStmt = $conn->query("SELECT * FROM projects");
$projects = $projectsStmt->fetch_all(MYSQLI_ASSOC);

$conn->close(); // Chiudi la connessione al database
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="arearis.css" rel="stylesheet" type="text/css">
    <title>Area Riservata</title>
</head>
<body>
    <div class="container">
        <div class="welcome-message">
            <h2>Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
            <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
        </div>

        <!-- Sezione Utenti -->
        <div class="actions-container">
            <h3>Utenti</h3>
            <a href="adduser.php" class="action-link add-link">Aggiungi Utente</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Messaggio</th>
                <th>Azioni</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['nome']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($user['messaggio']); ?></td>
                    <td>
                        <a href="moduser.php?id=<?php echo $user['id']; ?>" class="action-link">Modifica</a>
                        <a href="eliminauser.php?id=<?php echo $user['id']; ?>" class="action-link delete-link">Elimina</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Sezione Pagine -->
        <div class="actions-container">
            <h3>Pagine</h3>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome Pagina</th>
                <th>Titolo</th>
                <th>Contenuto</th>
                <th>Contenuto</th>
                <th></th>
                <th>Hobbi</th>
                <th>Info</th>
                <th>Azioni</th>
            </tr>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?php echo htmlspecialchars($page['id']); ?></td>
                    <td><?php echo htmlspecialchars($page['page_name']); ?></td>
                    <td><?php echo htmlspecialchars($page['paragrafo']); ?></td>
                    <td><?php echo htmlspecialchars($page['contenuto']); ?></td>
                    <td><?php echo htmlspecialchars($page['conten1']); ?></td>
                    <td><?php echo htmlspecialchars($page['hobbi1']); ?></td>
                    <td><?php echo htmlspecialchars($page['hobbi2']); ?></td>
                    <td><?php echo htmlspecialchars($page['info']); ?></td>
                    <td>
                        <a href="modpage.php?id=<?php echo $page['id']; ?>" class="action-link">Modifica</a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Sezione Progetti -->
        <div class="actions-container">
            <h3>Progetti</h3>
            <a href="addproject.php" class="action-link add-link">Aggiungi Progetto</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Descrizione</th>
                <th>Immagine</th>
                <th>Azioni</th>
            </tr>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['id']); ?></td>
                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                    <td><?php echo htmlspecialchars($project['description']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($project['image']); ?>" alt="Immagine Progetto"></td>
                    <td>
                        <a href="modproject.php?id=<?php echo $project['id']; ?>" class="action-link">Modifica</a>
                        <a href="eliminaproject.php?id=<?php echo $project['id']; ?>" class="action-link delete-link">Elimina</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

