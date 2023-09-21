<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
if(isset($_GET)&& !empty($_GET)){
    $id = $_GET['id'];
}
$art = getArticleByIdCat($id);
$cat=getCat();
//var_dump($art);
?>


<aside style='width:15%;height:100%; position:fixed; z-index:1000000 ; text-align:center;-webkit-box-shadow: 0px 0px 0.5px 0.5px #adabb2;
    -moz-box-shadow: 0px 0px 0.5px 0.5px #adabb2;
    box-shadow: 0px 0px 0.5px 0.5px #adabb2; ; font-weight:200'>
    <h3>Rechercher par  : </h3>
    <h3>Categories</h3>
    <?php foreach($cat as $c) {  ?>
    <a href="findBy.php?id=<?= $c['categorie_id'] ?>"><p><?= $c['nom']?></p></a>
    <?php } ?>
    <p>AUTEUR</p>
</aside>
<h1  style='position:absolute; right:550px; z-index:1000; font-weight:900; font-size: 3em'><span id='titre'>Découvrir le Web 3.0 </span>: Le Futur d'Internet à Votre Portée</h1>
<main class='container'>
<div class="row" style='margin-top:70px;'>
    <img src="https://assets-global.website-files.com/637359c81e22b715cec245ad/6464a7ec8c8fd22869e80364_home-hero-new-bg1.svg" alt="" style='position:absolute; left:0; top:20px;'>
    <?php foreach($art as $a) {  ?>
    <div  class="card m-5 art " style="width: 20rem; -webkit-box-shadow: 0px 0px 5px 4px #4D03A6;
    -moz-box-shadow: 0px 0px 5px 4px #4D03A6;
    box-shadow: 0px 0px 5px 4px #4D03A6; ">
    <img src="images/<?= htmlspecialchars($a['image'])?>" class="card-img-top"style='height:40%' alt="..." >
    <h3 class="card-title"><?= htmlspecialchars($a['titre'])?></h3>
    <p>PUBLIER LE : <span><?= date_format(new DateTime($a['date']),"d/m/Y" )?></span></p>
    <p>AUTEUR : <span><?=$a['name']?></span></p>
    <a href="detail.php?id=<?=$a['article_id']?>"><button class='btn'>Plus de detail</button></a>
    </div>
    <?php } ?>
    </div>
</main>

 




<?php require_once 'partial/footer.php' ?>