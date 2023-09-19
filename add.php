<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
//var_dump($_SESSION);
//var_dump($_FILES['img']);
if(isset($_POST) && !empty($_POST)){
    $autor = $_SESSION['user_id'];
    $titre = $_POST['titre'];
    $text = $_POST['description'];
    $date = date('Y-m-d');
    var_dump($date);
//  ----------------gestion du telechargement de l'image---------------------
    if(isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $img = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $unique_id = uniqid();
        $file_extension = pathinfo($img, PATHINFO_EXTENSION);
        $new_img_name = $unique_id . '.' . $file_extension;
        move_uploaded_file($img_tmp, 'images/'. $new_img_name );
        addArticle($titre,$new_img_name,$text,$date,$autor);
        header("Location:mes_articles.php?message=l'article a ete correctement ajouter &color=success");
}else{
    header("Location:add.php?message=erreur telechargement image &color=danger ");
}
}
?>
<!-- ------------------ formulaire pour ajouter un article seulement si lutilisateur est connecter-----------------  -->
<form action="add.php" method='POST' enctype="multipart/form-data">
<div>
    <label for="exampleFormControlInput1" class="form-label">Titre</label>
    <input class="form-control" type="text" name='titre'>
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">telecharger une image</label>
  <input class="form-control" type="file" id="formFile" name='img'>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='description'></textarea>
</div>
<button type="submit" class="btn btn-primary mb-3">Confirm </button>
</form>




<?php require_once 'partial/footer.php' ?>