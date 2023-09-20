<?php
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';


if(isset($_GET) && !empty($_GET)){
    $id = $_GET['id'];
    $delete = deleteArticle($id);
    header('Location:mes_articles.php?message=article suprimer avec success &color=success');
}

?>















<?php require_once 'partial/footer.php' ?>