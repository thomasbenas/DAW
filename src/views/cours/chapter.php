<div class="pagechapitre">
    <div class="margechapitre">
    <?php /** @var array $courses */
        foreach ($chapitres as $c): ?>
                <div class="chapitre"> 
                    <img class="logo" src="http://localhost/DAW/assets/images/flag.svg">
                    <h2><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $c['name'] ?>"><?= $c['name'] ?></a></h2>
                </div>
    <?php endforeach ?>
    </div>
    <div class="contenuchapitre">
        <h1>Chapitre n° <?= $chapitre['ch_number']?> - <?= $chapitre['name'] ?></h1>
        <p><?= $chapitre['content'] ?></p>
        <div class="buttons">
            <div class="buttonchapter"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitrePrecedent['name'] ?>">Précedent</a></div>
            <div class="buttonchapter"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitreSuivant['name'] ?>">Suivant</a></div>
        </div>
    </div>  
</div>


