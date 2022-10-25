<?php
session_start();
include('actions/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php')?>
<body>
<?php require('includes/navbar.php');

$getMessage = $bdd->prepare('SELECT DISTINCT pseudo_destinataire,id_destinataire FROM messages WHERE id_auteur = ?');
$getMessage->execute(array($_GET['id']));?><br>

<div class = "container"><?php
    while ($displayMessage = $getMessage->fetch()) {
        ?>
          <div class = 'card'>
        
      
        
         <a href="message.php?id=<?=$displayMessage['id_destinataire']?>"><?=$displayMessage['pseudo_destinataire'];?></a><br>
         <?php
         
     }
?>
</div>
</div>
</div>
<?php
$getMessages = $bdd->prepare('SELECT DISTINCT pseudo_auteur,id_auteur FROM messages WHERE id_destinataire = ?');
$getMessages->execute(array($_SESSION['id']));?><br>
<div class = "container"><?php
    while ($displayMessages = $getMessages->fetch()) {
        ?>
          <div class = 'card'>
        
      
        
         <a href="message.php?id=<?=$displayMessages['id_auteur']?>"><?=$displayMessages['pseudo_auteur'];?></a><br><?php
         }
         ?>
         
     
</div>
</div>
</div>


</body>
</html>