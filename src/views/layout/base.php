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
       
        <?= /** @var string $content */ $content ?>
 
        <?php require_once(ROOT.'src/views/layout/footer.php') ?>
    </div>
    <script src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/js/app.js"></script>
</body>
</html>




