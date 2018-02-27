<div class="container">
	<div class="row">
		<h1>Gestion des commentaires | <span>"<?= $nombreComments ?>" sur le site !</span></h1>
		<h2>Commentaires</h2>
		<p style="text-align: center">Il y a actuellement <?= $nombreComments ?> commentaire(s). En voici la liste :</p>
		<table class="table table-striped">
			<tr><th>Auteur</th><th>Commentaire</th><th>Date</th><th>Action</th></tr>
		<?php
		foreach ($listeCommentsAutre as $comment)
		{
			echo '<tr>
			<td>', $comment['auteur'], '</td>
			<td>', $comment['contenu'], '</td>
			<td>le ', $comment['date']->format('d/m/Y'), '</td>
			<td class="center">
				<a href="comment-update-'.$comment['id'].'.html"><img src="/images/update.png" alt="Modifier" /></a> 
				<a href="comment-delete-'.$comment['id'].'.html"><img src="/images/delete.png" alt="Supprimer" /></a> | 
				<a href="comment-clearsignaler-'.$comment['id'].'.html">clearsignaler</a>
			</td>
			</tr>', "\n";
		}
		?>
		</table>
		<h2>Commentaires signalés</h2>
		<p style="text-align: center">Il y a actuellement <?= $nombreCommentsSignaler ?> commentaire(s) signalé(s). En voici la liste :</p>
		<table class="table table-striped">
			<tr><th>Auteur</th><th>Commentaire</th><th>Signaler</th><th>Date</th><th>Action</th><th>Clear Signal</th></tr>
		<?php
		foreach ($listeCommentsSignaler as $comment)
		{
			echo '<tr>
			<td>', $comment['auteur'], '</td>
			<td>', $comment['contenu'], '</td>
			<td>', $comment['signaler'], '</td>
			<td>le ', $comment['date']->format('d/m/Y'), '</td>
			<td class="center">
				<a href="comment-update-'.$comment['id'].'.html"><img src="/images/update.png" alt="Modifier" /></a>
				<a href="comment-delete-'.$comment['id'].'.html"><img src="/images/delete.png" alt="Supprimer" /></a>
				</td>
				<td class="center">
				<a href="comment-clearsignaler-'.$comment['id'].'.html">clearsignaler</a>
				</td>
			</tr>', "\n";
		}
		?>
		</table>
	</div>
</div>