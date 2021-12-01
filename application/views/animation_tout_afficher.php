
<div class="row justify-content-center">
	<div class="col-lg-7 text-center">
		<div class="section-title">
			<!--<span class="h6 text-color">Latest News</span>-->
			<h2 class="mt-3 content-title text-black">Animations</h2>
		</div>
	</div>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Descriptif</th>
      <th scope="col">Les Invités</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		if($animation != NULL) {
			echo"<thead class='thead-dark'><tr><th scope='col'>En Cours</th> <th scope='col'> </th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){
				if($ani['etat']=='en cours'){
					if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
					if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";

					echo"
						<tr>
						<th scope='row'><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/animation/afficher/".$ani["ani_id"]."'>".$ani["ani_libelle"]."</a></h3></th>
						<td>".$ani["ani_description"]."<br><h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."</td>
						<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>
						</tr>";
				}
			}
			echo"<thead class='thead-dark'><tr><th scope='col'>A Venir</th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){
				if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
				if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";
				
				if($ani['etat']=='à venir'){
					echo"
						<tr>
						<th scope='row'><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/animation/afficher/".$ani["ani_id"]."'>".$ani["ani_libelle"]."</a></h3></th>
						<td>".$ani["ani_description"]."<br><h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."</td>
						<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>
						</tr>";
				}
			}
			echo"<thead class='thead-dark'><tr><th scope='col'>Terminé</th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){
				if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
				if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";

				if($ani['etat']=='finie'){
					echo"
						<tr>
						<th scope='row'><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/animation/afficher/".$ani["ani_id"]."'>".$ani["ani_libelle"]."</a></h3></th>
						<td>".$ani["ani_description"]."<br><h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."</td>
						<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>
						</tr>";
				}
			}
		}else {echo "<br />";
			echo"<thead class='thead-dark'><tr><th scope='col'>Aucune Animations !</th> <th scope='col'> </th> <th scope='col'></th> </tr></thead>";
		}
	?>
  </tbody>
</table>
