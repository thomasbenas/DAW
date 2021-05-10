<div class="container">
    <h2>Quiz</h2>
    <span>Chaque quiz correspond à une catégorie de cours proposée par <i>ClosedClassroom</i>, faites ceux qui vous intéresse en ce moment, vos résultats nous permettent de 
    vous recommander des cours adaptés à votre niveau !</span>
    <div class="list-cards">
        <?php /** @var array $quizs */
        foreach ($quizs as $quiz): ?> 
            <div class="list-card">
                <div class="list-text">
                    <h2><a href="quiz/voir/<?= $quiz['slug'] ?>"><?= $quiz['category'] ?></a></h2>
                    <span class="ability">Votre niveau actuel : <b><?= $ability ?></b></span> 
                </div>
                <img class="list-img" src="//<?= HOST . '/' . FOLDER_ROOT ?>/assets/images/qcm.svg">
            </div>
        <?php endforeach ?>
    </div>
</div>