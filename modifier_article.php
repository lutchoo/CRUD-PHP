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
            <p><?= htmlspecialchars($article['text'])?></p>
            <p>ECRIT LE :<?= htmlspecialchars(date_format (new DateTime($article['date']),"d/m/Y" ))?></p>
            <p>AUTEUR : <?=htmlspecialchars($article['name']) ?></p>
        </article>


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
<textarea id="basic-example">
  <p><img style="display: block; margin-left: auto; margin-right: auto;" title="Tiny Logo" src="https://www.tiny.cloud/docs/images/logos/android-chrome-256x256.png" alt="TinyMCE Logo" width="128" height="128"></p>
  <h2 style="text-align: center;">Welcome to the TinyMCE editor demo!</h2>

  <h2>Got questions or need help?</h2>

  <ul>
    <li>Our <a href="https://www.tiny.cloud/docs/tinymce/6/">documentation</a> is a great resource for learning how to configure TinyMCE.</li>
    <li>Have a specific question? Try the <a href="https://stackoverflow.com/questions/tagged/tinymce" target="_blank" rel="noopener"><code>tinymce</code> tag at Stack Overflow</a>.</li>
    <li>We also offer enterprise grade support as part of <a href="https://www.tiny.cloud/pricing">TinyMCE premium plans</a>.</li>
  </ul>

  <h2>A simple table to play with</h2>

  <table style="border-collapse: collapse; width: 100%;" border="1">
    <thead>
      <tr>
        <th>Product</th>
        <th>Cost</th>
        <th>Really?</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>TinyMCE</td>
        <td>Free</td>
        <td>YES!</td>
      </tr>
      <tr>
        <td>Plupload</td>
        <td>Free</td>
        <td>YES!</td>
      </tr>
    </tbody>
  </table>

  <h2>Found a bug?</h2>

  <p>
    If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers.
  </p>

  <h2>Finally ...</h2>

  <p>
    Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support.
  </p>
  <p>
    Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team.
  </p>
</textarea>
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='text'><?=$article['text']?></textarea>
</div>
<button type="submit" class="btn btn-primary mb-3">Confirm </button>
</form>

<?php require_once 'partial/footer.php' ?>