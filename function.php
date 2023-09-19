<?php

function dbConnect(){
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=sql_blog', 'root', "");
        return $dbh;
    } catch (PDOException $e) {
        // tenter de réessayer la connexion après un certain délai, par exemple
        echo 'echec de la connection';
    }
}

function signIn($name,$email,$password){
    $connect = dbConnect();
    $sanitized_email= filter_var($email, FILTER_SANITIZE_EMAIL);

    if(filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
        $stmt = $connect->prepare("SELECT COUNT(*) FROM auteurs WHERE auteurs.email = :email ");
        $stmt->bindParam(':email',$sanitized_email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

    if($count > 0){
        header("Location:signin.php?message=adresse mail deja utiliser &color=danger ");

    }else{
        $stmt = $connect->prepare("INSERT INTO auteurs (name,email,password) VALUE(:name,:email,:password)");
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        header("Location:login.php?message=utilisateur enregister &color=success ");

    }
    }else{
        header("Location:signin.php?message=adresse mail invalide &color=danger ");
    }
}

function logIn($email, $password){
    $connect = dbConnect();
    $stmt = $connect->prepare("SELECT * FROM auteurs WHERE auteurs.email = :toto");
    $stmt->bindParam(':toto',$email, PDO::PARAM_STR);
    $stmt ->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($user);
    if(!$user){
        echo "mauvais mot de passe ou nom d'utilisateur";
        header("Location:login.php?message=mauvais mot de passe ou nom d'utilisateur &color=danger ");

        }else{
            
            if(password_verify($password, $user['password'])){
                session_start();
                $_SESSION['user_id'] = $user['auteur_id'];
                $_SESSION['user_email'] = $user['email'];
                header("Location:index.php?message=utilisateur connecte &color=success ");
                
            }else{
                echo "mauvais mot de passe ou nom d'utilisateur ";
                header("Location:login.php?message=mauvais mot de passe ou nom d'utilisateur &color=danger ");

            }
    }

}

function getArticles(){
    $connect = dbConnect();
    $stmt = $connect->prepare("SELECT * FROM articles JOIN auteurs ON articles.`id-auteur` = auteurs.auteur_id ");
    $stmt->execute();
    $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $article;
    var_dump($article);
}

function getArticleById($id){
    $connect = dbConnect();
    $stmt = $connect->prepare("SELECT * FROM articles JOIN auteurs ON articles.`id-auteur` = auteurs.auteur_id WHERE articles.article_id = :id ");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $oneArticle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $oneArticle;
}

function addArticle($titre,$img,$text,$date,$autor){
    $connect = dbConnect();
    $stmt = $connect->prepare("INSERT INTO articles (titre,image,text,date,`id-auteur`) VALUE (:titre, :img, :text, :date, :autor)");
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':img', $img, PDO::PARAM_STR);
    $stmt->bindParam(':text', $text, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':autor', $autor, PDO::PARAM_INT);
    $stmt->execute();

}

function addCom($id_auteur,$comentaire,$date,$id_article){
    $connect = dbConnect();
    $stmt = $connect->prepare("INSERT INTO comentaires (id_auteur_com,comentaire,date,`id-article`) VALUE (:id_auteur,:com,:date,:id_article)");
    $stmt->bindParam(':id_auteur', $id_auteur);
    $stmt->bindParam(':com', $comentaire);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam('id_article', $id_article);
    $stmt->execute();
}

function getComByIdArticle($id){
    $connect = dbConnect();
    $stmt = $connect->prepare("SELECT * FROM comentaires JOIN auteurs ON comentaires.id_auteur_com = auteurs.auteur_id where comentaires.`id-article`= $id ");
    $stmt->execute();
    $com = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $com;
}
function getArticlesByIdUser($id){
    $connect = dbConnect();
    $stmt = $connect->prepare("SELECT * FROM articles JOIN auteurs ON articles.`id-auteur`= auteurs.auteur_id WHERE auteurs.auteur_id = $id");
    $stmt->execute();
    $art = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $art;
}

function modifyArticleById($titre,$img,$text,$date,$id_article){
    $connect = dbConnect();
    $stmt = $connect->prepare("UPDATE articles SET titre=:titre, image=:img, text=:text, date=:date Where articles.article_id = $id_article");
    $stmt->bindParam(':titre',$titre);
    $stmt->bindParam(':img',$img);
    $stmt->bindParam('text', $text);
    $stmt->bindParam(':date',$date);
    $stmt->execute();

}

function modifyArticleByIdWithOutImg($titre,$text,$date,$id_article){
    $connect = dbConnect();
    $stmt = $connect->prepare("UPDATE articles SET titre=:titre, text=:text, date=:date Where articles.article_id = $id_article");
    $stmt->bindParam(':titre',$titre);
    $stmt->bindParam('text', $text);
    $stmt->bindParam(':date',$date);
    $stmt->execute();
}