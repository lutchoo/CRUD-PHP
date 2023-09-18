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
            <article class ='col-6'>
            <h2><?= htmlspecialchars($a['titre'])?></h2>
            <div><img src="images/<?= htmlspecialchars($a['image'])?>" alt=""></div>
            <p class="text-center"><?= htmlspecialchars($a['text']) ?></p>
            <p>ECRIT LE :<?= htmlspecialchars(date_format (new DateTime($a['date']),"d/m/Y" ))?></p>
            <p>AUTEUR : <?=htmlspecialchars($a['name']) ?></p>
            <a href="detail.php?id=<?=$a['article_id']?>"><button>More</button></a>
            </article>
        <?php } ?>
    </div>

<?php require_once 'partial/footer.php' ?>