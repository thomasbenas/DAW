<div class="chapter-layout">
    <div class="chapter-aside">
        <?php /** @var array $courses */ foreach ($chapitres as $c): ?>
            <div class="chapter-aside-ele"> 
                <img class="course-chapter-image" src="http://localhost/DAW/assets/images/flag.svg">
                <p><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $c['slug'] ?>"><?= $c['name'] ?></a></p>
            </div>
        <?php endforeach ?>
    </div>

    <div class="chapter-content">
        <a href="../../cours" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour aux cours</span></a>
        <h2>Chapitre n° <?= $chapitre['ch_number']?> - <?= $chapitre['name'] ?></h2>
        <div class="buttons">
            <button class="button"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitrePrecedent['slug'] ?>">Précedent</a></button>
            <button class="button-fill"><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitreSuivant['slug'] ?>">Suivant</a></button>
        </div>
        <p><?= $chapitre['content'] ?></p>
    </div>
</div>



