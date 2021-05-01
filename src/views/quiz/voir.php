<?php
    $quizz = simplexml_load_file('http://'.HOST . '/' .FOLDER_ROOT.'/assets/xml/'.$quizs['linkXML']);
    $numberQuestions = 0;
?>
<div class="container">
    <h2>Quiz web</h2>
    <form action="http://localhost/DAW/quiz/voir/<?=$quizs['slug']?>" method="post" class="quiz">
        <?php foreach($quizz->question as $question): $numberQuestions++;?>
            <div class="blockQuestion">
                <div class="question"><?='Question ' . $numberQuestions . " : " . $question->libelle?></div>
                <?php foreach($question->reponse as $reponse) :?>
                    <div class="reponse"><input required type="radio" name="<?= $question['numero']?>"
                    value="<?=$reponse['point']?>"><?=$reponse?></div>
                <?php endforeach?>
            </div>
        <?php endforeach ?>
        <input class="button-fill" type="submit" name="validerQuiz" value="Terminer le quiz">
    </form>
    <?php 
    if(isset($_POST['validerQuiz']))
    {
        $total = 0;
        foreach ($_POST as $key => $value){
            if (isset($key) and $key != "validerQuiz"){
                    $total += $value;
            }
        }
        if ($total >= 0){
            echo "Votre score est de ".$total. ". Voici les bonnes réponses.";
        }else{
            echo "erreur";
        }
        echo '<script type="text/javascript">
        var reponses = document.getElementsByClassName("reponse");
        for (i = 0; i < reponses.length; i++) {
            if(reponses[i].value == 1){
                reponses[i].checked = true;
            }
          }
          </script>';
    } 
    ?>
</div>


