<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
//var_dump($_SESSION);
//var_dump($_FILES['img']);
$cat = getCat();
//var_dump($_POST);
if(isset($_POST) && !empty($_POST)){
    $autor = $_SESSION['user_id'];
    $titre = $_POST['titre'];
    $text = $_POST['text'];
    $date = date('Y-m-d');
    $catt= $_POST['cat'];
    //var_dump($date);
//  ----------------gestion du telechargement de l'image---------------------
    if(isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $img = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $unique_id = uniqid();
        $file_extension = pathinfo($img, PATHINFO_EXTENSION);
        $new_img_name = $unique_id . '.' . $file_extension;
        move_uploaded_file($img_tmp, 'images/'. $new_img_name );
        addArticle($titre,$new_img_name,$text,$date,$autor,$catt);
        header("Location:mes_articles.php?message=l'article a ete correctement ajouter &color=success");
}else{
    header("Location:add.php?message=erreur telechargement image &color=danger ");
}
}
?>
<!-- ------------------ formulaire pour ajouter un article seulement si lutilisateur est connecter-----------------  -->
<div class="container">
<form action="add.php" method='POST' enctype="multipart/form-data">
<div>
    <label for="exampleFormControlInput1" class="form-label">Titre</label>
    <input class="form-control" type="text" name='titre'>
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">telecharger une image</label>
  <input class="form-control" type="file" id="formFile" name='img'>
</div>
<?php foreach($cat as $c) {  ?>
  <label for="cat"><?= $c['nom'] ?></label>
  <input type="checkbox" name='cat[]' id='<?= $c['categorie_id'] ?>' value='<?= $c['categorie_id'] ?>'>

<?php }?>
  
  <select name="" id=""></select>
<div class="mb-3">
  <label for="tiny" class="form-label">Description</label>
  <textarea class="form-control" id='tiny' rows="3" name='text'>
  <tinymce-editor
                name="article"
                api-key="no-api-key"
                height="500"
                menubar="false"
                plugins="advlist autolink lists link image charmap preview anchor
                    searchreplace visualblocks code fullscreen
                    insertdatetime media table code help wordcount"
                toolbar="undo redo | blocks | bold italic backcolor |
                    alignleft aligncenter alignright alignjustify |
                    bullist numlist outdent indent | removeformat | help"
                content_style="body
                {
                    font-family:Helvetica,Arial,sans-serif;
                    font-size:14px
                }"
                >

                <!-- Adding some initial editor content -->
                &lt;p&gt;Ecrivez votre article ici&lt;/p&gt;

            </tinymce-editor>
  </textarea>
</div>
<button type="submit" class="btn mb-3">Confirm </button>
</form>
</div>



<?php require_once 'partial/footer.php' ?>