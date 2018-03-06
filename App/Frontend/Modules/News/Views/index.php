<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1" class=""></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
		<img class="first-slide" src="images/slider/slider1.jpg" alt="Billet simple pour l'Alaska">
		<div class="container">
			<div class="carousel-caption">
				<h1 class="animated bounce infinite">Billet simple pour l'Alaska</h1>
				<p>Roman</p>
			</div>
		</div>
	  </div>
	  <div class="carousel-item">
		<img class="second-slide" src="images/slider/slider2.jpg" alt="Voyager en Alaska">
		<div class="container">
			<div class="carousel-caption">
		   		<h1>l'Alaska</h1>
				<p>Voyager en Alaska présente des défis uniques ainsi que des opportunités.</p>
			</div>
		</div>
	  </div>
	</div>
	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
	  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	  <span class="sr-only">Next</span>
	</a>
</div>
<div class="text-center home">
	<h2>Mes derniers Episodes</h2>
	<p class="center">Roman - Billet simple pour l'Alaska</p>
</div>
<div class="container">
	<div class="row">
		<?php
		foreach ($listeNews as $news)
		{
		?>
		<div class="col-lg-4">
			<div class="card-bodyindex">
				<h3 class="card-title"><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h3>
				<p><?= nl2br($news['contenu']) ?></p>
				<div class="btn-group">
					<a href="news-<?= $news['id'] ?>.html"><button type="button" class="btn btn-sm btn-outline-secondary">Lire la suite</button></a>
					<!-- <button type="button" class="btn btn-sm btn-outline-secondary">Editer</button> -->
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<hr class="featurette-divider">
</div>