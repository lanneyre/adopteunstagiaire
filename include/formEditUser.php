
<form class="formModal" method="POST" action="editUser.php">

  <input type="hidden" name="utilisateur_id" id="editUser_utilisateur_id" value="">
  <div class="form-group form-group-modal">
    <label for="editUser_utilisateur_mail">Email</label>
    <input type="email" class="form-control" id="editUser_utilisateur_mail" name="utilisateur_mail" required="" value="<?php echo $_SESSION['user']->utilisateur_mail; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_utilisateur_mdp">Mot de passe</label>
    <!-- Afficher le mot de passe est inutile puisque d'une part il est crypté dans la BDD et de l'autre il affichera des ronds dans le navigateur -->
    <input type="password" class="form-control" id="editUser_utilisateur_mdp" name="utilisateur_mdp" value="">
  </div>

  <div class="form-group form-group-modal">
    <label for="editUser_utilisateur_presentation">Présentation</label>
    <textarea name="utilisateur_presentation" id="editUser_utilisateur_presentation" class="form-control"><?php echo $_SESSION['user']->utilisateur_presentation; ?></textarea>
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_utilisateur_tel">Téléphone</label>
    <input type="tel" class="form-control" id="editUser_utilisateur_tel" name="utilisateur_tel" value="<?php echo $_SESSION['user']->utilisateur_tel; ?>">
  </div>
  

  <?php 

    // En fonction du type de l'utilisateur je définie quel fichier je dois inclure 
    switch ($_SESSION['userType']) {
      case 'admin':
        # code...
        $include = "formEditAdmin.php";
        break;
      case 'entreprise':
        # code...
        $include = "formEditEntreprise.php";
        break;
      case 'formateur':
        # code...
        $include = "formEditFormateur.php";
        break;
      default:
        # code...
        $include = "formEditStagiaire.php";
        break;
    }
    // Petite séparation
    echo "<h4>".ucfirst($_SESSION['userType'])."</h4><hr>";
    // J'inclue le reste du formulaire en fonction du type d'utilisateur
    include("include/".$include);
  ?>


  <div class="form-group form-group-modal">
    <br>
    <button type="submit" class="btn btn-primary btn-modal">Envoyer</button>
  </div>
</form>