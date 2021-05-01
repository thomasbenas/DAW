
<div class="container">
    <a href="../../quiz" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour aux quiz</span></a>
    <div class="quiz-title">
        <h2>Quiz <?= $quizs['category'] ?></h2>
        <button id="quiz-reset" class="button-fill button-qcm" name="resetQuiz"><a class="button-content" href="//<?= HOST . '/' .FOLDER_ROOT ?>/quiz/voir/<?= $quizs['slug'] ?>">Recommencer</a></button>
    </div>
    <div class="quiz-form">
        <?php require_once(ROOT.'src/forms/quiz/quizForm.php') ?>
        <?php require_once(ROOT.'src/forms/quiz/quizAction.php') ?> 
    </div>
</div>


