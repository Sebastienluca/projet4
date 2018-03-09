<div class="container">
	<div class="text-center">
		<h1>Les chapitres</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<div class="row">
				<?php
				foreach ($listeNewsChapitres as $news)
				{
				?>
				<div class="col-md-6">
					<div class="card mb-6 box-shadow">
						<div class="card-body">
							<h2 class="card-title"><a href="chapitre-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
							<p><?= nl2br($news['contenu']) ?></p>
							<div class="btn-group">
								<a href="chapitre-<?= $news['id'] ?>.html"><button type="button" class="btn btn-sm btn-outline-secondary">Lire la suite</button></a>
								<?php if ($user->isAuthenticated()) { ?>
									<a href="/admin/news-update-<?= $news['id'] ?>.html"><button type="button" class="btn btn-sm btn-outline-secondary">Editer</button></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
