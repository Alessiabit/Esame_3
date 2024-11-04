<?php
session_start();
require 'login/db.php'; // connessione al database

// ottenere i dati della pagina dal database
function get_page_data($page) {
    global $conn; // usa la connessione al database

    $stmt = $conn->prepare("SELECT * FROM pages WHERE page_name = ?");
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se ci sono risultati ritorna i dati della pagina
        return $result->fetch_assoc();
    } else {
        // Se la pagina non è trovata restituisci un messaggio di errore
        return [
            'title' => 'Pagina non trovata',
            'paragrafo' => 'Spiacenti, la pagina che stai cercando non esiste.',
           
        ];
    }
}

// Imposta la pagina
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Ottengo i dati della pagina dal database
$page_data = get_page_data($page);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <link href="style/footer.css" rel="stylesheet" type="text/css">
    <link href="style/menu.css" rel="stylesheet" type="text/css">
    <link href="style/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title><?php echo htmlspecialchars($page_data['title']); ?></title>
</head>
<style>

.sfondo {
  background: url(img/sfondo.jpg) no-repeat center center/cover;
  height: 1000px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  text-align: center;
}
.testo {
  font-size: 60px;
  text-align: left;
  margin-top: -100px;
  
  
  
}
.testo1 {
  font-size: 20px;
  padding: 5px;
  height: 20px;
  margin-top: 100px;
  background-color: violet;
  border-radius: 20px;
  
}
.testo2 {
    max-width: 600px; 
    margin-top: 100px;
    margin-left: 0; 
    margin-right: auto; 
    padding: 10px; 
    font-size: 18px; 
    line-height: 1.5; 
    color: white; 
}
.contenitore {
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    max-width: 600px; 
    margin: 0 auto; 
}

section {
    background: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 5px;

}

.skills-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 16px;
    justify-content: center;
    max-width: 800px;
    margin: 0 auto;
    
}

.skill {
    background: #007BFF;
    color: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    transition: background 0.3s, transform 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}


.skill i{
    font-size: 50px;
}
.skill:hover {
    background: #0056b3;
    transform: translateY(-5px);
}
 
  
    .container1{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 20px;
        margin-top: 100px;
        
    }
    
    .project1 h2{
        color: #000000;
    }
    .project1 p{
        color: #000000;
    }
  
  
    .project1{
       
        padding: 5px;
        border-radius: 30px;
        width: 300px;
        text-align: center;
        transition: transform 0.3s;
       
        
    }
    .project1:hover{
        transform: translateY(-10px);
    }
    .project1 img{
    
        display: flex;
        width: 100%;
        flex-direction: row;
        align-items: center;
        border-radius: 50px;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
  

    .project h2{
        color: #000000;
    }
    .project p{
        color: #000000;
    }

  
  
   

    @media (max-width: 768px) {
        .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: white;
        
    }
    .container1{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: white;
        
    }
    .skills-container{
        grid-template-columns: 1fr;
    }
    .testo{
        order: 1;
        margin-top: 10px;
        text-align: center;

    }
    }
 
      
</style>
<body>

    <?php include 'menu.php'; ?>
    <section class="sfondo">
        <div class="contenitore">
            <div>
                <h1 class="testo"><?php echo htmlspecialchars($page_data['paragrafo']); ?></h1>
            </div>
            <div>
                <h3 class="testo1"><?php echo htmlspecialchars($page_data['conten1']); ?></h3>
            </div>
            <div>
                <p class="testo2"><?php echo htmlspecialchars($page_data['contenuto']); ?></p>
            </div>
        </div>
    </section>

    <div class="profilo">
        <h2>IL MONDO DELLA GRAFICA</h2>
        <p><?php echo htmlspecialchars($page_data['graf']); ?></p>
        <div class="immag">
            <img src="img/graf.png" alt="graf">
        </div>
        <div class="profilo1">
            <h2>IL MONDO DEL WEB</h2>
            <p><?php echo htmlspecialchars($page_data['web']); ?></p>
            <div class="immag2">
                <img src="img/web.png" alt="graf">
            </div>
        </div>

        <section>
            <h2>Skills</h2>
            <div class="skills-container">
                <div class="skill"><i class="fas fa-paint-brush"></i> Adobe Illustrator</div>
                <div class="skill"><i class="fas fa-image"></i> Adobe Photoshop</div>
                <div class="skill"><i class="fas fa-book-open"></i> Adobe InDesign</div>
                <div class="skill"><i class="fas fa-code"></i> HTML</div>
                <div class="skill"><i class="fab fa-css3-alt"></i> CSS</div>
                <div class="skill js"><i class="fab fa-js-square"></i> JavaScript</div>
                <div class="skill"><i class="fas fa-database"></i> PHP</div>
                <div class="skill"><i class="fas fa-paint-brush"></i> UI/UX Design</div>
            </div>
        </section>

        <div class="container">
            <div class="project">
                <img src="img/avvocato.jpg" alt="progetto1">
                <h2>SEGRETARIA</h2>
                <p><?php echo htmlspecialchars($page_data['seg']); ?></p>
            </div>
            <div class="project">
                <img src="img/giornalista.jpg" alt="progetto2">
                <h2>GRAPHIC DESIGNER</h2>
                <p><?php echo htmlspecialchars($page_data['gd']); ?></p>
            </div>
            <div class="project">
                <img src="img/webdesigner.jpg" alt="progetto3">
                <h2>WEB DESIGNER</h2>
                <p><?php echo htmlspecialchars($page_data['wd']); ?></p>
            </div>
        </div>

        <div class="container1">
            <div class="project1">
                   <img src="img/service.jpg" alt="service1">
                     <h2>INFO</h2>
                     <p><?php echo $page_data['info']; ?></p>
                 </div>
                 <div class="project1">
                    <img src="img/service2.jpg" alt="service2">
                     <h2>GRAFICA</h2>
                     <p><?php echo $page_data['info']; ?></p>
                 </div>
                 <div class="project1">
                     <img src="img/service3.jpg" alt="service3">
                     <h2>CONSULENZA</h2>
                     <p><?php echo $page_data['info']; ?></p>
                 </div>
                 <div class="project1">
                    <img src="img/service4.jpg" alt="service4">
                    <h2>DESIGN</h2>
                    <p><?php echo $page_data['info']; ?></p>
                </div>
            </div>
    
   
           

<hr>
<?php require ("footer.php");
         ?>
</body>

</html>
