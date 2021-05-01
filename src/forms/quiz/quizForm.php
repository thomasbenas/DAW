<?php
    $quizz = simplexml_load_file('http://'.HOST . '/' .FOLDER_ROOT.'/assets/xml/'.$quizs['linkXML']);
    $numberQuestions = 0;
?>

<form action="//<?= HOST . '/' . FOLDER_ROOT ?>/quiz/voir/<?= $quizs['slug']?>" method="post" class="quiz">
    <?php foreach($quizz->question as $question): $numberQuestions++;?>
        <div class="blockQuestion">
            <div class="question"><?='Question ' . $numberQuestions . " : " . $question->libelle?></div>
            <?php foreach($question->reponse as $reponse) :?>
                <div class="reponse"><input class="check" required type="radio" name="<?= $question['numero']?>" value="<?=$reponse['point']?>"><?=$reponse?></div>
            <?php endforeach?>
        </div>
    <?php endforeach ?>
    <input class="button-fill" type="submit" onclick="checkQuiz()" name="validerQuiz" value="Terminer le quiz">
</form>