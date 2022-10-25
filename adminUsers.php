<?php
    require('actions/users/adminUsersAction.php');
   
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?><br>
    <div class="container">
    <?php

$req = $bdd->query('SELECT COUNT(*) AS nbrLignes FROM users');
$data = $req->fetch();
$errorMsg = $data['nbrLignes'].' utilisateur sont inscrit sur le site';
?>
 <div class="container">
    
    <form method="GET">

        <div class="form-group row">

            <div class="col-8">
                <input type="search" name="search" class="form-control" placeholder="Rechercher une question">
            </div>
            <div class="col-4">
                <button class="btn btn-success" type="submit" >Rechercher</button>
            </div>

        </div>
    </form> <br>

<?php if (isset($errorMsg)){
    echo $errorMsg;
}
         while ($displayUsers = $getUsers->fetch()) {
            ?> <div class="container"><br>
             <div class="card">
             <div class="card-body">
             <a href="actions/users/deleteUsersAdmin.php?id=<?= $displayUsers['id']?>"><button type="button" class="btn btn-danger">bannir</button></a>
             <a href="actions/users/alertUsersAdmin.php?id=<?= $displayUsers['id']?>"><button type="button" class="btn btn-warning">avertissement</button></a>  <?= $displayUsers['avertissement'].' avertissement'?><br><br>
                <a href="profile.php?id=<?= $displayUsers['id']?>"><h4>@<?= $displayUsers['pseudo']?></h4></a><br>
                 Prénom : <?=$displayUsers['prenom']?><br>
                 Nom : <?=$displayUsers['nom'];?><br>
                 </div>
                 </div>
                 </div>
                <?php
          }
        
          
          ?>
 

</body>
</html>