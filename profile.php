

<?php

 require('actions/users/showArticleOnProfile.php'); ?>

<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php');?>
<body>
<?php require('includes/navbar.php');?><br>
<div class="container">
<?php

$req = $bdd->prepare('SELECT COUNT(*) AS nbrLignes FROM questions WHERE id_auteur = ?');
$req->execute(array($_GET['id']));
$data = $req->fetch();
echo  'cette utilisateur a publier '.$data['nbrLignes'].' questions';

$follow = $bdd->prepare('SELECT COUNT(*) AS followNbr FROM follow WHERE id_following = ?');
$follow->execute(array($_GET['id']));
$follower = $follow->fetch();
$followMsg =  $follower['followNbr'].' followers';

$getFollow = $bdd->prepare('SELECT * FROM follow WHERE id_follower = ? AND id_following = ?');
$getFollow->execute(array($_SESSION['id'],$_GET['id']));

$displayFollow = $getFollow->fetch();


?> 
<?php $usersInfo = $Info->fetch();
if (isset($usersInfo['nom'])) {
    ?><div class="container"><br>
    <div class="card">
    <div class="card-body">
        
        <?php
        
    
            
        
        if ($_SESSION['id'] !== $_GET['id']) {
         if ($getFollow->rowCount() > 0) {
            ?><a href="actions/users/followAction.php?id=<?=$usersInfo['id']?>"><button type="button" class="btn btn-info">ne plus suivre</button></a><?php
         }else{
    
           ?><a href="actions/users/followAction.php?id=<?=$usersInfo['id']?>"><button type="button" class="btn btn-info">Suivre</button></a><?php
            
         }
        }
    ?>
        <h4>@<?= $usersInfo['pseudo']?></h4>
      
            <a href="AllFollowers.php?id=<?=$usersInfo['id']?>"><?=$followMsg;?></a><br><br>
      
        <?php
       if ($_GET['id'] == $_SESSION['id']) {
       
        if ($usersInfo['avertissement'] > 0) {
        ?><?= 'attention vous avez '.$usersInfo['avertissement'].' avertissement a partir de 3 vous etes ban !';?><br><?php
        }
    }?>
        Prénom : <?=$usersInfo['prenom']?><br>
        Nom : <?=$usersInfo['nom'];?><br><br>
        <?php if ($_GET['id'] !== $_SESSION['id']) {
?><a href="message.php?id=<?=$usersInfo['id'] ?>"><button type="button" class="btn btn-primary btn-sm">Envoyez un message</button></a><?php
        }else {      
            ?><a href="edit-profile.php?id=<?= $_SESSION['id']?>">modifier mon profile</a>
            <?php
        
    }?>
        </div>
        
    </div>
    <?php
}else {
    $errorMsg = "cette utilisateur n'existe pas";
}
?>

<?php 
while ($Question = $getHisQuestion->fetch()) {
    ?>
    <div class="container"><br>
                    <a href="article.php?id=<?=$Question['id']?>"><h3><?=$Question['titre']; ?></h3></a>
                    <hr>
                    <p><?= $Question['description'] ?></p>
                    <hr>
                    <small><?= $Question['date_publication']; ?></small>
                
                <br>
              
<?php
}

    ?><br>
    <?php if (isset($errorMsg)) {
        echo $errorMsg;
    }
    ?>
   

</body>
</html>