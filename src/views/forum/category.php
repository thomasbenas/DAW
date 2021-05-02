<div class="container">
	<h2>Ajouter un sujet à <?= $category['name'] ?></h2>
	<form class="form" method='POST' action='//<?= HOST . '/' . FOLDER_ROOT . '/forum/ajoutSujet/' . $category['slug']; ?>'>
		<div class="form-inputs">
			<input type="text" placeholder="nom complet du sujet" name="name" required/>
			<input type="text" placeholder="nom réduit" name="slug" required/>
			<input type="submit" value="poster" />
		</div>
	</form>
</div>