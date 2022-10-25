<?php 
require('actions/database.php');

if (isset($_POST['validate'])){
    if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {

        $pseudo_admin = "admin";
        $pseudo_admin = "admin123";
     $infoAdmin = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    }
}