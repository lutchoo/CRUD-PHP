<?php
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';

if(isset($_GET['id'])&& !empty($_GET['id'])){
    $id = $_GET['id'];
    //var_dump($id);
}
$article = getArticleById($id);
$com = getComByIdArticle($id);
//var_dump($article);

if(isset($_POST)&& !empty($_POST)){
    $id_auteur = $_SESSION['user_id'];
    $comentaire = $_POST['comentaire'];
    $date = date('Y-m-d');
    $id_article = $id;
    addCom($id_auteur,$comentaire,$date,$id_article);
    header("Location:detail.php?id=$id");
}

?>
<div class='container'>
<!-- -------------afficher un article en detail grace a son id --------------------  -->
        <article>
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
            <img src="images/<?= htmlspecialchars($article['image'])?>" alt="">
            <p><?= htmlspecialchars($article['text'])?></p>
            <p>ECRIT LE :<?= htmlspecialchars(date_format (new DateTime($article['date']),"d/m/Y" ))?></p>
            <p>AUTEUR : <?=htmlspecialchars($article['name']) ?></p>
        </article>

</div>
<!-- -----------------si l'utilisateur est connecter alors il peut ajouter un commentaire-----------------------  -->
<?php if(isset($_SESSION) && !empty($_SESSION)){ ?>
    <form action="#" method ="POST">
    <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Commentaire</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='comentaire'></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-3">ajouter </button>
    </form>
<?php } ?>
<!-- ---------------aficher les comentaire de larticle--------------------------  -->
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <?php foreach($com as $c){;?>
    <li class="list-group-item"><?= htmlspecialchars($c['comentaire'])?><p><?= htmlspecialchars($c['date'] . " " . $c['name']) ?></p></li>
    <?php }?>
  </ul>
</div>
















<?php require_once 'partial/footer.php' ?>