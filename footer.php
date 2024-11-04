<?php
$year = date("Y"); 
$nome = "Piacentino Alessia";
$email = "alessia.piacentino@gmail.com";
$telefono = "3496597310";
$indirizzo = "Via Corso Francia Frosinone 03100";
$partitaIva = "8469743934873";
$copyright = "Copyright 1999/56";
?>

<footer>
    <p>&copy; <?php echo $year; ?> <?php echo $nome; ?>. Tutti i diritti riservati.</p> 
    <a href="mailto:<?php echo $email; ?>">Email: <?php echo $email; ?></a><br>
    <a href="tel:<?php echo $telefono; ?>">Telefono: <?php echo $telefono; ?></a><br>
    <a href="" title="privacy">Privacy Policy</a>
    <p>
        <?php echo $indirizzo; ?><br> 
        Partita Iva: <?php echo $partitaIva; ?><br> 
        <?php echo $copyright; ?>
    </p>
</footer>
