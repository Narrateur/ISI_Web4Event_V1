


<?php
    if($this->session->userdata('username') == null) redirect(base_url()."index.php");

    // DEFINITION DE str_contains
    if (!function_exists('str_contains')) {
        function str_contains (string $haystack, string $needle){
            return empty($needle) || strpos($haystack, $needle) !== false;
        }
    }

    if($infos != NULL){
        //variable pour les ajout de post, réseaux et passeport
        $post_added = 0;
        $url_added=0;
        $passeport_added = 0;
        //--------------------------------------------------------

        echo("<div class='sidebar-widget card border-0 mb-3'>
                <img src='images/blog/blog-author.jpg' alt='' class='img-fluid'>
                <div class='card-body p-4 text-center'>");
        foreach($infos as $i){
            if(strcmp($this->session->userdata('username'),$i["cpt_pseudo"])!=0) redirect(base_url()."index.php");
            
            if(!isset($alreadyPrint[$i["cpt_pseudo"]])){
                if($this->session->userdata('statut') == 'I'){
                    echo validation_errors();
                    echo form_open('compte/update_invite');
                    echo("
                            <img src='".base_url()."style/images/invite/".$i["inv_image"]."' alt='' class='img-fluid rounded'>
                            <h5 class='mb-0 mt-4'>".$i["cpt_pseudo"]."<br>
                            <input type='text' name='inv_nom' value='".$i["inv_nom"]."'/></h5>
                            <p><textarea type='text' name='inv_description' rows='5' cols='50'>".$i["inv_description"]."</textarea></p><br>
                            <input type='submit' value='Modifier'/>
                            </form>
                        ");
                    echo validation_errors();
                    echo form_open('compte/annuler_modification');
                    echo("<input type='submit' value='Annuler'/></form><br>");

                }else if($this->session->userdata('statut') == 'O'){
                    echo validation_errors();
                    echo form_open('compte/update_admin');
                    echo("
                            <h5 class='mb-0 mt-4'>
                                ".$i["cpt_pseudo"]."<br>
                                <input type='text' name='org_prenom' value='".$i["org_prenom"]."'/> 
                                <input type='text' name='org_nom' value='".$i["org_nom"]."'/>
                            </h5>
                            <p><input type='email' name='org_mail' value='".$i["org_mail"]."'/></p>
                            <input type='submit' value='Modifier'/>
                            </form>
                        ");
                        echo validation_errors();
                        echo form_open('compte/annuler_modification');
                        echo("<input type='submit' value='Annuler'/></form><br>");
                }
            }

            if($this->session->userdata('statut') == 'I'){
                $cptPseudo = $this->session->userdata('username'); // sauvegarde du pseudo pour afficher les url et les post
                
                //--------------------------------------------------------------URL-------------------------------------------------------
                
                foreach($infos as $url){
                    if(strcmp($cptPseudo,$url["cpt_pseudo"])==0 && !isset($urlTraite[$url["url_lien"]]) && $url["url_lien"]!=NULL ){
                        if(str_contains($url['url_lien'],'facebook')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-facebook-f text-muted'></i></a></li>";
                        if(str_contains($url['url_lien'],'twitter')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-twitter text-muted'></i></a></li>";
                        if(str_contains($url['url_lien'],'youtube')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-youtube text-muted'></i></a></li>";
                        if(str_contains($url['url_lien'],'pinterest')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-pinterest text-muted'></i></a></li>";
                        if(str_contains($url['url_lien'],'linkedin')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-linkedin-in text-muted'></i></a></li>";
                        $url_added=1;
                    }

                    $urlTraite[$url["url_lien"]]=1;
                }
                
                //echo"<br><br>"; 
                //------------------------------------------------------------------------------------------------------------------------
                
                //--------------------------------------------------------------PASSEPORT-------------------------------------------------------
                
                foreach($infos as $passeport){
                    if(strcmp($cptPseudo,$passeport["cpt_pseudo"])==0 && !isset($passeportTraite[$passeport["pas_login"]])){
                        if($passeport_added==0) echo("<h5 class='mb-0 mt-4'>PASSEPORT</h5>"); $passeport_added=1;
                        echo($passeport["pas_login"]." -- ".$passeport["pas_etat"]."<br>");
                    }
                    $passeportTraite[$passeport["pas_login"]]=1;
                }
                //echo("<br>");
                //------------------------------------------------------------------------------------------------------------------------------

                
                //--------------------------------------------------------------POST-------------------------------------------------------
                
                foreach($infos as $post){
                    if($post["pst_text"] != NULL && $post_added==0) echo("<br><table class='table table-striped'>"); $post_added=1;

                    if(strcmp($cptPseudo,$post["cpt_pseudo"])==0 && !isset($postTraite[$post["pst_text"]]) && $post["pst_text"] != NULL){
                        echo"
                        <thead class='thead-dark'>
                            <tr><th scope='col'>Post le ".$post["pst_date"]."</th> <th scope='col'>ETAT</th></tr>
                        </thead>
                        <tbody>
                            <tr><th scope='col'>".$post["pst_text"]."</th> <th scope='col'>".$post["pst_etat"]."</th></tr>
                        </tbody>";
                        $postTraite[$post["pst_text"]]=1;
                        $post_added=1;
                    }
                }
                if($post_added != 0) echo("</table>");
                //------------------------------------------------------------------------------------------------------------------------
            }

            $alreadyPrint[$i["cpt_pseudo"]]=1;
        }

        if($this->session->userdata('statut') == 'I'){
            if($passeport_added==0)echo"Pas de passeport!";
            if($url_added==0) echo"Pas de réseau social !";
            if($post_added==0)echo"Pas de post!";
        }


        echo validation_errors(); 
        echo form_open('compte/changer_mdp');
        echo"<br><br>
        <label>Modifier le Mot de Passe</label><br><br>
        Ancien Mot de Passe <input type='password' name='ancien_mdp' /><br>
        Nouveau Mot de Passe <input type='password' name='new_mdp'  minlength='5' /><br>
        Confirmer Nouveau Mot de Passe <input type='password' name='new_mdp_2'  minlength='5'  /><br>
        <input type='submit' value='Valider'/><br>";


        echo("  </div>
            </div>");
        
        
    }
?>


