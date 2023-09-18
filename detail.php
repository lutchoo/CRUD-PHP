<?php
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';

if(isset($_GET['id'])&& !empty($_GET['id'])){
    $id = $_GET['id'];
    //var_dump($id);
}
$article = getArticleById($id);
//var_dump($article);
?>

<div>
<?php foreach($article as $a) {?>
        <article>
            <h2><?= htmlspecialchars($a['titre']) ?></h2>
            <img src="images/<?= htmlspecialchars($a['image'])?>" alt="">
            <p><?= htmlspecialchars($a['text'])?></p>
            <p>ECRIT LE :<?= htmlspecialchars(date_format (new DateTime($a['date']),"d/m/Y" ))?></p>
            <p>AUTEUR : <?=htmlspecialchars($a['name']) ?></p>
        </article>

<?php } ?>

</div>


















<?php require_once 'partial/footer.php' ?>