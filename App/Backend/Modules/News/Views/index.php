<div class="container home">
	<div class="row">
		<div class="col-xl-12">
			<h1>Gestion des épisodes</h1>
			<p style="text-align: center">Il y a actuellement <?= $nombreNews ?> épisode(s). En voici la liste :</p>
		</div>
		
		<p> <a href="/admin/news-insert.html">Ajouter un épisode</a></p>
		<table class="table table-striped">
			<tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
		<?php
		foreach ($listeNews as $news)
		{
			echo '<tr>
			<td>', $news['auteur'], '</td>
			<td>', $news['titre'], '</td>
			<td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td>
			<td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td>
			<td>
			<a href="news-update-', $news['id'], '.html"><i class="fa fa-edit"></i></a> <a href="news-delete-', $news['id'], '.html"><i class="fa fa-trash"></i></a>
			</td>
			</tr>', "\n";
		}
		?>
		</table>
	</div>
</div>