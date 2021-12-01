<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="megakit,business,company,agency,multipurpose,modern,bootstrap4">
  
  <meta name="author" content="themefisher.com">

  <title>Megakit| Html5 Agency template</title>

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/themify/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/magnific-popup/dist/magnific-popup.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/css/style.css">

</head>

<body>


<!-- Header Start --> 

<header class="navigation">
	<div class="header-top ">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-2 col-md-4">
					<div class="header-top-socials text-center text-lg-left text-md-left">
						<a href="https://www.facebook.com/themefisher" target="_blank"><i class="ti-facebook"></i></a>
						<a href="https://twitter.com/themefisher" target="_blank"><i class="ti-twitter"></i></a>
						<a href="https://github.com/Narrateur/" target="_blank"><i class="ti-github"></i></a>
					</div>
				</div>
				<div class="col-lg-10 col-md-8 text-center text-lg-right text-md-right">
					<div class="header-top-info">
						<a href="tel:+23-345-67890">Call Us : <span>+23-345-67890</span></a>
						<a href="mailto:baguetteNwargame.support@gmail.com" ><i class="fa fa-envelope mr-2"></i><span>baguetteNwargame.support@gmail.com</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg  py-4" id="navbar">
		<div class="container">
		  <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/">
		  	Baguette N' <span>Wargame</span>
		  </a>

		  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-bars"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse text-center" id="navbarsExample09">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/animation/tout_afficher">Programmation</a></li>

				<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/invite/galerie">Nos Invités</a></li>

				<!--
			  	<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="about.html">Our company</a></li>
						<li><a class="dropdown-item" href="pricing.html">Pricing</a></li>
					</ul>
			  	</li>
				-->
			   	
			   <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/objet_trouve/tout_afficher">Objets Trouvés</a></li>

			   <?php if($this->session->userdata('statut') != null) echo"<li class='nav-item'><a class='nav-link' href='".base_url()."index.php/compte/afficher/".$this->session->userdata('username')."'>Mon Compte<br>".$this->session->userdata('username')."</a></li>"; ?>
			</ul> 


			<?php			
			if($this->session->userdata('statut') == null){
				echo"<form class='form-lg-inline my-2 my-md-0 ml-lg-4 text-center'>
						<a href='".base_url()."index.php/compte/connecter' class='btn btn-solid-border btn-round-full'>Connexion/Inscription</a>
					</form>";
			}else{
				echo"<form class='form-lg-inline my-2 my-md-0 ml-lg-4 text-center'>
						<a href='".base_url()."index.php/compte/deconnecter' class='btn btn-solid-border btn-round-full'>Deconnexion</a>
					</form>";
			}
			?>

		  </div>
		</div>
	</nav>
</header>


<!-- Header Close --> 


<?php
if($this->session->userdata('statut') == 'I'){
	$this->load->view('templates/haut_invite');
}else if($this->session->userdata('statut') == 'O'){
	$this->load->view('templates/haut_admin');
}
?>
