<div class="container">
	<h2>Les sujets par catégories</h2>
	<?php foreach($categories as $category): ?>
		<div class="category-card">
			<h3><?= $category['infos']['name']; ?></h3>
			<ul>	
				<?php foreach ($category['content'] as $subject): ?>
					<li>
						<a href="//<?= HOST . '/' . FOLDER_ROOT . '/forum/sujet/' . $category['infos']['slug'] . '/' . $subject['slug']; ?>">
							<?= (!empty($category)) ? $subject['title'] : 'Aucun sujet disponible' ?>
						</a>
					</li>
				<?php endforeach; ?>
				<?= (empty($category['content'])) ? '<li>Aucun sujet disponible</li>' : NULL ?>
			</ul>
			<button class="button"><a  href="//<?= HOST . '/' . FOLDER_ROOT . '/forum/categorie/' . $category['infos']['slug']; ?>">Ajouter un sujet</a></button>
		</div>
	<?php endforeach; ?>
</div>