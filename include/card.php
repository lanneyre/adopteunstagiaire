<div class="pagination row">
<?php 
    try{
        // combien d'apprenants je veux sur une page
        // je vais le stocker das une variable afin de pouvoir m'adapter quelque soit le nb d'apprenants par promotion, le nb d'apprenants totals et de fait le nb d'apprenants à afficher
        $nbCardPerPage = 20;

        // je récupère ici tous les apprenants de la promotion
        // la requete
        $sqlAllApprenants = "SELECT * FROM `stagiaire` WHERE `stagiaire_formation_id` = 1;";
        // que j'envoie au serveur
        $requeteAllApprenants = $db->query($sqlAllApprenants);
        // avant de récupérer les résultats
        $allApprenants = $requeteAllApprenants->fetchAll(PDO::FETCH_OBJ);

        // je teste si l'utilisateur souhaite voir une page en particulié
        if(!empty($_GET['p'])){
            $p = $_GET['p'];    
        } else {
            $p = 1;
        }
        
        // je calcul ici le point de départ pour ma requete SQL future
        $offset = ($p-1)*$nbCardPerPage; 
        // Si l'offset est supperieur aux nombres d'apprenants, alors je met l'offset à 0 afin d'éviter la page blanche sans apprenant
        if($offset < sizeof($allApprenants)){
            $offset = 0;
        }
        
        // je stocke ma requete dans une variable que je vais utiliser plus tard 
        $sqlApprenants = "SELECT * FROM `stagiaire` WHERE `stagiaire_formation_id` = 1 ORDER BY `stagiaire_prenom` ASC LIMIT ".$offset.",".$nbCardPerPage.";";
        // j'envoie la requete au serveur et je stocke son retour dans une autre variable
        $requeteApprenants = $db->query($sqlApprenants);
        // dans la variable $apprenants je vais stocker un tableau d'objet correspondant à ma requete
        $apprenants = $requeteApprenants->fetchAll(PDO::FETCH_OBJ);
        
        // $apprenants avec un s contient la totalité des résultats tandis que $apprenant sans s, lui ne contient qu'un seul résultat, une seule ligne de la bdd 
?>
    <div class="col-12">
        <?php
        // Je vais générer les boutons mais de combien en ai-je besoin ?
        // autant que de page or le nb de page = au nombre toal d'apprenants divisé par le nombre d'apprenants qu'on veux sur une page le tout arrondi à l'unité supérieure
        $nbPage = ceil(sizeof($allApprenants)/$nbCardPerPage);
        // J'ai le nombre max donc je fais une boucle pour les générer automatiquement la boucle for est tout indiquée puisqu'elle incrémente une variable ce qui m'interesse
        // je part de 1 (le 0 ne m'interesse pas ici je ne vaux pas l'afficher)
        for ($i=1; $i <= $nbPage ; $i++) { 
            # code...
            // Je génère donc un lien avec un numéro de page en variable dans l'url
            ?>
        <a href="index.php?p=<?php echo $i;?>#cardApprenants" class="btn btn-outline-secondary" role="button" aria-pressed="true"><?php echo $i;?></a>
            <?php
        }
        ?>
    </div>
<?php
        // maintenant j'affiche les apprenants que je veux avec les limit 
        foreach ($apprenants as $apprenant) {
            # code...
            // pour récupérer les apprenants j'ai opté pour PDO::FETCH_OBJ donc je vais avoir un objet dans $apprenant d'où les -> pour appeler les champs de la table
            ?>
        <div class="card">
            <img src="img/<?php echo $apprenant->stagiaire_nom; ?>.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $apprenant->stagiaire_nom; ?> <?php echo $apprenant->stagiaire_prenom; ?></h5>
                <p class="card-text"><?php echo $apprenant->stagiaire_preferences; ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
            <?php
        }
    } catch(PDOException $e){
        // en cas d'erreur
        echo $e->getMessage();
    }
?>
   </div>

<!-- 
Toutes les card que des apprenants se sont embétés à faire ne servent plus à rien : je les ai commenté parce que j'ai pas le coeur de les supprimer
<div class="card">
    <img src="img/Ahmed.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Anissa.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Audrey.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Axel.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Benedicte.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Benjamin.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Corine.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/deliquaire-nagui-26.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/develey fleur.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Emmanuel.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Franck Martinez 22.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Hugo.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/jeremy filin 28.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Lory.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Marie.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Nadege.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Nathalie.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Sabrina.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Soumaya.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<div class="card">
    <img src="img/Vincent cochet.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div> -->