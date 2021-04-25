<div class="pagechapitre">
    <div class="margechapitre">
    <?php /** @var array $courses */
        foreach ($chapitres as $c): ?>
                <div class="chapitre"> 
                    <img class="logo" src="http://localhost/DAW/assets/images/flag.svg">
                    <p><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $c['slug'] ?>"><?= $c['name'] ?></a></p>
                </div>
    <?php endforeach ?>
    </div>
    <div class="contenuchapitre">
        <h1>Chapitre n° <?= $chapitre['ch_number']?> - <?= $chapitre['name'] ?></h1>
        <p><?= $chapitre['content'] ?></p>
        <div class="buttons">
            <div class="buttonchapter"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitrePrecedent['slug'] ?>">Précedent</a></div>
            <div class="buttonchapter"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitreSuivant['slug'] ?>">Suivant</a></div>
        </div>
    </div>  
</div>


