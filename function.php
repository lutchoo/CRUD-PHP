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
                echo 'utilisateur connecte';
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
    $stmt = $connect->prepare("SELECT * FROM articles JOIN auteurs ON articles.`id-auteur` = auteurs.auteur_id WHERE articles.article_id = $id ");
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
