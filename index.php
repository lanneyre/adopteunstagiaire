<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/accueil.css">
  
    <title>Document</title>
</head>

<body>
    <?php include("include/modal.php");?>
    <?php include("include/header.php"); ?>

    <section>
        <div class="contentTop">
            <div class="contentLeft">
                <img src="img/ics_pic.png" alt="Photo du centre Ics Nice">
            </div>
            <div class="contentRight">
                <h3>Voici notre centre de formation</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae,
                    sapiente? Excepturi nemo fugiat voluptate blanditiis qui incidunt praesentium obcaecati
                    illum cumque at, consectetur aperiam beatae consequuntur veniam vitae ab officia?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae,
                    sapiente? Excepturi nemo fugiat voluptate blanditiis qui incidunt praesentium obcaecati
                    illum cumque at, consectetur aperiam beatae consequuntur veniam vitae ab officia?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae,
                    sapiente? Excepturi nemo fugiat voluptate blanditiis qui incidunt praesentium obcaecati
                    illum cumque at, consectetur aperiam beatae consequuntur veniam vitae ab officia?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae,
                    sapiente? Excepturi nemo fugiat voluptate blanditiis qui incidunt praesentium obcaecati
                    illum cumque at, consectetur aperiam beatae consequuntur veniam vitae ab officia?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae,
                    sapiente? Excepturi nemo fugiat voluptate blanditiis qui incidunt praesentium obcaecati
                    illum cumque at, consectetur aperiam beatae consequuntur veniam vitae ab officia?
                </p>
            </div>
        </div>
        <article class="apprenantsContent">
            <h3>Nos apprenants prêt à entrer en mission</h3>
            <div class="container">
                <?php include("include/card.php") ?>
            </div>
        </article>
        <article class="formulaire">
            <h3>Interessé par un apprenant ?</h3>
<?php include("include/form.php")?>
        </article>

    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/burger.js"></script>
    <script src="js/modal.js"></script>
</body>

</html>