<div class="row justify-content-center">
	<div class="col-lg-7 text-center">
		<div class="section-title">
			<!--<span class="h6 text-color">Latest News</span>-->
			<h2 class="mt-3 content-title text-black">Actualités</h2>
		</div>
	</div>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Contenu</th>
      <th scope="col">Date</th>
      <th scope="col">Auteur</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  if($actualite != NULL) {
		foreach($actualite as $actu){
			echo"
			<tr>
			  <th scope='row'>".$actu["act_titre"]."</th>
			  <td>".$actu["act_contenu"]."</td>
			  <td>".$actu["act_date"]."</td>
			  <td>".$actu["cpt_pseudo"]."</td>
			</tr>";			
		}
	}else {echo "<br />";
		echo"<thead class='thead-dark'><tr><th scope='col'>Aucune Actualités !</th> <th scope='col'> </th> <th scope='col'></th> <th scope='col'></th> </tr></thead>";
	}
	?>
  </tbody>
</table>