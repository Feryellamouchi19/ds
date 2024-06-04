<?php
require_once 'include/database.php';
$id=$_get['id'];
$sqlState=$pdo->prepare('DELETE FROM articles where id=?');
$supprime=$sqlState->execute([$id]);
header('location:articles.php');