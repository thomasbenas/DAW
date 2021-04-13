<!doctype html>
<html lang="fr">
<head>
    <?php require_once(ROOT.'src/views/layout/head.php') ?>
</head>
<body>
    <div class="wrapper">
        <header class="page-header">
            <?php require_once(ROOT.'src/views/layout/menu.php') ?>
        </header>
        <article class="page-body">
            <?= /** @var string $content */ $content ?>
        </article>
        <?php require_once(ROOT.'src/views/layout/footer.php') ?>
    </div>
    <script src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/js/app.js"></script>
</body>
</html>




