<?php 
    require_once("include/bdd.php");

    include_once("include/trait_mdpOublie.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/accueil.css">
  
    <title>Mot de passe oublié</title>
</head>

<body>
    <?php include("include/modal.php");?>
    <?php include("include/loginModal.php");?>
    <?php include("include/header.php"); ?>

    <section>
        <div class="contentTop">
            <div class="contentLeft">
                <img src="img/ics_pic.png" alt="Photo du centre Ics Nice">
            </div>
            <div class="contentRight">
                <h1>Mot de passe oublié ?</h1>
                <form action="mdpOublie.php" method="post">
                    <div class="form-group form-group-modal">
                        <label for="utilisateur_mail">Email</label>
                        <input type="email" class="form-control" id="utilisateur_mail" name="utilisateur_mail" required="" placeholder="Le mail associé à votre compte">
                    </div>

                    <div class="form-group form-group-modal">
                        <br>
                        <input type="submit" name="send" class="btn btn-primary btn-modal" value="Envoyez-moi un nouveau mot de passe !" >
                    </div>
                </form>

            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/burger.js"></script>
    <script src="js/modal.js"></script>
</body>

</html>