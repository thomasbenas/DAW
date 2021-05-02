<div class="container">
	<div>
		<a href='//<?= HOST.'/'.FOLDER_ROOT.'/forum'; ?>'>Forum</a>
		<i class='fas fa-angle-right'> </i>
		<span><?= $subject['title']; ?></span>
	</div>
	<div>
		<?php foreach ($posts as $post): ?>
			<p><?= $post['author_name'] . ' à ' . $post['date'] .  ' a dit : '  . $post['content']; ?></p>
		<?php endforeach; ?>
	</div>
	<form method='POST' action='//<?= HOST.'/'.FOLDER_ROOT.'/forum/ajoutPost/'.$category['slug'].'/'.$subject['slug']; ?>'>
		<input type='text' name='content' />
		<input type='submit' value='Envoyer' />
	</form>
</div>