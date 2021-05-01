<div class="lists-grid">
        <?php /** @var array $courses */
        foreach ($quizs as $quiz): ?> 
            <div class="list-cours">
                <div class="list-text">
                    <h2><a href="quiz/voir/<?= $quiz['slug']?>"><?= $quiz['category'] ?></a></h2> 
                </div>
            </div>
        <?php endforeach ?>
    </div>