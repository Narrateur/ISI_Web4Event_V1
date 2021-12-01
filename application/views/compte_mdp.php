<div class='sidebar-widget card border-0 mb-3'>
<div class='card-body p-4 text-center'>

<?php echo validation_errors(); ?>

<?php echo form_open('changer_mdp'); ?>

<label>Modifier le Mot de Passe</label><br><br>
Ancien Mot de Passe <input type='password' name='ancien_mdp' /><br>
Nouveau Mot de Passe <input type='password' name='new_mdp' /><br>
Confirmer Nouveau Mot de Passe <input type='password' name='new_mdp_2' /><br>
<input type='submit' value='Valider'/><br>
</form>

</div>
</div>