<?php 
  $formateur = $_SESSION['formateur'];
  // ici j'ai choisi de stocker le contenu de ma variable de session dans une autre session plus simple d'écriture 
  // <?php echo $stagiaire->stagiaire_prenom; 
  // mais j'aurais pu aussi ecrire <?php echo $_SESSION['stagiaire']->stagiaire_prenom;
?>
<input type="hidden" name="formateur_id" id="formateur_id" value="<?php echo $formateur->formateur_id;?>">
  <div class="form-group form-group-modal">
    <label for="editUser_formateur_prenom">Prénom</label>
    <input type="text" class="form-control" id="editUser_formateur_prenom" name="formateur_prenom" value="<?php echo $formateur->formateur_prenom;?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_formateur_nom">Nom</label>
    <input type="text" class="form-control" id="editUser_formateur_nom" name="formateur_nom" value="<?php echo $formateur->formateur_nom;?>">
  </div>
