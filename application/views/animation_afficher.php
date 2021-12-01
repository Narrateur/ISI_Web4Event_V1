
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
			echo"<thead class='thead-dark'><tr><th scope='col'>En Cours</th></tr></thead>";
			
		}else {echo "<br />";
			echo "Aucune Actualités !";
		}
	?>
  </tbody>
</table>
