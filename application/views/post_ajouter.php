<div class='sidebar-widget card border-0 mb-3'>
    <div class='card-body p-4 text-center'>

        

<?php echo validation_errors(); ?>
<?php echo form_open('post/inserer_post'); ?>


<label>Identifiant / Mot de Passe du Passeport : </label><input type="text" name="pas_login" placeholder="login"/><input type="password" name="pas_mdp" placeholder="mot de passe" /><br><br>
<label>Texte</label><br>
<textarea type='text' name='pst_text' maxlength='140' rows="5" cols="50"></textarea><br>

<input type="submit" value="Ajouter"/>




</form>

</div>
</div>