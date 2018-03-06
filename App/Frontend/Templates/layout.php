<!DOCTYPE html>
<html>
	<head>
		<title>
			<?= isset($title) ? $title : 'Mon super site' ?>
		</title>
		<meta charset="utf-8" />
		 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/Envision.css" type="text/css" />
	</head>
	<body>
		<header>
			<nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark box-shadow">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="#" data-toggle="popover" data-placement="bottom" data-content=" Acteur & écrivain">Jean Forteroche</a>
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>
					<div id="navbarCollapse" class="collapse navbar-collapse justify-content-md-end">
						<ul class="navbar-nav">
							<li class="nav-item"><a class="nav-link" href="/"><i class="fa fa-home"></i> Accueil</a></li>
							<li class="nav-item"><a class="nav-link" href="/chapitres.html"> Chapitres</a></li>
						<?php if ($user->isAuthenticated()) { ?>
							<li class="nav-item"><a class="nav-link" href="/admin/">Gestion des épisodes</a></li>
							<li class="nav-item"><a class="nav-link" href="/admin/comment-gestion.html">Gestion des commentaires</a></li>
						<?php } ?>
						<?php if ($user->isAuthenticated()) { ?>
							<li class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									Bonjour <?= $_SESSION['username'];?><span class="caret"></span></a>
								<div class="dropdown-menu" aria-labelledby="dropdown03">
								  <a class="dropdown-item" href="/admin/deconnexion.html">Déconnexion</a>
								</div>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<?php
		// On récupére l'URL de la page pour ensuite affecter le nom de la page
		$page = $_SERVER['REQUEST_URI'];
		// On récupére l'URL de la page pour ensuite affecter id = nom de la page
		$reg = '#.html$#';
		$urlid = preg_replace($reg, '$1', $page);
		$reg2 = '#^/#';
		$idsection = preg_replace($reg2, '$1', $urlid);
		?>
		<main role="main">
			<section <?php if(isset($idsection) && !empty($idsection)){ echo 'id="'.$idsection.'"'; }?>>
				<?php if ($user->hasFlash()) echo '<div class="container"><div class="row"><p style="text-align: center;">', $user->getFlash(), '</p></div></div>'; ?>
					<?= $content ?>
			</section>
			<hr class="featurette-divider">
		</main>
		<!-- FOOTER -->
		<footer class="footer">
			<div class="container">
				<p class="pull-right"><a href="#">Haut de page</a></p>
				<p>© 2018 Jean Forteroche.</p>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src='/js/tinymce/tinymce.min.js'></script>
		<script src="/js/editeur.js"></script>
		<script src="/js/app.js"></script>
		<script src="/js/design.js"></script>

	</body>
</html>