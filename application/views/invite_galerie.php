
<section class='section blog-wrap bg-gray'>
    <div class='container'>
        <div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<!--<span class="h6 text-color">Latest News</span>-->
					<h2 class="mt-3 content-title text-black">Nos Invités</h2>
				</div>
			</div>
		</div>
        <div class='row'>

			<?php 
                // DEFINITION DE str_contains
                if (!function_exists('str_contains')) {
                    function str_contains (string $haystack, string $needle){
                        return empty($needle) || strpos($haystack, $needle) !== false;
                    }
                }

                // DEBUT AFFICHAGE
				if($invite_info != NULL) {
					foreach($invite_info as $invInfo){// POUR CHAQUE ELEMENTS RETOURNE PAR LA REQUETE
                        if (!isset($urlTraite[$invInfo["cpt_pseudo"]])){// SI ON LE L'A PAS DEJA AFFICHE
                            echo"<div class='col-lg-6 col-md-6 mb-5'>
                                    <div class='blog-item'>
                                        <img src='".base_url()."style/images/invite/".$invInfo['inv_image']."' alt='' class='img-fluid rounded'>

                                        <div class='blog-item-content bg-white p-5'>
                                            <div class='blog-item-meta bg-gray py-1 px-2'>
                                            <h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/afficher/".$invInfo["cpt_pseudo"]."'>".$invInfo["inv_nom"]."</a></h3>
                                            </div> 
                                            
                                        <p class='mb-4'>";

                                            
                            
                            $cptPseudo = $invInfo['cpt_pseudo']; // sauvegarde du pseudo pour afficher les url et les post
                            $url_added=0;

                            foreach($invite_info as $url){
                                if(strcmp($cptPseudo,$url["cpt_pseudo"])==0 && !isset($urlTraite[$url["url_lien"]]) && $url["url_lien"]!=NULL){
                                    if(str_contains($url['url_lien'],'facebook')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-facebook-f text-muted'></i></a></li>";
                                    if(str_contains($url['url_lien'],'twitter')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-twitter text-muted'></i></a></li>";
                                    if(str_contains($url['url_lien'],'youtube')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-youtube text-muted'></i></a></li>";
                                    if(str_contains($url['url_lien'],'pinterest')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-pinterest text-muted'></i></a></li>";
                                    if(str_contains($url['url_lien'],'linkedin')) echo"<li class='list-inline-item mr-3'><a href='".$url["url_lien"]."'><i class='fab fa-linkedin-in text-muted'></i></a></li>";
                                    $url_added=1;
                                }

                                $urlTraite[$url["url_lien"]]=1;
                            }
                            if($url_added==0) echo"Pas de réseau social pour cet invité !";
                            echo"<br><br>";

                            $lastPost=0;
                            foreach($invite_info as $post){
                                if(strcmp($cptPseudo,$post["cpt_pseudo"])==0 && $lastPost==0 && $post["pst_etat"]=="A"){
                                    echo"
                                    <table class='table table-striped'>
                                    <thead class='thead-dark'>
                                        <tr><th scope='col'>Dernier Post le ".$post["pst_date"]."</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><th scope='col'>".$post["pst_text"]."</th></tr>
                                    </tbody>
                                    </table>";
                                    $lastPost=1;
                                }
                            }
                            if($lastPost==0)echo"Pas de post pour cet invité !";
                            echo"</p>";

                            
                            $urlTraite[$invInfo["cpt_pseudo"]]=1;

                            echo"<a href='".base_url()."index.php/invite/afficher/".$invInfo["cpt_pseudo"]."' class='btn btn-small btn-main btn-round-full'>Learn More</a>
                                    </div>
                                </div>
                            </div>";
                        }
					}//end foreach
				}else {echo "<br />";
					echo "Aucun Invité pour le moment !";
				}

			?>		

			
		</div>
	</div>
</section>


<!--
<ul class='list-inline footer-socials'>
    <li class='list-inline-item'><a href='https://www.facebook.com/themefisher'><i class='ti-facebook mr-2'></i>Facebook</a></li>
    <li class='list-inline-item'><a href='https://twitter.com/themefisher'><i class='ti-twitter mr-2'></i>Twitter</a></li>
    <li class='list-inline-item'><a href='https://www.pinterest.com/themefisher/'><i class='ti-linkedin mr-2 '></i>Linkedin</a></li>
</ul>

<ul class='list-inline author-socials'>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-facebook-f text-muted'></i></a></li>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-twitter text-muted'></i></a></li>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-linkedin-in text-muted'></i></a></li>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-pinterest text-muted'></i></a></li>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-behance text-muted'></i></a></li>
    <li class='list-inline-item mr-3'><a href='#'><i class='fab fa-youtube text-muted'></i></a></li>
</ul>

-->