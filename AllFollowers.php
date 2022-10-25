<?php require('actions/users/showAllFollowers.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require('includes/head.php')?>
<body>
<?php require('includes/navbar.php');?><br><br>


<div class="container">
followers :
<div class="card">
<div class="card-body">

    <?php
while ($displayFollowers = $getFollowers->fetch()) {
   ?> <a href="profile.php?id=<?=$displayFollowers['id_follower'] ?>"><h4>@<?= $displayFollowers['pseudo_follower']?></h4></a><br>
   <?php if ($_GET['id'] == $_SESSION['id']) {
     ?><a href="actions/users/deleteFollow.php?id=<?=$displayFollowers['id_follower'] ?>"><button type="button" class="btn btn-danger">supprimer</button></a><br><br>
     <?php
   }
   ?>

    <?php
}

?>
</div>
</div>
</div>

</body>
</html>