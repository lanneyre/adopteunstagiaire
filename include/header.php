<header>
    <div id="logo">
        <a href="accueil_or_connection.html"><img src="img/logo-ics-cci.png" alt="logo myIMMO"></a>
    </div>
    <div id="content-header-right">
        <ul class="nav_categorie">
            <li><a href="index.php">Adopte Un Stagiaire Ics</a></li>
        </ul>
        <div class="login">
            
            <!-- Button trigger modal -->
            <li>
                <a href="" data-toggle="modal" data-target="#exampleModal">
                    <img src="img/sinscrire.png" alt="S'inscrire">
                </a>
            </li>
            <li>
                <!-- editUserModal -->
                <?php 
                if(!empty($_SESSION['user'])){
                    $dataTarget = "editUserModal";
                } else {
                    $dataTarget = "loginModal";
                }
                ?>
                <a href="" data-toggle="modal" data-target="#<?php echo $dataTarget; ?>">
                    <img src="img/login.png" alt="login">
                </a>
            </li>
            <!--<a target="_blank" href="https://icones8.fr/icons/set/name">Nom icon</a> icon by <a target="_blank" href="https://icones8.fr">Icons8</a>-->
        </div>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </div>
</header>