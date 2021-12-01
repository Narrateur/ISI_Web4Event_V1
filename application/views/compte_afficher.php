


<?php
    if($this->session->userdata('username') == null) redirect(base_url()."index.php");
    if($infos != NULL){
        echo("<div class='sidebar-widget card border-0 mb-3'>
                <img src='images/blog/blog-author.jpg' alt='' class='img-fluid'>
                <div class='card-body p-4 text-center'>");

                if($this->session->userdata('statut') == 'I'){
                    echo("<img src='".base_url()."style/images/invite/".$infos->inv_image."' alt='' class='img-fluid rounded'>
                            <h5 class='mb-0 mt-4'>".$infos->cpt_pseudo."<br>".$infos->inv_nom."</h5>
                            <p>".$infos->inv_description."</p>");
                }else if($this->session->userdata('statut') == 'O'){
                    echo("<h5 class='mb-0 mt-4'>".$infos->cpt_pseudo."<br>".$infos->org_prenom." ".$infos->org_nom."</h5>
                            <p>".$infos->org_mail."</p>");
                }
                
                echo validation_errors(); 

                echo form_open('compte/changer_mdp');
                echo"
                <label>Modifier le Mot de Passe</label><br><br>
                Ancien Mot de Passe <input type='password' name='ancien_mdp' /><br>
                Nouveau Mot de Passe <input type='password' name='new_mdp' /><br>
                Confirmer Nouveau Mot de Passe <input type='password' name='new_mdp_2' /><br>
                <input type='submit' value='Valider'/><br>";


        echo("  </div>
            </div>");
    }
?>


