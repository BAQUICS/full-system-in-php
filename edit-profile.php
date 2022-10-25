<?php require('actions/users/getInfoEditProfilAction.php');?>
<?php require('actions/users/editProfilAction.php');?>


<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
<?php require('includes/navbar.php');?>


<br><br>
<div class="container">
    <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?>
    
    <?php if(isset($nom)){?>
            <form method="POST" enctype="multipart/form-data" >
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" value="<?=$pseudo?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Prenom</label>
                    <input type="text" class="form-control" name="prenom" value="<?=$prenom ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">nom</label>
                    <input type="text" class="form-control" name="nom" value="<?=$nom ?>">
                </div>
                

                <button type="submit" class="btn btn-primary" name="validate">Modifier le profile</button>
            </form>
     <?php 
     }
     ?>
</body>
</html>