<div class='sidebar-widget card border-0 mb-3'>
<div class='card-body p-4 text-center'>

<?php echo validation_errors(); ?>

<?php echo form_open('compte_creer'); ?>

<label for="id">Identifiant</label>
<input type="input" name="id" /><br />
<label for="mdp">Mot de passe</label>
<input type="password" name="mdp" /><br />
<input type="submit" name="submit" value="Créer un compte" />
</form>

</div>
</div>