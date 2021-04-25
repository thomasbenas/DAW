<div class="container">
    <div class="intro-cours ">
        <h1 class="titre-cours"><?= $courses['name'] ?></h1> 
    </div>    
    <p>Progrès global</p> 
        <?php /** @var array $courses */
        foreach ($chapitres as $chapitre): ?> 
            <div class="chapitre">
                <img class="logo" src="http://localhost/DAW/assets/images/flag.svg">
                <p><a href="//<?= HOST . '/' . FOLDER_ROOT ?>/cours/chapter/<?= $chapitre['slug'] ?>"><?= $chapitre['name'] ?></a></p>
            </div>
        <?php endforeach ?>
</div>
