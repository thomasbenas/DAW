<?php
    $quizz = simplexml_load_file('http://'.HOST . '/' .FOLDER_ROOT.'/assets/xml/'.$quizs['linkXML']);
    $numberQuestions = 0;
?>

<form action="//<?= HOST . '/' . FOLDER_ROOT ?>/quiz/voir/<?= $quizs['slug']?>" method="post" class="quiz">
    <?php foreach($quizz->question as $question): $numberQuestions++;?>
        <div class="blockQuestion">
            <div class="question"><?='Question ' . $numberQuestions . " -- " . $question->libelle?></div>
            <?php foreach($question->reponse as $reponse) :?>
                <div class="reponse"><input class="check" type="radio" name="<?= "question".$numberQuestions?>" value="<?=$reponse['point']?>"><?=$reponse?></div>
            <?php endforeach?>
        </div>
    <?php endforeach ?>
    <button id="submit" class="button-fill button-qcm" type="submit" name="validerQuiz"><div class="button-content">Terminer le quiz</div></button>
</form>