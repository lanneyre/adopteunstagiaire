<?php 
  $admin = $_SESSION['admin'];
  // ici j'ai choisi de stocker le contenu de ma variable de session dans une autre session plus simple d'écriture 
  // <?php echo $stagiaire->stagiaire_prenom; 
  // mais j'aurais pu aussi ecrire <?php echo $_SESSION['stagiaire']->stagiaire_prenom;
?>
 <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin->admin_id; ?>"> 
  <div class="form-group form-group-modal">
    <label for="editUser_admin_role">Role</label>
    <select name="admin_role" id="editUser_admin_role">
      <option value="0" <?php if($admin->admin_role == 0) echo 'selected=""'; ?>>Super Admin</option>
      <option value="1" <?php if($admin->admin_role == 1) echo 'selected=""'; ?>>Admin</option>
      <option value="2" <?php if($admin->admin_role == 2) echo 'selected=""'; ?>>Autre</option>
    </select>
  </div>
  