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
			<p class="btn btn-outline-dark btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Ajouter un commentaire"><span class="glyphicon glyphicon-comment"></span> <a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
		</div>
		<div class="col-xs-6 col-lg-4">
			<img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzUwMHg1MDAvYXV0bwpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE2MWJkNzkxN2I4IHRleHQgeyBmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTYxYmQ3OTE3YjgiPjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjRUVFRUVFIi8+PGc+PHRleHQgeD0iMTg1LjEzMzMzMTI5ODgyODEyIiB5PSIyNjEuNyI+NTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
		</div>
	</div>
</div>
