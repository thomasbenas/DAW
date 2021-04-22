<div>
	<div>
		<a href='//<?= HOST.'/'.FOLDER_ROOT.'/forum'; ?>'>Forum</a>
		<span>&gt;</span>
		<a href='//<?= HOST.'/'.FOLDER_ROOT.'/forum/categorie/'.$category['slug']; ?>'><?= $category['name']; ?></a>
		<span>&gt;</span>
		<span><?= $subject['title']; ?></span>
	</div>
	<div>
		<?php foreach ($posts as $post): ?>
			<p id='p_<?= $post['id']; ?>'><?= $post['content']; ?></p>
		<?php endforeach; ?>
	</div>
	<form method='POST' action='//<?= HOST.'/'.FOLDER_ROOT.'/forum/ajoutPost/'.$category['slug'].'/'.$subject['slug']; ?>'>
		<input type='text' name='content' />
		<input type='submit' value='Envoyer' />
	</form>
</div>