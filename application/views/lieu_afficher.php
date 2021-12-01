
<?php
    
    if($lieu_infos != NULL){
        echo("<div class='sidebar-widget card border-0 mb-3'>
            <img src='images/blog/blog-author.jpg' alt='' class='img-fluid'>
            <div class='card-body p-4 text-center'>");
        $afficher_lieu=0;
        foreach($lieu_infos as $lieu){
            if($afficher_lieu==0) echo"<h5 class='mb-0 mt-4'>".$lieu['lie_libelle']."<br>".$lieu['lie_adresse']."<br><br>Services :</h5><br>"; $afficher_lieu=1;

            echo("<p>".$lieu['srv_nom']."</p>");
        }
        echo("  </div>
            </div>");
        
    }