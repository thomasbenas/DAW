<div class="lists-grid">
    <?php /** @var array $quizs */
    foreach ($quizs as $quiz): ?> 
        <div class="lists-qcm">
            <div class="list-text">
                <h2><a href="quiz/voir/<?= $quiz['slug'] ?>"><?= $quiz['category'] ?></a></h2>   
            </div>
            <img class="list-img" src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/images/qcm.svg">
        </div>
    <?php endforeach ?>
</div>