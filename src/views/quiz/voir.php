<?php
    $quizz = simplexml_load_file('http://'.HOST . '/' .FOLDER_ROOT.'/assets/xml/'.$quizs['linkXML']);
    $numberQuestions = 0;
?>
<div class="container">
    <h2>Quiz web</h2>
    <form action="http://localhost/DAW/quiz" method="post" class="quiz">
        <?php foreach($quizz->question as $question): $numberQuestions++;?>
            <div class="blockQuestion">
                <div class="question"><?='Question ' . $numberQuestions . " : " . $question->libelle?></div>
                <?php foreach($question->reponse as $reponse) :?>
                    <div class="reponse"><input required type="radio" name="<?= $question['numero']?>"
                    value="<?=$reponse['point']?>"><?=$reponse?></div>
                <?php endforeach?>
            </div>
        <?php endforeach ?>
        <input class="button-fill" type="submit" name="submit" value="Terminer le quiz">
    </form>
</div>

