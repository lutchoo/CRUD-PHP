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
    <div class="row">
    <?php foreach($allArticles  as $a) { ;?>

    <div class="card m-5" style="width: 20rem; box-shadow: 0px 1px 2px 3px #8242f1">
    <img src="images/<?= htmlspecialchars($a['image'])?>" class="card-img-top" alt="...">
    <h5 class="card-title"><?= htmlspecialchars($a['titre'])?></h5>
    <div class="card-body" >
    <p class="card-text" style="height:200px; overflow: hidden " ><?= htmlspecialchars($a['text']) ?></p>
    </div>
    <p>PUBLIER LE :<?= htmlspecialchars(date_format(new DateTime($a['date']),"d/m/Y" ))?></p>
    <p>AUTEUR : <?=htmlspecialchars($a['name']) ?></p>
    <a href="modifier_article.php?id=<?=$a['article_id']?>"><button>modifier</button></a>
    <a href=""><button>suprimer</button></a>
    </div>
    <?php } ?>
    </div>
</main>
<?php require_once 'partial/footer.php' ?>