<div class="container">
    <h2><?= $courses['name'] ?></h2> 
    
        <div class="chapter-index">
            <a href="../../cours" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour aux cours</span></a>
            <h3>Chapitres</h3>
            <?php /** @var array $courses */
            foreach ($chapitres as $chapitre): ?> 
                <div class="list-card chapter-index-ele">
                    <span><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitre['slug'] ?>"><?= $chapitre['name'] ?></a></span>
                </div>
            <?php endforeach ?>
        </div>
</div>
