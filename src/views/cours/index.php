<div class="container">
    <h2>Tous nos cours</h2>

    <div class="buttons">
        <div class="button">
            <div class="button-content">Explorer</div>
        </div>
        <div class="button">
            <div class="button-content">En Cours</div>
        </div>
        <div class="button">
            <div class="button-content">Achevés</div>
        </div>
        <div class="button">
            <div class="button-content">Date</div>
        </div>
    </div>

    <div class="lists-grid">
        <?php /** @var array $courses */
        foreach ($courses as $cours): ?> 
            <div class="list-cours">
                <div class="list-text">
                    <h3><a href="cours/voir/<?= $cours['slug'] ?>"><?= $cours['name'] ?></a></h3>

                    <span><?= $cours['summary'] ?></span>
                </div>
                <img class="list-img" src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/images/<?= $cours['image'] ?>">
            </div>
        <?php endforeach ?>
    </div>
</div>