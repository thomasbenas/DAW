<div class="container">
    <h2>Tous nos cours</h2>

    <div class="buttons">
        <div class="button">Explorer</div>
        <div class="button">En Cours</div>
        <div class="button">Achevés</div>
        <div class="button">Date</div>
    </div>

    <div class="list-cards">
        <?php /** @var array $courses */
        foreach ($courses as $cours): ?> 
            <div class="list-card">
                <div class="list-text">
                    <h2><a href="cours/voir/<?= $cours['slug'] ?>"><?= $cours['name'] ?></a></h2>
                    <span><?= $cours['summary']?></span>    
                </div>
                <img class="list-img" src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/images/<?= $cours['image'] ?>">
            </div>
        <?php endforeach ?>
    </div>
</div>