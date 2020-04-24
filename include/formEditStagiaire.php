<?php 
  $stagiaire = $_SESSION['stagiaire'];
  // ici j'ai choisi de stocker le contenu de ma variable de session dans une autre session plus simple d'écriture 
  // <?php echo $stagiaire->stagiaire_prenom; 
  // mais j'aurais pu aussi ecrire <?php echo $_SESSION['stagiaire']->stagiaire_prenom;
?>
  <div class="form-group form-group-modal">
    <label for="editUser_stagiaire_prenom">Prénom</label>
    <input type="text" class="form-control" id="editUser_stagiaire_prenom" name="stagiaire_prenom" value="<?php echo $stagiaire->stagiaire_prenom; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_stagiaire_nom">Nom</label>
    <input type="text" class="form-control" id="editUser_stagiaire_nom" name="stagiaire_nom" value="<?php echo $stagiaire->stagiaire_nom; ?>">
  </div>

  <div class="form-group form-group-modal">
    <label for="editUser_stagiaire_cv">CV</label>
    <input type="text" class="form-control" id="editUser_stagiaire_cv" name="stagiaire_cv" value="<?php echo $stagiaire->stagiaire_cv; ?>">
  </div>
  <div class="form-group form-group-modal">
    <br>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="editUser_stagiaire_statut">Statut</label>
      </div>
      <select name="stagiaire_statut" id="editUser_stagiaire_statut" class="custom-select">
        <option value="0" <?php if($stagiaire->stagiaire_statut == 0){ echo 'selected=""';} ?>>En recherche</option>
        <option value="1" <?php if($stagiaire->stagiaire_statut == 1){ echo 'selected=""';} ?>>Adopté</option>
      </select>
    </div>
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_stagiaire_preferences">Préférence</label>
    <textarea name="stagiaire_preferences" id="editUser_stagiaire_preferences" class="form-control"><?php echo $stagiaire->stagiaire_preferences; ?></textarea>
  </div>