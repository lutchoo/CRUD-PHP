<?php
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';

    if(isset($_GET) && !empty($_GET)){
        $idArticle = $_GET['id'];
        //var_dump($idArticle);
        $article = getArticleById($idArticle);
        //var_dump($article);
        $old_image = ('images/' . $article['image']);
        //var_dump($old_image);

    if(isset($_POST) && !empty($_POST)){
        $titre = $_POST['titre'];
        $text = $_POST['text'];
        $date = date('Y-m-d');
        
    if(isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $img = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $unique_id = uniqid();
        $file_extension = pathinfo($img, PATHINFO_EXTENSION);
        $new_img_name = $unique_id . '.' . $file_extension;

        //suprimer l'anciene image 
        if($article['image'] != null){
            $old_image = ('images/' . $article['image']);
            if(file_exists($old_image)){
                unlink($old_image);
            }
        }
        move_uploaded_file($img_tmp, 'images/'. $new_img_name );
        modifyArticleById($titre,$new_img_name,$text,$date,$idArticle);
        header('Location:mes_articles.php?message= larticle a ete correctement modifier &color=success');
    }else{
        modifyArticleByIdWithOutImg($titre,$text,$date,$idArticle);
        header('Location:mes_articles.php?message=ajout sans nouvelle image &color=success');
        }
    }  
    }
?>
        <article class='container'>
        
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
            <img src="images/<?= htmlspecialchars($article['image'])?>" alt="">
            <p><?= $article['text']?></p>
            <p>ECRIT LE :<?= htmlspecialchars(date_format (new DateTime($article['date']),"d/m/Y" ))?></p>
            <p>AUTEUR : <?=htmlspecialchars($article['name']) ?></p>
        </article>
<div class='container'>
<form action="modifier_article.php?id=<?php print $idArticle;?>" method='POST' enctype="multipart/form-data">
<div>
    <label for="exampleFormControlInput1" class="form-label">Titre</label>
    <input class="form-control" type="text" name='titre' value="<?=$article['titre']?>">
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">telecharger une image</label>
  <input class="form-control" type="file" id="formFile" name='img'>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="tiny" rows="3" name='text'><?=$article['text']?></textarea>
</div>
<button type="submit" class="btn btn-primary mb-3">Confirm </button>
</form>
</div>
<?php require_once 'partial/footer.php' ?>