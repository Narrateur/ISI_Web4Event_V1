<?php
if($this->session->userdata('statut') != 'O') redirect(base_url()."index.php");
?>


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
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
	  <?php
		if($animation != NULL) {
			echo"<thead class='thead-dark'><tr><th scope='col'>En Cours</th> <th scope='col'> </th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){
				if($ani['etat']=='en cours'){
					if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
					if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";

					echo validation_errors();
					echo form_open('animation/modifier_animation');
					echo"
						<tr>
							<th scope='row'> <input type='text' value=".$ani["ani_id"]." readonly='readonly' name='ani_id'/> <input type='text' name='ani_libelle' value='".$ani["ani_libelle"]."'></th>
							
							<td> 
								<textarea type='text' name='ani_description' >".$ani["ani_description"]."</textarea><br>
								<h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>
								Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."
							</td>
							
							<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>";
							

							
							echo"
							<td>
								<input type='submit' value='Mettre à Jour'/></form>
								<br>";

								echo validation_errors();
								echo form_open('animation/supprimer_animation');
								echo"
								<input type='text' value=".$ani["ani_id"]." hidden='hidden' name='ani_id'/><input type='submit' value='Supprimer'/></form>
							</td>
						</tr>";
				}
			}
			echo"<thead class='thead-dark'><tr><th scope='col'>A Venir</th> <th scope='col'></th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){				
				if($ani['etat']=='à venir'){
					if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
					if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";

					echo validation_errors();
					echo form_open('animation/modifier_animation');
					echo"
						<tr>
							<th scope='row'> <input type='text' value=".$ani["ani_id"]." readonly='readonly' name='ani_id'/> <input type='text' name='ani_libelle' value='".$ani["ani_libelle"]."'></th>
							
							<td> 
								<textarea type='text' name='ani_description' >".$ani["ani_description"]."</textarea><br>
								<h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>
								Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."
							</td>
							
							<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>";
							

							
							echo"
							<td>
								<input type='submit' value='Mettre à Jour'/></form>
								<br>";

								echo validation_errors();
								echo form_open('animation/supprimer_animation');
								echo"
								<input type='text' value=".$ani["ani_id"]." hidden='hidden' name='ani_id'/><input type='submit' value='Supprimer'/></form>
							</td>
						</tr>";
				}
			}
			echo"<thead class='thead-dark'><tr><th scope='col'>Terminé</th> <th scope='col'></th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
			foreach($animation as $ani){
				if($ani['etat']=='finie'){
					if($ani['invite'] == "") $ani['invite'] = "Pas d'invité pour le moment";
					if($ani['lie_libelle'] == "") $ani['lie_libelle'] = "Pas de lieu pour le moment";

					echo validation_errors();
					echo form_open('animation/modifier_animation');
					echo"
						<tr>
							<th scope='row'> <input type='text' value=".$ani["ani_id"]." readonly='readonly' name='ani_id'/> <input type='text' name='ani_libelle' value='".$ani["ani_libelle"]."'></th>
							
							<td> 
								<textarea type='text' name='ani_description' >".$ani["ani_description"]."</textarea><br>
								<h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$ani["lie_id"]."'>".$ani["lie_libelle"]."</a></h5><br>
								Quand? Du ".$ani["ani_horaireDebut"]." au ".$ani["ani_horaireFin"]."
							</td>
							
							<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$ani["ani_id"]."'>".$ani["invite"]."</a></h3></td>";
							

							
							echo"
							<td>
								<input type='submit' value='Mettre à Jour'/></form>
								<br>";

								echo validation_errors();
								echo form_open('animation/supprimer_animation');
								echo"
								<input type='text' value=".$ani["ani_id"]." hidden='hidden' name='ani_id'/><input type='submit' value='Supprimer'/></form>
							</td>
						</tr>";
				}
			}
		}else {echo "<br />";
			echo"<thead class='thead-dark'><tr><th scope='col'>Aucune Animations !</th> <th scope='col'> </th> <th scope='col'></th> </tr></thead>";
		}
	?>
  </tbody>
</table>
