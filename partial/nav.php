<header>
    <div id="container-1">
    <div id="logo"><a href="index.php"><img src="img/Black_and_White_Minimalist_Modern_Clean_Technology_Logo_.png" alt=""></a></div>
    </div>
    <div id="container-2"> 
        <nav>
            <a id="icon-menu" href="#"><img src="img/menu-icon.png" alt=""></a>
            <?php if(isset($_SESSION) && !empty($_SESSION)){ ?>
                
                <ul class="deroulant">
                <li><a href="">Mon compte</a></li>
                <ul class="sous" >
                    <li><a href="add.php">ajouter un article</a></li>
                    <li><a href="mes_articles.php">voir mes articles</a></li>
                </ul>
                </ul>
                <ul class='disconect'>
                <li><a href="deco.php">Se Deconnecter</a></li>
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