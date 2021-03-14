<?php /** @var array $tests */
foreach ($tests as $test): ?>

<h2><a href="/test/voir/<?= $test['slug'] ?>"><?= $test['id'] ?></a></h2>

<p><?= $test['str'] ?></p>

<?php endforeach ?>