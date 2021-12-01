
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
			echo"
				<tr>
				<th scope='row'><h3 class='mt-3 mb-3'>".$animation->ani_libelle."</h3></th>
				<td>".$animation->ani_description."<br><h5 class='mt-3 mb-3'>Où? <a href='".base_url()."index.php/lieu/afficher/".$animation->lie_id."'>".$animation->lie_libelle."</a></h5><br>Quand? Du ".$animation->ani_horaireDebut." au ".$animation->ani_horaireFin."</td>
				<td><h3 class='mt-3 mb-3'><a href='".base_url()."index.php/invite/galerie_animation/".$animation->ani_id."'>".$animation->invite."</a></h3></td>
				</tr>";
			
		}else {echo "<br />";
			echo "Animation Inconnu !";
		}
	?>
  </tbody>
</table>
