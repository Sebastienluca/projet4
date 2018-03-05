<div class="container-fluid">
	<div class="row">
	</div>
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
		<hr class="featurette-divider">
	</div>
</div>