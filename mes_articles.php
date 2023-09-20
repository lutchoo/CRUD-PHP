<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';

if(isset($_SESSION) && !empty($_SESSION)){
    $id = $_SESSION['user_id'];
    $allArticles =getArticlesByIdUser($id);
}
?>
<main class='container'>
    <div class="row" style='margin-top:70px'>
    <img src="https://assets-global.website-files.com/637359c81e22b715cec245ad/6464a7ec8c8fd22869e80364_home-hero-new-bg1.svg" alt="" style='position:absolute; left:0'>
    <?php foreach($allArticles  as $a) { ;?>

    <div class="card m-5 art" style="width: 20rem; -webkit-box-shadow: 0px 0px 5px 4px #4D03A6;
-moz-box-shadow: 0px 0px 5px 4px #4D03A6;
box-shadow: 0px 0px 5px 4px #4D03A6;">
    <img src="images/<?= htmlspecialchars($a['image'])?>" class="card-img-top" alt="...">
    <h3 class="card-title"><?= htmlspecialchars($a['titre'])?></h3>
    <div class="card-body" >
    <p class="card-text" style="height:200px; overflow: hidden " ><?= htmlspecialchars($a['text']) ?></p>
    </div>
    <p>PUBLIER LE :<?= htmlspecialchars(date_format(new DateTime($a['date']),"d/m/Y" ))?></p>
    <p>AUTEUR : <?=htmlspecialchars($a['name']) ?></p>
    <a href="modifier_article.php?id=<?=$a['article_id']?>"><button>modifier</button></a>
    <a href="delete.php?id=<?=$a['article_id']?>"><button>suprimer</button></a>
    </div>
    <?php } ?>
    </div>
</main>
<?php require_once 'partial/footer.php' ?>