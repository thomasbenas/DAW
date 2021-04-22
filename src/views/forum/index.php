<div>
	<?php foreach($data as $value): ?>
		<div>
			<h4><?= $value['infos']['name']; ?></h4>
			<a href='//<?= HOST . '/' . FOLDER_ROOT . '/forum/categorie/' . $value['infos']['slug']; ?>'>Lien pour la categorie</a>
			<?php foreach ($value['content'] as $subject): ?>
				<div>
					<h5><?= $subject['title']; ?></h5>
					<a href='//<?= HOST . '/' . FOLDER_ROOT . '/forum/sujet/' . $value['infos']['slug'] . '/' . $subject['slug']; ?>'>Lien pour le sujet</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>