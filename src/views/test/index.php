<?php /** @var array $tests */
foreach ($tests as $test): ?>

    <h2><a href="/test/voir/<?= $tests['slug'] ?>"><?= $tests['id'] ?></a></h2>

<p><?= $test['str'] ?></p>

<?php endforeach ?>