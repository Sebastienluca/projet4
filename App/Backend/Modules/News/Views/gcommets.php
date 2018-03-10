<div class="container">
	<div class="col-xl-12">
		<h1>Gestion des commentaires</h1>
	</div>
	<h2>Commentaires</h2>
	<p style="text-align: center">Il y a actuellement <?= $nombreComments ?> commentaire(s) Dont <?= $nombreCommentsSignaler ?> commentaire(s) signalé(s). En voici la liste :</p>
	<table class="table table-striped">
		<tr><th>Auteur</th><th>Commentaire</th><th>Chapitres</th><th>Date</th><th>Action</th><th>Signalement</th><th>Status</th></tr>
	<?php
	foreach ($listeCommentsAutre as $comment)
	{
		echo '<tr>
		<td>', htmlspecialchars($comment['auteur']), '</td>';
			if ($comment['signaler'] == 1){
				echo '<td class="alert alert-danger">' .htmlspecialchars(substr($comment['contenu'], 0, 50)). '</td>';
			}else{
				echo '<td>' .htmlspecialchars(substr($comment['contenu'], 0, 50)). '</td>';
			};
		echo '<td>', $comment['titre_news'], '</td>
		<td>le ', $comment['date'], '</td>
		<td class="center">
			<a href="comment-update-'.$comment['id'].'.html"><i class="fa fa-edit"></i></a>
			<a class="confirmation" href="comment-delete-'.$comment['id'].'.html"><i class="fa fa-trash"></i></a>
			</td>
			<td><a href="comment-clearsignaler-'.$comment['id'].'.html">Désignaler</a></td>
		<td>';
			if ($comment['statut'] == 0)
			{
			echo '<a href="comment-statutdesactiver-'.$comment['id'].'.html"><i class="fa fa-toggle-on fa-2x"></i></a>';
		}else {
				echo '<a href="comment-statutactiver-'.$comment['id'].'.html"><i class="fa fa-toggle-off fa-2x"></i></a>';
			}
			echo '</td> </tr>', "\n";
	}
	?>
	</table>
</div>