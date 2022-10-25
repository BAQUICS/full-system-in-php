<?php 
session_start();
include('actions/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php');?>
<body>
<?php require('includes/navbar.php');?><br>

<div style="text-align:center">
message :<br>
<form method = "POST">
<textarea name="message" cols="100" rows="5"></textarea><br><br>
<input type="submit" class="btn btn-primary btn-sm" name="validate" value="Envoyez">
</form>
</div>
<?php 

$getPseudoDestinataire = $bdd->prepare("SELECT pseudo FROM users WHERE id = ?");
$getPseudoDestinataire->execute(array($_GET['id']));


$Pseudo = $getPseudoDestinataire->fetch();

$displayPseudo = $Pseudo['pseudo'];
if (isset($_POST['validate'])) {

   if (!empty($_POST['message'])){

    $message = nl2br(htmlspecialchars($_POST['message']));
    

    $insertMessage = $bdd->prepare('INSERT INTO messages(message,id_destinataire, id_auteur,pseudo_auteur,pseudo_destinataire)VALUES(?, ?, ?, ?, ?)');
    $insertMessage->execute(array($message,$_GET['id'],$_SESSION['id'],$_SESSION['pseudo'],$displayPseudo));
   }else {

       echo "Aucun message n'a été rentrez";
   }
}

$getMessage = $bdd->prepare('SELECT id,message,pseudo_auteur,id_destinataire FROM messages WHERE id_destinataire AND id_auteur  ORDER BY id ASC');
$getMessage->execute(array($_GET['id'],$_SESSION['id']));

while($message = $getMessage->fetch()){
    if ($message['id_destinataire'] == $_SESSION['id']) {
      ?>
  <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="red" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#3bbaff;"></rect></svg>
          <strong class="me-auto"><?=$message['pseudo_auteur']?></strong>
          <small></small>
        </div>
        <div class="toast-body">
<?=$message['message'] ?>     

</div>
      </div><br><br>
      <?php
    }elseif ($message['id_destinataire'] == $_GET['id']){
        ?>   <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="green" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#3bbaff;"></rect></svg>
          <strong class="me-auto"><?=$message['pseudo_auteur']?></strong>
          <small></small>
          <a href="deleteMessage.php?id=<?=$message['id']?>"><button type="button" class="btn-close" data-bs-dismiss="toast" ></button></a>
        </div>
        <div class="toast-body">
<?=$message['message'] ?>     

</div>
      </div><br><br>
      <?php
    }   
}
?>