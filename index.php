<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
$article = getArticles();
//var_dump($article);
?>
<main class='container'>
<div class="row" style='margin-top:70px'>
    <img src="https://assets-global.website-files.com/637359c81e22b715cec245ad/6464a7ec8c8fd22869e80364_home-hero-new-bg1.svg" alt="" style='position:absolute; left:0'>
    <?php foreach($article as $a) { ?>
    
    <div  class="card m-5 art" style="width: 20rem; -webkit-box-shadow: 0px 0px 5px 4px #4D03A6;
-moz-box-shadow: 0px 0px 5px 4px #4D03A6;
box-shadow: 0px 0px 5px 4px #4D03A6; ">
    <img src="images/<?= htmlspecialchars($a['image'])?>" class="card-img-top" alt="..." >
    <h3 class="card-title"><?= htmlspecialchars($a['titre'])?></h3>
    <div class="card-body" >
    <p class="card-text" style="height:200px; overflow: hidden " ><?= htmlspecialchars($a['text']) ?></p>
    </div>
    <p>PUBLIER LE : <span><?= htmlspecialchars(date_format(new DateTime($a['date']),"d/m/Y" ))?></span></p>
    <p>AUTEUR : <span><?=htmlspecialchars($a['name'])?></span></p>
    <a href="detail.php?id=<?=$a['article_id']?>"><button>More</button></a>
    </div>
    <?php } ?>
    </div>
</main>
       
<?php require_once 'partial/footer.php' ?>



