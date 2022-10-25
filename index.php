<?php 
    
    require('actions/users/securityAction.php');
    require('actions/questions/showAllQuestionsAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br><?php

$req = $bdd->query('SELECT COUNT(*) AS nbrLignes FROM questions');
$data = $req->fetch();
$errorMsg = $data['nbrLignes'].' question a été publier';

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
        </form>

        <br>
<?php if (isset($errorMsg)) {
    echo $errorMsg;
}?>
        <?php 
            while($question = $getAllQuestions->fetch()){
                ?>
                <div class="card">
                    <div class="card-header">
                        <?php if ($_SESSION['pseudo'] == 'admin') {
                           ?>  <a href="actions/users/deleteQuestionAdmin.php?id=<?= $question['id']?>"><button class="btn btn-danger"><i class="fa fa-ban"></i> | supprimer</button></a><br><?php
                        }?>
                  
                            <?= $question['titre']; ?> 
                            <a href="article.php?id=<?= $question['id'];  ?>">Répondre
                        </a>
                    </div>
                    <div class="card-body">
                        <?= $question['description']; ?>
                    </div>
                    <div class="card-footer">
                        
                        Publié par <a href="profile.php?id=<?= $question['id_auteur']; ?>">
                        <?= $question['pseudo_auteur']; ?></a> <br>
                        <?= $question['date_publication']; ?>
                    </div>
                </div>
                <br>
                <?php
            }
        ?>

    </div>

</body>
</html>