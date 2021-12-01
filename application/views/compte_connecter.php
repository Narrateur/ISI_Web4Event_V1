<div class='sidebar-widget card border-0 mb-3'>
    <div class='card-body p-4 text-center'>

        

<?php echo validation_errors(); ?>
<?php echo form_open('compte/connecter'); ?>


<label>Saisissez vos identifiants ici :</label><br>
        <input type="text" name="pseudo" />
        <input type="password" name="mdp" />
        <input type="submit" value="Connexion"/>



<?php
echo"<br><br><a href='".base_url()."index.php/compte/creer'>Pas encore inscrit? Cliquez ici!</a>";
?>
</form>

</div>
</div>