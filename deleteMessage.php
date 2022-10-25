<?php
include('actions/database.php');

$deleteMessage = $bdd->prepare('DELETE FROM messages WHERE id = ?');
$deleteMessage->execute(array($_GET['id']));
header('location:'.$_SERVER['HTTP_REFERER']);