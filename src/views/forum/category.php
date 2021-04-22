<div>
	<h2><?= $category['name']; ?></h2>
	<?php foreach ($subjects as $subject): ?>
		<div>
			<h4><?= $subject['title']; ?></h4>
			<a href='//<?= HOST . '/' . FOLDER_ROOT . '/forum/sujet/' . $category['slug'] . '/' . $subject['slug']; ?>'>Lien vers le sujet</a>
		</div>
	<?php endforeach; ?>
	<form method='POST' action='//<?= HOST . '/' . FOLDER_ROOT . '/forum/ajoutSujet/' . $category['slug']; ?>'>
		<input type='text' name='name' />
		<input type='text' name='slug' />
		<input type='submit' value='Valider' />
	</form>
</div>