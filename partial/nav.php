<header>
    <div id="container-1">
    <div id="logo"><a href="index.php"><img src="img/Black and White Minimalist Modern Clean Technology Logo .png" alt=""></a></div>
    </div>
    <div id="container-2"> 
        <nav>
            <a id="icon-menu" href="#"><img src="img/menu-icon.png" alt=""></a>
            <?php if(isset($_SESSION) && !empty($_SESSION)){ ?>
                
                <ul>
                <li class="deroulant"><a href="">Mon compte</a></li>
                <li><a href="deco.php">Se Deconnecter</a></li>
                <ul class="sous" >
                    <li><a href="add.php">ajouter un article</a></li>
                    <li><a href="mes_articles.php">voir mes articles</a></li>
                </ul>
                </ul>
            <?php  }else{?>
                <ul>
                <li><a href="signIn.php">Inscription</a></li>
                <li><a href="login.php">Se connecter</a></li>
            </ul>
          <?php  }?>
         
        </nav>
    </div>   
</header>
<?php if(isset($_GET['message'])&& !empty($_GET)){ ?>
        <div class="alert alert-<?=$_GET['color']?> alert-dismissible fade show" role="alert">
            <strong><?=$_GET["message"]?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
    <?php }?>