<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-8">
			<div class="row">
				<h1><?= $news['titre'] ?></h1>
				<legend>Par <em><?= $news['auteur'] ?></em>, le <span class="glyphicon glyphicon-time"></span> <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></legend>
				<p><?= nl2br($news['contenu']) ?></p>
				<?php if ($news['dateAjout'] != $news['dateModif']) 
				{ ?>
					<p><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
				<?php 
				} ?>
			</div>
			<hr>
				<ul class="pagination justify-content-center">
					<?php 
					foreach ($newsPrecedent as $newsP)
					{
					?>
					<li class="btn btn-secondary previous"><a href="news-<?= $newsP['id'] ?>.html"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Chapitre précédent</a></li>
					<?php 
					}
					foreach ($newsSuivant as $newsS)
					{
					?>
					<li class="btn btn-secondary next"><a href="news-<?= $newsS['id'] ?>.html">Chapitre suivant <span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a></li>
					<?php 
					} ?>
				</ul>
			<hr>
			<?php
			if (empty($comments))
			{
			?>
			<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
			<?php
			}
				foreach ($comments as $comment)
			{
			?>
			<fieldset>
				<legend>
					Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?> --
					<a href="comment-signaler-<?= $comment['id'] ?>.html" data-toggle="tooltip" data-placement="top" title="Aidez-moi a surveiller les commentaires">Signaler</a>
					<?php if ($user->isAuthenticated()) { ?> | 
						<a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier </a> |
						<a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer </a>
					<?php } ?>
				</legend>
				<p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
			</fieldset>
			
			<?php
			}
			?>
			<p class="btn btn-ajoutercom btn-block" data-toggle="tooltip" data-placement="top" title="Ajouter un commentaire"><span class="glyphicon glyphicon-comment"></span> <a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
		</div>
		<aside class="col-md-4 blog-sidebar">
			<div class="p-3 mb-3 bg-light rounded">
            <p class="mb-0"><img class="featurette-image img-responsive center-block" alt="alaska" src="images/carte-right.jpg"></p>
          </div>
		</aside>
	</div>
</div>
