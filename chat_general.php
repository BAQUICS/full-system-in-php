<?php
session_start();
require_once 'actions/database.php'
?>
<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php');
?>
<body>
<?php
require ('includes/navbar.php');
?>
   <div style="text-align:center">
<br>
<form  method="post">
    <textarea name="chat_general" cols="100" rows="5"></textarea><br><br>
    <input type="submit" class="btn btn-primary btn-sm" value="envoyez" name="validate">
</form>
    </div>
    <?php
    if (isset($_POST['validate'])) {
      if (!empty($_POST['chat_general'])) {
        $message = nl2br(htmlspecialchars($_POST['chat_general']));

        $InsertMessage = $bdd->prepare('INSERT INTO chat_general(pseudo,message,id_auteur)VALUES(?,?,?)');
        $InsertMessage->execute(array($_SESSION['pseudo'],$message,$_SESSION['id']));
      }
    }
$GetChatSend = $bdd->prepare('SELECT * FROM chat_general ORDER BY id DESC');
$GetChatSend->execute(array());

while($DisplayMessage = $GetChatSend->fetch()){
    if ($DisplayMessage['id_auteur'] == $_SESSION['id']) {
       
    
        ?>
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
          <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="green" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#3bbaff;"></rect></svg>
            <a href="profile.php?id=<?=$DisplayMessage['id_auteur']?>"><strong class="me-auto"><?=$DisplayMessage['pseudo']?></strong></a>
            <small></small>
          </div>
          <div class="toast-body">
  <?=$DisplayMessage['message'] ?>     
  
  </div>
        </div><br>
    <?php
    }else {
        ?>
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
              <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="red" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#3bbaff;"></rect></svg>
              <a href="profile.php?id=<?=$DisplayMessage['id_auteur']?>"><strong class="me-auto"><?=$DisplayMessage['pseudo']?></strong></a><small></small>
              </div>
              <div class="toast-body">
      <?=$DisplayMessage['message'] ?>     
      
      </div>
            </div><br><?php
    }
}
?>
</section>
</body>
</html>