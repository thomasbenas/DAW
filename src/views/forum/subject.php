<?php include(ROOT.'src/core/utils/textFormatting.php') ?>

<div class="container">
	<div class="goBack">
		<a href='//<?= HOST.'/'.FOLDER_ROOT.'/forum'; ?>'>Forum</a>
		<i class='fas fa-angle-right'> </i>
		<span><?= $subject['title']; ?></span>
	</div>
	<div class="posts">
		<?php foreach ($posts as $post): ?>
			<div class="post">
				<div class="post-header">
					<div class="post-header-user-info">
						<img src="//<?= HOST . '/' .FOLDER_ROOT ?>/assets/images/businessman.svg" alt="">
						<span><?= $post['author_name'] ?></span>
					</div>
					<div class="post-header-text">
						<span>le <?= dateInFrenchFormat($post['date'])?></span>
						<span>à <?= dateOnlyHoursAndMinutes($post['date']) ?></span>
					</div>
				</div>
				<div class="post-content">
					<p><?= $post['content'] ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<form method='POST' class="post-form" action='//<?= HOST.'/'.FOLDER_ROOT.'/forum/ajoutPost/'.$category['slug'].'/'.$subject['slug']; ?>'>
		<textarea name="content"></textarea>
		<input class="button" type='submit' value='Envoyer' />
	</form>
</div>