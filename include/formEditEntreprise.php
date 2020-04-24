<?php 
  $entreprise = $_SESSION['entreprise'];
  // ici j'ai choisi de stocker le contenu de ma variable de session dans une autre session plus simple d'écriture 
  // <?php echo $stagiaire->stagiaire_prenom; 
  // mais j'aurais pu aussi ecrire <?php echo $_SESSION['stagiaire']->stagiaire_prenom;
?>
 <input type="hidden" name="entreprise_id" id="entreprise_id" value="<?php echo $entreprise->entreprise_id; ?>"> 
  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_raisonSociale">Raison sociale</label>
    <input type="text" class="form-control" id="editUser_entreprise_raisonSociale" name="entreprise_raisonSociale" value="<?php echo $entreprise->entreprise_raisonSociale; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_adresse">Adresse</label>
    <input type="text" class="form-control" id="editUser_entreprise_adresse" name="entreprise_adresse" value="<?php echo $entreprise->entreprise_adresse; ?>">
  </div>

  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_cp">CP</label>
    <input type="text" class="form-control" id="editUser_entreprise_cp" name="entreprise_cp" value="<?php echo $entreprise->entreprise_cp; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_ville">Ville</label>
    <input type="text" class="form-control" id="editUser_entreprise_ville" name="entreprise_ville" value="<?php echo $entreprise->entreprise_ville; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_siret">SIRET</label>
    <input type="text" class="form-control" id="editUser_entreprise_siret" name="entreprise_siret" value="<?php echo $entreprise->entreprise_siret; ?>">
  </div>
  <div class="form-group form-group-modal">
    <label for="editUser_entreprise_caracteristiques">Caractéristiques</label>
    <textarea name="entreprise_caracteristiques" id="editUser_entreprise_caracteristiques" class="form-control"><?php echo $entreprise->entreprise_caracteristiques; ?></textarea>
  </div>