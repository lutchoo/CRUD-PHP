<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
$article = getArticles();
//var_dump($article);
?>
<main class='container'>
<div class="row">
    <?php foreach($article as $a) { ?>
    
    <div  class="card m-5" style="width: 20rem; box-shadow: 0px 1px 2px 2px #4D03A6;">
    <img src="images/<?= htmlspecialchars($a['image'])?>" class="card-img-top" alt="...">
    <h5 class="card-title"><?= htmlspecialchars($a['titre'])?></h5>
    <div class="card-body" >
    <p class="card-text" style="height:200px; overflow: hidden " ><?= htmlspecialchars($a['text']) ?></p>
    </div>
    <p>PUBLIER LE : <?= htmlspecialchars(date_format(new DateTime($a['date']),"d/m/Y" ))?></p>
    <p>AUTEUR : <?=htmlspecialchars($a['name']) ?></p>
    <a href="detail.php?id=<?=$a['article_id']?>"><button>More</button></a>
    </div>
    <?php } ?>
    </div>
       
<?php require_once 'partial/footer.php' ?>



