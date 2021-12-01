
<?php
    
    if($lieu_infos != NULL){
        
        
        foreach($lieu_infos as $lieu){
            $currentLieuID = $lieu['lie_id'];

            echo("<div class='sidebar-widget card border-0 mb-3'>
                <img src='images/blog/blog-author.jpg' alt='' class='img-fluid'>
                <div class='card-body p-4 text-center'>");
            
            
            $boolService = 0;

            if(!isset($lieuTraite[$lieu['lie_id']])){
                echo"<h5 class='mb-0 mt-4'>".$lieu['lie_libelle']."<br>".$lieu['lie_adresse']."<br><br>Services :</h5><br>";

                foreach($lieu_infos as $services){
                    if($services['lie_id']==$currentLieuID){
                        if($services['srv_nom']!="" || $services['srv_nom']!=NULL ) $boolService = 1;
                        echo("<p>".$services['srv_nom']."</p>");
                    }
                    $serviceTraite[$services['srv_nom']]=1;
                }

                if($boolService==0)echo("<p>Aucun Service</p>");
                echo("  </div>
                    </div>");
            } 

            $lieuTraite[$lieu['lie_id']]=1;
        }
    }

?>